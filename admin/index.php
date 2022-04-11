<?php
    require '../db/connection.php';
    require './admin.php';
    require './services.php';
    require '../entity/Tournament.php';
    require '../entity/Article.php';
    require '../entity/Item.php';


    $adminData;
    session_start();
    if (isset($_SESSION['admin_login_error'])) {
        unset($_SESSION['admin_login_error']);
    }
    if (!isset($_SESSION['admin'])) {
        login($conn);
    }else {
        global $adminData;
        $adminData = unserialize($_SESSION['admin']);
    }
?>

<html lang="en">

    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="./css/admin.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <?php include('./partial/sidebar.php')?>
        <section class="mainSection">
            <?php include "./partial/article.php" ?>
            <?php
            if (!isset($_GET['page'])) {
               include "./partial/dashboard.php";
            }else{
                $page = $_GET['page'];
                if ($page == "purchaselog") {
                    include "./partial/purchaselogs.php";
                }else if ($page == "tournament") {
                    include "./partial/tournament.php";
                }else if ($page == "articles") {
                    include "./partial/articleslist.php";
                }else if ($page == "shop") {
                    include "./partial/shop.php";
                }
            }
        ?>
        </section>
    </body>
    <script>
    function sendToLogin(error) {
        document.querySelector('#errorInput').value = error;
        document.querySelector('#sendError').click()
    }
    </script>
    <script src="./js/index.js"></script>

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
                                global $adminData;
                                $adminData = new Admin($aid,$aname,$ausername);
                                $adminCopy = serialize($adminData);
                                $_SESSION['admin'] = $adminCopy;
                                $isLoggedIn = true;
                                break;
                            }else {
                                redirectToLogin("Username or password does not match");
                            }
                        }
                    }
                    if (!$isLoggedIn) {
                        redirectToLogin("Username or password does not exist.");
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
        header('location:./login.php');
    }
?>