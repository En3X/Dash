<?php
    require './db/connection.php';
    require './entity.php';
    require './services.php';
    session_start();
    $tournament;$featured;
    function idGiven(){
        global $conn;
        global $tournament;
        global $featured;
        if (isset($_GET['id'])) {
            $tournament = getTournamentById($conn,$_GET['id']);
            $featured=$tournament;
            return true;
        }
        return false;
    }
    function isEnded($conn,$tournament){
        $checkEnd = "Select * from tournamentwinner where tid=$tournament->tid";
        if ($data = $conn->query($checkEnd)) {
            if ($data->num_rows > 0) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
?>

<?php
    if (isset($_POST['winner'])) {
        if (idGiven()) {
            if (!isEnded($conn,$tournament)) {
                $changeStatus = "update tournament set ended=1 where tid=$tournament->tid";
                if ($conn->query($changeStatus)) {
                    $winner = $_POST['winner'];
                    $winnerQuery = "Insert into tournamentwinner values($tournament->tid,$winner)";
                    $conn->query($winnerQuery);
                }
            }
        }
        unset($_POST['winner']);
    }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/index.css">
        <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="./css/tournamentdetail.css">

        <title>
            <?php 
                if (idGiven()) {
                    if ($tournament!="404") {
                        echo $tournament->name;
                    }else{
                        echo "404 Tournament Not Found";
                    }
                }
            ?>
        </title>
    </head>

    <body>


        <?php include './partials/nav.php'?>
        <main>
            <section class="sidebar">
                <?php include './partials/usercard.php'?>

                <div class="commentcard">
                    <div class="card-title">
                        Chat with members
                    </div>
                    <div id="chats" class="commentdisplay">
                        <div class="message">
                            <div class="sender dis kbold">
                                Fetching Chats Now
                            </div>
                            <div class="sender dis kregular">
                                Please wait, connecting to chat servers
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="commentinput">
                        <input id="chatnow" placeholder="Chat with other members" type="text" name="" id="">
                    </div>
                </div>
            </section>
            <section class="maincontent">
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
                        <!-- <form action="#" method="post">
                            <input type="hidden" value=1 name="join">
                            <button type="submit" id="host" class="saveTournament kmedium">
                                Join Tournament
                                <i class="fa fa-plus"></i>
                            </button>
                        </form> -->

                        <?php
                            if ($user->uid != $tournament->uid) {
                                if ($user->hasJoinedTournament($conn,$tournament->tid)) {
                                    ?>
                        <form action="#" method="post">
                            <input type="hidden" value=1 name="unjoin">
                            <button type="submit" id="host" class="joinedbtn kmedium">
                                <i class="fa fa-check"></i>
                                Joined
                            </button>
                        </form>
                        <?php
                                }else{
                                    ?>
                        <form action="#" method="post">
                            <input type="hidden" value=1 name="join">
                            <button type="submit" id="host" class="saveTournament kmedium">
                                <i class="fa fa-plus"></i>
                                Join tournament
                            </button>
                        </form>
                        <?php
                                }
                            }else{
                                if (!isEnded($conn,$tournament)) {
                                    ?>
                        <div class="buttons">
                            <button
                                onclick="window.location.href='./db/droptournament.php?id=<?php echo $tournament->tid?>'"
                                type="submit" id="host" class="saveTournament kmedium">
                                Drop Tournament
                            </button>
                            <button onclick="showEndModal()" type="submit" id="host" class="saveTournament kmedium">
                                End Tournament
                            </button>
                        </div>
                        <?php
                                }else{
                                   echo '<div class="card-title">Tournament Ended</div>';
                                }
                                
                            }
                        ?>
                    </div>
                    <div class="banner-img" style="
                        background: url(<?php echo fetchBanner($conn,$featured)?>);
                        background-repeat: no-repeat;
                        background-size: 100%;
                    ">
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">
                        Other Tournaments
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
                <div class="card memberslist">
                    <div class="card-title">
                        Members
                    </div>
                    <div class="card-body">
                        <?php
                            $q = "Select * from tournamentmembers where tid=$tournament->tid";
                            if ($data=$conn->query($q)) {
                                if ($data->num_rows > 0) {
                                    while ($row=$data->fetch_assoc()) {
                                        echo "<div class='dis kregular tab'>".$row['username']."</div>";
                                    }
                                }else{
                                    echo "<div class='dis kregular tab'>No members found</div>";
                                }
                            }
                        ?>
                    </div>
                </div>
            </section>
        </main>
        <div class="popup" id="endpopup">
            <div class="popupwrapper">
                <div class="popupheader kbold">
                    <span>
                        <span id="purchasestatus">
                            End Tournament
                        </span>
                    </span>
                    <i onclick="hideEndModal()" style="cursor:pointer" id="close-update-modal" class="fa fa-times"></i>
                </div>
                <div id="purchasemsg" class="popupbody kregular">
                    You are about to end the tournament. Please select the winner of the tournament
                </div>
                <form action="#" method="post">
                    <div class="popupbody searchbar kregular">
                        <select class="winnerSelector kbold" name="winner">
                            <option disabled> - Select Winner - </option>
                            <?php
                                $q = "Select * from tournamentmembers where tid=$tournament->tid";
                                if ($data=$conn->query($q)) {
                                    if ($data->num_rows > 0) {
                                        while ($row=$data->fetch_assoc()) {
                                            $userid = $row['uid'];
                                            $name = $row['username'];
                                            echo "
                                                <option value = $userid>$name</option>
                                            ";
                                        }
                                    }else{
                                        echo "<option>No Tournament Members</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="popupbutton">
                        <button type="submit" class="btn success kbold">
                            Continue
                        </button>
                        <button onclick="hideEndModal()" type="button" id="cancel" class="btn secondary kbold">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <input type="hidden" id="tournamentId" value="<?php echo $tournament->tid?>">
        <input type="hidden" id="username" value="<?php echo $user->name?>">
    </body>
    <script src="./js/chat.js"></script>
    <script src="./js/userpage.js"></script>

</html>

<!-- Join and unjoin -->
<?php
    if (isset($_POST['join'])) {
        $head=$body="";
        if (!($user->hasJoinedTournament($conn,$tournament->tid))) {
            if ($tournament->status == "Open") {
                $query = "Insert into tournamentmembers values($tournament->tid,$user->uid,'$user->name')";
                if ($conn->query($query)) {
                    unset($_POST['join']);
                    $head = "Tournament Joined";
                    $body = "You successfully joined the tournament. Please Make sure to play on it at time. Enjoy.";
                }
            }else{
                $head = "Joining Failed";
                $body = "You cannot join the tournament because the tournament is private and only invited person can join the tournament. If you think this is mistake, please contact the host.";
            }
        }else{
            $head = "Tournament Already Joined";
                    $body = "You are already the member of this tournament. If you think this is by mistake, you can unjoin the tournament. Or try refreshing the page and come back to it later.";
        }
        ?>
<div id="successpopup" class="popup">
    <div class="popupwrapper">
        <div class="popupheader kbold">
            <span>
                <span id="purchasestatus">
                    <?php echo $head?>
                </span>
            </span>
            <i style="cursor:pointer" onclick="window.location.href='./index.php'" id="close-modal"
                class="fa fa-times"></i>
        </div>
        <div id="purchasemsg" class="popupbody kregular">
            <?php echo $body ?>
        </div>
        <div class="popupbutton">
            <button onclick="window.location.href='./index.php'" class="btn success kbold">
                OK
            </button>
        </div>
    </div>
</div>
<?php
    }
    if (isset($_POST['unjoin'])) {
        if ($user->hasJoinedTournament($conn,$tournament->tid)) {
            $query = "Delete from tournamentmembers where tid = $tournament->tid and uid=$user->uid";
                if ($conn->query($query)) {
                    unset($_POST['unjoin']);
                    $head = "Tournament left";
                    $body = "You left the tournament. If you wish to comment on the tournament and interract, please join it again.";
                }else{
                    $head = "Action Failed";
                    $body = "sorry! We could not complete your action. This was not your fault but an issue from our side.";
                }
        }else{
            $head = "Action Failed";
            $body = "To leave the tournament, you have to be a member of it. You are no longer the member of this tournament.";
        }
        ?>
<div id="successpopup" class="popup">
    <div class="popupwrapper">
        <div class="popupheader kbold">
            <span>
                <span id="purchasestatus">
                    <?php echo $head?>
                </span>
            </span>
            <i style="cursor:pointer" onclick="window.location.href='./index.php'" id="close-modal"
                class="fa fa-times"></i>
        </div>
        <div id="purchasemsg" class="popupbody kregular">
            <?php echo $body ?>
        </div>
        <div class="popupbutton">
            <button onclick="window.location.href='./index.php'" class="btn success kbold">
                OK
            </button>
            <button onclick="window.location.href='./topup.php'" class="btn secondary kbold">
                Topup balance
            </button>
        </div>
    </div>
</div>
<?php
    }
?>

<?php
function fetchBanner($mysqli,$featured){
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