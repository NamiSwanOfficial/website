<?php
session_start();

require_once './FUNCTIONS/fileEnv.php';
require_once './FUNCTIONS/discordData.php';

if (!isset($_SESSION['access_token'])) {
    header('Location: index.php');
    exit();
}

$access_token = $_SESSION['access_token'];
$server_id = $_GET['server_id'] ?? null;
$user = get_discord_data('https://discord.com/api/users/@me', $access_token);
$guilds = get_discord_data('https://discord.com/api/users/@me/guilds', $access_token);
$guildsDrop = get_discord_data('https://discord.com/api/users/@me/guilds', $access_token);
// test('https://discord.com/api/users/@me/guilds/' . $server_id, $access_token);
$Informations = [];
$serverDetails = [];
$dropMenu = [];
$serverBDD = [];
$serverIdFromDatabase = [];
$connection = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));

if (!$server_id) {
    die('Server ID is required.');
}

if (!$connection) {
    die("Connection impossible");
}

foreach ($guilds as $serv) {
    if ($serv["id"] === $server_id) {
        $serverDetails = $serv;
    }
}

//* Connexion a la BDD
$requetePDP = mysqli_query($connection, 'SELECT `URL` FROM `liensSite` WHERE `NomURL` = "PDPDuBOT"');
$rowPDP = mysqli_fetch_assoc($requetePDP);
$Informations['pdpbot'] = $rowPDP['URL'];

$requeteBDDServer = mysqli_query($connection, 'SELECT `langue`, `idChannelDefault` FROM `serveurDiscord` WHERE `IDServeur` =' .  $server_id);
$rowSBDD = mysqli_fetch_assoc($requeteBDDServer);
$serverBDD = $rowSBDD;


