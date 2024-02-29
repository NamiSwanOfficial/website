<?php


$Informations = [];

//* Connexion a la BDD
if (!$connection) {
    //? Si la connexion n'a pas été effectuée
    die("Connection impossible");
} else {
    //? Connexion réussie
    $requeteNom = mysqli_query($connection, 'SELECT `NomTexte` FROM `Texte` WHERE `Utilite` = "NomDuBOT"');
    $rowNom = mysqli_fetch_assoc($requeteNom);
    $Informations['nom'] = $rowNom['NomTexte'];


    $requeteDesc = mysqli_query($connection, 'SELECT `NomTexte` FROM `Texte` WHERE `Utilite` = "DescriptionDuBOT"');
    $rowDesc = mysqli_fetch_assoc($requeteDesc);
    $Informations['description'] = $rowDesc['NomTexte'];


    $requeteInvBOT = mysqli_query($connection, 'SELECT `URL` FROM `Liens` WHERE `NomURL` = "InvitationBOT"');
    $rowInvBOT = mysqli_fetch_assoc($requeteInvBOT);
    $Informations['invitationbot'] = $rowInvBOT['URL'];


    $requetePDP = mysqli_query($connection, 'SELECT `URL` FROM `Liens` WHERE `NomURL` = "PDPDuBOT"');
    $rowPDP = mysqli_fetch_assoc($requetePDP);
    $Informations['pdpbot'] = $rowPDP['URL'];


    $requeteInvServ = mysqli_query($connection, 'SELECT `URL` FROM `Liens` WHERE `NomURL` = "InvitationServeurSupport"');
    $rowInvServ = mysqli_fetch_assoc($requeteInvServ);
    $Informations['invitationserv'] = $rowInvServ['URL'];


    $requeteDescIntro = mysqli_query($connection, 'SELECT `NomTexte` FROM `Texte` WHERE `Utilite` =  "DescriptionIntro"');
    $rowDescIntro = mysqli_fetch_assoc($requeteDescIntro);
    $Informations['descintro'] = $rowDescIntro['NomTexte'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <?php
    include "./STRUCTURES/head.php";
    echo '<link rel="icon" href="' . $Informations['pdpbot'] . '">';
    ?>
    <title>NamiSwan | Home</title>
    <!--<link rel="stylesheet" href="../CSS/all.css">-->
</head>

<body onload="loaderFunction()">

    <div id="loader">
        <div class="loading">
            <span></span>
        </div>
    </div>

    <div id="page">
        <?php
        include "./STRUCTURES/header.php";
        ?>

        <div class="content noselect">
            <div class="heading text-center">
                <?php
                echo '<img id="botLogo" class="noselect" src="' . $Informations['pdpbot'] . '" alt="botLogo">';
                echo '<h1 class="title">' . $Informations['nom'] . '</h1>';
                echo '<p class="subtitle">' . $Informations['description'] . '</p>';
                echo "<br>";
                echo '<a class="btn btn-primary" style="color:black;" href="' . $Informations['invitationbot'] . '"target="_none" role="button"><i class="fab fa-discord"></i> Add to server</a>';
                ?>
                <a class="btn btn-secondary" href="./commands.php" style="color: white;" role="button"><i class="far fa-list-alt"></i>
                    Commands</a>
                <div class="topGG">
                    <a href="https://top.gg/bot/1098965395999825963">
                        <img src="https://top.gg/api/widget/1098965395999825963.svg" alt="NamiSwan">
                    </a>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!--<script src="../JS/all.js"></script>-->
</body>

</html>