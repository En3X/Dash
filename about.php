<?php
    require './db/connection.php';
    require './entity.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Dash</title>
</head>

<body>
    <div class="container">
        <?php include './partials/nav-about.php'?>
        <section class="main">
            <section class="first">
                <div class="title">
                    Create Events or join one made by other
                </div>
                <div class="subtitle">
                    Here, players around the globe can host or join tournaments. Need a safe place to shop for your
                    game? We got you covered in that as well!
                </div>
                <div class="buttons kregular">
                    <button class="primary" onclick="window.location.href='./login.php'">
                        Login Now
                    </button>
                    <button class="success" onclick="window.location.href='./signup.php'">
                        Create Account
                    </button>
                </div>
            </section>

            <section class="second">
                <img src="./img/agents.png" alt="">
            </section>
        </section>

        <section id="intro" class="introduction">
            <div class="text">
                <div class="intro kbold">
                    Who are we?
                </div>
                <div class="subintro kmedium">
                    We are <b>Dash</b>. A web based application for gamers. We have list of games for which you can host
                    your own tournament. In addition to that, there are other lovely players from around the world who
                    would love to host tournament for you. You can meet players, join tournament and bring the trophy
                    home!
                    <br>
                    We provide you with following features:
                    <br>
                    <ul class="kregular advantages">
                        <li>Attractive yet simple to use UI</li>
                        <li>Safe and secure, you have nothing to worry about</li>
                        <li>Platform to host your own game or join others' tournament</li>
                        <li>Need a skin or ingamme currency? We got that covereed too</li>
                        <li>Well what else do you need as a gamer???</li>
                    </ul>
                    If you haven't yet, join us now!
                    <div class="buttons kregular">
                        <button class="primary" onclick="window.location.href='./login.php'">
                            Login Now
                        </button>
                        <button class="success" onclick="window.location.href='./signup.php'">
                            Create Account
                        </button>
                    </div>
                </div>
            </div>
            <div class="img">
                <img src="./img/snapshot/main_page.png" alt="Logo image">
            </div>
        </section>

        <center>
            <div class="h200">
                <section id="process" class="process">
                    <div class="process-group">
                        <i class="fa fa-user-plus"></i>
                        <div>
                            <div class="topic">Join</div>
                            <div class="des">
                                Become part of the family. It just takes few seconds.
                            </div>
                        </div>
                    </div>
                    <div class="process-group">
                        <i class="fa fa-gamepad"></i>
                        <div>
                            <div class="topic">Host</div>
                            <div class="des">
                                Host tournament for game of your choice. Other's will like to join!
                            </div>
                        </div>
                    </div>
                    <div class="process-group">
                        <i class="fa fa-shopping-cart"></i>
                        <div>
                            <div class="topic">Shop</div>
                            <div class="des">
                                Need something? We might have it in our store.
                            </div>
                        </div>
                    </div>
                    <div class="process-group">
                        <i class="fa fa-star"></i>
                        <div>
                            <div class="topic">Recommend</div>
                            <div class="des">
                                Have friends who game? They might likeee us too
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </center>
    </div>

    <div id="btt" onclick="backToTop()" class="stt">
        <i class="fa fa-angle-right"></i>
    </div>
</body>
<script src="./js/about.js"></script>

</html>