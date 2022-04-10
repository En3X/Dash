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
        function getNumTournament($mysqli)
    {
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
?>