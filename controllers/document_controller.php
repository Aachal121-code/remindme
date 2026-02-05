<?php
require_once '../session_check.php';
require_once '../config/db_connect.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../dashboard.php');
    exit;
}

$doc_name    = trim($_POST['doc_name']);
$category    = trim($_POST['category']);
$expiry_date = $_POST['expiry_date'];
$notes       = trim($_POST['notes'] ?? null);

// basic validation
if (empty($doc_name) || empty($category) || empty($expiry_date)) {
    $_SESSION['error'] = 'All required fields must be filled.';
    header('Location: ../add_document.php');
    exit;
}

// ---------- FILE UPLOAD ----------
/* ---------- BASIC VALIDATION ---------- */
if (!empty($_FILES['document_file']['name'])) {

    $allowed_ext = ['jpg', 'jpeg', 'png'];
    $max_size = 2 * 1024 * 1024; // 2MB

    $file_name = $_FILES['document_file']['name'];
    $file_size = $_FILES['document_file']['size'];
    $file_tmp  = $_FILES['document_file']['tmp_name'];

    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed_ext)) {
        $_SESSION['error'] = 'Only JPG, JPEG, PNG files are allowed.';
        header('Location: ../add_document.php');
        exit;
    }

    if ($file_size > $max_size) {
        $_SESSION['error'] = 'File size must be less than 2MB.';
        header('Location: ../add_document.php');
        exit;
    }

    $upload_dir = '../uploads/documents/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $new_name = time() . '_' . uniqid() . '.' . $ext;
    $target_path = $upload_dir . $new_name;

    if (!move_uploaded_file($file_tmp, $target_path)) {
        $_SESSION['error'] = 'File upload failed.';
        header('Location: ../add_document.php');
        exit;
    }

    $image_path = 'uploads/documents/' . $new_name;
}


// ---------- INSERT ----------
$stmt = $conn->prepare("
    INSERT INTO documents 
    (user_id, doc_name, category, expiry_date, image_path, notes, reminder_30_sent, reminder_7_sent)
    VALUES (?, ?, ?, ?, ?, ?, 0, 0)
");

$stmt->bind_param(
    "isssss",
    $user_id,
    $doc_name,
    $category,
    $expiry_date,
    $image_path,
    $notes
);

$stmt->execute();

$_SESSION['success'] = 'Document added successfully.';
header('Location: ../dashboard.php');
exit;
