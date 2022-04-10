<?php
    require './db/connection.php';
    function getNumUser($mysqli){
            $query = "SELECT * from users";
            if ($data=$mysqli->query($query)) {
                return $data->num_rows;
            }else {
                return 0;
            }
        }
        function getNumTournament($mysqli)
    {
        $s = "select * from tournament";
    if ($t = $mysqli->query($s)) {
        return $t->num_rows;
    }else{
        return 0;
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

function getGames($conn,$limit)
{
    $games = array();
    $query = "select * from games  limit $limit";
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

function getArticles($mysqli)
{
    $articles = array();
    $query = "select * from article order by id desc";
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

function getAllShopItems($conn){
    $q = "select * from shop";
    $items = array();
    if ($data=$conn->query($q)) {
        while ($row = $data->fetch_assoc()) {
            $i = new Item($row['itemid'],$row['gameid'],$row['name'],$row['price'],$row['img']);
            array_push($items,$i);
        }
        return $items;
    }
}

function refreshUser($conn,$uid,$bal){
    $q = "SELECT * from users where uid=$uid";
    if ($data = $conn->query($q)) {
        if ($data->num_rows == 1) {
            while ($row=$data->fetch_assoc()) {
                $name = $row['name'];
                $email = $row['email'];
                $pwd = $row['password'];
                $balance = $row['balance'];
            }
            $newBal = $bal + $balance;
            $update = "UPDATE users set balance = $newBal where uid=$uid";
            if ($conn->query($update)) {
                ?>
<script>
alert("Balance added successfully");
window.location.href = "./index.php";
</script>
<?php
            }else{
                ?>
<script>
alert("Could not add balance, please try again later");
window.location.href = "./index.php";
</script>
<?php
            }
        }
    }
}


function getFilteredItems($conn,$minprice,$maxprice,$gamesfilter){
    // echo "<script>alert('$gamesfilter')</script>";
    $q = "SELECT * FROM `shop` WHERE price between $minprice and $maxprice";
    if ($gamesfilter != 0) {
        $q = "select * from shop where price between $minprice and $maxprice and gameid=$gamesfilter";
    }
    $items = array();
    if ($data=$conn->query($q)) {
        while ($row = $data->fetch_assoc()) {
            $i = new Item($row['itemid'],$row['gameid'],$row['name'],$row['price'],$row['img']);
            array_push($items,$i);
        }
        return $items;
    }
}

function getItem($mysqli,$id){
    $q = "Select * from shop where itemid=$id";
    if ($data=$mysqli->query($q)) {
        if ($data->num_rows < 1) {
            return "404";
        }
        $item = "";
        while ($row = $data->fetch_assoc()) {
            $gid = $row['gameid'];
            $name = $row['name'];
            $price = $row['price'];
            $img = $row['img'];
            $item = new Item($id,$gid,$name,$price,$img);
            return $item;
        }
    }
}

function createPurchaseLog($conn,$i,$u){
    $sql = "insert into purchaselog(uid,username,itemid,itemname,price)
    values($u->uid,'$u->name',$i->id,'$i->name',$i->price)
    ";
    if ($conn->query($sql)) {
        return true;
    }else{
        return false;
    }
}
?>