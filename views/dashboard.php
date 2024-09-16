<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../views/login.php");
    exit();
}

// Include necessary files
include "../config/db.php";
include "../models/schedule_email-model.php";
include "../controllers/schedule_email-contr.php";

// // Instantiate the controller
$emailController = new EmailContr(null, null, null, null); // No need to pass arguments for fetching emails

// Fetch scheduled emails
$emails = $emailController->fetchScheduledEmails();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

    <h1>Welcome to the Dashboard</h1>
    <p>Hello, <?php echo $_SESSION['user']; ?>!</p>

    <h2>Scheduled Emails</h2>

    <?php if (empty($emails)): ?>
        <p>No emails scheduled yet.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Recipient Email</th>
                <th>Subject</th>
                <th>Body</th>
                <th>Scheduled Time</th>
                <th>Status</th>
                <th>Attempts</th>
            </tr>
            <?php foreach ($emails as $email): ?>
                <tr>
                    <td><?php echo htmlspecialchars($email['recipient_email']); ?></td>
                    <td><?php echo htmlspecialchars($email['subject']); ?></td>
                    <td><?php echo htmlspecialchars($email['body']); ?></td>
                    <td><?php echo htmlspecialchars($email['scheduled_time']); ?></td>
                    <td><?php echo htmlspecialchars($email['status']); ?></td>
                    <td><?php echo htmlspecialchars($email['attempts']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <a href="schedule_email.php">Schedule a New Email</a>

        <br><br>
        <form action="../includes/logout.inc.php" method="POST">
            <button type="submit" name="logout">Logout</button>
        </form>
    </section>
</body>
</html>
