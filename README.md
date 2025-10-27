# 🎓 FYP Full Tracking System

A web-based system developed to **streamline the management of Final Year Projects (FYP)** for students and faculty members at the Faculty of Informatics and Computing, **Universiti Sultan Zainal Abidin (UniSZA)**.

This system provides a centralized digital platform that automates supervisor assignment, tracks student progress, and enables coordinators, supervisors, and students to collaborate more efficiently throughout the FYP lifecycle.

---

## 🧩 Table of Contents
- [🎯 Project Objectives](#-project-objectives)
- [🚀 Features](#-features)
- [🧰 Tech Stack](#-tech-stack)
- [🧠 System Overview](#-system-overview)
- [⚙️ Installation Guide](#️-installation-guide)
- [🧮 Algorithm Used (AHP)](#-algorithm-used-ahp)
- [🖼️ Screenshots](#️-screenshots)
- [🧪 Testing Summary](#-testing-summary)
- [📊 Future Enhancements](#-future-enhancements)
- [👤 Author](#-author)

---

## 🎯 Project Objectives
1. To study the existing approaches of managing Final Year Projects.  
2. To develop a system that helps monitor student progress and automatically assign supervisors efficiently.  
3. To test and evaluate the functionality and usability of the proposed system.

---

## 🚀 Features

### 👨‍🎓 Student Module
- Register and log in securely.  
- View assigned supervisor automatically (based on project field and CGPA).  
- Submit project title, abstracts, and progress reports.  
- View FYP schedules and announcements.  
- Upload project presentation slides and posters.

### 🧑‍🏫 Supervisor Module
- Log in and manage profile information.  
- Update area of expertise and preferred project types.  
- Monitor assigned student progress.  
- Provide comments and grades on student submissions.

### 🧑‍💼 Coordinator Module
- Manage student and supervisor records.  
- Automatically assign supervisors using **AHP (Analytic Hierarchy Process)**.  
- Manage announcements, schedules, and project information.  
- View FYP progress and grading status.

---

## 🧰 Tech Stack
| Category | Technology |
|-----------|-------------|
| Frontend | HTML, CSS, JavaScript, Bootstrap 5 |
| Backend | PHP |
| Database | MySQL (via phpMyAdmin) |
| IDE | Visual Studio Code |
| Methodology | Agile (Plan → Design → Develop → Test → Deploy → Review) |

---

## 🧠 System Overview

### Framework Design
Three main users interact with the system:
- **Coordinator** — manages students, supervisors, and assignments.
- **Supervisor** — monitors and evaluates student progress.
- **Student** — submits and tracks project progress.

### Database Tables
- `student`
- `supervisor`
- `coordinator`
- `project_details`
- `pairwise`
- `fyp_information`

---


## ⚙️ Installation Guide

```bash
# Clone the repository
git clone https://github.com/yourusername/fyp-full-tracking-system.git
cd fyp-full-tracking-system

# Place files inside your XAMPP 'htdocs' folder
# Example: C:\xampp\htdocs\fyp-full-tracking-system

# Start Apache and MySQL via XAMPP Control Panel

# Import the SQL file (fyp_system.sql) into phpMyAdmin

# Access the system in your browser
http://localhost/fyp-full-tracking-system



