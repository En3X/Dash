<?php
    class User{
        public $uid;
        public $name;
        public $email;
        public $password;
        public $stat;
        public $balance;
        function __construct($uid, $name, $email, $password,$balance){
            $this->uid = $uid;
            $this->email = $email;
            $this->name = $name;
            $this->password = $password;
            $this->balance = $balance;
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
            $this->stat = array('w'=>$won,'l'=>$loss,'h'=>$hosted);
        }

        public function refresh($conn){
            $q = "Select * from users where uid=$this->uid";
            if ($data = $conn->query($q)) {
                if ($data->num_rows == 1) {
                    while ($row=$data->fetch_assoc()) {
                        $newname = $row['name'];
                        $newemail = $row['email'];
                        $newpwd = $row['password'];
                        $newbalance = $row['balance'];
                    }
                }

                $this->name=$newname;$this->email=$newemail;
                $this->password=$newpwd;
                $this->balance=$newbalance;
                unset($_SESSION['user']);
                $_SESSION['user'] = serialize($this);
            }
        }
    }
?>