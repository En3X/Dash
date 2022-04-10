<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Purchase Logs</title>
        <link rel="stylesheet" href="./css/dashboard.css">
        <link rel="stylesheet" href="./css/purchaselog.css">
    </head>

    <body>
        <div class="dashboard">
            <div class="header kbold">
                Purchase Log
            </div>
            <div class="cards-section">
                <table>
                    <tr class="kbold">
                        <th class="heading">
                            Purchase ID
                        </th>
                        <th class="heading">
                            Item ID
                        </th>
                        <th class="heading">
                            Item Name
                        </th>
                        <th class="heading">
                            User ID
                        </th>
                        <th class="heading">
                            User Name
                        </th>
                        <th class="heading">
                            Price
                        </th>
                    </tr>
                    <?php 
                        $query = "Select * from purchaselog";
                        if ($data = $conn->query($query)) {
                            while ($row = $data->fetch_assoc()) {
                                ?>
                    <tr class="kregular">
                        <td class="data">
                            <?php echo $row['id']?>
                        </td>
                        <td class="data">
                            <?php echo $row['itemid']?>

                        </td>
                        <td class="data">
                            <?php echo $row['itemname']?>

                        </td>
                        <td class="data">
                            <?php echo $row['uid']?>

                        </td>
                        <td class="data">
                            <?php echo $row['username']?>

                        </td>
                        <td class="data">
                            $ <span class="pricedata"><?php echo $row['price']?>
                            </span>
                        </td>
                    </tr>

                    <?php
                            }
                        }
                    
                    ?>
                    <tr class="kmedium">
                        <td colspan=5>Total</td>
                        <td id="totalprice"></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
    <script>
    allPrice = document.querySelectorAll(".pricedata");
    total = 0;
    allPrice.forEach(price => {
        total += Number(price.textContent);
    });
    total = '$ ' + total;

    document.querySelector("#totalprice").textContent = total;
    </script>

</html>