<?php
// session_start();


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

    $requeteNbreServeur = mysqli_query($connection, 'SELECT `NomTexte` FROM `Texte` WHERE `Utilite` =  "NombreServeurs"');
    $rowNbreServ = mysqli_fetch_assoc($requeteNbreServeur);
    $Informations['nbreserv'] = $rowNbreServ['NomTexte'];
}
?>
<nav>
    <div class="logo noselect">
        <?php
        echo "<a href='https://namiswan.tsukizo.fr/'>";
        echo '<img class="noselect" alt="NamiSwan" src="' . $Informations['pdpbot'] . '">' . $Informations['nom'];
        echo "</a>"
        ?>
    </div>

    <div class="openMenu noselect"><i class="fa fa-bars"></i></div>
    <ul class="mainMenu noselect">
        <li><a class="active" href="./index.php"><i class="fas fa-home"></i> Home</a></li>

        <?php
        $currentFileName = basename($_SERVER['PHP_SELF']);

        if ($currentFileName === "index.php") {
            $linkToCommands = "./commands.php";
            echo '<li><a href="' . $linkToCommands . '"><i class="far fa-list-alt"></i> Commands</a></li>';
        } else if ($currentFileName === "commands.php") {
            $linkToCommands = "./commands.php";
            echo '<li><a href="' . $linkToCommands . '"><i class="far fa-list-alt"></i> Commands</a></li>';
        }
        echo '<li><a class="active" href="https://github.com/NamiSwanOfficial" target="_blank"><i class="fa fa-folder"></i> Project</a></li>';
        echo '<li><a href="https://' . $Informations['invitationserv'] . '" target="_blank"><i class="fas fa-headset"></i> Support</a></li>';
        ?>
        <div class="closeMenu noselect"><i class="fa fa-times"></i></div>
    </ul>
</nav>