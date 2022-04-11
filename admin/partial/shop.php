<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shop</title>
        <link rel="stylesheet" href="./css/dashboard.css">
        <link rel="stylesheet" href="./css/purchaselog.css">
    </head>

    <body>
        <div class="dashboard">
            <div class="header kbold">
                <div>
                    Shop Items
                </div>
                <button class="savetournament">
                    <i class="fa fa-plus"></i>
                    Add Item
                </button>
            </div>
            <div class="cards-section">
                <table>
                    <tr class="kbold">
                        <th class="heading">
                            Item ID
                        </th>
                        <th class="heading">
                            Game ID
                        </th>
                        <th class="heading">
                            Item Name
                        </th>
                        <th class="heading">
                            Price
                        </th>
                        <th class="heading">
                            Image Url
                        </th>
                    </tr>
                    <?php 
                        $items = getAllShopItems($conn);
                        foreach ($items as $i) {
                            ?>
                    <tr class="kregular">
                        <td>
                            <?php echo $i->id?>
                        </td>
                        <td>
                            <?php echo $i->name?>
                        </td>
                        <td>
                            <?php echo $i->getGameName($conn)?>
                        </td>
                        <td>
                            $ <?php echo $i->price?>
                        </td>
                        <td>
                            <?php echo $i->img?>
                        </td>
                    </tr>
                    <?php  
                        }
                    ?>
                    <tr class="kmedium">
                        <td colspan=7>Total Shop Items: <?php echo count($items)?></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>

</html>