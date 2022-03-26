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
                    Recent Games
                </div>
                <div class="card-body">
                    <?php
                    $games = getGames($conn);
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
                    <div class="dis kmedium">
                        Coming Soon
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>

<?php

function getArticles($mysqli)
{
    $articles = array();
    $query = "select * from article order by id desc limit 4 ";
    if ($data=$mysqli->query($query)) {
        foreach ($data as $value) {
            $id = $value['id'];
            $title = $value['title'];
            $dis = $value['dis'];
            $article = new Article($id,$title,$dis);         
            array_push($articles,$article);
        }
        return $articles;
    }
}

function getGames($conn)
{
    $games = array();
    $query = "select * from games  limit 4";
    if ($data=$conn->query($query)) {
        foreach ($data as $value) {
            $gid = $value['gid'];
            $gname = $value['gname'];
            $distributor = $value['distributor'];
            $logo = $value['logopath'];
            $bg=$value['bgpath'];
            $newGame = new Game($gid,$gname,
            $distributor,$logo,$bg);
            array_push($games,$newGame);
        }
        return $games;
    }
}
function getTournaments($mysqli,$uid,$limit)
{
    $tournaments = array();
    $query = "select name from tournament where uid=$uid limit $limit";
    if ($data=$mysqli->query($query)) {
        if ($data->num_rows <= 0) {
            return array('Host tournament to see them here');
        }
        foreach ($data as $value) {
            $name = $value['name'];
            array_push($tournaments,$name);
        }
        return $tournaments;
    }
}

function getAllTournament($mysqli)
{
    $tournaments = array();
    $query = "select * from tournament";
    if ($data=$mysqli->query($query)) {
        foreach ($data as $value) {
            $tid = $value['tid'];
            $gid = $value['gid'];
            $uid = $value['uid'];
            $name = $value['name'];
            $dis = $value['description'];
            $status = $value['status'];
            $month = $value['month'];
            $day = $value['day'];
            $hour = $value['hour'];
            $min = $value['min'];
            $sec = $value['sec'];
            $t = new Tournament($tid,$gid,$uid,$name,
            $dis,$status,$month,$day,$hour,$min,$sec);
            array_push($tournaments,$t);
        }
        return $tournaments;
    }
}
?>