<?php
if (isset($_POST['submit'])) {
    
    $recipient_email = $_POST['recipient_email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $scheduled_time = $_POST['scheduled_time'];

    // Include the necessary files
    include "../config/db.php";
    include "../models/schedule_email-model.php";
    include "../controllers/schedule_email-contr.php";

    // Instantiate the Email controller
    $email = new EmailContr($recipient_email, $subject, $body, $scheduled_time);

    // Schedule the email
    $email->scheduleEmail();

    // Redirect or confirm success
    header("Location: ../views/schedule_email.php?success=emailscheduled");
    exit();
}
