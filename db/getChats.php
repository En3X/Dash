<?php
    require './connection.php';

    if (isset($_POST['tournamentId'])) {
        $tid = $_POST['tournamentId'];
        $q = "Select * from tournamentcomment where tid=$tid";
        if ($data = $conn->query($q)) {
            if ($data->num_rows<1) {
                echo "
                <div class='message'>
                    <div class='sender dis kbold'>
                        No Chat Found
                    </div>
                    <div class='sender dis kregular'>
                        Start by chatting now
                    </div>
                <hr>
                ";
            }else{
                while ($chat = $data->fetch_assoc()) {
                    $chatmsg = $chat['msg'];
                    $sender = $chat['username'];
                    echo "
                        <div class='message'>
                            <div class='sender dis kbold'>
                                $sender
                            </div>
                            <div class='sender dis kregular'>
                                $chatmsg
                            </div>
                        <hr>
                ";
                }
            }
        }
    }


    if (isset($_POST['chatSent'])) {
        $chat = $_POST['chattext'];
        $sender = $_POST['sender'];
        $tid = $_POST['tid'];

        $q = "Insert into tournamentcomment(msg,username,tid) values('$chat','$sender',$tid)";
        if ($conn->query($q)) {
            echo "Chat sent through";
        }else{
            echo "Chat not sent";
        }
    }
?>