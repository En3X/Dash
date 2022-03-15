<?php
    require('./entity.php');

    session_start();
?>
<a href="./gamepage.php">Go To Game Page</a>
<a href="./login.php">Go To Login Page</a>
<br>
<br>


<?php
    if (isset($_SESSION['user'])) {
        $user = unserialize($_SESSION['user']);
        ?>
<ul>
    <li>Userid: <b><?php echo $user->uid?></b> </li>
    <li>Name: <b><?php echo $user->name?></b> </li>
    <li>Email: <b><?php echo $user->email?></b> </li>
    <li>Password: <b><?php echo $user->password?></b> </li>

    <li>
        <a href="./logout.php">Logout</a>
    </li>
</ul>

<?php
    }
?>