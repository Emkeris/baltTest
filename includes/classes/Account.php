<?php     
    class Account {

        private $con;
        private $errorArray;

        public function __construct($con)
        {
            $this->con = $con;
            $this->errorArray = array();
        }

        public function login($un, $pw) {
            $pw = md5($pw);

            $query = mysqli_query($this->con, "SELECT * FROM users WHERE username = '$un' AND password = '$pw'");
            
            if(mysqli_num_rows($query) == 1) {
                return true;
            } else {
                array_push($this->errorArray, Constants::$loginFail);
                return;
            }
        }


        public function register($un, $fn, $ln, $em, $em2, $pw, $pw2) {
            $this->validateUsername($un);
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateEmails($em, $em2);
            $this->validatePasswords($pw, $pw2);

            if(empty($this->errorArray)) {
                return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
            } else {
                return false;
            }
        }

        public function getError($error) {
            if(!in_array($error, $this->errorArray)) {
                $error = '';
            }
            return "<span class='errorMessage'>$error</span>";
        }

        public function registerMessageSuccess() {
            $messageReg = "Sveikiname";
            return $messageReg; 
        }

        private function insertUserDetails($un, $fn, $ln, $em, $pw) {
            $encryoted = md5($pw);
            $date = date("Y-m-d");

            $result = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryoted', '$date')");
            return $result;
        }

        private function validateUsername($un) {
            if(strlen($un) < 5 || strlen($un) > 25 ) {
                array_push($this->errorArray, Constants::$usernameShortLong);
                return;
            }

            $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
            if(mysqli_num_rows($checkUsernameQuery) != 0) {
                array_push($this->errorArray, Constants::$usernameTaken);
                return;
            }
            
        }
        private function validateFirstName($fn) {
            if(strlen($fn) < 2 || strlen($fn) > 25 ) {
                array_push($this->errorArray, Constants::$firstnameShortLong);
                return;
            }
        }
        private function validateLastName($ln) {
            if(strlen($ln) < 2 || strlen($ln) > 25 ) {
                array_push($this->errorArray, Constants::$lastnameShortLong);
                return;
            }
        }
        private function validateEmails($em, $em2) {
            if($em != $em2) {
                array_push($this->errorArray, Constants::$emailNotMatch);
                return;
            }

            if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }

            $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email = '$em'");
            if(mysqli_num_rows($checkEmailQuery) != 0) {
                array_push($this->errorArray, Constants::$emailTaken);
                return;
            }
        }
        private function validatePasswords($pw, $pw2) {
           if($pw != $pw2) {
               array_push($this->errorArray, Constants::$passwordNotMatch);
               return;
           }

           if(strlen($pw) < 2 || strlen($pw) > 25 ) {
                array_push($this->errorArray, Constants::$passwordShortLong);
                return;
            }

            if(preg_match('/[^A-Za-z0-9]/', $pw)) {
                array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
                return;
            }
        }
    }

?> 