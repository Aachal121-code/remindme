<?php
session_start();

// Error message
if(!empty($_SESSION['error'])){
    echo '<div class="message_error">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);
}

// Success message
if(!empty($_SESSION['success'])){
    echo '<div class="message_success">'.$_SESSION['success'].'</div>';
    unset($_SESSION['success']);
}

// Sticky fields
$old_input = $_SESSION['old_input'] ?? [];
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets//css//register.css" type="text/css">
    <title>RemindMe - register</title>
</head>

<body>

    <div class="back">
        <i class="fa-solid fa-arrow-left"></i>
    </div>

    <h1>👤 Create Your Account</h1>

    <div class="register-container">
        <form action="controllers/register_process.php" method="post">
            
            <div id="name-input">
                <label for="name">Name</label><br>
                <input type="text" id="name" name="name" required 
                value="<?php echo htmlspecialchars($old_input['name'] ?? ''); ?>"><br>
            </div>
            
            <div id="email-input">
                <label for="email">Email ID</label><br>
                <input type="text" id="email" name="email" required 
                value="<?php echo htmlspecialchars($old_input['email'] ?? ''); ?>"><br>
            </div>

            <div id="password-input">
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" required><br>
            </div>

            <div id="confirm-input">
                <label for="confirm_password">Confirm Password</label><br>
                <input type="password" id="confirm_password" name="confirm_password" required><br>
            </div>
            <button type="submit" id="register-button">Register</button>
            
            <a href="login.php" id="register-footer">Already have an account?</a>
        </form>
    </div>

</body>
</html>
