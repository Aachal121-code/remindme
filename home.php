<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to ReMindMe</title>
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>

<section class="hero">
    <div class="content">
        <h1>Never Forget Your Important Documents</h1>
        <p>
            ReMindMe helps you track document expiry dates,  
            get reminders, and stay stress-free.
        </p>

        <ul class="features">
            <li>✔ Track expiry dates</li>
            <li>✔ Automatic status updates</li>
            <li>✔ Upload & manage documents</li>
            <li>✔ Secure & private</li>
        </ul>

        <a href="add_document.php" class="cta-btn">
            ➕ Add Your First Document
        </a>
    </div>
</section>

</body>
</html>
