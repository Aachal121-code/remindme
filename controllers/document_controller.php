<?php
session_start();
require_once('../config/db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../add_document.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$doc_name = trim($_POST['doc_name']);
$category = $_POST['category'];
$expiry_date = $_POST['expiry_date'];
$notes = trim($_POST['notes'] ?? '');

$image_path = null;

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


/* ---------- INSERT INTO DATABASE ---------- */
$stmt = $conn->prepare("
    INSERT INTO documents (user_id, doc_name, category, expiry_date, image_path, notes)
    VALUES (?, ?, ?, ?, ?, ?)
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

if ($stmt->execute()) {

    require_once __DIR__ . '/../mail/mail_config.php';
    require_once __DIR__ . '/../mail/mail_sending.php'; // contains sendReminder() function

    // Fetch newly added document info
    $newDocId = $stmt->insert_id;
    $newDoc = [
        'id' => $newDocId,
        'doc_name' => $doc_name,
        'expiry_date' => $expiry_date,
        'name' => $_SESSION['user_name'],
        'email' => $_SESSION['user_email'] ?? '', // ensure this is stored in session
        'reminder_30_sent' => 0,
        'reminder_7_sent' => 0
    ];

    // Send test email immediately (for new document)
    sendReminder($newDoc, 30); 
    sendReminder($newDoc, 7);

    $_SESSION['success'] = 'Document added successfully!';
    header('Location: ../dashboard.php');
    exit;
}

$_SESSION['error'] = 'Something went wrong. Try again.';
header('Location: ../add_document.php');
exit;
?>
