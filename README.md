# 🗳️ Digital Voting System
(Done in may 2024)
A secure web-based voting platform for student elections. Built with PHP and MySQL, this system enables real-time result updates, user authentication, one-time vote submission, and PDF report generation.

## 🚀 Features

- ✅ User Registration & Login  
- 🧾 Candidate Selection  
- 🗳️ One-Time Vote Casting  
- 🔄 Real-Time Results with AJAX  
- 📄 PDF Export of Election Results  
- 🔐 Session-Based Security

## 🛠 Tech Stack

- **Backend:** PHP  
- **Database:** MySQL  
- **Frontend:** HTML, CSS, JavaScript (AJAX)  
- **PDF Generator:** [FPDF](http://www.fpdf.org/)


## ⚙️ Setup Instructions

1. **Clone the repository**:
```bash
git clone https://github.com/your-username/digital-voting-system.git
```

2. **Import the database**:  
- Create a MySQL database.  
- Import `tables.sql` using phpMyAdmin or MySQL CLI.

3. **Configure the DB connection**:  
- Open `config.php`.  
- Set your database credentials (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`).

4. **Run locally**:  
- Place the folder in your server root (e.g., `htdocs/` if using XAMPP).  
- Open `http://localhost/digital-voting-system` in your browser.