$requeteServ = mysqli_query($connection, 'SELECT `IDServeur` FROM `serveurDiscord`');
while ($rowPDP = mysqli_fetch_assoc($requeteServ)) {
    $serverIdFromDatabase[] = $rowPDP['IDServeur'];
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="TsuKiZo">
    <?php
    echo '<link rel="icon" href="' . $Informations['pdpbot'] . '">';
    ?>
    <title>NamiSwan | Main</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    include "./STRUCTURES/header.php";
    ?>

    <div class="wrapper">
        <main class="content">
            <section class="manage">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-2"></div>
                        <nav class="col-md-3 col-lg-2 col-sm-3 d-md-block sidebarMNG mt-5">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle btn-lg dropMenuManageServ" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%;">
                                    <img class="serverDrop" src="<?php echo $serverDetails['icon'] ? 'https://cdn.discordapp.com/icons/' . $serverDetails['id'] . '/' . $serverDetails['icon'] . '.png?size=64' : './IMG/noiconguilds.jpg'; ?>" class="img-fluid" width="20"> <?php echo $serverDetails['name']; ?>
                                </button>
                                <ul class="dropdown-menu dropdown_menuMNG" id="serverList">
                                    <?php foreach ($guilds as $guild) : ?>
                                        <?php foreach ($serverIdFromDatabase as $serverPlaceNami) : ?>
                                            <?php if ($guild['id'] === $serverPlaceNami) : ?>
                                                <li>
                                                    <a class='dropdown-item dropdownSepare dropdown_itemServ' id="serverChoose" href="manage_bot.php?server_id=<?php echo $guild['id']; ?>">
                                                        <img class="serverDrop" src="<?php echo $guild['icon'] ? 'https://cdn.discordapp.com/icons/' . $guild['id'] . '/' . $guild['icon'] . '.png?size=64' : './IMG/noiconguilds.jpg'; ?>" class="img-fluid" width="20">
                                                        <?php echo htmlspecialchars($guild['name']); ?>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="sidebar-sticky">
                                <h6 class="sidebar-heading mt-4 textWhite">Categories</h6>
                                <a href="#" class="active" data-category="main">Main</a>
                                <a href="#" data-category="setting" class="category-hidden">Settings</a>
                                <a href="#">Looking to add ...</a>
                            </div>
                        </nav>
                        <div class="col-md-9 col-lg-7 col-sm-9 px-md-4 mt-5 ms-2 signCmd">
                            <div class="infoServer">
                                <div class="col-12 col-md-12 col-sm-12 imgServ mt-3">
                                    <img data-category="main" src="<?php echo $serverDetails['icon'] ? 'https://cdn.discordapp.com/icons/' . $serverDetails['id'] . '/' . $serverDetails['icon'] . '.png?size=64' : './IMG/noiconguilds.jpg'; ?>" class="img-fluid imgServManage" width="200">
                                </div>
                                <div class="col-12 col-md-12 col-sm-12 mt-2 ms-2">
                                    <p data-category="main" class="h1 textServ"><?php echo $serverDetails['name']; ?></p>
                                    <p data-category="main" class="h5 textServ">Server ID : <?php echo $serverDetails['id']; ?></p>
                                </div>
                            </div>
                            <div class="listCmd mt-5">
                                <div class="col-12">
                                    <p data-category="main" class="h3">Categories</p>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="col-12 col-sm-4 col-md-3 col-lg-3">
                                        <a href="#" id="settingsLink" data-category="main">
                                            <div class="cardManage">
                                                <div class="col-12 textCardCmd">
                                                    <i data-category="main" class="fa-solid fa-gear h1"></i>
                                                </div>
                                                <div class="col-12 textCardCmd mt-2">
                                                    <p data-category="main" class="h5">Settings</p>
                                                </div>
                                                <div class="col-12 textCardCmd mt-2">
                                                    <p data-category="main" class="textDescription">Allows you to change the general settings of NamiSwan on your server</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="category-hidden" id="textSett" data-category="setting">
                                        Settings</p>
                                </div>
                                <div class="col-12 mt-3" data-category="setting" class="category-hidden" id="language">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <form action="./FUNCTIONS/update_language.php" method="POST">
                                            <div class="dropdown">
                                                <p>Languages</p>
                                                <button class="btn btn-secondary dropdown-toggle dropMenuManage" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <?php
                                                    $langue = $serverBDD["langue"];
                                                    $langueDisplay = $langue === "fr-FR" ? "Français" : ($langue === "en-US" ? "English" : ($langue === "es-ES" ? "Español" : $langue));
                                                    echo '<img src="./IMG/MENAGE/LANGUE/' . $langue . '.png" class="mb-0 me-2" data-value="' . $langue . '" width="20">' . $langueDisplay;
                                                    ?>
                                                </button>
                                                <ul class="dropdown-menu dropdown_menuMNGLangue" id="valueLangue">
                                                    <li class="dropdown-item firstList dropdown_itemMNG" data-value="fr-FR"><img src="./IMG/MENAGE/LANGUE/fr-FR.png" class="" width="20"> Français</li>
                                                    <li class="dropdown-item dropdownSepare dropdown_itemMNG" data-value="es-ES"><img src="./IMG/MENAGE/LANGUE/es-ES.png" class="" width="20"> Español</li>
                                                    <li class="dropdown-item dropdownSepare lastList dropdown_itemMNG" data-value="en-US"><img src="./IMG/MENAGE/LANGUE/en-US.png" class="" width="20"> English</li>
                                                </ul>
                                            </div>
                                            <input type="hidden" name="langue" id="selectedLangue" value="<?php echo $langue; ?>">
                                            <input type="hidden" name="server_id" value="<?php echo $server_id; ?>">
                                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="separation"></div>
                                <!-- <div class="col-12 mt-3" data-category="setting" class="category-hidden" id="default">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div>
                                            <form>
                                                <div class="mb-3">
                                                    <label for="default" class="form-label">Default Channel</label>
                                                    <input type="email" class="form-control" id="default" aria-describedby="forChannelDefault">
                                                    <div id="forChannelDefault" class="form-text">We'll never share your email with anyone else.</div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-5"></div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <?php
    include "./STRUCTURES/footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="./JS/index.js"></script>
</body>

</html>