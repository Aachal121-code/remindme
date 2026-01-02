<?php
session_start();

/* If user confirmed logout */
if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Confirm Logout</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
/* Blur background */
body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.4);
    backdrop-filter: blur(5px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 999;
}

/* Popup box */
.logout-box {
    background: #fff;
    padding: 24px;
    width: 90%;
    max-width: 380px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.logout-box h2 {
    margin-bottom: 10px;
}

.logout-box p {
    color: #555;
    margin-bottom: 20px;
}

.logout-actions {
    display: flex;
    justify-content: center;
    gap: 12px;
}

.logout-actions button {
    padding: 10px 18px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 15px;
}

.btn-cancel {
    background: #e5e7eb;
}

.btn-logout {
    background: #dc2626;
    color: white;
}
</style>
</head>

<body>

<div class="overlay">
    <div class="logout-box">
        <h2>Confirm Logout</h2>
        <p>Are you sure you want to logout?</p>

        <div class="logout-actions">
            <!-- Confirm Logout -->
            <form method="POST" style="margin:0;">
                <input type="hidden" name="confirm" value="yes">
                <button class="btn-logout" type="submit">Logout</button>
            </form>
            <!-- Cancel = Go back -->
            <button class="btn-cancel" onclick="history.back()">Cancel</button>

        </div>
    </div>
</div>

</body>
</html>
