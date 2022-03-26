<?php
    try {
        $mysqli = new mysqli('localhost','root','','dash');
        if (!$mysqli) {
            echo "Connection to database failed";
        }else{
            $name = $_POST['name'];
            $des=$_POST['des'];
            $gid = $_POST['game'];
            $status = $_POST['privacy'];
            $uid = $_POST['uid'];
            $day = $_POST['day'];
            $month=$_POST['month'];
            $hour = $_POST['hour'];
            $min = $_POST['min'];
            $sec = $_POST['sec'];

            // Query to insert the data
            $query = "INSERT into tournament(
                gid,name,description,status,month,day,hour,min,sec,uid
            ) values (
                '$gid','$name','$des','$status','$month',
                '$day','$hour','$min','$sec','$uid'
            )";

            if ($mysqli->query($query)) {
                echo "Hosted a new tournament";
            }else{
                echo "Tournament hosting failed";
            }
        }
    } catch (Exception $e) {
        echo "There was error trying to host tournament";
        echo $e->getmessage();
    }

?>