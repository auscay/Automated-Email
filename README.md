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

### 2. Install Dependencies