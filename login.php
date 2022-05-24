<?php
    require './db/connection.php';
    include './entity/User.php';
    session_start();

    if (isset($_SESSION['user'])) {
        header('location: index.php');
    }
    function showError($err){
            ?>
<script>
showErrorInPage('<?php echo $err?>');
</script>
<?php
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login to continue</title>
        <link rel="stylesheet" href="./css/control.css">
        <link rel="stylesheet" href="./css/login.css">

    </head>

    <body>
        <!-- nav should be included -->
        <div class="container">
            <div class="intro">
                <h1 class="title">
                    Login to your account
                </h1>
                <h3 class="subtitle">
                    Choose from multiple game library and host or join events of your choice
                </h3>
                <?php include './partials/errors.php' ?>
                <div class="row">
                    <div class="formSection">
                        <form autocomplete="off" action="#" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <input name="username" placeholder="Username or email" type="text"
                                        class="form-input">
                                    <i class="fa fa-at"></i>
                                </div>
                                <div class="input-group">
                                    <input name="password" id="password" placeholder="Password" type="password"
                                        class="form-input">
                                    <i onclick="togglePwd()" id="togglepwd" class="fa fa-eye-slash pointer"></i>
                                </div>
                                <input type="hidden" name="formSubmitted" value="1">
                                <div class="input-group">
                                    <input class="pointer" name="login" type="submit" value="Login to your account">
                                    <i class="fa fa-arrow-right"></i>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="orSection">
                        <div class="vertical-center">
                            /
                        </div>
                    </div>
                    <div class="socialLogin">
                        <div class="form-group">
                            <div class="socialbtn">
                                <i class="fa fa-steam"></i>
                                Sign in with Steam
                            </div>
                            <div class="socialbtn">
                                <i class="fa fa-google"></i>
                                Sign in with Google
                            </div>
                            <div class="socialbtn">
                                <i class="fa fa-facebook"></i>
                                Sign in with Facebook
                            </div>
                        </div>
                    </div>
                </div>

                <div class="subtitle mt10">
                    <p class="pointer">
                        Forgot password?
                    </p>
                    <p class="pointer" onclick="window.open('./signup.php','_self')">
                        Signup instead
                    </p>
                </div>

            </div>
        </div>
    </body>
    <script src="./js/signup.js"></script>
    <script src="./js/error.js"></script>

</html>

<?php
    $username = $password = "";
    if (isset($_POST['login']) && isset($_POST['formSubmitted'])) {
        // Login button clicked
        global $username,$password;
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if (empty($username) || empty($password)) {
            showError("Username and password are required");
        }else{
            // Mysql check if password or username exist
            $mysqli = $conn;
            $query = "SELECT * from users where `users`.`email` = '$username'";

            if($data = $mysqli->query($query)){
                if ($data->num_rows != 1) {
                    showError("Username does not exist");
                }else{
                    while ($user = $data->fetch_assoc()) {
                        $uid = $user['uid'];
                        $name = $user['name'];
                        $email = $user['email'];
                        $pwd = $user['password'];
                        $balance = $user['balance'];
                    }
                    if(password_verify($password,$pwd)){
                        $mainUser = new User($uid,$name,$email,$pwd,$balance);
                        $_SESSION['user'] = serialize($mainUser);
                        showError('Login successful. Redirecting!!!');
                        header('refresh:0;url=index.php');   
                    }else{
                        showError('Password for the username does not match. ');
                    }
                }
            }
        }
    }
?>