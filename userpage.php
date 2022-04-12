<?php
    require('./entity.php');
    require('./services.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="./css/index.css">
        <link rel="stylesheet" href="./css/userpage.css">
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

        <title>
            Profile |
            <?php
                echo unserialize($_SESSION['user'])->name;
            ?>
        </title>
    </head>

    <body>
        <?php include './partials/nav.php' ?>
        <main>
            <section class="sidebar">
                <?php include './partials/usercard.php'?>
                <div class="card">
                    <div class="card-title">
                        Tournament Stats
                    </div>
                    <div class="sgroup">
                        <div class="card-title">
                            Won
                        </div>
                        <div class="dis kbold">
                            <?php echo $user->win;?>
                        </div>
                    </div>
                    <div class="sgroup">
                        <div class="card-title">
                            Lost
                        </div>
                        <div class="dis kbold">
                            <?php echo $user->loss;?>

                        </div>
                    </div>
                    <div class="sgroup">
                        <div class="card-title">
                            Hosted
                        </div>
                        <div class="dis kbold">
                            <?php echo $user->host;?>

                        </div>
                    </div>
                    <div class="sgroup">
                        <div class="card-title">
                            Joined
                        </div>
                        <div class="dis kbold">
                            <?php echo $user->join;?>
                        </div>
                    </div>
                </div>
                <div class="card tournamentcard">
                    <div class="card-title">
                        Your Tournaments
                    </div>
                    <div class="card-body">
                        <?php
                        $tournament = getTournaments($conn,$user->uid,5);
                        $count = 0;
                        foreach ($tournament as $t) {
                            ++$count;
                            echo " <div class='dis mt10 kmedium'>$count. $t</div>";
                        }
                    ?>
                    </div>
                </div>

            </section>
            <section class="maincontent">
                <div class="card">
                    <div class="card-title">
                        Account Settings
                    </div>
                    <div id="msg" class="dis kmedium">

                        <?php
                            if (isset($_GET['successmsg'])) {
                                echo $_GET['successmsg'];
                            }
                            if (isset($_POST['updaterequest'])) {
                                $name = $_POST['name'];
                                $email = $_POST['email'];
                                $password = $_POST['password'];
                                if ($password!="") {
                                    $password = password_hash($password,PASSWORD_DEFAULT);
                                }
                                if ($name == "" && $email == "" && $password == "") {
                                    echo "No changes were made";
                                }else{
                                    $sql = "Update users set name='$name',email='$email',password='$password' where uid=$user->uid";
                                    $msg = "";
                                    if ($name == "" && $email == "") {
                                        $sql = "Update users set password='$password' where uid=$user->uid";
                                        $msg = "Password changed";
                                    }else if ($name == "" && $password == "") {
                                        $sql = "Update users set email='$email' where uid=$user->uid";
                                        $msg = "Email changed. Please make sure to login with new email next time.";
                                    }else if ($email == "" && $password == "") {
                                        $sql = "Update users set name='$name' where uid=$user->uid";
                                        $msg = "Name changed. It might take some time to show the effect.";
                                    }else{
                                        if ($name=="") {
                                            $sql = "Update users set email='$email',password='$password' where uid=$user->uid";
                                            $msg = "Password and email modified successfully.";
                                        }elseif ($password=="") {
                                            $sql = "Update users set email='$email',name='$name' where uid=$user->uid";
                                            $msg = "Email and name updated successfully.";
                                        }elseif ($email=="") {
                                            $sql = "Update users set password='$password',name='$name' where uid=$user->uid";
                                            $msg = "Name and password updated successfully";
                                        }else{
                                            $msg = "Updates made successfully. Please wait for some time before it shows and update on your profile.";
                                            $sql = "Update users set name='$name',email='$email',password='$password' where uid=$user->uid";
                                        }
                                    }

                                    if ($conn->query($sql)) {
                                        $msg = $msg;
                                    }else{
                                        $msg =  "There was some error trying to process your request. Please try again later.";
                                    }
                                    echo $msg;
                                }
                                unset($_POST['name']);
                                unset($_POST['email']);
                                unset($_POST['password']);
                                echo '
                                    <script>
                                        window.location.href = "./userpage.php?successmsg='.$msg.'";
                                    </script>
                                ';
                            }
                        ?>
                    </div>
                    <div class="card-body grid">
                        <div onclick="showChangePopup()" class="insidecard">
                            <div class="icon">
                                <i class="fa fa-key"></i>
                            </div>
                            <div class="settingtext dis kregular">
                                Change Password
                            </div>
                        </div>
                        <div onclick="window.location.href='./topup.php'" class="insidecard">
                            <div class="icon">
                                <i class="fa fa-usd"></i>
                            </div>
                            <div class="settingtext dis kregular">
                                Add Balance
                            </div>
                        </div>
                        <div onclick="showChangePopup()" class="insidecard">
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="settingtext dis kregular">
                                Change Name
                            </div>
                        </div>
                        <div onclick="showChangePopup()" class="insidecard">
                            <div class="icon">
                                <i class="fa fa-at"></i>
                            </div>
                            <div class="settingtext dis kregular">
                                Change Email
                            </div>
                        </div>
                        <div class="insidecard">
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="settingtext dis kregular">
                                Go Premium
                            </div>
                        </div>
                        <div onclick="showDeactivateModal()" class="insidecard">
                            <div class="icon">
                                <i class="fa fa-times"></i>
                            </div>
                            <div class="settingtext dis kregular">
                                Deactivate Account
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="sidebar sidebar-end">
                <div class="moneycard card">
                    <div class="tab card-title">
                        Total Spent: $<?php print_r($user->getTotalSpent($conn))?>
                    </div>
                    <div class="tab card-title">
                        Total Balance: $<?php print_r($user->balance)?>
                    </div>
                </div>

                <div class="card purchasecard">
                    <div class="card-title">
                        Purchase history
                    </div>
                    <div class="card-body">
                        <?php
                            $logs = getFilteredPurchaseLog($conn,$user->uid);
                            foreach ($logs as $log) {
                                echo "
                                    <div class='dis tab kregular'>
                                        $log
                                    </div>
                                ";
                            }
                        ?>
                    </div>
                </div>
            </section>
        </main>


        <!-- Popups -->
        <!-- Change Password -->
        <div id="updatemodal" class="popup">
            <div class="popupwrapper">
                <div class="popupheader kbold">
                    <span>
                        <span id="purchasestatus">
                            Update User Profile
                        </span>
                    </span>
                    <i onclick="hideChangePopup()" style="cursor:pointer" id="close-update-modal"
                        class="fa fa-times"></i>
                </div>
                <form autocomplete="off" action="#" method="post">

                    <div id="purchasemsg" class="popupbody kregular">
                        <div class="inputgroup">
                            <input name="name" type="text" placeholder="Update Name">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="inputgroup">
                            <input name="password" type="password" placeholder="Update Password">
                            <i class="fa fa-key"></i>
                        </div>
                        <div class="inputgroup">
                            <input name="email" type="email" placeholder="Update Email">
                            <i class="fa fa-at"></i>
                        </div>
                        <input type="hidden" name="updaterequest" value="1">
                    </div>
                    <div class="popupbutton">
                        <button type="submit" class="btn success kbold">
                            OK
                        </button>
                        <button type="reset" id="cancel" class="btn secondary kbold">
                            Reset
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <!-- Deactivate modal -->
        <div class="popup" id="deactivatemodal">
            <div class="popupwrapper">
                <div class="popupheader kbold">
                    <span>
                        <span id="purchasestatus">
                            Deactivate Account?
                        </span>
                    </span>
                    <i onclick="hideDeactivateModal()" style="cursor:pointer" id="close-update-modal"
                        class="fa fa-times"></i>
                </div>
                <div id="purchasemsg" class="popupbody kregular">
                    <b>Please read this. This is not usual <i>blah blah!</i></b>
                    <br>
                    <p>You are about to completely <b>delete</b> your account. By deleting your account, you will no
                        longer be able to use the services of Dash anymore. You can create a new account with same email
                        later though.</p>
                </div>
                <form action="./deactivate.php" method="post">
                    <div class="popupbutton">
                        <input type="hidden" name="userid" value="<?php echo $user->uid?>">
                        <button type="submit" class="btn success kbold">
                            Continue
                        </button>
                        <button onclick="hideDeactivateModal()" type="button" id="cancel" class="btn secondary kbold">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script src="./js/userpage.js"></script>

</html>