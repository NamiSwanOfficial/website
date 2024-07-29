<?php
session_start();

require_once './FUNCTIONS/fileEnv.php';
require_once './FUNCTIONS/discordData.php';

$connection = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));
$Informations = [];

//* Connexion a la BDD
if (!$connection) {
    //? Si la connexion n'a pas été effectuée
    die("Connection impossible");
} else {
    //? Connexion réussie
    $requeteNom = mysqli_query($connection, 'SELECT `NomTexte` FROM `texteSite` WHERE `Utilite` = "NomDuBOT"');
    $rowNom = mysqli_fetch_assoc($requeteNom);
    $Informations['nom'] = $rowNom['NomTexte'];


    $requeteDesc = mysqli_query($connection, 'SELECT `NomTexte` FROM `texteSite` WHERE `Utilite` = "DescriptionDuBOT"');
    $rowDesc = mysqli_fetch_assoc($requeteDesc);
    $Informations['description'] = $rowDesc['NomTexte'];


    $requeteInvBOT = mysqli_query($connection, 'SELECT `URL` FROM `liensSite` WHERE `NomURL` = "InvitationBOT"');
    $rowInvBOT = mysqli_fetch_assoc($requeteInvBOT);
    $Informations['invitationbot'] = $rowInvBOT['URL'];


    $requetePDP = mysqli_query($connection, 'SELECT `URL` FROM `liensSite` WHERE `NomURL` = "PDPDuBOT"');
    $rowPDP = mysqli_fetch_assoc($requetePDP);
    $Informations['pdpbot'] = $rowPDP['URL'];


    $requeteInvServ = mysqli_query($connection, 'SELECT `URL` FROM `liensSite` WHERE `NomURL` = "InvitationServeurSupport"');
    $rowInvServ = mysqli_fetch_assoc($requeteInvServ);
    $Informations['invitationserv'] = $rowInvServ['URL'];


    $requeteDescIntro = mysqli_query($connection, 'SELECT `NomTexte` FROM `texteSite` WHERE `Utilite` =  "DescriptionIntro"');
    $rowDescIntro = mysqli_fetch_assoc($requeteDescIntro);
    $Informations['descintro'] = $rowDescIntro['NomTexte'];
}
?>

<html lang="en">

<head>
    <?php
    echo '<link rel="icon" href="' . $Informations['pdpbot'] . '">';
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="TsuKiZo">
    <title>NamiSwan | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    include "./STRUCTURES/header.php";
    ?>
    <section class="bot mt-5 mb-5">
        <div class="container d-flex justify-content-center">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <?php
                    echo '<img id="botLogo" class="noselect" src="' . $Informations['pdpbot'] . '" alt="botLogo">';
                    ?>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <?php
                    echo '<h1 class="title mt-2 ms-1">' . $Informations['nom'] . '</h1>';
                    ?>
                </div>
                <div class="col-12 d-flex justify-content-center mb-3">
                    <?php
                    echo '<p class="subtitle mt-3">' . $Informations['description'] . '</p>';
                    ?>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <?php
                    echo '<a class="btn btn-primary me-2 add btn-lg" style="color:black;" href="' . $Informations['invitationbot'] . '" target="_blank" role="button"><i class="fab fa-discord"></i> Add to server</a>';
                    ?>
                    <a class="btn btn-secondary ms-2 cmds btn-lg" href="./commands.php" style="color: white;" role="button"><i class="far fa-list-alt"></i> Commands</a>
                </div>
                <div class="col-12 d-flex justify-content-center mt-5">
                    <div class="topGG">
                        <a href="https://top.gg/bot/1098965395999825963">
                            <img src="https://top.gg/api/widget/1098965395999825963.svg" alt="NamiSwan">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include "./STRUCTURES/footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./JS/index.js"></script>
</body>

</html>