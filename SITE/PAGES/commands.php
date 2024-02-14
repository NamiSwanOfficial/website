<?php


$Informations = [];

//* Connexion a la BDD
if (!$connection) {
    //? Si la connexion n'a pas été effectuée
    die("Connection impossible");
} else {
    //? Connexion réussie

    $rowPDP = mysqli_fetch_assoc($requetePDP);
    $Informations['pdpbot'] = $rowPDP['URL'];
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "../STRUCTURES/head.php";
    echo '<link rel="icon" href="' . $Informations['pdpbot'] . '">';
    ?>
    <title>NamiSwan | Commands</title>
    <link rel="stylesheet" href="../CSS/all.css">
</head>

<body onload="loaderFunction()">

    <div id="loader">
        <div class="loading">
            <span></span>
        </div>
    </div>


    <div id="page">

        <?php
        include "../STRUCTURES/header.php";
        ?>

        <div class="container clear noselect">
            <div class="row wrapper">

                <span class="collapse" onclick="closeSidePanel()"><i class="fas fa-caret-left"></i></span>
                <span class="expand" onclick="openSidePanel()"><i class="fas fa-caret-right"></i></span>

                <div class="sidepanel">
                    <div class="divider left"></div>

                    <a class="title" href="#introduction">Introduction</a>
                    <a class="section" href="#aboutthisbot">About this Bot</a>
                    <a class="section" href="#technology">Technology</a>
                    <div class="divider left"></div>
                    <a class="title" href="#gettingstarted">Getting Started</a>
                    <a class="section" href="#addingthebot">Adding the Bot</a>
                    <div class="divider left"></div>
                    <a class="title" href="#commands">Commands</a>
                    <a class="section" href="#categories">Categories</a>
                    <a class="section" href="#sfw">SFW</a>
                    <a class="section" href="#nsfw">NSFW</a>
                    <div class="divider left"></div>
                    <a class="title" href="#moreinformation">More Information</a>
                    <div class="space double"></div>

                </div>

                <div class="right-col">
                    <h1 id="introduction">Introduction</h1>

                    <?php
                    echo '<p id="aboutthisbot">' . $Informations["descintro"] . '</p>';
                    ?>

                    <h2>About this Bot</h2>

                    <p id="technology">NamiSwan provides both SFW and NSFW functionality for social interactions or even more general commands for information or other.</p>

                    <h2>Technology</h2>

                    <p id="gettingstarted">The bot is built in Javascript using the discord.js library.<br><br>
                        The bot uses our own server to filter and deliver images to your server.</p>

                    <div class="divider" style="width:24%; margin:30px 0;"></div>

                    <h1>Getting Started</h1>

                    <p id="inbothelp">To get started with our bot is fairly easy and we have done our best to make it simpler for
                        you.</p>


                    <h2 id="addingthebot">Adding the bot</h2>

                    <?php
                    echo '<p id="commands">To add the bot to your server <a href="' . $Informations["invitationbot"] . '"target="_none">click
                            here.</a><br><br>This does needs you to either be the owner of the server or have "manage server"
                        permissions.</p>';
                    ?>

                    <div id="categories" class="divider" style="width:24%; margin:30px 0;">
                    </div>


                    <h1>Commands</h1>
                    <div>Syntax:
                        <ul>
                            <li><span class="codeBlock">
                                    /
                                </span> : Required Argument</li>
                        </ul>
                    </div>

                    <h2>Categories</h2>
                    <div>
                        <ul>
                            <li class="collapsible">Fun</li>
                            <div class="cmdCollapse">
                                Description: Allows you to ask a question to the BOT
                                <br>
                                Usage : <span class="codeBlock">/</span>
                                <br>
                                Example : <span class="codeBlock">/catcrystalball Am I the best bot ?</span>
                                <br>
                                Note: There are multiple answers.
                            </div>
                            <li class="collapsible">Informations</li>
                            <div class="cmdCollapse">
                                Description: Have the information of the mentioned members
                                <br>
                                Usage : <span class="codeBlock">/</span>
                                <br>
                                Example : <span class="codeBlock">/userinfo NamiSwan</span>
                            </div>
                            <li class="collapsible">Social</li>
                            <div class="cmdCollapse">
                                Description: Showing your emotions and feelings to someone or yourself
                                <br>
                                Usage : <span class="codeBlock">/</span>
                                <br>
                                Example : <span class="codeBlock">/blush</span>
                            </div>
                            <li class="collapsible">Games</li>
                            <div class="cmdCollapse">
                                Description : Have the conversion of robux to euro
                                <br>
                                Usage : <span class="codeBlock">/</span>
                                <br>
                                Example : <span class="codeBlock">/robux PHONE 10000</span>
                            </div>
                            <li class="collapsible">Credits</li>
                            <div class="cmdCollapse">
                                Description : Information about the support server
                                <br>
                                Usage : <span class="codeBlock">/</span>
                                <br>
                                Example : <span class="codeBlock">/supportservers</span>
                            </div>
                        </ul>
                    </div>

                    <h2>SFW</h2>
                    <ul>
                        <li>Syntax</li>
                        <div>
                            All the commands here have the same syntax : <span class="codeBlock">/help</span>
                            <br>
                            <br><br>
                        </div>
                        <li>Social : Image and action Commands</li>
                        <div> With action commands you can also mention users while executing the command.</div>
                        <div>
                            <ul>
                                <li><span class="codeBlock">blush</span></li>
                                <li><span class="codeBlock">cookie</span></li>
                                <li><span class="codeBlock">cry</span></li>
                                <li><span class="codeBlock">headpat</span></li>
                                <li><span class="codeBlock">hehe</span></li>
                                <li><span class="codeBlock">hi</span></li>
                                <li><span class="codeBlock">hide</span></li>
                                <li><span class="codeBlock">hug</span></li>
                                <li><span class="codeBlock">idk</span></li>
                                <li><span class="codeBlock">kiss</span></li>
                                <li><span class="codeBlock">laugh</span></li>
                                <li><span class="codeBlock">meme</span></li>
                                <li><span class="codeBlock">notlikethis</span></li>
                                <li><span class="codeBlock">party</span></li>
                                <li><span class="codeBlock">pout</span></li>
                                <li><span class="codeBlock">pray</span></li>
                                <li><span class="codeBlock">punch</span></li>
                                <li><span class="codeBlock">slap</span></li>
                                <li><span class="codeBlock">smile</span></li>
                                <li><span class="codeBlock">wink</span></li>
                                <li><span class="codeBlock">waifu</span></li>
                                <li><span class="codeBlock">neko</span></li>
                                <li><span class="codeBlock">shinobu</span></li>
                                <li><span class="codeBlock">megumin</span></li>
                                <li><span class="codeBlock">bully</span></li>
                                <li><span class="codeBlock">cuddle</span></li>
                                <li><span class="codeBlock">awoo</span></li>
                                <li><span class="codeBlock">lick</span></li>
                                <li><span class="codeBlock">pat</span></li>
                                <li><span class="codeBlock">smug</span></li>
                                <li><span class="codeBlock">bonk</span></li>
                                <li><span class="codeBlock">yeet</span></li>
                                <li><span class="codeBlock">wave</span></li>
                                <li><span class="codeBlock">highfive</span></li>
                                <li><span class="codeBlock">nom</span></li>
                                <li><span class="codeBlock">bite</span></li>
                                <li><span class="codeBlock">glomp</span></li>
                                <li><span class="codeBlock">kill</span></li>
                                <li><span class="codeBlock">happy</span></li>
                                <li><span class="codeBlock">poke</span></li>
                                <li><span class="codeBlock">dance</span></li>
                                <li><span class="codeBlock">cringe</span></li>

                            </ul>
                            <br>
                        </div>
                        <li>Fun Commands</li>
                        <ul>
                            <li><span class="codeBlock">catcrystalball</span></li>
                            <li><span class="codeBlock">dice</span></li>
                            <li><span class="codeBlock">choose</span></li>
                            <li><span class="codeBlock">love</span></li>
                        </ul>
                        <br>
                        <li>Informations Commands</li>
                        <div>
                            <ul>
                                <li><span class="codeBlock">help</span></li>
                                <li><span class="codeBlock">avatar</span></li>
                                <li><span class="codeBlock">banner</span></li>
                                <li><span class="codeBlock">ping</span></li>
                                <li><span class="codeBlock">servericon</span></li>
                                <li><span class="codeBlock">serverinfo</span></li>
                                <li><span class="codeBlock">whoiam</span></li>
                                <li><span class="codeBlock">userinfo</span></li>
                            </ul>

                            <br id="nsfw">
                    </ul>

                    <h2>Games</h2>
                    <ul>
                        <li>Commands</li>
                        <div>
                            <ul>
                                <li><span class="codeBlock">Roblox : robloxinfogroup</span></li>
                                <li><span class="codeBlock">Roblox : robloxclothinginfo</span></li>
                                <li><span class="codeBlock">Roblox : robloxrobux</span></li>
                                <li><span class="codeBlock">Roblox : robloxinfoplayer</span></li>
                                <li><span class="codeBlock">Roblox : robloxvaluemm2</span></li>
                                <li><span class="codeBlock">Genshin Impact : genshininfoplayer</span></li>
                                <li><span class="codeBlock">Minecraft : minecraftserverinfo</span></li>
                                <li><span class="codeBlock">Minecraft : minecraftplayerinfo</span></li>
                            </ul>
                            <br>
                        </div>
                    </ul>


                    <h2>Credits</h2>
                    <ul>
                        <li>Commands</li>
                        <div>
                            <ul>
                                <li><span class="codeBlock">supportservers</span></li>
                                <li><span class="codeBlock">invite</span></li>
                                <li><span class="codeBlock">website</span></li>
                                <li><span class="codeBlock">vote</span></li>
                            </ul>
                            <br>
                        </div>
                    </ul>

                    <h2>NSFW</h2>
                    <ul>
                        <li>Commands</li>
                        <div>
                            <ul>
                                <li><span class="codeBlock">nsfwwaifu</span></li>
                                <li><span class="codeBlock">nsfwneko</span></li>
                                <li><span class="codeBlock">nsfwtrap</span></li>
                                <li><span class="codeBlock">nsfwblowjob</span></li>
                            </ul>
                            <br>
                        </div>
                    </ul>
                    <div class="divider" style="width:24%; margin:30px 0;"></div>

                    <h1 id="moreinformation">More Information</h1>

                    <ul>
                        <?php
                        echo "<li>Present in : " . $Informations['nbreserv'] . "  servers</li>";
                        ?>

                    </ul>
                    <div class="doublespace"></div>
                    <div class="divider" style="width:24%; margin:30px 0;"></div>
                </div>
            </div>
        </div>
        <script src="../JS/all.js"></script>
</body>

</html>