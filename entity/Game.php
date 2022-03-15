<?php
    class Game{
        public $id,$name,$dis,$logo,$bg;
        function __construct($id,$name,$dis,$logo,$bg){
            $this->id = $id;
            $this->name = $name;
            $this->dis = $dis;
            $this->logo = $logo;
            $this->bg = $bg;
        }
    }
?>