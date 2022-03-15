<?php
    class Tournament
    {
        public $tid,$gid,$hostedby,$hostdate,$startdate,$status;
        function __construct($tid,$gid,$hostedby,$hostdate,$startdate,$status) {
            $this->tid = $tid;
            $this->gid=$gid;
            $this->hostedby = $hostedby;
            $this->hosteddate=$hosteddate;
            $this->startdate = $startdate;
            $this->status=$status;
        }
    }
?>