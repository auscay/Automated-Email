<?php

class Signup extends Dbh {

      // Create user in db
      protected function setUser($username, $email, $password) {
        $stmt = $this->connect()->prepare('INSERT INTO users (users_username, users_email, users_password) VALUES (?, ?, ?);');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Execute and check if statement fails
        if (!$stmt->execute(array($username, $email, $hashedPassword))) {
            $stmt = null; // Close the statement
            header("Location: ../views/signup.php?error=stmtfailed");
            exit();
        }

        $stmt = null; // Close statement after successful execution
    }   

    // Check for duplicate username or email
    protected function checkUser($username, $email) {
        $stmt = $this->connect()->prepare('SELECT users_username FROM users WHERE users_username = ? OR users_email = ?;');

        // Execute and check if statement fails
        if (!$stmt->execute(array($username, $email))) {
            $stmt = null; // Close the statement
            header("Location: ../views/signup.php?error=stmtfailed");
            exit();
        }

        // Check if any rows are returned
        if ($stmt->rowCount() > 0) {
            $resultCheck = false; // User exists
        } else {
            $resultCheck = true;  // User does not exist
        }

        $stmt = null; // Close statement
        return $resultCheck;
    }

}