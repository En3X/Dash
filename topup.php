<?php
    session_start();
    require './entity.php';
    require('./services.php');

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
        <title>Add Balance</title>
        <link rel="stylesheet" href="./css/index.css">
        <link rel="stylesheet" href="./css/topup.css">

    </head>

    <body>
        <?php include './partials/nav.php'?>

        <main>
            <section class="sidebar">
                <?php include './partials/usercard.php'?>
                <?php include './partials/topup-term.php'?>
            </section>
            <section class="maincontent">
                <div class="card topupcard">
                    <div class="card-title">
                        Add Balance
                    </div>
                    <div class="dis kregular">
                        We accept visacard, mastercard, credit/debit cards
                    </div>
                    <div class="topupform">
                        <form action="" method="post">
                            <div class="form-group">
                                <div class="dis kbold">
                                    Topup Balance (USD)
                                </div>
                                <input required type="number" min=0 name="balance" placeholder="e.g. 1000">
                            </div>
                            <div class="form-group">
                                <div class="dis kbold">
                                    Cardholder's Name
                                </div>
                                <input type="text" name="holdername" placeholder="e.g. John Doe">
                            </div>
                            <div class="form-group">
                                <div class="dis kbold">
                                    Card number
                                </div>
                                <input type="text" name="cardnumber" placeholder="XXXX XXXX XXXX XXXX">
                            </div>
                            <div class="form-group">
                                <div class="dis kbold">
                                    Expiry Date
                                </div>
                                <input type="text" name="expdate" placeholder="DD/MM">
                            </div>
                            <div class="form-group">
                                <div class="dis kbold">
                                    CVV
                                </div>
                                <input type="text" name="cvv" placeholder="XXXX">
                            </div>
                            <button id="host" name="addbalance" type="submit" class="saveTournament kmedium">
                                Add Balance
                                <i class="fa fa-plus"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </section>
            <section>
                <!-- Just a decoy to make the cards even -->
            </section>
        </main>
    </body>

</html>

<?php
    if (isset($_POST['addbalance'])) {
        $newBalance = $_POST['balance'];
        refreshUser($conn,$user->uid,$newBalance);
        $query = "Update users set balance=$newBalance where uid=$user->uid";
    }

?>