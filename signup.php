<?php
    require './db/connection.php';

    session_start();

    if (isset($_SESSION['user'])) {
        header('location: index.php');
    }
    // @params $info string
    function showInfo($info){
        ?>
<script>
showErrorInPage('<?php echo $info?>');
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
    <title>Signup</title>
    <link rel="stylesheet" href="./css/control.css">
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="container">
        <div class="intro">
            <h1 class="title">
                Create new account
            </h1>
            <h3 class="subtitle">
                Host your own tournament, join any public events, buy in-game currencies or skins
            </h3>
            <?php
                include './partials/errors.php';
            ?>
            <div class="row">
                <?php getPartials()?>
                <div class="orSection mt20">
                    <div class="vertical-center">
                        /
                    </div>
                </div>
                <?php include './partials/social.php'?>
            </div>

            <div class="subtitle mt10">
                <p class="pointer">
                    Already have an account?
                </p>
                <p class="pointer" onclick="window.open('./login.php','_self')">
                    Login here
                </p>
            </div>

        </div>
    </div>
</body>
<script src="./js/signup.js"></script>
<script src="./js/error.js"></script>

</html>

<?php
    function getPartials(){
        require './partials/signup/login_form.php';
    }

    // Signup code
    $name = $username = $password = '';
    if (isset($_POST['signup']) && isset($_POST['formSubmitted'])) {
        global $name,$username,$password;
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (empty($username) || empty($password) || empty($name)) {
            showInfo('Required field not filled properly.');
        }else{
            $password = password_hash($password,PASSWORD_DEFAULT);

            try {
                $query = "INSERT into users(name,email,password,balance) values ('$name','$username','$password',0)";
                // See if username already exist'
                if ($users = $conn->query("SELECT * From users where `users`.`email` = '$username'")) {
                    if ($users->num_rows > 0) {
                        showInfo('User with username '.$username.' already exists');
                    }else{
                        if ($conn->query($query)) {
                            showInfo('Signup Successful');
                            header('refresh:2;url=login.php');
                        }
                    }
                }
            } catch (\Throwable $th) {
                 showInfo($th);
            }
        }
    }
?>