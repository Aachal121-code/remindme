<?php
session_start();
require_once('config/db_connect.php'); 

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    $_SESSION['error'] = 'Invalid request.';
    header('Location: dashboard.php');
    exit;
}

$doc_id = (int) $_GET['id'];
$user_id = $_SESSION['user_id'];


$stmt = $conn->prepare("DELETE FROM documents WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $doc_id, $user_id);

if ($stmt->execute()) {
    $_SESSION['success'] = 'Document deleted successfully.';
} else {
    $_SESSION['error'] = 'Failed to delete document.';
}


header('Location: dashboard.php');  //redirected to the dashboard page
exit;
