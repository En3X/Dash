<?php
    require './entity.php';
    require './db/connection.php';
?>
<html lang="en">
<head>
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
     <form method="post" action="./gamepage.php" class="hide">
         <input type="text" name="error" id="err">
         <input type="submit" name="sendError" id="senderr">
     </form>
    <?php
        $gameId = "";
        if (isset($_POST['gameId']) && isset($_POST['gameSubmit'])) {
            $gameId = $_POST['gameId'];
            $game = fetchGame($gameId,$conn);
            echo $game->name;
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
</body>
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