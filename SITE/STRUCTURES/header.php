<?php
// session_start();


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


    $rowNbreServ = mysqli_fetch_assoc($requeteNbreServeur);
    $Informations['nbreserv'] = $rowNbreServ['NomTexte'];
}
?>
<nav>
    <div class="logo noselect">
        <?php
        echo '<img class="noselect" src="' . $Informations['pdpbot'] . '">' . $Informations['nom'];
        ?>
    </div>

    <div class="openMenu noselect"><i class="fa fa-bars"></i></div>
    <ul class="mainMenu noselect">
        <li><a class="active" href="../../index.php"><i class="fas fa-home"></i> Home</a></li>

        <?php
        $currentFileName = basename($_SERVER['PHP_SELF']);

        if ($currentFileName === "index.php") {
            $linkToCommands = "./SITE/PAGES/commands.php";
            echo '<li><a href="' . $linkToCommands . '"><i class="far fa-list-alt"></i> Commands</a></li>';
        } else if ($currentFileName === "commands.php") {
            $linkToCommands = "./commands.php";
            echo '<li><a href="' . $linkToCommands . '"><i class="far fa-list-alt"></i> Commands</a></li>';
        }
        echo '<li><a href="https://' . $Informations['invitationserv'] . '" target="_blank"><i class="fas fa-headset"></i> Support</a></li>';
        ?>
        <div class="closeMenu noselect"><i class="fa fa-times"></i></div>
    </ul>
</nav>