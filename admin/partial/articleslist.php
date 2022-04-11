<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Articles</title>
        <link rel="stylesheet" href="./css/dashboard.css">
        <link rel="stylesheet" href="./css/purchaselog.css">
    </head>

    <body>
        <div class="dashboard">
            <div class="header kbold">
                Articles
            </div>
            <div class="cards-section">
                <table>
                    <tr class="kbold">
                        <th class="heading">
                            Article ID
                        </th>
                        <th class="heading">
                            Title
                        </th>
                        <th class="heading">
                            Description
                        </th>

                        <th>Function</th>
                    </tr>
                    <?php 
                        $articles = getArticles($conn);
                        foreach ($articles as $a) {
                            ?>
                    <tr class="kregular">
                        <td>
                            <?php echo $a->id?>
                        </td>
                        <td>
                            <?php echo $a->title?>
                        </td>
                        <td>
                            <?php echo $a->dis?>
                        </td>
                        </td>
                        <td style="cursor:pointer"
                            onclick="window.location.href = './function/deletearticle.php?id=<?php echo $a->id?>'">
                            Delete
                        </td>
                    </tr>
                    <?php  
                        }
                    ?>
                    <tr class="kmedium">
                        <td colspan=7>Total Articles: <?php echo count($articles)?></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>

</html>