# Teacher Management Full Stack Application

## 🚀 Overview
This is a full-stack web application built as part of an internship task.
It allows users to:
- Register and login
- Create teacher records
- View users and teachers

The project demonstrates authentication, API development, and frontend-backend integration.

---

## 🛠 Tech Stack
- Backend: CodeIgniter 4 (PHP)
- Frontend: ReactJS
- Database: MySQL
- API Testing: Postman

---

## 🔐 Features

### Authentication
- User Registration
- User Login (JWT-based authentication)

### Teacher Management
- Create teacher (stored in relational tables)
- Fetch users list
- Fetch teachers list (with JOIN)

### Security
- JWT token-based authentication
- Protected API routes

---

## 📁 Project Structure
```
teacher-app/
├── ci-backend/           # CodeIgniter backend
├── teacher-frontend/     # React frontend
├── screenshot evidence/  # Project screenshots
└── README.md
```

---

## ⚙️ Setup Instructions

### 🔹 Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm
- MySQL

### 🔹 Backend
```bash
cd ci-backend
composer install
php spark serve
```
Backend runs on **http://localhost:8081**

### 🔹 Frontend
```bash
cd teacher-frontend
npm install
npm start
```
Frontend runs on **http://localhost:3000**

---

## 📡 API Endpoints

| Method | Endpoint | Auth Required | Description |
|--------|----------|---------------|-------------|
| POST | `/api/register` | No | Register a new user |
| POST | `/api/login` | No | Login and get JWT token |
| POST | `/api/teacher` | ✅ Yes | Create teacher record |
| GET | `/api/users` | ✅ Yes | Get all users |
| GET | `/api/teachers` | ✅ Yes | Get all teachers |

---

## 👤 Author
**Aaryan Sah**
