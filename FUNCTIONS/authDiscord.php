<?php
session_start();

require_once './fileEnv.php';

$client_id = getenv('DISCORD_CLIENT_ID');
$client_secret = getenv('DISCORD_CLIENT_SECRET');
$redirect_uri = getenv('REDIRECT_URI');


if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $url = 'https://discord.com/api/oauth2/token';
    $data = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => $redirect_uri
    ];

    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $response_data = json_decode($response, true);

    if (isset($response_data['access_token'])) {
        $_SESSION['access_token'] = $response_data['access_token'];
        header('Location: ../dashboard.php');
        exit();
    } else {
        // echo 'Error retrieving access token';
        header('Location: ../error.php');
        exit();
    }
} else {
    // echo 'Authorization code not received';
    header('Location: ../error.php');
    exit();
}
