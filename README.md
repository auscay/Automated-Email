# Email Scheduling and Notification System

This project is a simple **Email Scheduling and Notification System** built using **PHP**, **MySQL**, and **PHPMailer**. Users can schedule emails to be sent at a future date and time. The system checks for pending emails periodically using a cron job and sends them automatically.

## Features

- **User Authentication**: Users can sign up, log in, and access a personalized dashboard.
- **Email Scheduling**: Users can schedule emails to be sent at a specific future date and time.
- **Automated Email Sending**: A cron job checks the database every minute for pending emails and sends them using PHPMailer.
- **Failed Emails Handling**: The system retries failed emails and logs the status of each email.
- **PHP Sessions**: Protects certain pages (like the dashboard) by ensuring only logged-in users can access them.

## Prerequisites

Before running the project, make sure you have the following installed:

- PHP (>=7.3)
- MySQL
- Composer (for dependency management)
- PHPMailer (installed via Composer)

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/email-scheduling-app.git
cd email-scheduling-app

```
### 2. Install Dependencies

#### Make sure you have Composer installed, then run:

```bash
composer install
```
#### This will install PHPMailer and other dependencies.

### 3. Create the .env File

#### Create a .env file in the project root and define your sensitive configurations:

```bash
DB_HOST=your_db_host
DB_NAME=your_db_name
DB_USER=your_db_user
DB_PASSWORD=your_db_password

SMTP_HOST=smtp.yourmailprovider.com
SMTP_PORT=587
SMTP_USER=your_email@domain.com
SMTP_PASS=your_email_password
```
### 4. Setup the Database

#### Create the MySQL database and import the SQL schema:

```sql
CREATE DATABASE email_scheduler;
USE email_scheduler;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE scheduled_emails (
  email_id INT AUTO_INCREMENT PRIMARY KEY,
  recipient_email VARCHAR(255) NOT NULL,
  subject VARCHAR(255) NOT NULL,
  body TEXT NOT NULL,
  scheduled_time DATETIME NOT NULL,
  status ENUM('pending', 'sent', 'failed') DEFAULT 'pending',
  attempts INT DEFAULT 0
);
```
### 5. Configure Database Connection

#### Edit the config/db.php file to load the environment variables using the vlucas/phpdotenv package.

```php
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class Dbh {
    protected function connect() {
        $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'];
        try {
            $pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }
}
```
### 6. Run the Application
#### Serve the PHP application locally (or on your preferred server). If using PHP’s built-in server, run:

```bash
php -S localhost:8000
```
#### Then, open http://localhost:8000 in your browser.

### 7. Setup Cron Job for Email Sending

##### Set up a cron job to run every minute to process scheduled emails:

###### 1. Open the crontab editor:
```bash
crontab -e
```
###### 2. Add the following line to execute the email sending script every minute:
```bash
* * * * * /usr/bin/php /path/to/project/includes/send_email.inc.php
```
##### Make sure the path to your PHP binary and project directory is correct.

## Usage

- **Sign up:** Create an account on the signup page.
- **Login:** Log in to your account and access the dashboard.
- **Schedule an Email:** Enter the recipient's email, subject, body, and scheduled time.
- **View Scheduled Emails:** Check the dashboard for a list of all scheduled and sent emails.
- **Automated Sending:** The system will automatically send emails when their scheduled time is reached.

## File Structure
```bash
project-root/
│
├── .env
├── .gitignore
├── composer.json
├── composer.lock
├── config.php
├── index.php
├── project.sql
├── README.md
│
├── config/
│   └── db.php
│
├── controllers/
│   ├── login-contr.php
│   ├── schedule_email-contr.php
│   └── signup-contr.php
│
├── includes/
│   ├── login.inc.php
│   ├── logout.inc.php
│   ├── schedule_email.inc.php
│   ├── send_email.inc.php
│   └── signup.inc.php
│
├── models/
│   ├── login-model.php
│   ├── schedule_email-model.php
│   └── signup-model.php
│
├── cron/
│   └── send_email.php
│
└── views/
    ├── dashboard.php
    ├── login.php
    ├── schedule_email.php
    └── signup.php

```

## Future Enhancements
- Add functionality for recurring email schedules.
- Implement a more robust error logging mechanism.
- Implement email templates for better customization.

## Technologies Used
- **PHP:** Backend language
- **MySQL:** Database to store users and email schedules
- **PHPMailer:** To handle email sending
- **Composer:** PHP dependency management
- **Dotenv:** For managing environment variable

## Contributions
Contributions are welcome! Feel free to submit a pull request or open an issue.

