<?php
session_start();
require_once './FUNCTIONS/fileEnv.php';
require_once './FUNCTIONS/discordData.php';

$connection = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));
$Informations = [];

//* Connexion a la BDD
if (!$connection) {
    //? Si la connexion n'a pas été effectuée
    die("Connection impossible");
} else {
    //? Connexion réussie

    $requetePDP = mysqli_query($connection, 'SELECT `URL` FROM `liensSite` WHERE `NomURL` = "PDPDuBOT"');
    $rowPDP = mysqli_fetch_assoc($requetePDP);
    $Informations['pdpbot'] = $rowPDP['URL'];
}
?>

<html lang="en">

<head>
    <?php
    echo '<link rel="icon" href="' . $Informations['pdpbot'] . '">';
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NamiSwan | Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    include "./STRUCTURES/header.php";
    ?>

    <section class="errorPage">
        <div class="wrapper">
            <div class="container mt-5" style="display: flex; flex-direction: column; flex-wrap: nowrap; align-content: center; justify-content: center; align-items: center;">
                <div class="row mt-5" style="display: flex; flex-direction: column;">
                    <div class="col-12 mt-5" style=" display: flex; justify-content: center;">
                        <img src="./IMG/ERROR/error.png" alt="Error !" width="200" class="img-fluid">
                    </div>
                    <div class="col-12 mt-4">
                        <p class="h1" style="color: white;">An error occured !</p>
                    </div>
                </div>
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