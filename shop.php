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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>

    <body>
        <?php include './partials/nav.php'?>
        <main>
            <section class="sidebar">
                <?php include './partials/usercard.php'?>
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
                                <input placeholder="Search for skin" id="search" name="searchterm" type="text">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                        <form action="#" method="get">
                            <!-- Price selection -->
                            <div class="tab">
                                <div class="dis kmedium">
                                    Price
                                </div>
                                <div class="pricerange">
                                    <div class="priceInputGroup">
                                        <i class="fa fa-usd"></i>
                                        <input id="minprice" name="minprice" placeholder="0" type="number"
                                            class="klight">
                                    </div>
                                    -
                                    <div class="priceInputGroup">
                                        <i class="fa fa-usd"></i>

                                        <input id="maxprice" name="maxprice" placeholder="&infin;" type="number"
                                            class="klight">
                                    </div>
                                </div>
                            </div>
                            <!-- Game select -->
                            <div class="tab">
                                <div class="kmedium dis">
                                    Select Game
                                </div>
                                <select name="game" class="gameSelect">
                                    <option value="0">All Games</option>
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
                            <input type="hidden" name="filters" value=1>
                            <!-- buttons -->
                            <div class="buttonsgroup tab">
                                <button class="saveTournament">
                                    Filter
                                </button>
                                <?php
                                if (isset($_GET['filters'])) {?>
                                <button type="button" onclick="window.location.href='./shop.php'"
                                    class="saveTournament secondary">
                                    Reset
                                </button>
                                <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>

            </section>
            <section id="shopsection" class="shopSection">
                <?php
                $shopItems = "";
                    if (isset($_GET['filters'])) {
                        $minprice = $maxprice = $gamesfilter = "";
                        if (!isset($_GET['minprice']) || $_GET['minprice'] == "") {
                            $minprice = 0;
                        }else{
                            $minprice = $_GET['minprice'];
                        }
                        if (!isset($_GET['maxprice']) || $_GET['maxprice'] == "") {
                            $maxprice = 9999999999999999999999999;
                        }else{
                            $maxprice = $_GET['maxprice'];
                        }
                        
                        if (!isset($_GET['game']) || $_GET['game'] == "") {
                            $gamesfilter = 0;
                        }else{
                            $gamesfilter = $_GET['game'];
                        }
                        $shopItems = getFilteredItems($conn,$minprice,$maxprice,$gamesfilter);
                    }else{
                        $shopItems = getAllShopItems($conn);
                    }
                    foreach ($shopItems as $item) {
                        ?>
                <div class="shoppingcard" onclick="window.location.href='./itempage.php?itemid=<?php echo $item->id?>'">
                    <div class="img">
                        <img src="./shop/img/<?php echo $item->img?>" alt="">
                    </div>
                    <div class="itemdesc" onclick="window.location.href='./itempage.php?itemid=<?php echo $item->id?>'">
                        <div class="wrapper">
                            <div>
                                <div class="gametag klight">
                                    <?php print_r($item->getGameName($conn))?>
                                </div>
                                <div id="itemname" class="itemname kbold">
                                    <?php echo $item->name?>
                                </div>
                                <div class="price klight">
                                    $ <span class="itemprice"> <?php echo $item->price?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>

            </section>
        </main>
    </body>
    <script src="./js/shop.js"></script>
    <?php
        if (isset($_GET['filters'])) {
            ?>
    <script>
    $('#minprice').val(<?php echo $minprice?>);
    $('#maxprice').val(<?php echo $maxprice?>);
    </script>
    <?php
        }
    ?>

</html>