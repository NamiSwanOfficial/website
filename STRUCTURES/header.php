<?php
require_once './FUNCTIONS/fileEnv.php';
require_once './FUNCTIONS/discordData.php';

$connection = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));
$urlConnection = getenv('URLCO');
$Informations = [];
$maintenance;
$access_token = isset($_SESSION['access_token']) ? $_SESSION['access_token'] : '';
$user = $access_token ? get_discord_data('https://discord.com/api/users/@me', $access_token) : [];

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

    $requeteMaintenance = mysqli_query($connection, 'SELECT `value` FROM `variablesDiscord` WHERE `nom`= "Maintenance"');
    $rowMaintenance = mysqli_fetch_assoc($requeteMaintenance);
    $maintenance = $rowMaintenance;
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

                    if ($currentFileName === "index.php" || $currentFileName === "commands.php" || $currentFileName === "tos.php" || $currentFileName === "pp.php" || $currentFileName === "dashboard.php" || $currentFileName === "manage_bot.php" ||  $currentFileName === "error.php") {
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
                    <?php if (isset($_SESSION['access_token'])) : ?>
                        <li class="nav-item dropdown" style="position: relative; bottom: 5px;">
                            <a class="nav-link dropdown-toggle headerTxt" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://cdn.discordapp.com/avatars/<?php echo $user["id"] ?>/<?php echo $user["avatar"] ?>.webp?size=512" alt="Profile Picture" class="pfp">
                            </a>
                            <ul class="dropdown-menu dropdown_menuHD">
                                <li><a class="dropdown-item dropdown_itemHD headerTxt" href="./dashboard.php"><i class="fa-brands fa-discord me-2"></i> Dashboard</a></li>
                                <li><a class="dropdown-item dropdown_itemHD headerTxt" href="./logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link headerTxt" href="<?php echo $urlConnection ?>" target="_blank"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</section>

<?php if (!empty($maintenance["value"])) : ?>
    <section class="isMaintenance">
        <div class="messagedefilant">
            <div id="leMessDefilant" data-text="NamiSwan is a maintenance !"></div>
        </div>
    </section>
<?php endif ?>