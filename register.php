<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets//css//register.css" type="text/css">
    <title>ReMindMe - register</title>
</head>

<body>

    <div class="back">
        <i class="fa-solid fa-arrow-left"></i>
    </div>

    <h1>Create Your Account</h1>

    <div class="register-container">
        <form action="authentication.php" method="post">
            
            <div id="name-input">
                <label for="name">Name</label><br>
                <input type="text" id="name" name="name" required><br>
            </div>
            
            <div id="email-input">
                <label for="email">Email ID</label><br>
                <input type="text" id="email" name="email" required><br>
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
