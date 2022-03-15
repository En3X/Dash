<?php
    require '../db/connection.php';
    session_start();
    if (isset($_SESSION['admin_login_error'])) {
        unset($_SESSION['admin_login_error']);
    }
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <?php
        if (!isset($_SESSION['aid']) && !isset($_SESSION['ausername'])) {
            login($conn);
        }
    ?>
    <a href="./login.php">
        Go to admin login
    </a>
    <a href="./logout.php">
        Logout
    </a>
</body>
<script>
function sendToLogin(error) {
    document.querySelector('#errorInput').value = error;
    document.querySelector('#sendError').click()
}
</script>

</html>
<?php
    function login($mysql)
    {
        if (isset($_POST['login']) && isset($_POST['username'])
        && isset($_POST['password'])
        ) {
            // form submitted, validation required
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "SELECT * from admintbl";
            if ($data = $mysql->query($query)) {
                // echo "Fetched data";
                if ($data->num_rows <= 0) {
                    redirectToLogin("Admin does not exist");
                }else {
                    $isLoggedIn = false;
                    while ($admin = $data->fetch_assoc()) {
                        if ($admin['username'] == $username) {
                            if ($admin['password'] == $password) {
                                $ausername = $admin['username'];
                                $aid = $admin['aid'];
                                $aname = $admin['name'];
                                $isLoggedIn = true;
                                break;
                            }else {
                                redirectToLogin("Username or password does not match");
                            }
                        }
                    }
                    if (!$isLoggedIn) {
                        redirectToLogin("Username or password does not exist.");
                    }else{
                        $_SESSION['aid'] = $aid;
                        $_SESSION['ausername'] = $ausername;
                        $_SESSION['aname'] = $aname;
                        // echo $aname;
                    }
                    
                }
            }
        }else{
            redirectToLogin("Please login to continue");
        }
    }
    function redirectToLogin($err)
    {
        $_SESSION['admin_login_error'] = $err;
        header('location:./admin/login.php');
    }
?>