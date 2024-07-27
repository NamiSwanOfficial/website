<?php
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
    <title>NamiSwan | Terms of Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/style.css">
</head>

<body>
    <?php
    include "./STRUCTURES/header.php";
    ?>

    <section class="tos mt-2">
        <div class="container" style="color: white;">
            <h1>Terms of Service</h1>
            <p><strong>1. Acceptance of Terms</strong></p>
            <p>By adding NamiSwan to your Discord server, you agree to these Terms of Service ("Terms") and Privacy Policy. If you do not agree to these Terms, do not add or use NamiSwan.</p>

            <p><strong>2. Description of Service</strong></p>
            <p>NamiSwan is a Discord bot offering various commands including general, image interactions, information, and games. The bot can be added to your Discord server and used by server members according to the permissions set by the server owner.</p>

            <p><strong>3. User Conduct</strong></p>
            <p>You agree to use NamiSwan in compliance with all applicable laws and regulations. You will not use NamiSwan for any unlawful or harmful activities, including but not limited to:</p>
            <ul>
                <li>Spamming commands</li>
                <li>Distributing malicious content</li>
                <li>Harassing or threatening other users</li>
                <li>Uploading or sharing NSFW content in channels not designated for such content</li>
            </ul>

            <p><strong>4. Bot Commands and Categories</strong></p>
            <p>NamiSwan offers various command categories:</p>
            <ul>
                <li><strong>Fun:</strong> Includes commands like `/catcrystalball`, `/dice`, etc.</li>
                <li><strong>Information:</strong> Commands to fetch user or server info like `/userinfo`, `/serverinfo`, etc.</li>
                <li><strong>Social:</strong> Commands to express emotions like `/hug`, `/kiss`, etc.</li>
                <li><strong>Games:</strong> Commands related to games like Roblox, Genshin Impact, and Minecraft.</li>
                <li><strong>NSFW:</strong> Restricted commands that should be used in designated NSFW channels only.</li>
            </ul>

            <p><strong>5. Privacy and Data Collection</strong></p>
            <p>NamiSwan collects and stores data necessary to perform its functions. This includes user IDs, server IDs, and command usage statistics. This data is used to improve the bot's performance and user experience. We do not share your data with third parties without your consent, except as required by law.</p>

            <p><strong>6. Changes to Terms</strong></p>
            <p>We reserve the right to modify these Terms at any time. Changes will be posted on our official website, and it is your responsibility to review these Terms regularly. Continued use of NamiSwan after any changes constitutes acceptance of the new Terms.</p>

            <p><strong>7. Termination</strong></p>
            <p>We reserve the right to terminate or suspend your access to NamiSwan at our sole discretion, without notice, for conduct that we believe violates these Terms or is harmful to others.</p>

            <p><strong>8. Disclaimer of Warranties</strong></p>
            <p>NamiSwan is provided "as is" and "as available" without warranties of any kind. We do not guarantee that NamiSwan will be error-free or uninterrupted.</p>

            <p><strong>9. Limitation of Liability</strong></p>
            <p>In no event shall NamiSwan, its developers, or affiliates be liable for any indirect, incidental, special, or consequential damages arising out of the use or inability to use NamiSwan.</p>

            <p><strong>10. Contact Information</strong></p>
            <p>If you have any questions about these Terms, please contact us at support@tsukizo.fr.</p>

            <p><strong>11. Governing Law</strong></p>
            <p>These Terms are governed by and construed in accordance with the laws of France. Any disputes arising out of or relating to these Terms shall be resolved in the courts of France.</p>
        </div>
    </section>

    <?php
    include "./STRUCTURES/footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
</body>

</html>