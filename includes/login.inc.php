<?php

if (isset($_POST['submit'])) {

    // Sanitize input
    $usernameOrEmail = htmlspecialchars($_POST['usernameOrEmail']);
    $password = $_POST['password'];

    // Include necessary files
    include "../config/db.php";
    include "../models/login-model.php";
    include "../controllers/login-contr.php";

    // Instantiate Login Controller
    $login = new LoginContr($usernameOrEmail, $password);

    // Running Error Handlers and Logging in the user
    $login->loginUser();

    // If successful, this will redirect to dashboard or another page
}
