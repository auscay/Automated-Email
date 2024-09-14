<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="../includes/login.inc.php" method="post">
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter your username" name="usernameOrEmail" required>
        <br><br>
        <br><br>
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <br><br>
        <br><br>
        <button type="submit" name="submit">Login</button>
    </form>
</body>
</html>