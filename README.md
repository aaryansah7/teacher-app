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
teacher-app/
├── ci-backend/ # CodeIgniter backend
├── teacher-frontend/ # React frontend
├── screenshot evidence/ # Project screenshots
├── README.md
├── Teacher API

## ⚙️ Setup Instructions

### 🔹 Backend

```bash
cd ci-backend
php spark serve

# Backend runs on http://localhost:8081

# Frontend: runs on http://localhost:3000
cd teacher-frontend
npm install
npm start


# API Endpoints
# POST /api/register
# POST /api/login
# POST /api/teacher
# GET /api/users
# GET /api/teachers

# Author: Aaryan Sah