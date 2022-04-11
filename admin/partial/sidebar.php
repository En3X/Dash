<link rel="stylesheet" href="./css/sidebar.css">

<section class="sidebar">
    <div class="">
        <div class="sidebar-header">
            <!-- <div class="logo tab kmedium">
                Admin Panel
            </div> -->
            <div class="tab kmedium intro-admin">
                <div id="photo" class="photo">
                    A
                </div>
                <span id="adminname" class="name">
                    <?php echo $adminData->name;?>
                </span>
            </div>
        </div>
        <div class="sidebaricons">
            <div onclick="window.location.href='./index.php'" class="iconset">
                <i class="fa fa-dashboard"></i>
                <span>
                    Dashboard
                </span>
            </div>
            <!-- <div class="iconset">
                <i class="fa fa-pie-chart"></i>
                <span>
                    Charts
                </span>
            </div>
            <div class="iconset">
                <i class="fa fa-thumbs-down"></i>
                <span>
                    User Reports
                </span>
            </div> -->
            <div onclick="window.location.href='./index.php?page=purchaselog'" class="iconset">
                <i class="fa fa-info-circle"></i>
                <span>
                    Purchase Logs
                </span>
            </div>
            <div onclick="window.location.href='./index.php?page=shop'" class="iconset">
                <i class="fa fa-money"></i>
                <span>
                    Shopping District
                </span>

            </div>
            <div onclick="window.location.href='./index.php?page=tournament'" class="iconset">
                <i class="fa fa-gamepad"></i>
                <span>
                    Tournaments
                </span>
            </div>
            <div onclick="window.location.href='./index.php?page=articles'" class="iconset">
                <i class="fa fa-newspaper-o"></i>
                <span>
                    Articles List
                </span>
            </div>
            <div id="addArticle" class="iconset">
                <i class="fa fa-plus"></i>
                <span>
                    Add Article
                </span>
            </div>
            <div class="iconset" onclick="window.open('./logout.php','_self')">
                <i class="fa fa-sign-out"></i>
                <span>
                    Logout
                </span>
            </div>
        </div>
    </div>
</section>