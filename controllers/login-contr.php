<?php

class LoginContr extends Login {
    private $usernameOrEmail;
    private $password;

    public function __construct($usernameOrEmail, $password) {
        $this->usernameOrEmail = $usernameOrEmail;
        $this->password = $password;
    }

    // Login User
    public function loginUser() {
        if ($this->emptyInput() == false) {
            header("Location: ../views/login.php?error=emptyinput");
            exit();
        }

        // Check if user exists and log them in
        $this->getUser($this->usernameOrEmail, $this->password);
    }

    // Error Handler - Check for empty inputs
    private function emptyInput() {
        $result = true;
        if (empty($this->usernameOrEmail) || empty($this->password)) {
            $result = false;
        }
        return $result;
    }
}
