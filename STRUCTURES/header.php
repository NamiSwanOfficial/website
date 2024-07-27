<?php
// session_start();
require_once 'load_env.php';

try {
    loadEnv(__DIR__ . '/.env');
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

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

    $requeteNbreServeur = mysqli_query($connection, 'SELECT `NomTexte` FROM `texteSite` WHERE `Utilite` =  "NombreServeurs"');
    $rowNbreServ = mysqli_fetch_assoc($requeteNbreServeur);
    $Informations['nbreserv'] = $rowNbreServ['NomTexte'];
}
?>

<section class="leHeader">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand ms-4 d-flex align-items-center" href="https://namiswan.tsukizo.fr/" style="color: orange; font-family: 'Pacifico', sans-serif; font-size: 30px;">
                <img src="<?php echo $Informations['pdpbot']; ?>" alt="NamiSwan" class="logo">
                <span style="margin-left: 10px;"><?php echo $Informations['nom']; ?></span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation" style="background: orange !important;">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo01">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active headerTxt" aria-current="page" href="./index.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <?php
                    $currentFileName = basename($_SERVER['PHP_SELF']);

                    if ($currentFileName === "index.php" || $currentFileName === "commands.php" || $currentFileName === "tos.php" || $currentFileName === "pp.php") {
                        $linkToCommands = "./commands.php";
                        echo '<li class="nav-item"><a class="nav-link headerTxt" href="' . $linkToCommands . '"><i class="far fa-list-alt"></i> Commands</a></li>';
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link headerTxt" href="https://github.com/NamiSwanOfficial" target="_blank"><i class="fa fa-folder"></i> Project</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link headerTxt" href="<?php echo $Informations['invitationserv']; ?>" target="_blank"><i class="fas fa-headset"></i> Support</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>