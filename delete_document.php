<?php
session_start();
require_once('config/db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    $_SESSION['error'] = 'Invalid request.';
    header('Location: dashboard_router.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$doc_id  = (int) $_GET['id'];

/* 1️⃣ Fetch image path first */
$stmt = $conn->prepare("
    SELECT image_path 
    FROM documents 
    WHERE id = ? AND user_id = ?
");
$stmt->bind_param("ii", $doc_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = 'Document not found.';
    header('Location: dashboard_router.php');
    exit;
}

$doc = $result->fetch_assoc();

/* 2️⃣ Delete image file if exists */
if (!empty($doc['image_path'])) {
    $filePath = $doc['image_path'];

    if (file_exists($filePath)) {
        unlink($filePath); // 🔥 deletes uploaded image
    }
}

/* 3️⃣ Delete database record */
$stmt = $conn->prepare("
    DELETE FROM documents 
    WHERE id = ? AND user_id = ?
");
$stmt->bind_param("ii", $doc_id, $user_id);

if ($stmt->execute()) {
    $_SESSION['success'] = 'Document deleted successfully.';
} else {
    $_SESSION['error'] = 'Failed to delete document.';
}

/* 4️⃣ Redirect through router */
header('Location: dashboard_router.php');
exit;
