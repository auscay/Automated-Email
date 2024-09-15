<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");  // Redirect to login page if not logged in
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome to Your Dashboard, <?php echo $_SESSION['user']; ?>!</h1>
    </header>

    <section>
        <h2>Manage Your Scheduled Emails</h2>
        <p>Here you can view, edit, or delete your scheduled email notifications.</p>

        <!-- Add dashboard content such as list of scheduled emails -->
        <table>
            <tr>
                <th>Email Recipient</th>
                <th>Subject</th>
                <th>Scheduled Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>example@example.com</td>
                <td>Subject of the email</td>
                <td>2024-09-20 10:30 AM</td>
                <td>Pending</td>
                <td>
                    <button>Edit</button>
                    <button>Delete</button>
                </td>
            </tr>
            <!-- More email notifications here -->
        </table>

        <a href="schedule-email.php">Schedule a New Email</a>

        <br><br>
        <form action="../includes/logout.inc.php" method="POST">
            <button type="submit" name="logout">Logout</button>
        </form>
    </section>
</body>
</html>
