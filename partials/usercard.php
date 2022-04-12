<link rel="stylesheet" href="./css/usercard.css">
<div onclick="window.location.href='./userpage.php'" class="card usercard">
    <div class="profile">
        <div class="image">
            <img src="./img/default.png" alt="">
        </div>
        <div class="text">
            <div class="name kbold">
                <?php echo $user->name ?>
            </div>
            <div class="email kregular">
                <?php echo $user->email?>
            </div>
            <div class="balance klight">
                <i class="fa fa-dollar"></i> <?php echo $user->balance?>
            </div>
        </div>
    </div>

</div>