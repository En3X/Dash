<?php
if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
}else{
    header('location: ./about.php');
}
?>

<link rel="stylesheet" href="./css/nav.css">
<nav>
    <div class="firstSection">
        <div class="logo">
            <img src="./img/logo.png" alt="">
        </div>
        <div class="navlist">
            <div onclick="window.location.href='./index.php'" class="item-group kbold">
                <i class="fa fa-home"></i> Home
            </div>
            <div onclick="window.location.href='./tournamentlist.php'" class="item-group kbold">
                <i class="fa fa-gamepad"></i> Tournaments
            </div>
            <div class="item-group kbold">
                <i class="fa fa-shopping-cart"></i> Shop
            </div>

            <div onclick="window.location.href='./about.php'" class=" item-group kbold">
                <i class="fa fa-info"></i> About
            </div>

        </div>
        <div class="iconsection">
            <div class="icon-group" onclick="window.location.href='./gamepage.php'">
                <i class="fa fa-plus"></i>
            </div>
            <div class="icon-group">
                <i class="fa fa-bell"></i>
            </div>
            <div class="icon-group" onclick="window.location.href='./logout.php'">
                <i class="fa fa-sign-out"></i>
            </div>
        </div>
    </div>

    <div class="usersection">
        <div class="pp">
            <img src="./img/default.png" alt="">
        </div>
        <div class="username kbold">
            <?php 
                    $name = $user->name;
                    $firstname = explode(" ",$name)[0];
                    echo $firstname;
                ?>
        </div>
    </div>
</nav>