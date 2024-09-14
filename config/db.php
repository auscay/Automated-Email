<?php

class Dbh {

    // Database connection
    protected function connect() {
        try {
            $username = "root";
            $password = "rickross99$$";
            $dbh = new PDO('mysql:host=localhost;dbname=automated_email', $username, $password);
            // echo "Database success!";
            return $dbh;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br>";
            die();
        }
    }
}