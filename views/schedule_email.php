<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Email</title>
</head>
<body>
    <h1>Schedule an Email Notification</h1>

    <form action="../includes/schedule_email.inc.php" method="POST">
        <label for="recipient_email">Recipient Email:</label><br>
        <input type="email" id="recipient_email" name="recipient_email" required><br><br>

        <label for="subject">Subject:</label><br>
        <input type="text" id="subject" name="subject" required><br><br>

        <label for="body">Body:</label><br>
        <textarea id="body" name="body" rows="5" required></textarea><br><br>

        <label for="scheduled_time">Scheduled Time:</label><br>
        <input type="datetime-local" id="scheduled_time" name="scheduled_time" required><br><br>

        <button type="submit" name="submit">Schedule Email</button>
    </form>

</body>
</html>
