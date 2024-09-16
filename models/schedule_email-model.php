<?php

class Email extends Dbh {

    // Schedule an email in the database
    protected function setScheduleEmail($recipient_email, $subject, $body, $scheduled_time) {
        $stmt = $this->connect()->prepare('INSERT INTO scheduled_emails (recipient_email, subject, body, scheduled_time, status, attempts) VALUES (?, ?, ?, ?, ?, ?);');

        $status = 'pending';  // Status is pending until sent
        $attempts = 0;  // Start with 0 attempts

        if (!$stmt->execute(array($recipient_email, $subject, $body, $scheduled_time, $status, $attempts))) {
            $stmt = null;
            header("Location: ../views/schedule-email.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    // Get emails that are pending and ready to be sent
    protected function getPendingEmails() {
        $stmt = $this->connect()->prepare('SELECT * 
        FROM scheduled_emails 
        WHERE status IN (?, ?) AND scheduled_time <= NOW()');
        // Define statuses to retrieve
        $statusPending = 'pending';
        $statusFailed = 'failed';

        if (!$stmt->execute(array($statusPending, $statusFailed))) {
            $stmt = null;
            header("Location: ../cron/send-email.php?error=stmtfailed");
            exit();
        }

        // Fetch all pending emails
        $emails = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        return $emails;
    }

       // Fetch all scheduled emails from the database
       protected function getAllScheduledEmails() {
        $stmt = $this->connect()->prepare('SELECT * FROM scheduled_emails ORDER BY scheduled_time DESC;');

        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../views/dashboard.php?error=stmtfailed");
            exit();
        }

        $emails = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        return $emails;
    }

    // Update email status after attempting to send it
    protected function updateEmailStatus($email_id, $status, $attempts) {
        $stmt = $this->connect()->prepare('UPDATE scheduled_emails SET status = ?, attempts = ? WHERE email_id = ?;');

        if (!$stmt->execute(array($status, $attempts, $email_id))) {
            $stmt = null;
            header("Location: ../cron/send-email.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}
