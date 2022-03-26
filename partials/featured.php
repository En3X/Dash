<?php
    $tournaments = getAllTournament($conn);
    $featured = $tournaments[count($tournaments)-1];
?>
<div class="card featuredcard">
    <div class="textsection">
        <div class="tournamentstatus kmedium">
            <?php 
            echo $featured->status." Tournament";
        ?>
        </div>
        <div class="tournamentName mbold">
            <?php echo $featured->name?>
        </div>
        <div class="description mregular">
            <?php echo $featured->dis?>
        </div>
        <div class="tournamentDate">
            <div class="dateCapsule">
                <div id="day" class="cmain mbold">
                    <?php echo $featured->day;?>
                </div>
                <div id="month" class="csub mregular">
                    <?php echo $featured->month;?>
                </div>
            </div>
            <div class="dateCapsule">
                <div id="hour" class="cmain mbold">
                    <?php echo $featured->hour;?>
                </div>
                <div id="month" class="csub mregular">Hour</div>
            </div>
            <div class="dateCapsule">
                <div id="min" class="cmain mbold">
                    <?php echo $featured->min;?>
                </div>
                <div class="csub mregular">Min</div>
            </div>
            <div class="dateCapsule">
                <div id="sec" class="cmain mbold">
                    <?php echo $featured->sec;?>
                </div>
                <div class="csub mregular">Sec</div>
            </div>
        </div>
        <button id="host" class="saveTournament kmedium">
            Join Tournament
            <i class="fa fa-plus"></i>
        </button>
    </div>
    <div class="banner-img" style="
        background: url(<?php echo fetchBanner($conn,$featured)?>);
        background-repeat: no-repeat;
        background-size: 100%;
    ">
    </div>
</div>

<?php
    function fetchBanner($mysqli,$featured)
    {
        $gid = $featured->gid;
        $query = "
            select logopath from games where gid=$gid
        ";
        if ($path = $mysqli->query($query)) {
            while ($data = $path->fetch_assoc()) {
                return $data['logopath'];
            }
        }
        $src="./img/404.jpg";
        return $src;
    }
?>