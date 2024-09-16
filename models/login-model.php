<?php

class Login extends Dbh {

    // Check if user exists and password matches
    protected function getUser($usernameOrEmail, $password) {
        $stmt = $this->connect()->prepare('SELECT users_password FROM users WHERE users_username = ? OR users_email = ?;');

        if (!$stmt->execute(array($usernameOrEmail, $usernameOrEmail))) {
            $stmt = null;
            header("Location: ../views/login.php?error=stmtfailed");
            exit();
        }

        // Check if a user exists with the provided username or email
        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../views/login.php?error=usernotfound");
            exit();
        }

        // Fetch the user details (including hashed password)
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password using password_verify
        $checkPwd = password_verify($password, $user['users_password']);

        if ($checkPwd === false) {
            $stmt = null;
            header("Location: ../views/login.php?error=wrongpassword");
            exit();
        } elseif ($checkPwd === true) {
            // Password matches, login successful
            // Start session and set session variables
            session_start();
            $_SESSION['user'] = $usernameOrEmail;  // Store username in session
            $_SESSION['logged_in'] = true;

            // Clear statement
            $stmt = null;
        }
    }

}
