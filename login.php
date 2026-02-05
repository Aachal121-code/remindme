
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets//css//login.css" type="text/css">
    <title>ReMindMe - Login</title>
</head>

<body>
    <?php
        session_start();
        require_once 'popup.php'; 

        $old_input = $_SESSION['old_input'] ?? [];
    ?>


    <h1>🔐 Login to Continue</h1>

    <div class="login-container">
        <form action="controllers/authentication.php" method="post">
            
            <div id="email-input">
                <label for="email">Email ID</label><br>
                <input type="text" id="email" name="email" required
                value="<?php echo htmlspecialchars($old_input['email'] ?? ''); ?>"><br>
            </div>
            
            <div id="password-input">
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" required><br>
            </div>
            
            <button type="submit" id="login-button">Login</button>
            
            <a href="register.php" id="login-footer">Don't have an account?</a>
        </form>
    </div>

</body>
</html>
