<?php

// Load PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';  // If you're using Composer to install PHPMailer

include "../config/db.php";
include "../models/schedule_email-model.php";

class EmailSender extends Email {

    // Fetch pending emails and send them (or log them for now)
    public function processEmails() {
        // Fetch emails marked as 'pending' where their scheduled time has passed
        $emails = $this->getPendingEmails();

        // Check if any emails are returned
        if (count($emails) > 0) {
            foreach ($emails as $email) {
                // Initialize PHPMailer
                $mail = new PHPMailer(true);

                try {
                    // Server settings
                    $mail->isSMTP();                                             // Set mailer to use SMTP
                    $mail->Host       = $_ENV['MAIL_HOST'];                       // Specify SMTP server (e.g., smtp.gmail.com)
                    $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
                    $mail->Username   = $_ENV['MAIL_USERNAME'];                 // SMTP username
                    $mail->Password   = $_ENV['MAIL_PASSWORD'];                    // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           // Enable SMTP encryption
                    $mail->Port       = $_ENV['MAIL_PORT'];                                      // SMTP port to connect to

                    // Recipients
                    $mail->setFrom('automatedmail.com', 'Automated Mail');
                    $mail->addAddress($email['recipient_email']);                 // Add recipient

                    // Content
                    $mail->isHTML(true);                                         // Set email format to HTML
                    $mail->Subject = $email['subject'];
                    $mail->Body    = $email['body'];

                    // Attempt to send the email
                    $mail->send();

                    // Log message for debugging
                    $logMessage = "Email to: " . $email['recipient_email'] . "\n";
                    $logMessage .= "Subject: " . $email['subject'] . "\n";
                    $logMessage .= "Body: " . $email['body'] . "\n";
                    $logMessage .= "Scheduled Time: " . $email['scheduled_time'] . "\n";
                    $logMessage .= "Status: Sent\n";

                    // Update email status to 'sent' if successful
                    $this->updateEmailStatus($email['email_id'], 'sent', $email['attempts'] + 1);

                } catch (Exception $e) {
                    // Handle PHPMailer exception and log failure
                    $logMessage = "Email to: " . $email['recipient_email'] . "\n";
                    $logMessage .= "Subject: " . $email['subject'] . "\n";
                    $logMessage .= "Body: " . $email['body'] . "\n";
                    $logMessage .= "Scheduled Time: " . $email['scheduled_time'] . "\n";
                    $logMessage .= "Status: Failed to send. Error: " . $mail->ErrorInfo . "\n";

                    // Update email status to 'failed' if there was an error
                    $this->updateEmailStatus($email['email_id'], 'failed', $email['attempts'] + 1);
                }

                // Output the log message for debugging purposes
                echo nl2br($logMessage);
            }
        } else {
            echo "No pending emails to process.\n";
        }
    }
}
