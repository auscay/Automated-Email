<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <form action="../includes/signup.inc.php" method="post">
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter your username" name="username" required>
        <br><br>
        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" required>
        <br><br>
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <br><br>
        <label for="password_repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Confirm Password" name="password_repeat" required>
        <br><br>
        <button type="submit" name="submit">Signup</button>
    </form>
    <p>Have an account already? <a href="../views/login.php">Login</a></p>
</body>
</html>