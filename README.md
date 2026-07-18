# 🏛️ Uma Foundation - Community Management System

A modern, database-driven, secure web application designed to manage community services, streamline administrative workflows, and connect community members. Built with a responsive **Vanilla CSS glassmorphism UI**, a **PHP** backend, and a cloud-hosted **TiDB (Serverless MySQL) database with SSL security**.

[![Live Demo](https://img.shields.io/badge/Live%20Demo-Active-brightgreen)](https://uma-foundation.onrender.com)
[![Docker](https://img.shields.io/badge/Docker-Supported-blue)](https://www.docker.com/)
[![PHP](https://img.shields.io/badge/PHP-%3E%3D%208.1-777BB4)](https://www.php.net/)
[![Database](https://img.shields.io/badge/Database-TiDB%20Cloud%20(MySQL)-blueviolet)](https://pingcap.com/products/tidb-cloud)

---

## 🌟 Key Features & Modules

### 1. 👥 Multi-Tier User & Role Management
* **Authentication**: Secure registration, login, and logout flow using custom session variables.
* **OTP Verification**: Email verification via SMTP OTP to prevent spam and dummy registrations.
* **Granular Role Hierarchy**:
  * `Not Verified`: Registered users pending verification.
  * `Member`: Basic community members who can book halls, donate, and apply for scholarships.
  * `Committee Member`: Middle tier with partial access to review community tasks.
  * `Committee Major`: High-tier decision-makers.
  * `Admin`: Superusers managing configuration files, adding announcements, and approving portal requests.

### 2. 💳 Razorpay Donation Gateway Integration
* **Support Causes**: Integrated donation forms for Temple Garbhgruh Pillars, Platinum/Golden/Silver Donors, Tree Planting, Education/Health foundations, and Food Donations (Birthdays/Anniversaries).
* **Payment Security**: Razorpay API integration with verification callbacks to prevent checkout spoofing and ensure transaction authenticity.
* **Analytics**: Administrative tables tracking every successful donation with transaction details.

### 3. 📢 Announcement & Event Portal
* **Dynamic Announcements**: Category-based publishing (e.g., Events, Cricket Matches, Scholarships, Drawing Competitions).
* **Targeted Posting**: Events are automatically displayed with custom banners, dates, descriptions, and downloadable PDF registration forms.
* **Auto-Archiving**: Date checking keeps inactive or expired announcements from cluttering the homepage.

### 4. 🎓 Scholarship Application System
* **Academic Aid**: Students from the community can apply directly through a dedicated portal.
* **Verification Documents**: File upload inputs for Aadhaar cards, father/mother income certificates, previous year marksheets, and fee receipts.
* **Approval Pipeline**: Trackable bank details (Bank Name, IFSC Code, Account Number) for secure financial disbursement upon admin review.

### 5. 🏢 Smart Hall Booking Module
* **Resource Booking**: Members can check community hall capacity, location, rent pricing, and book time slots.
* **Double-Booking Prevention**: Start/End date validations to avoid overlapping reservations.
* **Admin Review**: Bookings enter a pending state until verified.

### 6. 🛠️ Admin Dashboard (AdminLTE Framework)
* **Master Configurations**: Screens to manage master records (`Add Hall`, `Add Event`, `Add Announcement Type`).
* **Interactive Datatables**: Responsive tables for filtering, reviewing, and approving:
  * Community members and role promotion requests.
  * Successful donations and scholarship applications.
  * Active hall bookings and transactions.

---

## 🛠️ Tech Stack & Architecture

| Layer | Technologies |
| :--- | :--- |
| **Frontend** | HTML5, Vanilla CSS3 (Glassmorphism & Dark Mode theme), Vanilla JavaScript, FontAwesome 6, Google Fonts (Inter) |
| **Backend** | PHP (Session-based Security, Object-oriented DB connectors) |
| **Database** | TiDB Cloud (Serverless MySQL with SSL enforcement) |
| **Dependencies** | Razorpay SDK (v2.9.0), PHPMailer (SMTP Integration) |
| **DevOps** | Docker, Apache (`mod_rewrite` enabled) |

---

## 📂 Project Structure

```bash
├── Admin/                        # AdminLTE dashboard files and folders
│   ├── pages/
│   │   ├── forms/                # Add Hall Master, Add Event, Add Scholarship, etc.
│   │   └── tables/               # Show Hall, Show Announcements, Show Donations, etc.
│   ├── aside.php                 # Sidebar navigation component
│   └── index.php                 # Administrative analytics home
├── Ajax_file/                    # Asynchronous script handlers
├── Authentication/               # User authentication assets
├── razorpay-php-2.9.0/           # Razorpay PHP SDK integration
├── test1/                        # Core public modules & forms
│   ├── announcement.php          # Announcement viewer portal
│   ├── donationform.php          # Razorpay donation interface
│   ├── hallbooking.php           # Hall availability and booking form
│   ├── scholarship.php           # Educational scholarship submissions
│   └── index.php                 # Brand-new modern UI Landing Page
├── connect.php                   # Database connection file (TiDB SSL enabled)
├── Dockerfile                    # Production container configuration
├── project_fixed.sql             # Full database schema and seed data
└── Registration.php              # Multi-step signup form with document uploads
```

---

## 🚀 Setup & Installation Instructions

### Option 1: Local Server (XAMPP / WAMP / MAMP)
1. **Clone the Repository**:
   ```bash
   git clone https://github.com/your-username/Community-management-system.git
   ```
2. **Move to Server Root**:
   * Move the project folder into your server's root directory (e.g., `C:\xampp\htdocs\` or `/var/www/html/`).
3. **Database Configuration**:
   * Start MySQL/MariaDB server via XAMPP.
   * Open phpMyAdmin and create a database named `test` (or database of your choice).
   * Import the `project_fixed.sql` file.
4. **Update DB Connection File**:
   * Edit `connect.php` to match your database settings:
     ```php
     $host = "localhost";
     $username = "root";
     $password = "";
     $dbname = "test";
     $port = 3306;
     ```
5. **Access in Browser**:
   * Open `http://localhost/Community-management-system-main/Community-management-system-main/` in your browser.

### Option 2: Docker Environment (Recommended)
This project is configured with a custom `Dockerfile` using `php:8.1-apache` with automatic `mysqli` setup.

1. **Build the Docker Image**:
   ```bash
   docker build -t community-system .
   ```
2. **Run the Container**:
   ```bash
   docker run -d -p 8080:80 --name my-community-app community-system
   ```
3. **Access App**:
   * Open `http://localhost:8080` in your web browser.

---

## 🛡️ Security Implementations
* **SSL Enforced Queries**: Database connection in `connect.php` strictly implements `mysqli_ssl_set()` to secure raw query logs over cloud gateways.
* **SMTP Validation**: Prevents fake accounts by sending dynamic OTP codes to verify emails prior to registration.
* **SQL Mode Compliance**: Configured with standard ANSI SQL modes to ensure database queries work seamlessly across both local MySQL and cloud-based TiDB engines.

---

## 🤝 Contribution & License
Contributions are welcome! Please feel free to open a Pull Request or report bugs via issues.
Distributed under the MIT License. See `LICENSE` for details.
