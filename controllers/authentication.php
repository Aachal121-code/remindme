<?php
session_start();
require_once('../config/db_connect.php'); // DB connection

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.php');
    exit;
}

// Get form inputs
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Store old input for sticky form
$_SESSION['old_input'] = ['email' => $email];

// ---------------- Validation ----------------
if (empty($email) || empty($password)) {
    $_SESSION['error'] = 'Email and password are required.';
    header('Location: ../login.php');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Invalid email format.';
    header('Location: ../login.php');
    exit;
}

// Check if user exists
$stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Verify password
    if (password_verify($password, $row['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        unset($_SESSION['old_input']); // clear sticky data on successful login
        header('Location: ../dashboard_router.php');
        exit;
    }
}

// If login fails
$_SESSION['error'] = 'Invalid email or password.';
header('Location: ../login.php');
exit;
?>
