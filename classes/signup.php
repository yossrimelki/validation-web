<?php

    class Signup
    {
        private $error = "";

        public function checkuser ($var,$char)
        {
            $DB= new Database();


		    $sql_u = "SELECT * FROM users WHERE $char='$var'";
		    $res = $DB->check($sql_u);
		    if ($res == false) {
                return false ;
            }
            else{
                return TRUE;
        }
        }
        public function evaluate ($data)
        {


            foreach ($data as $key => $value){
                if (empty($value)){
                    $this->error = $this->error . $key .  " is empry ! <br>" ;
                }
                if ($key == "email"){
                    if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$value)){
                        $this->error = $this->error . "Invalid email !! <br>";
                    }

                    
                    } 
                if ($key =='password'){
                    if(strlen($value) < 8){
                        $this->error = $this->error . "Password too short!! <br>";
                    }
                    if(!preg_match("#[0-9]+#",$value)){
                        $this->error = $this->error . "Password must include at least one number!! <br>";
                    }
                    if (!preg_match("#[a-zA-Z]+#",$value)){
                        $this->error = $this->error . "Password must include at least one letter!! <br>";
                    }
                }
                if($key =="fullname"){
                    if (is_numeric($value)){
                        $this->error = $this->error . "fullname can t be a number<br>";
                    }
                }
                if($key =="username"){
                    if (is_numeric($value)){
                        $this->error = $this->error . "username can t be a numbers <br>";
                    }
                    if (strstr($value," ")){
                        $this->error = $this->error . "spaces invalid in username <br>";
                    }
                }
                
            }
            $num = $this->checkuser($data['username'],"username");
                if ($num== 0){
                    $this->error = $this->error . "username ALready Taken <br>";
                }
            $num1 = $this->checkuser($data['email'],"email");
                if ($num1== 0){
                    $this->error = $this->error . "email ALready Taken <br>";
                }
            
            if ($this->error == ""){

                //labes
                $this->create_user($data);

            }else 
            {
                return $this->error;
            }
            

        }

        public function create_user ($data){
            $username = $data['username'];
            $email = $data['email'];
            $password = $data['password'];
            $fullname = $data['fullname'];
            ///////////////////
            $user_id = $this->create_userid();
            $user_url = strtolower($username);
            ///////////////////
            $query  = "INSERT INTO users 
            (user_id,user_url,username,email,password,fullname) 
            VALUE
             ('$user_id','$user_url', '$username','$email','$password','$fullname')";
            $DB= new Database();
            $DB->save($query);

        }
        private function create_userid()
        {
            $length = rand(4,11);
            $number = "";
            for ($i=0; $i < $length; $i++){
                $new_rand = rand(0,9);
                $number = $number . $new_rand;

            }
            return $number;


        }

    }
?>