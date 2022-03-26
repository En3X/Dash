<?php
    require_once './db/connection.php';
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
    <title>List of tournament</title>
    <link rel="stylesheet" href="./css/tournamentlist.css">
</head>

<body>
    <?php include './partials/nav.php' ?>
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
            <?php
                $tournaments = getAllTournament($conn);
            ?>
            <?php
                foreach ($tournaments as $featured) {?>
            <div class="card featuredcard">
                <div class="textsection">
                    <div class="tournamentstatus kmedium">
                        <?php 
                            echo $featured->status." Tournament";
                        ?>
                    </div>
                    <div class="tournamentName mbold">
                        <?php echo $featured->name?>
                    </div>
                    <div class="description mregular">
                        <?php echo $featured->dis?>
                    </div>
                    <div class="tournamentDate">
                        <div class="dateCapsule">
                            <div id="day" class="cmain mbold">
                                <?php echo $featured->day;?>
                            </div>
                            <div id="month" class="csub mregular">
                                <?php echo $featured->month;?>
                            </div>
                        </div>
                        <div class="dateCapsule">
                            <div id="hour" class="cmain mbold">
                                <?php echo $featured->hour;?>
                            </div>
                            <div id="month" class="csub mregular">Hour</div>
                        </div>
                        <div class="dateCapsule">
                            <div id="min" class="cmain mbold">
                                <?php echo $featured->min;?>
                            </div>
                            <div class="csub mregular">Min</div>
                        </div>
                        <div class="dateCapsule">
                            <div id="sec" class="cmain mbold">
                                <?php echo $featured->sec;?>
                            </div>
                            <div class="csub mregular">Sec</div>
                        </div>
                    </div>
                    <button id="host" class="saveTournament kmedium">
                        Join Tournament
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
                <div class="banner-img" style="
                        background: url(<?php echo fetchBanner($conn,$featured)?>);
                         background-repeat: no-repeat;
                        background-size: 100%;
                ">
                </div>
            </div>
            <?php
                }
            ?>

        </section>
    </main>
</body>

</html>

<?php
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

function fetchBanner($mysqli,$featured)
    {
        $gid = $featured->gid;
        $query = "
            select logopath from games where gid=$gid
        ";
        if ($path = $mysqli->query($query)) {
            while ($data = $path->fetch_assoc()) {
                return $data['logopath'];
            }
        }
        $src="./img/404.jpg";
        return $src;
    }
?>