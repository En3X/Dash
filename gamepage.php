<?php
    require './db/connection.php';
    require './entity/Game.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./css/game.css">
    <title>Game Page</title>
</head>

<body>
    <?php include './partials/alert.php'?>
    <?php
        if (isset($_POST['error']) && isset($_POST['sendError'])) {
            // Send from tournament page so show error
            $error = $_POST['error'];
            ?>
    <script>
    alert = document.querySelector('#alert');
    document.querySelector('#alertmsg')
        .textContent = "<?php echo $error?>";
    alert.classList.remove('hide');
    setTimeout(() => {
        alert.classList.add('hide');
    }, 3000);
    </script>
    <?php
        }
    ?>
    <div class="container">
        <h2 class="title">
            Available Games
        </h2>
        <div class="grid-wrapper">
            <?php
                try {
                    $games = fetchGames($conn);
                    foreach ($games as $game) {
                        ?>
            <div class="game-card" style="
                                background-image: url('<?php echo $game->bg?>');
                            " onclick="goToTournament('<?php echo $game->id?>')">
                <img class="cardImg" src="<?php echo $game->logo?>" alt="Game Logo">
            </div>
            <?php
                    }
                } catch (Exception $e) {
                    echo 'Error: '. $e->getMessage();
                }
            ?>
        </div>
    </div>
    <form action="./tournamentpage.php" method="post" style="display:none">
        <input type="hidden" name="gameId" id="gameid">
        <input type="submit" name="gameSubmit" id="go" value="">
    </form>
</body>

</html>
<script src="./js/game.js"></script>
<?php
    function fetchGames($mysqli){
        $query = "SELECT * FROM games";
        if ($data = $mysqli->query($query)) {
            if ($data->num_rows <= 0 ) {
                throw new Exception("No data in database table");
            }else{
                $gameList = array();
                while ($game = $data->fetch_assoc()) {
                    $gameObject = new Game($game['gid'],$game['gname']
                    ,$game['distributor'],$game['logopath'],$game['bgpath']);
                    array_push($gameList,$gameObject);
                }
                return $gameList;
            }
        }else {
            throw new Exception("Error fetching the data", 1);
        }
    }
?>