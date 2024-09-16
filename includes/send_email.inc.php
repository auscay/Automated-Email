<?php

include "../cron/send_email.php";

// Instantiate and run the email sender
$emailSender = new EmailSender();
$emailSender->processEmails();