<?php
session_start();

if (!isset($_SESSION['access_token'])) {
    header('Location: index.php');
    exit();
}

require_once './FUNCTIONS/fileEnv.php';
require_once './FUNCTIONS/discordData.php';

$access_token = $_SESSION['access_token'];
$user = get_discord_data('https://discord.com/api/users/@me', $access_token);
$guilds = get_discord_data('https://discord.com/api/users/@me/guilds', $access_token);
$connection = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));
$Informations = [];
$serverIdFromDatabase = [];

//* Connexion a la BDD
if (!$connection) {
    //? Si la connexion n'a pas été effectuée
    die("Connection impossible");
} else {
    //? Connexion réussie
    $requetePDP = mysqli_query($connection, 'SELECT `URL` FROM `liensSite` WHERE `NomURL` = "PDPDuBOT"');
    $rowPDP = mysqli_fetch_assoc($requetePDP);
    $Informations['pdpbot'] = $rowPDP['URL'];

    $requeteServ = mysqli_query($connection, 'SELECT `IDServeur` FROM `serveurDiscord`');
    while ($rowPDP = mysqli_fetch_assoc($requeteServ)) {
        $serverIdFromDatabase[] = $rowPDP['IDServeur'];
    };
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    echo '<link rel="icon" href="' . $Informations['pdpbot'] . '">';
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="TsuKiZo">
    <title>NamiSwan | Dashboard</title>
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
            <section class="guildsHome">
                <div class="container-fluid">
                    <div class="row" style="display: flex; flex-direction: column; align-content: center; justify-content: center; align-items: center;">
                        <div class="titleGuilds">
                            <p class="fs-1 h1 d-flex justify-content-center mt-5 mb-5" style="color: white !important;">Select a server</p>
                        </div>
                        <div class="search_barDash mb-3">
                            <input type="text" class="form-control" placeholder="Search" id="searchbarDash" onkeyup="searchBarDash()">
                        </div>
                        <div id="servers" class="grid d-flex" style="width: 70%; flex-wrap: wrap;">
                            <?php foreach ($guilds as $guild) : ?>
                                <?php foreach ($serverIdFromDatabase as $serverPlaceNami) : ?>
                                    <?php if ($guild['id'] === $serverPlaceNami) : ?>
                                        <div class='col-12 col-sm-4 col-md-3 col-lg-3'>
                                            <a href="manage_bot.php?server_id=<?php echo $guild['id']; ?>">
                                                <div class='cardServer m-2'>
                                                    <div class="banner">
                                                        <img src="<?php echo $guild['icon'] ? 'https://cdn.discordapp.com/icons/' . $guild['id'] . '/' . $guild['icon'] . '.png?size=64' : './IMG/MENAGE/noiconguilds.jpg'; ?>" alt="<?php echo $guild['name']; ?>" class="img-fluid rounded-full server-icon" width="70">
                                                        <?php if ($guild['owner'] == 1) : ?>
                                                            <img src="./IMG/MENAGE/ROLE/owner.png" alt="" class="img-fluid ownerCrown" title="Server Owner">
                                                        <?php elseif ($guild['permissions'] == 2147483647) : ?>
                                                            <img src="./IMG/MENAGE/ROLE/admin.png" alt="" class="img-fluid adminHat" title="Server Moderator / Administrator">
                                                        <?php endif; ?>
                                                        <?php if ($guild['banner']) : ?>
                                                            <img src="https://cdn.discordapp.com/banners/<?php echo $guild['id']; ?>/<?php echo $guild['banner']; ?>.png?size=2048" alt="Banner" class="img-fluid banner-img">
                                                        <?php else : ?>
                                                            <img src="./IMG/MENAGE/nobannerguilds.jpg" alt="Banner" class="img-fluid banner-img">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div>
                                                        <p class="textGuildName"><?php echo $guild['name']; ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <?php
    include "./STRUCTURES/footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./JS/index.js"></script>
</body>

</html>