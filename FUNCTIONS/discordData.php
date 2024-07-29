<?php
function get_discord_data($url, $token)
{
    $options = [
        'http' => [
            'header' => "Authorization: Bearer $token",
            'method' => 'GET',
            'ignore_errors' => true
        ]
    ];
    
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        $error = error_get_last();
        echo 'Erreur lors de l\'appel API : ' . $error['message'];
        return null; 
    }


    $headers = $http_response_header;
    $voirNbreRequet = false;

    if ($voirNbreRequet === true && $headers) {
        foreach ($headers as $header) {
            if (stripos($header, 'X-RateLimit-Limit') !== false) {
                echo "Limit: " . $header . "<br>";
            } elseif (stripos($header, 'X-RateLimit-Remaining') !== false) {
                echo "Remaining: " . $header . "<br>";
            } elseif (stripos($header, 'X-RateLimit-Reset') !== false) {
                echo "Reset: " . $header . "<br>";
            }
        }
    }

    return json_decode($response, true);
}
