# 🔔 RenewMe – Document Expiry Reminder System

RenewMe is a web-based document management and reminder system that helps users track important document expiry dates and receive timely email reminders before expiration.

Whether it’s insurance, vehicle documents, education certificates, or personal IDs — **RenewMe ensures you never miss a renewal again.**

---

## 🚀 Features

- 📂 Upload & manage documents with expiry dates
- ⏰ Automatic email reminders (30 days & 7 days before expiry)
- 📊 Dashboard with document status:
  - 🟢 Valid
  - 🟡 Expiring Soon
  - 🔴 Expired
- 📨 Email notifications using PHPMailer
- 📤 Export user data (JSON)
- 🗑️ Secure account deletion with full data cleanup
- 🔐 Session-based authentication
- 📱 Fully responsive UI

---

## 🛠️ Tech Stack

- **Frontend:** HTML, CSS, JavaScript  
- **Backend:** PHP (Core PHP)  
- **Database:** MySQL  
- **Email Service:** PHPMailer  
- **Server:** Apache (XAMPP / Hosting Panel)

---

## 📁 Project Structure

RenewMe/    
│    
├── assets/                        # Frontend static files    
│ ├── css/                         # All CSS stylesheets      
│ │ ├── dashboard.css     
│ │ ├── add_document.css     
│ │ |── edit_document.css    
| | ├── home.css     
│ │ ├── index.css    
│ │ ├── login.css    
│ │ |── register.css    
| | ├── setting.css    
| | ├── view_document.css     
│ ├── js/                          # Client-side JavaScript     
│ │ ├── settings.js                # Settings page interactions     
│ │ └── dashboard.js               # Dashboard UI behavior     
│ │    
│ └── logo.png                     # Logo image     
│     
├── controllers/                   # Application logic (MVC - Controller layer)     
│ ├── authentication.php           # Login, register, logout     
│ ├── register_process.php         # User registration processing     
│ └── document_controller.php      # Add, delete, validate documents      
│      
├── mail/                          # Email system     
│ └── PHPMailer/                   # PHPMailer library files          
│ └── mail_sending.php             # cron-based reminders logic     
│    
├── uploads/                       # User uploaded files (ignored in git)    
│ └── documents/                   # Document images      
│     
├── config/                        # Configuration files    
│ └── db_connect.php               # Database connection (ignored in git)    
│    
├── settings/                      # User settings pages    
│ ├── about.php                    # About application page    
│ ├── preference.php               # User preferences    
│ ├── privacy.php                  # Cookies, export data, delete account     
│ ├── profile.php                  # User profile management     
│ ├── security.php                 # Password & security settings      
│ └── settings.php                 # Settings router page     
│     
├── dashboard.php                  # Main user dashboard    
├── dashboard_router.php           # Settings router page    
├── dashboard_status.php           # Document status logic (valid/soon/expired)   
├── add_document.php               # Add new document page     
├── delete_document.php            # Delete document action     
├── download_document.php          # Download stored document     
├── edit_document.php              # Edit existing document    
├── upcoming_expiry.php            # Expiring documents list     
├── home.php                       # Landing/home page    
├── index.php                      # Entry point    
├── login.php                      # Login page    
├── register.php                   # User registration    
├── logout.php                     # Logout & session destroy     
├── view_document.php              # View document details    
├── popup.php                      # Flash messages & alerts    
├── session_check.php              # Auth guard (session validation)     
│    
├── .gitignore                     # Excluded files & folders    
└── README.md                      # Project documentation    

---

## 📧 Email Reminder Logic

- Reminder emails are sent:
  - **30 days before expiry**
  - **7 days before expiry**
- Emails are triggered via:
  - Cron job OR
  - Server-side scheduled execution
- Each reminder is sent **only once per document**

---

## 🔒 Security Measures

- Prepared SQL statements
- Session-based access control
- Sensitive files excluded using `.gitignore`
- Uploaded files are validated
- User data deleted completely on account removal

---

## 🧪 Local Setup (Development)

1. Clone the repository
   ```bash
   git clone https://github.com/Aachal121-code/renewme.git
   ```
2. Move project to htdocs (XAMPP)

3. Create MySQL database & import tables

4. Configure database

    `config/db_connect.php`

5. Configure email

    `mail/mail_config.php`

6. Start Apache & MySQL

7. Open in browser
   ```bash
   http://localhost/renewme
   ```

## 📦 Production Notes

- Use a real SMTP service (Gmail / Zoho / Host SMTP)
- Set up cron job for reminder execution
- Ensure `uploads/documents` has write permissions
- Keep sensitive files out of GitHub

## 🤝 Contributing

This project is currently maintained by the original developer.
Suggestions and improvements are welcome.

## 📄 License

This project is licensed under the  
**Creative Commons Attribution–NonCommercial–NoDerivatives 4.0 International License**.

You are allowed to:
- View the source code
- Fork the repository for contribution purposes
- Submit pull requests

You are NOT allowed to:
- Use this project for commercial purposes
- Redistribute or publish modified versions
- Claim this project as your own work

For permissions beyond this license, please contact the author.
