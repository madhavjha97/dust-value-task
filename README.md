# Dust Value Task

## Overview
This is a Task **Job Application Portal & HR** where candidates can:
- **Register and Login**
- **Apply for jobs**
- **Track job applications**
- **View interview status**
- **Logout securely**

## Features
✅ Candidate Registration & Login (without any package)  
✅ Apply for jobs with one click  
✅ View all available job listings  
✅ Track application status  
✅ Check interview status (Scheduled, Completed, Rejected, Hired)  
✅ Tailwind CSS for responsive UI  
✅ Secure authentication with session handling  

## Installation & Setup

### 1. Clone the Repository
```sh
    git clone https://github.com/madhavjha97/dust-value-task.git
  
```

### 2. Install Dependencies
```sh
    composer install
    npm install
```

### 3. Set Up Environment Variables
```sh
    cp .env.example .env
```
- Configure your **database settings** in `.env`

### 4. Run Migrations & Seed Data
```sh
    php artisan migrate --seed
```

### 5. Start the Server
```sh
    php artisan serve
```
Access the app at: **http://127.0.0.1:8000**

## Routes
| Route | Method | Description |
|--------|--------|-------------|
| `/register` | GET | Show candidate registration form |
| `/register` | POST | Register a new candidate |
| `/login` | GET | Show login form |
| `/login` | POST | Authenticate candidate |
| `/dashboard` | GET | Candidate dashboard |
| `/apply-job` | POST | Apply for a job |
| `/logout` | GET | Logout candidate |

## Database Schema

### **Candidates Table**
| Column | Type |
|---------|-------|
| id | BIGINT (PK) |
| name | STRING |
| email | STRING (UNIQUE) |
| password | STRING |
| phone | STRING |
| experience_years | INTEGER |
| skills | TEXT (nullable) |
| education | TEXT (nullable) |
| resume_path | STRING |
| timestamps | TIMESTAMP |

### **Jobs Table**
| Column | Type |
|---------|-------|
| id | BIGINT (PK) |
| title | STRING |
| description | TEXT |
| company | STRING |
| location | STRING |
| salary | DECIMAL |
| type | ENUM (Full-time, Part-time, Contract, Remote) |
| timestamps | TIMESTAMP |

### **Applications Table**
| Column | Type |
|---------|-------|
| id | BIGINT (PK) |
| job_id | FOREIGN KEY (jobs) |
| candidate_id | FOREIGN KEY (candidates) |
| timestamps | TIMESTAMP |

### **Interviews Table**
| Column | Type |
|---------|-------|
| id | BIGINT (PK) |
| candidate_id | FOREIGN KEY (candidates) |
| interview_date | DATETIME |
| status | ENUM (Scheduled, Completed, Rejected, Hired) |
| timestamps | TIMESTAMP |

## Tech Stack
- **Backend:** Laravel 10 (PHP 8+)
- **Frontend:** Blade, Tailwind CSS
- **Database:** MySQL 
- **Authentication:** Custom Session-based Auth (No Packages)
t is open-source and available under the **MIT License**.

---
### **Enjoy Coding! 🚀**
