<?php
    class login 
    {

        private $error = "";

        public function evaluate ($data){
            foreach ($data as $key => $value){
                if (empty($value)){
                    $this->error = $this->error . $key .  " is empry ! <br>" ;
                }
                if ($key == "log_email"){
                    if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$value)){
                        $this->error = $this->error . "Invalid email !! <br>";
                }

                    
                    } 
               
            }
                
            $email = $data['log_email'];
            $password = $data['log_password'];
            ///////////////////
            $query = "SELECT * FROM users WHERE email = '$email'  limit 1 ";
            $DB= new Database();
            $result = $DB->read($query);


            if ($result) {

                $row = $result[0];

                if ($password == $row['password'])
                {
                    //i try to create session
                    $_SESSION['mercury_user_id'] = $row ['user_id'];
                }
                else {
                    $this->error .="wrong Password <br> " ;
                }


            }
            else {
                $this->error .= "Wrong email <br>";
            }

            return $this->error;

        }

        public function check_login ($id)
        {
            $query  = "SELECT user_id FROM users WHERE user_id = '$id' LIMIT 1";
            $DB= new Database();
            $result = $DB->read($query);


            if ($result) {
                return true;
            } 
            return false;

        }
    }
    
?>