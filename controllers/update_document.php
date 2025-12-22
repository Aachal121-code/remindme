<?php
session_start();
require_once('../config/db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../dashboard.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$doc_id = (int)($_POST['id'] ?? 0);
$doc_name = trim($_POST['doc_name'] ?? '');
$category = $_POST['category'] ?? '';
$expiry_date = $_POST['expiry_date'] ?? '';
$notes = trim($_POST['notes'] ?? '');

if ($doc_id <= 0) {
    $_SESSION['error'] = 'Invalid document.';
    header('Location: ../dashboard.php');
    exit;
}

// Verify ownership
$check = $conn->prepare("SELECT * FROM documents WHERE id = ? AND user_id = ?");
$check->bind_param("ii", $doc_id, $user_id);
$check->execute();
$res = $check->get_result();

if ($res->num_rows === 0) {
    $_SESSION['error'] = 'Document not found or permission denied.';
    header('Location: ../dashboard.php');
    exit;
}

$existing = $res->fetch_assoc();
$new_image_path = $existing['image_path'];

/* file handling */
if (!empty($_FILES['document_file']['name'])) {
    $allowed_ext = ['jpg', 'jpeg', 'png'];
    $max_size = 2 * 1024 * 1024; // 2MB

    $file_name = $_FILES['document_file']['name'];
    $file_size = $_FILES['document_file']['size'];
    $file_tmp  = $_FILES['document_file']['tmp_name'];

    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed_ext)) {
        $_SESSION['error'] = 'Only JPG, JPEG, PNG files are allowed.';
        header('Location: ../edit_document.php?id=' . $doc_id);
        exit;
    }

    if ($file_size > $max_size) {
        $_SESSION['error'] = 'File size must be less than 2MB.';
        header('Location: ../edit_document.php?id=' . $doc_id);
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
        header('Location: ../edit_document.php?id=' . $doc_id);
        exit;
    }

    // Delete old file if exists
    if (!empty($existing['image_path'])) {
        $filePath = __DIR__ . '/../' . ltrim($existing['image_path'], '/\\');
        if (is_file($filePath)) @unlink($filePath);
    }

    $new_image_path = 'uploads/documents/' . $new_name;
} elseif (!empty($_POST['remove_image'])) {
    // Remove existing file if requested
    if (!empty($existing['image_path'])) {
        $filePath = __DIR__ . '/../' . ltrim($existing['image_path'], '/\\');
        if (is_file($filePath)) @unlink($filePath);
    }
    $new_image_path = null;
}

// Update
if ($new_image_path === null) {
    $sql = "UPDATE documents SET doc_name = ?, category = ?, expiry_date = ?, image_path = NULL, notes = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $doc_name, $category, $expiry_date, $notes, $doc_id, $user_id);
} else {
    $sql = "UPDATE documents SET doc_name = ?, category = ?, expiry_date = ?, image_path = ?, notes = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssii", $doc_name, $category, $expiry_date, $new_image_path, $notes, $doc_id, $user_id);
}

if ($stmt->execute()) {
    $_SESSION['success'] = 'Document updated successfully!';
    header('Location: ../dashboard.php?id=' . $doc_id);
    exit;
}

$_SESSION['error'] = 'Something went wrong. Try again.';
header('Location: ../edit_document.php?id=' . $doc_id);
exit;