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
?>