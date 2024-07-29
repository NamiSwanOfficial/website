<?php

require_once './fileEnv.php';
$connection = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));

if (!$connection) {
    //? Si la connexion n'a pas été effectuée
    die("Connection impossible");
} else {
    function updateLanguage($newLangue, $serverId, $connection)
    {
        $newLangue = mysqli_real_escape_string($connection, $newLangue);
        $serverId = (int)$serverId;

        if (!empty($newLangue) && in_array($newLangue, ['fr-FR', 'en-US', 'es-ES'])) {
            $query = "UPDATE serveurDiscord SET langue = '$newLangue' WHERE IDServeur = $serverId";

            if (mysqli_query($connection, $query)) {
                header('Location: ../manage_bot.php?server_id=' . $serverId);
                exit();
            } else {
                return "Erreur lors de la mise à jour de la langue : " . mysqli_error($connection);
                header('Location: ../error.php');
                exit();
            }
        } else {
            // return "Langue non valide.";
            header('Location: ../error.php');
            exit();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newLangue = $_POST['langue'];
    $serverId = $_POST['server_id'];

    $result = updateLanguage($newLangue, $serverId, $connection);
    echo $result;
}
