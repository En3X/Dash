<?php
    require './db/connection.php';
    require './entity.php';
    session_start();
    if (isset($_SESSION['user'])) {
        $user = unserialize($_SESSION['user']);
        if(isset($_POST['userid'])){
            $sql = "delete from users where uid = $user->uid";
            if ($conn->query($sql)) {
                $deleteTournament = "delete from tournament where uid=$user->uid";
                $conn->query($deleteTournament);
                header('location:./logout.php');
            }
        }else{
            header('location: ./index.php');
        }
    }else{
        header('location: ./index.php');
    }
?>