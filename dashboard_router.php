<?php
session_start();
require_once 'config/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM documents WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$count = $stmt->get_result()->fetch_assoc()['total'];

if ($count == 0) {
    header("Location: home.php");
} else {
    header("Location: dashboard.php");
}
exit;
?>