<?php
session_start();
require_once('../config/db_connect.php'); // DB connection

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../register.php');
    exit;
}

// Get form inputs
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Store old input for sticky form
$_SESSION['old_input'] = ['name'=>$name, 'email'=>$email];

// Validation 
if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
    $_SESSION['error'] = 'All fields are required.';
    header('Location: ../register.php');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Invalid email format.';
    header('Location: ../register.php');
    exit;
}

if ($password !== $confirm_password) {
    $_SESSION['error'] = 'Passwords do not match.';
    header('Location: ../register.php');
    exit;
}

// Password strength check
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);

if(strlen($password) < 6 || !$uppercase || !$lowercase || !$number || !$specialChars) {
    $_SESSION['error'] = 'Password must be at least 6 characters and include uppercase, lowercase, number, and special character.';
    header('Location: ../register.php');
    exit;
}

// Check duplicate email
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $_SESSION['error'] = 'Email already registered.';
    header('Location: ../register.php');
    exit;
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user
$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $name, $email, $hashed_password);
if ($stmt->execute()) {
    $_SESSION['success'] = 'Account created successfully. Please login.';
    unset($_SESSION['old_input']); // clear old input after successful registration
    header('Location: ../login.php');
    exit;
} else {
    $_SESSION['error'] = 'Something went wrong. Try again.';
    header('Location: ../register.php');
    exit;
}
?>
