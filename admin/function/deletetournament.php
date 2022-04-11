<?php
require '../../db/connection.php';
    if (!isset($_GET['id'])) {
        header('location: ../index.php?page=tournament');
    }else{
        $id = $_GET['id'];
        $q = "delete from tournament where tid=$id";
        $conn->query($q);
        header('location: location: ../index.php?page=tournament');
    }
?>