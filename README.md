🎓 Amrita Placement Insight Portal (APIP)
![alt text](https://via.placeholder.com/800x450?text=Placement+Insight+Portal+Dashboard)
Amrita Placement Insight Portal (APIP) is a high-performance, full-stack decision support system designed for university placement cells. The application automates the complex task of auditing student eligibility against various recruitment criteria using a unique decoupled logic engine architecture.
🚀 Key Features
Intelligence Engine: Integrated Python analytical engine for real-time eligibility auditing.
Enterprise Dashboard: SaaS-inspired dark-themed UI for high-level placement overview.
Full CRUD Operations: Manage Student Roster and Placement Drives with sophisticated validation.
Data Visualization: Global analytics page with dynamic progress bars representing campus-wide eligibility.
Secure Architecture: Built with PHP PDO to protect against SQL Injection.
🛠 Tech Stack
Layer	Technology
Frontend	HTML5, CSS3 (Modern Flexbox/Grid), FontAwesome Icons
Backend	PHP 8.x (PDO), Python 3.x (Analytical Engine)
Database	MySQL (Relational Schema)
Server	WAMP / Apache Server
Logic Bridge	PHP-to-Python Shell Execution
⚙️ Architecture & Workflow
The project utilizes a 3-Tier Architecture that separates the User Interface from the Business Logic.
Data Entry: Admins input student academic records and company recruitment criteria via PHP-driven forms.
Storage: Data is normalized and stored across students, companies, and analytics_results tables in MySQL.
Analytical Bridge: Upon triggering "Get Analysis," the system invokes a Python Script via shell_exec().
Processing: The Python engine performs a backend audit, comparing the CGPA of every student against the cut-off criteria of every company.
Visualization: The results are written back to the database, which the PHP dashboard visualizes into actionable insights and percentages.
📸 Screenshots
🖥 Main Dashboard
The command center showing KPI cards and individual company eligibility insights calculated by Python.
![alt text](dashboard_screenshot.png)
(Replace with your image)
👥 Student Roster
A clean management interface to add, edit, or delete student academic profiles.
![alt text](roster_screenshot.png)
(Replace with your image)
🏢 Placement Drives
Detailed view of upcoming recruitment drives and sector-specific requirements.
![alt text](drives_screenshot.png)
(Replace with your image)
📊 Global Analytics
Campus-wide distribution of eligibility across all partner companies.
![alt text](analytics_screenshot.png)
(Replace with your image)
🚀 Getting Started
Prerequisites
WAMP Server (Apache, MySQL, PHP)
Python 3.x
MySQL Connector for Python: pip install mysql-connector-python
Installation
Clone the repository to your WAMP www folder:
code
Bash
git clone https://github.com/yourusername/amrita-placement-portal.git
Import the amrita_placement.sql file into your phpMyAdmin.
Configure db.php with your local database credentials.
Update the Python absolute path in run_analysis.php to match your local Python installation.
Launch the dashboard at http://localhost/amrita-placement-portal/dashboard.php.
🛡 Security & Validation
Server-Side Validation: Prevents out-of-range CGPA inputs (0.0 - 10.0).
Data Sanitization: Trimming and floating-point conversion for all numerical inputs.
Referential Integrity: ON DELETE CASCADE implementation ensures analytics are wiped when a company is removed.
👨‍💻 Author
Snehi
Computer Science & Engineering Student