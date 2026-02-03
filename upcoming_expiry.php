<?php
require_once 'session_check.php';
require_once 'config/db_connect.php';

$user_id = $_SESSION['user_id'];

// Today and 1 month from now
$today = date('Y-m-d');
$one_month = date('Y-m-d', strtotime('+1 month'));

$stmt = $conn->prepare("
    SELECT id, doc_name, expiry_date
    FROM documents
    WHERE user_id = ?
      AND expiry_date BETWEEN ? AND ?
    ORDER BY expiry_date ASC
");

$stmt->bind_param("iss", $user_id, $today, $one_month);
$stmt->execute();
$result = $stmt->get_result();

$upcomingDocs = [];
while ($row = $result->fetch_assoc()) {
    $upcomingDocs[] = $row;
}
