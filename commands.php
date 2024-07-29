<?php
session_start();
require_once './FUNCTIONS/fileEnv.php';
require_once './FUNCTIONS/discordData.php';

$connection = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));
$Informations = [];
$commands = [];
$categories = [];

if (!$connection) {
    //? Si la connexion n'a pas été effectuée
    die("Connection impossible");
} else {
    //? Connexion réussie
    $requetePDP = mysqli_query($connection, 'SELECT `URL` FROM `liensSite` WHERE `NomURL` = "PDPDuBOT"');
    $rowPDP = mysqli_fetch_assoc($requetePDP);
    $Informations['pdpbot'] = $rowPDP['URL'];

    $requeteCMD = mysqli_query($connection, 'SELECT * FROM `commandesDiscord`');
    if ($requeteCMD) {
        while ($row = mysqli_fetch_assoc($requeteCMD)) {
            array_push($commands, $row);
        }
    } else {
        echo "Erreur dans la requête SQL : " . mysqli_error($connection);
    }

    foreach ($commands as $cmd) {
        $categories[$cmd['categorie']][] = $cmd;
    }
}
$connection->close();
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
    <title>NamiSwan | Commands</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <?php
    include "./STRUCTURES/header.php";
    ?>

    <section class="commands">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2"></div>
                <nav class="col-md-3 col-lg-2 d-md-block sidebar mt-5">
                    <div class="sidebar-sticky">
                        <a href="#" class="active">Slash</a>
                        <h6 class="sidebar-heading mt-4 textWhite">Categories</h6>
                        <a href="#" data-category="all">All</a>
                        <a href="#" data-category="infos">Informations</a>
                        <a href="#" data-category="fun">Fun</a>
                        <a href="#" data-category="social1">Social 1/2</a>
                        <a href="#" data-category="social2">Social 2/2</a>
                        <a href="#" data-category="games">Games</a>
                        <a href="#" data-category="credits">Credits</a>
                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-7 px-md-4 mt-5">
                    <div class="search-bar mb-3">
                        <input type="text" class="form-control" placeholder="Search" id="searchbarCmds" onkeyup="searchBarCmds()">
                    </div>
                    <div class="command-list" style="overflow: auto; height:547px;">
                        <?php foreach ($commands as $cmd) : ?>
                            <?php if (isset($cmd['sousCategorie']) && !empty($cmd['sousCategorie'])) : ?>
                                <div class="command-item with-subcategory" data-category="<?php echo htmlspecialchars($cmd['categorie']); ?>" data-subcategory="<?php echo htmlspecialchars($cmd['sousCategorie']); ?>">
                                    <h5>/<?php echo htmlspecialchars($cmd['categorie']); ?> <?php echo htmlspecialchars($cmd['sousCategorie']); ?> <?php echo htmlspecialchars($cmd['nom']); ?></h5>
                                    <p><?php echo htmlspecialchars($cmd['description']); ?></p>
                                </div>
                            <?php else : ?>
                                <div class="command-item" data-category="<?php echo htmlspecialchars($cmd['categorie']); ?>">
                                    <h5>/<?php echo htmlspecialchars($cmd['categorie']); ?> <?php echo htmlspecialchars($cmd['nom']); ?></h5>
                                    <p><?php echo htmlspecialchars($cmd['description']); ?></p>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </main>
                <div class="col-5"></div>
            </div>
        </div>
    </section>

    <?php
    include "./STRUCTURES/footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <script src="./JS/index.js"></script>
</body>

</html>