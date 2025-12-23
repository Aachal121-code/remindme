<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/db_connect.php';

$user_id = $_SESSION['user_id'];
$today = date('Y-m-d');
$soon_date = date('Y-m-d', strtotime('+30 days'));

// Expired count
$expiredQuery = $conn->prepare("
    SELECT COUNT(*) AS total 
    FROM documents 
    WHERE user_id = ? AND expiry_date < ?
");
$expiredQuery->bind_param("is", $user_id, $today);
$expiredQuery->execute();
$expired = $expiredQuery->get_result()->fetch_assoc()['total'];

// Expiring Soon count (next 30 days)
$soonQuery = $conn->prepare("
    SELECT COUNT(*) AS total 
    FROM documents 
    WHERE user_id = ? 
    AND expiry_date BETWEEN ? AND ?
");
$soonQuery->bind_param("iss", $user_id, $today, $soon_date);
$soonQuery->execute();
$expiringSoon = $soonQuery->get_result()->fetch_assoc()['total'];

// Valid count
$validQuery = $conn->prepare("
    SELECT COUNT(*) AS total 
    FROM documents 
    WHERE user_id = ? AND expiry_date > ?
");
$validQuery->bind_param("is", $user_id, $soon_date);
$validQuery->execute();
$valid = $validQuery->get_result()->fetch_assoc()['total'];
?>