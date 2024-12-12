# **Project Name**

Zeroplex Task Manager is a Laravel-based application where users can manage their tasks.

---

## **Table of Contents**
- [Project Overview](#project-overview)
- [Features](#features)
- [Installation](#installation)
- [Configuration](#configuration)
- [Running the Application](#running-the-application)
- [Roles & Permissions](#roles--permissions)
- [Email Notifications](#email-notifications)
- [Package used](#package-used)

---

## **Project Overview**

This project includes features such as task management, role-based permissions, scheduled commands, and email notifications processed through queues.

---

## **Features**
- Task management system where users can create and manage tasks.
- Role-based access control with **Admin** and **Regular User** roles.
- Email notifications for task-related events (e.g., task due dates or new comments).
- Ability for users to comment on tasks.
- Laravel queue for background task processing (e.g., sending emails).
- Use of Redis for queue management.
- Supervisord setup for running the queue worker as a background process.

---

## **Installation**

### **Requirements**
- Docker installed

### **Steps**

1. **Clone the Repository**:
   Clone the repository to your local machine:

   ```bash
   git clone https://github.com/jolace/zeroplex-assessment.git
   cd zeroplex-assessment
   ``` 
2. **Create the `.env` file and copy variables from `.env.example`**:  
   Before running Docker containers, ensure that the database environment variable values are properly configured in the `.env` file.
    ```bash
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ``` 
3. **Build and Start Docker Containers**:
    ```bash
    docker-compose up -d --build
    ```
4. **Install Composer Dependencies (inside the container)**:
    ```bash
    docker-compose exec [laravel-docker] composer install
    ```
5. **Generate Application Key**:
    ```bash
    docker-compose exec [laravel-docker] php artisan key:generate
    ```
6. **Set up MySql connection and host**
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=[mysql-docker-name]
    ```
7. **Run Migrations**:
    ```bash
    docker-compose exec [laravel-docker] php artisan migrate
    ```
8. **Run Seeders**:
    ```bash
    docker-compose exec [laravel-docker] php artisan db:seed
    ```
9. **Install npm dependencies**:
    ```bash
    docker-compose exec [laravel-docker] npm install
    ```
10. **Add permissions to storage folder**
    ```bash
    docker-compose exec [laravel-docker] chmod 777 -R storage
    ```
## **Configuration**
### **Steps**

1. **Set up Mailtrap configuration**:
    ```bash
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=your_username
    MAIL_PASSWORD=your_password
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=no-reply@yourapp.com
    MAIL_FROM_NAME="${APP_NAME}"
    ```
2. **Set up Redis configuration**:
    ```bash
    QUEUE_CONNECTION=redis
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    ```
# Running the Application

Open your browser and visit http://localhost 
# Roles & Permissions

This project utilizes Spatie's Laravel Permission package to manage roles and permissions.

## Roles:
- **Admin**: Can manage all tasks and users.
- **Regular User**: Can only manage their own tasks.

## Assigning Roles:
Roles are assigned to users automatically upon creation (via the User model).

# Email Notifications
Email notifications are sent to users in the following scenarios:

- When a task is due.
- When a new comment is added to a task.

To ensure emails are sent, make sure that your mail configuration (MailTrap) is properly set in `.env`.


# Package used

1. laravel/breeze for Auth routes and views

2. Spatie for Laravel roles and permissions https://spatie.be/docs/laravel-permission/v6/introduction

3. jstable -  A lightweight, dependency-free JavaScript plugin that makes an HTML table interactive https://jstable.github.io/

4. Notyf is a minimalistic JavaScript library for toast notifications. - https://github.com/caroso1222/notyf

5. FontAwesome icon library and toolkit  https://fontawesome.com/