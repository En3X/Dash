<?php 
    require './db/connection.php';
    require './entity.php';
    require './services.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="./img/logo.png/" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dash | Shop</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/shop.css">

</head>

<body>
    <?php include './partials/nav.php'?>
    <main>
        <section class="sidebar">
            <div class="card usercard">
                <div class="profile">
                    <div class="image">
                        <img src="./img/default.png" alt="">
                    </div>
                    <div class="text">
                        <div class="name kbold">
                            <?php echo $user->name ?>
                        </div>
                        <div class="email kregular">
                            <?php echo $user->email?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card gamecard">
                <div class="card-title">
                    Filters
                </div>
                <div class="card-body">
                    <div class="tab">
                        <div class="dis mb5 kmedium">
                            Search
                        </div>
                        <div class="gname searchbar kregular">
                            <input placeholder="Search for skin" name="searchterm" type="text">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <!-- Price selection -->
                    <div class="tab">
                        <div class="dis kmedium">
                            Price
                        </div>
                        <div class="pricerange">
                            <div class="priceInputGroup">
                                <i class="fa fa-usd"></i>
                                <input value="0" placeholder="0.0" type="text" class="klight">
                            </div>
                            -
                            <div class="priceInputGroup">
                                <i class="fa fa-usd"></i>

                                <input value="0" type="text" class="klight">
                            </div>
                        </div>
                    </div>
                    <!-- Game select -->
                    <div class="tab">
                        <div class="kmedium dis">
                            Select Game
                        </div>
                        <select name="game" class="gameSelect">
                            <?php
                                $games = getGames($conn,100);
                                foreach ($games as $game) {
                                    ?>
                            <option value="<?php echo $game->id?>"><?php echo $game->name?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <!-- buttons -->
                    <div class="tab">
                        <button class="saveTournament">
                            <i class="fa fa-filter"></i>
                            Filter Result
                        </button>
                    </div>
                </div>
            </div>

        </section>
        <section class="maincontent">

        </section>
    </main>
</body>

</html>