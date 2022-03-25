<?php
    class Admin
    {
        public $id,$name,$username;
        function __construct(
            $id,$name,$username
        )
        {
            $this->name = $name;
            $this->id = $id;
            $this->username = $username;
        }
    }

?>