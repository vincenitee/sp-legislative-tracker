# Provincial Ordinances and Resolutions Management & Search System

A web-based legislative tracking and public search application developed for the **Computer Programmer I Practical Programming Examination** (Sangguniang Panlalawigan of La Union).

---

## 1. Applicant Information
- **Applicant Name:** Vincent A. Bolinget
- **Position Applied For:** Computer Programmer I

---

## 2. Technologies and Versions Used
- **Framework:** Laravel 12.x / 13.x
- **Programming Language:** PHP 8.5 (compatible with PHP 8.2+)
- **Database:** MySQL 8.4 (compatible with MySQL 8.0+ / MariaDB)
- **Frontend / Styling:** Blade Templates, Bootstrap 5.3 (via CDN), Bootstrap Icons 1.11 (via CDN)
- **Dependency Manager:** Composer 2.x

---

## 3. Summary of Features Implemented

### A. User Authentication
- Session-based login and logout for authorized administrative users (`AuthController`).
- Route protection using Laravel's `auth` and `guest` middleware.
- Automatic redirection of unauthenticated users attempting to access `/admin/*` pages to `/login`.

### B. Provincial Ordinances Module (Admin)
- Full CRUD operations: Create, View list, View details, Edit/Update, and Delete (with confirmation prompt).
- Search and filter by **Ordinance Number**, **Title** (supports exact and partial keyword matching), and **Date Passed**.
- Server-side validation ensuring required fields are not blank, `ordinance_number` is unique, and `date_passed` is a valid date.

### C. Provincial Resolutions Module (Admin)
- Full CRUD operations: Create, View list, View details, Edit/Update, and Delete (with confirmation prompt).
- Search and filter by **Resolution Number**, **Title** (supports exact and partial keyword matching), and **Date Passed**.
- Server-side validation ensuring required fields are not blank, `resolution_number` is unique, and `date_passed` is a valid date.

### D. Public Legislative Search (Unauthenticated / View-Only)
- Publicly accessible search portal at `/` without logging in.
- Unified search across **Provincial Ordinances**, **Provincial Resolutions**, or **Both**.
- Supports both **exact** and **partial** keyword searches on titles (e.g., searching `agricultur` returns records containing `agriculture`, and `environment` returns records containing `environment`).
- Clearly labels each result with a visual badge (**Ordinance** vs. **Resolution**) and provides read-only detail pages without administrative actions.

---

## 4. Database Setup & Configuration Instructions

### Step 1: Create the MySQL Database
Log in to MySQL and create a new database:
```sql
CREATE DATABASE sp_legislative_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 2: Configure Environment Variables
Copy the `.env.example` file to `.env`:
```bash
cp .env.example .env
```
Open `.env` and configure your MySQL database connection settings:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sp_legislative_db
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

---

## 5. Installation and Running the Application

Run the following commands from the project root directory:

```bash
# 1. Install PHP dependencies
composer install

# 2. Generate the application encryption key
php artisan key:generate

# 3. Run database migrations and seed initial records & admin user
php artisan migrate --seed

# 4. Start the local development server
php artisan serve
```

Once the server is running, open your browser and visit:
- **Public Legislative Search:** `http://127.0.0.1:8000`
- **Administrator Login:** `http://127.0.0.1:8000/login`

---

## 6. Default Login Credentials

Running `php artisan migrate --seed` (or `php artisan db:seed`) creates the following pre-configured administrator account:

- **Email:** `admin@launion.gov.ph`
- **Password:** `password123`

*(It also seeds sample Provincial Ordinances and Provincial Resolutions so search and filtering can be tested immediately.)*

---

## 7. Known Limitations
- **File Uploads:** This version stores ordinance and resolution metadata and text summaries in MySQL; PDF/document file attachments are not included in this baseline build.
- **User Management UI:** As specified in the examination guidelines, user registration is not required and authentication uses the seeded administrator account.