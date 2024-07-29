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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NamiSwan | Privacy Policy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    include "./STRUCTURES/header.php";
    ?>

    <section class="privacy-policy mt-2">
        <div class="container" style="color: white;">
            <h1>Privacy Policy</h1>

            <p><strong>1. Introduction</strong></p>
            <p>Welcome to NamiSwan! We are committed to protecting your privacy. This Privacy Policy explains how we collect, use, and protect your information when you use our Discord bot.</p>

            <p><strong>2. Information We Collect</strong></p>
            <p>When you use NamiSwan, we collect the following types of information:</p>
            <ul>
                <li><strong>Automatically Collected Information:</strong> This includes your Discord user ID, username, and any messages you send to the bot.</li>
                <li><strong>Voluntarily Provided Information:</strong> Some features may require you to provide additional information, such as preferences or specific commands.</li>
            </ul>

            <p><strong>3. Use of Information</strong></p>
            <p>We use the collected information for the following purposes:</p>
            <ul>
                <li><strong>Bot Functionality:</strong> To respond to your commands and provide the features you request.</li>
                <li><strong>Service Improvement:</strong> To analyze trends and improve the quality of NamiSwan.</li>
                <li><strong>Customer Support:</strong> To assist you with any issues or inquiries regarding the bot.</li>
            </ul>

            <p><strong>4. Information Sharing</strong></p>
            <p>We do not share your personal information with third parties except in the following circumstances:</p>
            <ul>
                <li><strong>Legal Compliance:</strong> To comply with legal obligations or to protect the rights, safety, or property of NamiSwan.</li>
                <li><strong>Third-Party Services:</strong> We use third-party services to host and operate the bot, which may have access to some of your information under strict confidentiality agreements.</li>
            </ul>

            <p><strong>5. Security</strong></p>
            <p>We take reasonable measures to protect your information from unauthorized access, disclosure, alteration, or destruction. However, no method of transmission over the internet or electronic storage is completely secure, and we cannot guarantee absolute security.</p>

            <p><strong>6. Your Rights</strong></p>
            <p>You have the following rights regarding your personal information:</p>
            <ul>
                <li><strong>Access:</strong> You can request a copy of the information we hold about you.</li>
                <li><strong>Correction:</strong> You can request corrections to any inaccurate or incomplete information.</li>
                <li><strong>Deletion:</strong> You can request the deletion of your personal information, subject to certain legal conditions.</li>
            </ul>

            <p><strong>7. Changes to This Policy</strong></p>
            <p>We may update this Privacy Policy from time to time. Changes will be posted on our official website, and it is your responsibility to review this policy regularly. Continued use of NamiSwan after changes constitutes acceptance of the new policy.</p>

            <p><strong>8. Contact Us</strong></p>
            <p>If you have any questions or concerns about this Privacy Policy, please contact us at support@tsukizo.fr.</p>

            <p><strong>9. Governing Law</strong></p>
            <p>This Privacy Policy is governed by and construed in accordance with the laws of France. Any disputes arising out of or relating to this policy shall be resolved in the courts of France.</p>
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