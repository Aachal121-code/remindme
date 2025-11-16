
# **Software Requirements Specification (SRS)**  

## **Project: ReMindMe – Document Expiry Reminder System**

---

## **1. Introduction**

### **1.1 Purpose**  
The purpose of *ReMindMe* is to help users store important document details and receive reminders before expiry. Many people forget renewal dates for essential documents like ID cards, licenses, and insurance. This system ensures timely renewal through automated tracking.

### **1.2 Scope**  
ReMindMe is a web-based system where users can create accounts and manage documents with expiry dates. Optional image upload is available. The system displays expiry alerts and helps users stay organized.  
Technologies used: **HTML, CSS, JavaScript, PHP, MySQL**.

### **1.3 Definitions**
- **Expiry Date:** Date when a document becomes invalid.  
- **Reminder:** Notification or alert before expiry.  
- **User:** Registered person using the system.

---

## **2. Problem Statement**
People often miss expiry deadlines for important documents. This leads to problems like fines, service interruptions, or loss of validity. A simple tool is needed to track expiry dates and remind users in advance.

---

## **3. Objectives**
- Store document details securely.  
- Allow users to add, view, edit, and delete document details.  
- Provide reminders before expiry.  
- Offer a clean and user-friendly interface.

---

## **4. Proposed System**
The system allows users to maintain document records and receive alerts before expiry. A dashboard displays documents categorized by expiration status (Valid / Expiring Soon / Expired).

---

## **5. System Requirements**

### **5.1 Functional Requirements**

**FR1 — User Login & Registration**  
- Secure login and registration using email & password.  
- Input validation and password hashing.

**FR2 — Dashboard**  
- Shows total documents, upcoming expiry alerts, and expired items.  
- Buttons for Add Document, View All Documents, and Settings.

**FR3 — Add Document**  
- Fields: name, type, expiry date, notes, file upload.  
- Validations: required fields, correct date, file type, file size limit.  
- Secure file storage.

**FR4 — View Document**  
- Shows full details of the selected document.  
- Options: Edit and Delete.

**FR5 — Edit Document**  
- Update document details and re-upload file with validation.

**FR6 — Delete Document**  
- Remove a document and its file after confirmation.

**FR7 — View All Documents**  
- List view with search, sort, and quick actions.

**FR8 — Settings**  
- Update profile, change password, About App, Logout.

**FR9 — Notifications**  
- Highlights documents that are near or past expiry.

**FR10 — Security**  
- SQL injection prevention, sanitization, secure sessions, file validation.

---

### **5.2 Non-Functional Requirements**
- **Usability:** Simple interface for beginners.  
- **Performance:** Fast loading; optimized database queries.  
- **Security:** Password hashing; secured input handling.  
- **Portability:** Works on all browsers.  
- **Scalability:** Supports multiple user accounts easily.

---

## **6. System Design**

### **6.1 User Modules**
- **Authentication Module** – register/login.  
- **Document Module** – manage document details.  
- **Reminder Module** – check upcoming expiry dates.  
- **Dashboard Module** – show all entries visually.

---

## **7. Hardware & Software Requirements**

### **Hardware**
- 4GB RAM  
- 1.5 GHz Processor  
- 500MB storage

### **Software**
- XAMPP / WAMP  
- PHP 7+  
- MySQL  
- VS Code  
- Chrome / Firefox browser  

---

## **8. Limitations**
- Requires manual data entry by users.  
- Email reminders need internet.  
- No cloud sync features.  
- Not a mobile app unless converted later.

---

## **9. Conclusion**
ReMindMe is a simple and effective expiry reminder system. It helps users avoid missing important renewal dates and maintain organized document records. The system is practical, beginner-friendly, and suitable for everyday use.


