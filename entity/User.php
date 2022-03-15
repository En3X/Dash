<?php
    class User{
        public $uid;
        public $name;
        public $email;
        public $password;
        public $stat;
        function __construct($uid, $name, $email, $password){
            $this->uid = $uid;
            $this->email = $email;
            $this->name = $name;
            $this->password = $password;
            $this->fetch_stat();
        }

        public function fetch_stat()
        {
            /*
                TODO: Some bunch of shitty sql to fetch stats from database
            */
            $won = 100;
            $loss = 11;
            $hosted = 5;
            $this->stat = array('won'=>$won,'loss'=>$loss,'host'=>$hosted);
        }
    }
?>