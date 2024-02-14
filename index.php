<?php
session_start();


$Informations = [];

//* Connexion a la BDD
if (!$connection) {
    //? Si la connexion n'a pas été effectuée
    die("Connection impossible");
} else {
    //? Connexion réussie

    $rowNom = mysqli_fetch_assoc($requeteNom);
    $Informations['nom'] = $rowNom['NomTexte'];



    $rowDesc = mysqli_fetch_assoc($requeteDesc);
    $Informations['description'] = $rowDesc['NomTexte'];



    $rowInvBOT = mysqli_fetch_assoc($requeteInvBOT);
    $Informations['invitationbot'] = $rowInvBOT['URL'];



    $rowPDP = mysqli_fetch_assoc($requetePDP);
    $Informations['pdpbot'] = $rowPDP['URL'];



    $rowInvServ = mysqli_fetch_assoc($requeteInvServ);
    $Informations['invitationserv'] = $rowInvServ['URL'];



    $rowDescIntro = mysqli_fetch_assoc($requeteDescIntro);
    $Informations['descintro'] = $rowDescIntro['NomTexte'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <?php
    include "./SITE/STRUCTURES/head.php";
    echo '<link rel="icon" href="' . $Informations['pdpbot'] . '">';
    ?>
    <meta name="description" content="NamiSwan - Discord BOT">
    <title>NamiSwan</title>
    <link rel="stylesheet" href="./SITE/CSS/all.css">
</head>

<body>

    <?php
    include "./SITE/PAGES/home.php";
    ?>
    <script src="./SITE/JS/all.js"></script>
</body>

</html>