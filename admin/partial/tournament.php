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
                Hosted Tournaments
            </div>
            <div class="cards-section">
                <table>
                    <tr class="kbold">
                        <th class="heading">
                            Tournament ID
                        </th>
                        <th class="heading">
                            Game ID
                        </th>
                        <th class="heading">
                            Hosted By
                        </th>
                        <th class="heading">
                            Tournament Name
                        </th>
                        <th class="heading">
                            Tournament Discription
                        </th>
                        <th class="heading">
                            Date and time
                        </th>
                        <th>Function</th>
                    </tr>
                    <?php 
                        $tournaments = getTournaments($conn);
                        foreach ($tournaments as $t) {
                            ?>
                    <tr class="kregular">
                        <td>
                            <?php echo $t->tid?>
                        </td>
                        <td>
                            <?php echo $t->gid?>
                        </td>
                        <td>
                            <?php echo $t->uid?>
                        </td>
                        <td>
                            <?php echo $t->name?>
                        </td>
                        <td>
                            <?php echo $t->dis?>
                        </td>
                        <td>
                            <?php
                                $date = "$t->day $t->month, $t->hour:$t->min:$t->sec";
                                echo $date;
                            ?>
                        </td>
                        <td style="cursor:pointer"
                            onclick="window.location.href = './function/deletetournament.php?id=<?php echo $t->tid?>'">
                            Delete
                        </td>
                    </tr>
                    <?php  
                        }
                    ?>
                    <tr class="kmedium">
                        <td colspan=7>Total Tournaments: <?php echo count($tournaments)?></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>

</html>