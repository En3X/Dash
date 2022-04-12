<?php
    class Tournament
    {
        public $tid,$gid,$uid,$name,
        $dis,$status,$month,$day,$hour,$min,$sec,$isEnded;
        function __construct($tid,$gid,$uid,$name,$dis,$status,$month,$day,$hour,$min,$sec,$end) {
            $this->tid = $tid;
            $this->gid=$gid;
            $this->uid = $uid;
            $this->name=$name;
            $this->dis = $dis;
            $this->status=$status;
            $this->month = $month;
            $this->day=$day;
            $this->hour = $hour;
            $this->min=$min;
            $this->sec = $sec;
            $this->isEnded = $end;
        }

    }
?>