<?php
require '../../db/connection.php';
    if (!isset($_GET['id'])) {
        header('location: ../index.php?page=articles');
    }else{
        $id = $_GET['id'];
        $q = "delete from article where id=$id";
        $conn->query($q);
        header('location: ../index.php');
    }
?>