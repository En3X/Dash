<?php
    class Item
    {
        public $id,$name,$gid,$price,$img;
        function __construct($id,$gid,$name,$price,$img){
            $this->id = $id;
            $this->name = $name;
            $this->gid = $gid;
            $this->price = $price;
            $this->img = $img;
        }
        function getGameName($conn){
            $q = "select gname from games where gid=$this->gid";
            $gname = $conn->query($q);
            $data = $gname->fetch_assoc();
            return $data['gname'];
        }
    }
?>