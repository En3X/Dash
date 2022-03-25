<?php
    require './entity.php';
    require './db/connection.php';
    session_start();
    $gameName;
    $gamebg;
    if (!isset($_SESSION['user'])) {
        header('location: ./login.php');
    }
?>


<?php
        $gameId = "";
        if (isset($_POST['gameId']) && isset($_POST['gameSubmit'])) {
            $gameId = $_POST['gameId'];
            $game = fetchGame($gameId,$conn);
        }else {
            ?>
<script>
function redirectToGame() {
    errinp = document.querySelector('#err');
    errbtn = document.querySelector('#senderr');
    errinp.value = "Please select game to start the tournament";
    errbtn.click();
}
redirectToGame();
</script>
<?php
        }
    ?>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="./css/tournament.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament Page</title>
</head>

<body>
    <!-- 
        This form is to redirect to gamepage with data
     -->

    <div id="userid" style="display:none">
        <?php echo unserialize($_SESSION['user'])->uid ?>
    </div>
    <form method="post" action="./gamepage.php" class="hide">
        <input type="text" name="error" id="err">
        <input type="submit" name="sendError" id="senderr">
    </form>

    <section class="container">
        <section class="form-section">
            <div class="aboutTournament">
                <div class="prefix" onclick="changePrivacy(this)">
                    <span id="privacy">
                        <span id="privacyStatus">Open</span> Tournament
                    </span>
                    <i class="fa fa-reload"></i>
                </div>
                <div id="tournament-name" class="nameOfTournament">
                    <span class="editablespan kbold" id="tourniename" contenteditable>
                        Tournament by <?php echo unserialize($_SESSION['user'])->name;?>
                    </span>
                    <!-- <i class="fa fa-pencil editable"></i> -->
                </div>
                <div class="tournament-des">
                    <span id="des" contenteditable class="editablespan kmedium">You can edit the name of the tournament,
                        description or even the date and time of tournament. When you are done, press <b>"Host
                            Tournament"</b> button to host the tournament.</span>
                    <!-- <i class="fa fa-pencil editable"></i> -->
                </div>
                <div class="tournamentDate">
                    <div class="dateCapsule">
                        <div contenteditable id="day" class="cmain mbold">25</div>
                        <div contenteditable id="month" class="csub mregular">Mar</div>
                    </div>
                    <div class="dateCapsule">
                        <div contenteditable id="hour" class="cmain mbold">09</div>
                        <div id="month" class="csub mregular">Hour</div>
                    </div>
                    <div class="dateCapsule">
                        <div contenteditable id="min" class="cmain mbold">00</div>
                        <div class="csub mregular">Min</div>
                    </div>
                    <div class="dateCapsule">
                        <div contenteditable id="sec" class="cmain mbold">00</div>
                        <div class="csub mregular">Sec</div>
                    </div>
                </div>
                <div style="display:none" id="game" class="kmedium">
                    <span id="gameid"><?php echo $game->id?></span>
                    . <?php getGameName()?>
                </div>
                <button id="host" class="saveTournament kmedium">
                    Host Tournament
                </button>
                <button onclick="window.location.href='./index.php'" class="saveTournament kmedium">
                    Cancel
                </button>
            </div>

            <div class="banner-img" style="background-image: url(
                                <?php echo getGameBg()?>
            );background-repeat: no-repeat;
            background-position: center;
                                background-size: 100%;"> </div>
        </section>
    </section>

    <!-- Code to check if the game is selected -->
</body>
<script src="./js/tournament.js"></script>

</html>

<?php
    function fetchGame($gid,$mysql)
    {
        $query = "Select * from games where gid=$gid";
        if ($data = $mysql->query($query)) {
            if ($data->num_rows <= 0) {
                ?>
<script>
console.log("No data in database with game id <?php echo $gid?>");
</script>
<?php
            }else{
                while ($gameData = $data->fetch_assoc()) {
                    $game = new Game(
                        $gameData['gid'],
                        $gameData['gname'],
                        $gameData['distributor'],
                        $gameData['logopath'],
                        $gameData['bgpath']
                    );
                }
                global $gameName;
                global $gamebg;
                $gamebg = $game->logo;
                $gameName=$game->name;
                return $game;
            }
        }else{
            ?>
<script>
console.log('Error fetching the data');
</script>
<?php
        }
    }
?>

<?php
    function getGameName()
    {
        global $gameName;
        echo $gameName;
    }

    function getGameBg(){
        global $gamebg;
        return $gamebg;
    }
?>