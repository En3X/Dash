<?php
    if (isset($_POST['title']) && isset($_POST['des'])) {
        http_response_code(200);
        $t = $_POST['title'];
        $d = $_POST['des'];
        $mysqli = new mysqli('localhost','root','','dash');
        $query = "insert into article(title,dis) values('$t','$d')";

        if ($mysqli->query($query)) {
            echo "Insertion of article successful";
        }else{
            echo "Insertion failed!";
        }
    }else{
        http_response_code(400);
    }
?>