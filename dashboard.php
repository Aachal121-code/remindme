<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets//css//Dashboard.css" type="text/css">
    <title>RemindMe - dashboard</title>
</head>
<body>
    <section class="dashboard">
        <div class="navbar">
            <div class="logo">
                <p>Remind<span>Me</span></p>
            </div>
            <div class="nav-actions">
                <div class="addDocument">
                    <button id="addDocumentBtn">+ Add Document</button>
                </div>
                <div class="setting">
                    <button id="settingBtn">⚙️</button>
                </div>
            </div>
        </div>
        <div class="dashboard-container">
            <div class="quickStatus">
                <h2>Quick Status</h2>
                <div class="statusCards">
                    <div class="valid">
                        <h3>🟢 Valid : <span id="validCount">0</span></h3>
                    </div>
                    <div class="expiringSoon">
                        <h3>🟠 Expiring Soon : <span id="validCount">0</span></h3>
                    </div>
                    <div class="expired">
                        <h3>🔴 Expired : <span id="validCount">0</span></h3>
                    </div>
                </div>
            </div>
            <div class="upcoming-expiry">
                <h2>Upcoming Expiry</h2>
                <div class="expiry-list" id="expiryList">
                    <p>No upcoming expiries.</p>
                </div>
            </div>
            <div class="document-list">
                <h2>Your Documents</h2>
                <div class="documents" id="documentList">
                    <p>No documents added yet.</p>
                </div>
            </div>    

        </div>
    </section>
        
</body>
</html>