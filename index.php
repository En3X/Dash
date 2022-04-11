<?php
    require('./entity.php');
    require('./services.php');
    session_start();

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dash</title>
        <link rel="stylesheet" href="./css/index.css">
    </head>

    <body>
        <?php include './partials/nav.php'?>
        <main>
            <section class="sidebar">
                <?php include './partials/usercard.php'?>

                <div class="card gamecard">
                    <div class="card-title">
                        Recent Games
                    </div>
                    <div class="card-body">
                        <?php
                    $games = getGames($conn,4);
                    foreach ($games as $game) {
                        ?>
                        <div class="tab">
                            <div class="gname kmedium">
                                <?php echo $game->id.". ".$game->name?>
                            </div>
                            <div class="dis kregular">
                                <?php echo $game->dis ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>
                <div class="card tournamentcard">
                    <div class="card-title">
                        Your Tournaments
                    </div>
                    <div class="card-body">
                        <?php
                        $tournament = getTournaments($conn,$user->uid,5);
                        $count = 0;
                        foreach ($tournament as $t) {
                            ++$count;
                            echo " <div class='dis mt10 kmedium'>$count. $t</div>";
                        }
                    ?>
                    </div>
                </div>

            </section>
            <section class="maincontent">
                <?php include './partials/featured.php' ?>

                <div class="card">
                    <div class="card-title">
                        Tournaments
                    </div>
                    <div class="card-body kmedium tournamentlist">
                        <div class="row">
                            <span>SN.</span>
                            <span>Name</span>
                            <span>Date & Time</span>
                            <span>Members</span>
                            <span>Status</span>
                        </div>
                        <?php
                            $ts = getAllTournament($conn);
                            $count = 0;
                            foreach ($ts as $t) {
                                $count++;
                               ?>
                        <div class="row">
                            <span>
                                <?php echo $count?>
                            </span>
                            <span>
                                <?php echo $t->name?>
                            </span>
                            <span>
                                <?php echo $t->day." ".$t->month.", ".$t->hour.":".$t->min.":".$t->sec;?>
                            </span>
                            <span>0</span>
                            <span>
                                <?php echo $t->status?>
                            </span>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </section>
            <section class="sidebar sidebar-end">
                <div class="card teams">
                    <div class="card-title">
                        Teams
                    </div>
                    <div class="dis kmedium">
                        Coming Soon
                    </div>

                </div>
                <div class="card article">
                    <div class="card-title">
                        Articles
                    </div>

                    <div class="card-body">
                        <?php
                    $articles = getArticles($conn);

                    $tempCount = 0;
                    foreach ($articles as $article) {
                        $tempCount++;
                        ?>
                        <div class="tab">
                            <div class="gname kmedium">
                                <?php echo $tempCount.". ". $article->title?>
                            </div>
                            <div class="dis kregular">
                                <?php echo $article->dis?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>
                <div class="card shopcard">
                    <div class="card-title">
                        Marketplace
                    </div>
                    <div class="card-body">
                        <div class="dis kregular">
                            Featured items
                        </div>
                        <div class="row">
                            <div class="item" onclick="window.location.href='./shop.php'">
                                <img src="./shop/img/fade.png" alt="">
                            </div>
                            <div class="item" onclick="window.location.href='./shop.php'">
                                <img src="./shop/img/emeralddragonp90.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>

</html>

<?php

?>