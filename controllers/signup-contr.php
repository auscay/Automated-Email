<?php

class SignupContr extends Signup {
    private $username;
    private $email;
    private $password;
    private $password_repeat;

    // constructor method 
    public function __construct($username, $email, $password, $password_repeat) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->password_repeat = $password_repeat;
    }

    // Signup User
    public function signupUser() {
        if ($this->emptyInput() == false) {
            // header("Location: ../views/signup.php?error=emptyinput");
            echo "Empty Input";
            exit();
        }
        if ($this->invalidUsername() == false) {
            header("Location: ../views/signup.php?error=invalidusername");
            exit();
        }
        if ($this->invalidEmail() == false) {
            header("Location: ../views/signup.php?error=invalidemail");
            exit();
        }
        if ($this->pwdMatch() == false) {
            header("Location: ../views/signup.php?error=passwordnotmatch");
            exit();
        }
        if ($this->userExists() == false) {
            header("Location: ../views/signup.php?error=userexists");
            exit();
        }

        $this->setUser($this->username, $this->email, $this->password);
    }

    // Error Handlers
    private function emptyInput() {
        $result = true;
        if (empty($this->username) || empty($this->email) || empty($this->password) || empty($this->password_repeat)) {
            $result = false;
        }
        return $result;
    }

    private function invalidUsername() {
        $result = true;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->username)) {
            $result = false;
        }
        return $result;
    }

    private function invalidEmail() {
        $result = true;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        }
        return $result;
    }

    private function pwdMatch() {
        $result = true;
        if ($this->password !== $this->password_repeat) {
            $result = false;
        }
        return $result;
    }

    private function userExists() {
        $result = true;
        if (!$this->checkUser($this->username, $this->email)) {
            $result = false;
        }
        return $result;
    }
}
