<?php
    require '../db/connection.php';
    session_start();
    if (isset($_SESSION['aid']) && isset($_SESSION['ausername'])) {
        header('location: ./index.php');
    }
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <title>Admin Login</title>
</head>

<body>
    <div class="container">
        <div class="introSection">
            <div class="welcome">
                <img src="../img/login.jpg" alt="">
            </div>
        </div>
        <div class="loginSection mbold">
            <div class="form-intro">
                <hr>
                <span id="intro" class="mmedium">
                    Login as a Admin User
                </span>
            </div>
            <form action="./index.php" method="post" autocomplete="off">
                <?php
                    if (isset($_SESSION['admin_login_error'])) {?>
                <div class="errorSection">
                    <span id="error">
                        <?php echo $_SESSION['admin_login_error']?>
                    </span>
                </div>
                <?php
                    }
                ?>
                <div class="form-section">
                    <div class="form-group">
                        <input required class="form-input" type="text" name="username" placeholder="John Doe">
                        <span class="material-icons-outlined">
                            account_circle
                        </span>
                    </div>
                    <div class="form-group">
                        <input required class="form-input" type="password" name="password" placeholder="Password">
                        <span class="material-icons-outlined">
                            password
                        </span>
                    </div>
                    <div class="hidden">
                        <input type="submit" id="loginBtn" name="login" value="1">
                    </div>
                    <div class="form-group" onclick="submitform()">
                        Login
                    </div>
                </div>
                <div class="mmedium smalltext">
                    Get help logging in
                </div>
            </form>
        </div>
    </div>
</body>
<script>
function submitform(params) {
    document.querySelector('#loginBtn').click();
}
</script>

</html>