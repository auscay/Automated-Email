<?php

// echo "Hello world";

if (isset($_POST['submit'])) {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];


    include "../config/db.php";
    include "../models/signup-model.php";
    include "../controllers/signup-contr.php";

    // Instantiate Signup Controller
    $signup = new SignupContr($username, $email, $password, $password_repeat);

    // Running Error Handlers and Signing up the user
    $signup->signupUser();

    // Back to Login Page
    header("Location: ../views/login.php?error=successfulsignup");
    // echo "User signup successful";


}