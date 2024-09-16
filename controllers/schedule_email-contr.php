<?php

// Set the timezone to West Africa Time (WAT)
date_default_timezone_set('Africa/Lagos');

class EmailContr extends Email {
    private $recipient_email;
    private $subject;
    private $body;
    private $scheduled_time;

    public function __construct($recipient_email, $subject, $body, $scheduled_time) {
        $this->recipient_email = $recipient_email;
        $this->subject = $subject;
        $this->body = $body;
        $this->scheduled_time = $scheduled_time;
    }

    // Schedule an email by validating inputs and calling the model method
    public function scheduleEmail() {
        if ($this->emptyInput() == false) {
            header("Location: ../views/schedule_email.php?error=emptyinput");
            exit();
        }
        if ($this->invalidEmail() == false) {
            header("Location: ../views/schedule_email.php?error=invalidemail");
            exit();
        }
        if ($this->invalidTime() == false) {
            header("Location: ../views/schedule_email.php?error=invalidtime");
            exit();
        }

        // Schedule the email in the database
        $this->scheduleEmailInDb();
    }

    // Check if any input fields are empty
    private function emptyInput() {
        $result = true;
        if (empty($this->recipient_email) || empty($this->subject) || empty($this->body) || empty($this->scheduled_time)) {
            $result = false;
        }
        return $result;
    }

    // Validate email format
    private function invalidEmail() {
        $result = true;
        if (!filter_var($this->recipient_email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        }
        return $result;
    }

    // Ensure scheduled time is a future date and time
    private function invalidTime() {
        $result = true;
        $current_time = new DateTime();
        $scheduled_time = new DateTime($this->scheduled_time);

        if ($scheduled_time <= $current_time) {
            $result = false;
        }
        return $result;
    }

    // Call the model to schedule the email
    private function scheduleEmailInDb() {
        $this->setScheduleEmail($this->recipient_email, $this->subject, $this->body, $this->scheduled_time);
    }

    // Get all emails to display on the dashboard
    public function fetchScheduledEmails() {
        return $this->getAllScheduledEmails();
    }
}
