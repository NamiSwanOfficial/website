<?php
session_start();


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
    include './STRUCTURES/head.php';
    echo '<link rel="icon" href="' . $Informations['pdpbot'] . '">';
    ?>
    <meta name="description" content="NamiSwan is a powerful, multifunctional Discord bot with plenty of controls for all tastes !">
    <title>NamiSwan | Home</title>
    <link rel="stylesheet" href="./CSS/all.css">
</head>

<body>

    <?php
    include "./home.php";
    ?>
    <script src="./JS/all.js"></script>
</body>

</html>