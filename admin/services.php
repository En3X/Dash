<?php
    require '../db/connection.php';
    function getNumUser($mysqli){
            $query = "SELECT * from users";
            if ($data=$mysqli->query($query)) {
                return $data->num_rows;
            }else {
                return 0;
            }
        }
    function getNumTournament($mysqli){
        $s = "select * from tournament";
        if ($t = $mysqli->query($s)) {
            return $t->num_rows;
        }else{
            return 0;
        }
    }


    function getNumOrder($conn){
        $sql = "Select * from purchaselog";
        if ($data = $conn->query($sql)) {
            return $data->num_rows;
        }else{
            return 0;
        }
    }

    
function getArticles($mysqli){
    $articles = array();
    $query = "select * from article";
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
function getTournaments($mysqli){
    $tournaments = array();
    $query = "select * from tournament";
    if ($data=$mysqli->query($query)) {
        foreach ($data as $value) {
            $name = $value['name'];
            $tid = $value['tid'];
            $gid = $value['gid'];
            $description = $value['description'];
            $status = $value['status'];
            $month = $value['month'];
            $day = $value['day'];
            $hour = $value['hour'];
            $min = $value['min'];
            $sec = $value['sec'];
            $uid = $value['uid'];
            $t = new Tournament($tid,$gid,$uid,$name,$description,$status
            ,$month,$day,$hour,$min,$sec);
            array_push($tournaments,$t);
        }
        return $tournaments;
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
?>