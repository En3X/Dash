<?php
    session_start();
    include './services.php';
    include './entity.php';
    $item = "404";
    if (isset($_GET['itemid'])) {
        global $item;
        $item = getItem($conn,$_GET['itemid']);
    }
    function itemExists()
    {
        global $item;
        if ($item != "404") {
            return true;
        }
        return false;
    }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="./css/index.css">
        <link rel="stylesheet" href="./css/itempage.css">
        <title>
            <?php
            global $item;
                if (itemExists()) {
                    echo "Dash Shop | ".$item->name;
                }else{
                    echo "404 Item not found";
                }
            ?>
        </title>

    </head>

    <body>
        <?php include './partials/nav.php'?>
        <main>
            <section class="sidebar">
                <?php include './partials/usercard.php'?>
                <?php include './partials/shop-term.php'?>
            </section>
            <section class="maincontent">
                <div class="card agree-term-card">
                    <div class="card-body">
                        <div class="dis kregular">
                            By making the purchase, you are agreeing to all the terms and conditions.
                            <br>
                            The terms and conditions are in the left hand side of the screen.
                        </div>
                    </div>
                </div>
                <?php
                    if (itemExists()) {
                        ?>
                <div class="card featuredcard">
                    <div class="textsection">
                        <div class="tournamentstatus kmedium">
                            <?php echo $item->getGameName($conn)?>
                        </div>
                        <div class="tournamentName mbold">
                            <?php echo $item->name?>
                        </div>
                        <div class="description mregular">
                            Description
                        </div>
                        <div class="tournamentDate">
                            <div class="dateCapsule">
                                <div id="day" class="cmain mbold">
                                    <?php echo $item->price?>
                                </div>
                                <div id="month" class="csub mregular">
                                    USD
                                </div>
                            </div>
                            <div class="dateCapsule">
                                <div id="hour" class="cmain mbold">
                                    Factory
                                </div>
                                <div id="month" class="csub mregular">
                                    New
                                </div>
                            </div>
                        </div>
                        <form action="#" method="post">
                            <input type="hidden" name="bought" value=1>
                            <button type=" submit" id="host" class="saveTournament kmedium">
                                <i class="fa fa-shopping-cart"></i>
                                Buy product
                            </button>
                        </form>

                    </div>
                    <div class="banner-img" style="
                        background: url(./shop/img/<?php echo $item->img?>);
                background-repeat: no-repeat;
                background-position: fixed;
                background-size: 100%;
                    ">
                    </div>
                </div>
                <?php
                    }else{

                    }
                ?>
            </section>
            <section class=" sidebar sidebar-end">
                <div class="card shopcard">
                    <div class="card-title">
                        You might also like
                    </div>
                    <div class="card-body">
                        <div class="dis kregular">
                            People buying this item also prefer these
                        </div>
                        <div class="row">
                            <div class="item" onclick="window.location.href='./shop.php'">
                                <img src="./shop/img/fade.png" alt="">
                            </div>
                            <div class="item" onclick="window.location.href='./shop.php'">
                                <img src="./shop/img/emeralddragonp90.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card summarycard">
                    <div class="card-title">
                        Purchase Summary
                    </div>
                    <div class="dis kregular">
                        <?php
                        if (itemExists()) {
                            echo "Summary to help dive deep into your economy.";
                        }else{
                            echo "Item not found. Select item from shop to make the calculations.";
                        }
                    ?>
                    </div>
                    <?php
                        if (itemExists()) {
                            ?>
                    <div class="customList">
                        <div class="dis klight listitem">
                            You will be purchasing <span class="capitalize"><b><?php echo $item->name?></b></span> which
                            is digital product for the game <span
                                class="capitalize"><b><?php echo $item->getGameName($conn)?></b></span>.
                        </div>
                        <div class="dis klight listitem">
                            You have account balance of <b>$<?php echo $user->balance?></b> and the product costs
                            <b>$<?php echo $item->price?></b>. So,
                            <?php
                                if ($user->hasBalance($item->price)) {
                                    echo "You can buy the product.";
                                }else{
                                    echo "You cannot buy the product.";
                                }
                            ?>
                        </div>
                        <div class="dis klight listitem">
                            <?php
                                if ($user->hasBalance($item->price)) {
                                    $diff = $user->balance - $item->price;
                                    echo "You will have <b>$$diff</b> balance left in your account.";
                                }else{
                                    $diff = $item->price - $user->balance;
                                    echo "You are short by <b>$$diff</b> which you can topup very easily.";
                                }
                            ?>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </section>
        </main>

    </body>
    <?php
        $purchaseStatus = $purchaseMessage = "";
        if (isset($_POST['bought'])) {
            if (itemExists()) {
                if ($user->hasBalance($item->price)) {
                    # User can buy the product
                    $newUserBalance = $user->balance - $item->price;
                    try{
                        if ($user->updateBalance($conn,$newUserBalance)) {
                            $purchaseStatus = "Successful";
                            $purchaseMessage = "Your purchase has been sent through and it was successful. Currently, it is being processed in admin
                            side. You will be receiving the product shortly. Thank you for shopping with us.";
                            createPurchaseLog($conn,$item,$user);
                        }
                    }catch(Exception $e){
                        $purchaseStatus = "Failed";
                    $purchaseMessage = $e->getMessage();
                    }
                }else{
                    $purchaseStatus = "Failed";
                    $purchaseMessage = "You do not have enough balance to make the purchase as of now. But do not worry, you can use our topup service and easily add balance to your account. We accept Visa card, Credit card and Master Card.";
                }
            }else{
                $purchaseStatus = "Failed";
                $purchaseMessage = "Purchase failed because you have not selected any product to buy. Please go back to shop and select the item that you would like to purchase.";
            }
            ?>
    <div id="successpopup" class="popup">
        <div class="popupwrapper">
            <div class="popupheader kbold">
                <span>
                    Purchase <span id="purchasestatus">
                        <?php echo $purchaseStatus?>
                    </span>
                </span>
                <i style="cursor:pointer" onclick="window.location.href='./index.php'" id="close-modal"
                    class="fa fa-times"></i>
            </div>
            <div id="purchasemsg" class="popupbody kregular">
                <?php echo $purchaseMessage ?>
            </div>
            <div class="popupbutton">
                <button onclick="window.location.href='./index.php'" class="btn success kbold">
                    OK
                </button>
                <button onclick="window.location.href='./topup.php'" class="btn secondary kbold">
                    Topup balance
                </button>
            </div>
        </div>
    </div>
    <?php
        }    

    ?>
    <script src="./js/buyitem.js"></script>

</html>