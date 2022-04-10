<link rel="stylesheet" href="./css/dashboard.css">
<title>Admin | Dashboard</title>
<div class="dashboard">
    <div class="header kbold">
        Dashboard
    </div>
    <div class="cards-section">
        <div class="card card-primary">
            <div class="card-body">
                <div class="card-body-text">
                    <div class="kmedium cardNumber">
                        <?php echo getNumOrder($conn)?>
                    </div>
                    <div class="title kregular">
                        Total Purchase
                    </div>
                </div>
                <div class="card-icon">
                    <i class="fa fa-shopping-bag"></i>
                </div>
            </div>
            <div class="footer kregular">
                More info
                <i class="fa fa-arrow-right"></i>
            </div>
        </div>

        <div class="card card-danger">
            <div class="card-body">
                <div class="card-body-text">
                    <div class="kmedium cardNumber">
                        <?php echo getNumTournament($conn) ?>
                    </div>
                    <div class="title kregular">
                        Tournaments
                    </div>
                </div>
                <div class="card-icon">
                    <i class="fa fa-gamepad"></i>
                </div>
            </div>
            <div class="footer kregular">
                More info
                <i class="fa fa-arrow-right"></i>
            </div>
        </div>

        <div class="card card-success">
            <div class="card-body">
                <div class="card-body-text">
                    <div class="kmedium cardNumber">
                        53%
                    </div>
                    <div class="title kregular">
                        Bounce Rate
                    </div>
                </div>
                <div class="card-icon">
                    <i class="fa fa-line-chart"></i>
                </div>
            </div>
            <div class="footer kregular">
                More info
                <i class="fa fa-arrow-right"></i>
            </div>
        </div>

        <div class="card card-warning">
            <div class="card-body">
                <div class="card-body-text">
                    <div class="kmedium cardNumber">
                        <?php echo getNumUser($conn)?>
                    </div>
                    <div class="title kregular">
                        User Registrations
                    </div>
                </div>
                <div class="card-icon">
                    <i class="fa fa-user-plus"></i>
                </div>
            </div>
            <div class="footer kregular">
                More info
                <i class="fa fa-arrow-right"></i>
            </div>
        </div>
    </div>
</div>

<?php
?>