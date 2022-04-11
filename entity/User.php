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

        public function hasBalance($check)
        {
            if ($this->balance >= $check) {
                return true;
            }
            return false;
        }


        public function updateBalance($conn,$nb)
        {
            $q = "Update users set balance=$nb where uid=$this->uid";
            if ($conn->query($q)) {
                return true;
            }else{
                throw new Exception("Sorry there was some error processing your request. We will try and fix it soon. Until then, please try using some other feature of our webappp.", 1);
            }
        }
        public function hasJoinedTournament($conn,$tid){
            $sql = "select * from tournamentmembers where tid=$tid and uid=$this->uid";
            if ($data=$conn->query($sql)) {
                if ($data->num_rows>0) {
                    return true;
                }else{
                    return false;
                }
            }
        }
    }
?>