# Simple Login System

## Student Information

- Student Name: **Jessiebel Banalo**
- Course : **BSIT**

## Project Description

This project is a simple login system for a college laboratory activity. It uses standalone Apache, PHP, and PostgreSQL software.

The system includes a login page, successful-login page, protected dashboard, and logout function.

The project does not use XAMPP, Laragon, WAMP, EasyPHP, Docker, Composer, or any bundled web-server package.

## Software Requirements

- Windows 10/11 or Ubuntu Linux
- Apache 2.4
- PHP 8.5.9 or later stable version
- PostgreSQL 18
- pgAdmin 4 (optional)

## Project Structure

```text
login-system/
├── config/
│   └── database.php
├── public/
│   ├── index.php
│   ├── success.php
│   ├── dashboard.php
│   └── logout.php
├── assets/
│   └── css/style.css
├── sql/
│   └── database.sql
├── screenshots/
├── docs/
├── README.md
└── .gitignore
```

## Installation Instructions

1. Install Apache, PHP, and PostgreSQL separately.
2. Configure Apache to load PHP using `php8apache2_4.dll`.
3. Enable `pdo_pgsql` and `pgsql` in `C:\php\php.ini`.
4. Create the PostgreSQL database named `lab_login`.
5. Run `sql/database.sql` in pgAdmin or PostgreSQL.
6. Place this project inside the Apache document root:

```text
C:\Apache24\htdocs\login-system
```

7. Start Apache and PostgreSQL.
8. Open the application:

```text
http://localhost/login-system/public/
```

## Database Configuration

The application connects to PostgreSQL using PDO.

```text
Host: 127.0.0.1
Port: 5432
Database: lab_login
User: postgres
```

Set the PostgreSQL password in PowerShell. Replace the value with the password configured for the `postgres` user:

```powershell
setx DB_HOST "127.0.0.1"
setx DB_PORT "5432"
setx DB_NAME "lab_login"
setx DB_USER "postgres"
setx DB_PASSWORD "your-postgres-password"
```

Restart Apache after setting the variables. Do not commit database passwords to GitHub.

## Database Table

The `users` table contains:

```text
id        SERIAL PRIMARY KEY
username  VARCHAR(50) UNIQUE
password  VARCHAR(255)
fullname  VARCHAR(100)
```

## Login Credentials for Testing

```text
Username: admin
Password: Admin@123!

Username: jane
Password: Password123!

Username: banalo
Password: banalo 123
```

Passwords are stored as secure hashes using `password_hash()` and checked using `password_verify()`.

## Screenshots of the Application

Place the required screenshots in the `screenshots/` folder:

1. [Login Page](screenshots/login-page.png)
2. [Invalid Login Attempt](screenshots/invalid-login.png)
3. [Successful Login](screenshots/successful-login.png)
4. [Dashboard and Logout](screenshots/dashboard%20and%20logout.png)
5. [PostgreSQL Database](screenshots/postgresql-database.png)
6. [Users Table and Sample Records](screenshots/users-table-records.png)
7. [Apache/PHP Verification](screenshots/apache-php-verification.png)

## Technical Requirements Demonstrated

- PHP sessions
- PostgreSQL database connection
- PDO prepared statements
- Input validation
- Error handling
- Password hashing and verification
- Protected dashboard access
- Session destruction during logout

## Documentation

The project documentation PDF is located at:

```text
docs/simple-login-system-documentation.pdf
```

## GitHub Repository

Repository naming format:

```text
webserver-login-lab-[lastname]
```

The repository should be public and should contain the complete source code, SQL script, README, screenshots, and documentation PDF.
