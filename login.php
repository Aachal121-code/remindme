<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>ReMindMe - Login</title>
</head>

<body>

    <div class="back">
        <i class="fa-solid fa-arrow-left"></i>
    </div>

    <h1>🔐 Login to Continue</h1>

    <form action="authentication.php" method="post">

        <label for="email">Email ID:</label>
        <input type="text" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>

        <a href="register.php">Don't have an account?</a>
    </form>

</body>
</html>
