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
<?php

if (!empty($_SESSION['error'])) {
    echo '<div class="toast error">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);
}

if (!empty($_SESSION['success'])) {
    echo '<div class="toast success">'.$_SESSION['success'].'</div>';
    unset($_SESSION['success']);
}
?>



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
                        <h3>✔ Valid : <span id="validCount">0</span></h3>
                    </div>
                    <div class="expiringSoon">
                        <h3>⚠️ Expiring Soon : <span id="validCount">0</span></h3>
                    </div>
                    <div class="expired">
                        <h3>❌ Expired : <span id="validCount">0</span></h3>
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
                    <!-- <p>No documents added yet.</p> -->
                    <table class="document-table">
                        <thead>
                            <tr>
                                <th>Document</th>
                                <th>Type</th>
                                <th>Expiry</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Document rows will be populated here -->
                            <tr>
                                <td>Driving License</td>
                                <td>Personal</td>
                                <td>06-03-2025</td>
                                <td><span class="status soon">⚠️ Expiring Soon</span></td>
                                <td class="actions">
                                    👁️ ✏️ 🗑️
                                </td>
                            </tr>

                            <tr>
                                <td>Aadhaar Card</td>
                                <td>Personal</td>
                                <td>11-12-2028</td>
                                <td><span class="status valid">✔ Valid</span></td>
                                <td class="actions">
                                    👁️ ✏️ 🗑️
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>    

        </div>
    </section>
        
    <script src="assets/js/dashboard.js"></script>
    <script>
    setTimeout(() => {
        document.querySelectorAll('.toast').forEach(el => el.remove());
    }, 3000);
</script>


</body>

</html>