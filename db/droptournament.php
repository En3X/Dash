<?php
require './connection.php';
    if (isset($_GET['id'])) {
        $tid = $_GET['id'];
        $q = "delete from tournament where tid=$tid";
        $conn->query($q);
        header('location: ../index.php');
    }
?>