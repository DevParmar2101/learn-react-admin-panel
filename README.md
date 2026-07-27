# CRM API (Laravel 11) - Project Setup Guide

This document contains all the steps required to set up the Laravel backend for our CRM application.

---

# Project Overview

This project will be built using:

- Laravel 11
- MySQL
- Laravel Sanctum (API Authentication)
- Spatie Laravel Permission (Roles & Permissions)
- React (Frontend - Separate Project)

The backend will expose REST APIs that the React application will consume.

---

# Prerequisites

Make sure you have the following installed:

- PHP 8.2+
- Composer
- MySQL
- Git
- Node.js (Optional for backend development)

Verify your installation:

```bash
php -v
composer -V
mysql --version
git --version
```

---

# Step 1 - Create Laravel Project

Create a new Laravel application.

```bash
composer create-project laravel/laravel crm-api
```

Move into the project.

```bash
cd crm-api
```

### Why?

This creates a fresh Laravel project with all the required dependencies.

---

# Step 2 - Configure Environment

Copy the environment file if needed.

```bash
cp .env.example .env
```

Generate the application key.

```bash
php artisan key:generate
```

### Why?

The application key is used for encryption, sessions, password hashing, and other security features.

---

# Step 3 - Configure Database

Create a MySQL database.

Example

```text
crm_api
```

Update your `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crm_api
DB_USERNAME=root
DB_PASSWORD=
```

Run the default migrations.

```bash
php artisan migrate
```

### Why?

Laravel creates its default tables such as:

- users
- password_reset_tokens
- sessions
- cache
- jobs

These tables are required by Laravel's built-in authentication and queue systems.

---

# Step 4 - Install Laravel Sanctum

Install Sanctum.

```bash
composer require laravel/sanctum
```

Publish Sanctum configuration and migrations.

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

Run migrations.

```bash
php artisan migrate
```

### Why?

Laravel Sanctum provides secure API authentication.

Instead of traditional PHP sessions, React will authenticate using API tokens.

Sanctum allows us to:

- Login
- Logout
- Protect API routes
- Authenticate React users
- Manage API tokens securely

Without Sanctum, anyone could access protected APIs.

---

# Step 5 - Install Spatie Laravel Permission

Install the package.

```bash
composer require spatie/laravel-permission
```

Publish configuration and migrations.

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

Run migrations.

```bash
php artisan migrate
```

### Why?

A CRM usually has multiple types of users.

Example:

- Super Admin
- Admin
- Manager
- Sales Executive
- Support Staff

Each role should have different permissions.

Examples:

| Role | Permissions |
|-------|-------------|
| Admin | Everything |
| Manager | Customers + Leads |
| Sales | Customers + Tasks |
| Support | Customers (View Only) |

Instead of writing custom permission logic, Spatie handles it efficiently.

---

# Step 6 - Install Laravel Debugbar

Install Debugbar.

```bash
composer require barryvdh/laravel-debugbar --dev
```

### Why?

Debugbar is a development tool.

It shows:

- Executed SQL queries
- Request information
- Route details
- Execution time
- Memory usage

This helps us optimize and debug our application.

---

# Step 7 - Install Laravel Pint

Install Pint.

```bash
composer require laravel/pint --dev
```

Run Pint.

```bash
./vendor/bin/pint
```

### Why?

Pint automatically formats PHP code according to Laravel's coding standards.

Benefits:

- Cleaner code
- Consistent formatting
- Easier collaboration
- Better readability

---

# Step 8 - Install Laravel IDE Helper (Optional)

Install IDE Helper.

```bash
composer require --dev barryvdh/laravel-ide-helper
```

Generate helper files.

```bash
php artisan ide-helper:generate
```

### Why?

Improves IDE support by providing:

- Better autocompletion
- Better code navigation
- Better type hints

Useful when working with large Laravel projects.

---

# Step 9 - Create Storage Link

```bash
php artisan storage:link
```

### Why?

Allows uploaded files to be publicly accessible.

We'll use this later for:

- Profile Images
- Customer Documents
- Attachments
- Company Logos

---

# Step 10 - Start Development Server

```bash
php artisan serve
```

The application will run on:

```
http://127.0.0.1:8000
```

### Why?

Starts Laravel's local development server.

---

# Step 11 - Initialize Git

Initialize Git.

```bash
git init
```

Add files.

```bash
git add .
```

Create the first commit.

```bash
git commit -m "Initial Laravel CRM API setup"
```

### Why?

Git allows us to:

- Track changes
- Revert mistakes
- Collaborate
- Maintain version history

---

# Current Project Structure

```
crm-api
│
├── app
├── bootstrap
├── config
├── database
├── public
├── resources
├── routes
├── storage
├── tests
└── vendor
```

---

# Additional Folders (Recommended)

As the project grows, create these folders to keep the code organized.

```
app
│
├── Enums
├── Helpers
├── Services
├── Traits
│
├── Http
│   ├── Controllers
│   │    └── API
│   │
│   ├── Requests
│   ├── Resources
│   └── Middleware
```

### Why?

Following a clean architecture keeps business logic separated from controllers and makes the project easier to maintain.

---

# Packages Installed

| Package | Purpose |
|----------|---------|
| Laravel Sanctum | API Authentication |
| Spatie Permission | Roles & Permissions |
| Laravel Debugbar | Debugging |
| Laravel Pint | Code Formatting |
| IDE Helper | Better IDE Support |

---

# Packages We'll Install Later

We'll install these only when they're needed.

- Laravel Excel
- DomPDF
- Laravel Activitylog
- Intervention Image
- Laravel Backup
- Laravel Telescope

Installing packages only when needed keeps the project lightweight.

---

# Development Roadmap

## Phase 1

- Project Setup
- Authentication
- User Profile
- Roles
- Permissions

---

## Phase 2

- Customer Module

---

## Phase 3

- Lead Module

---

## Phase 4

- Task Module

---

## Phase 5

- Dashboard APIs

---

## Phase 6

- Reports
- Notifications
- Activity Logs
- Settings

---

# API Architecture

```
React Frontend
        │
        │ HTTP (Axios)
        ▼
Laravel REST API
        │
        ▼
Service Layer
        │
        ▼
Models
        │
        ▼
MySQL Database
```

---

# Goal

By the end of this project, we will have built a production-style CRM backend with:

- Secure Authentication
- REST APIs
- Roles & Permissions
- CRUD Operations
- Dashboard APIs
- File Uploads
- Reports
- Notifications
- Activity Logs
- Clean Code Architecture
- React Integration
