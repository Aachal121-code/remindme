<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReMindMe</title>
</head>
<body>
    <h1>Login to Continue</h1>
    <form action="authentication.php" method="post">
        <label for="email">Email ID:</label>
        <input type="text" id="email" name="email" required>
        <label for="password">Password:</lable>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
        <a href="register.php">Don't have an account?</a>
    </form>
</body>
</html>