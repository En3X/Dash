<?php
    class User{
        public $uid;
        public $name;
        public $email;
        public $password;
        public $win,$loss,$host,$join;
        public $balance;
        function __construct($uid, $name, $email, $password,$balance){
            $this->uid = $uid;
            $this->email = $email;
            $this->name = $name;
            $this->password = $password;
            $this->balance = $balance;
        }


        public function fetch_stat($conn){
            $winsql = "Select * from tournamentwinner where uid=$this->uid";
            if ($winsql = $conn->query($winsql)) {
                $this->win = $winsql->num_rows;
            }else{
                $this->win = 0;
            }
            $hostsql = "select * from tournament where uid=$this->uid";
            if ($hostdata = $conn->query($hostsql)) {
                $this->host = $hostdata->num_rows;
            }else{
                $this->host = 0;
            }

            $joinsql = "select * from tournamentmembers where uid=$this->uid";
            if ($joindata = $conn->query($joinsql)) {
                $this->join = $joindata->num_rows;
            }else{
                $this->join = 0;
            }

            $this->loss = $this->join - $this->win;;
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

        public function getTotalSpent($conn){
            $sql = "select price from purchaselog where uid=$this->uid";
            if ($data = $conn->query($sql)) {
                if ($data->num_rows == 0) {
                    return 0;
                }else{
                    $sum = 0;
                    while ($row=$data->fetch_assoc()) {
                        $sum += $row['price'];
                    }
                    return $sum;
                }
            }
        }
    }
?>