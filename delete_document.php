<?php
session_start();
require_once('config/db_connect.php');  //connection to the database 

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');   //if session end redirect to login page
    exit;
}

if (!isset($_GET['id'])) {
    $_SESSION['error'] = 'Invalid request.';
    header('Location: dashboard.php');     //else redirected to the dashboard page
    exit;
}

$doc_id = (int) $_GET['id'];     //get the document id from the url
$user_id = $_SESSION['user_id'];   //get the user id from the session


$stmt = $conn->prepare("DELETE FROM documents WHERE id = ? AND user_id = ?");   //sql query to delete the document
$stmt->bind_param("ii", $doc_id, $user_id);    //bind the parameters

if ($stmt->execute()) {
    $_SESSION['success'] = 'Document deleted successfully.';
} else {
    $_SESSION['error'] = 'Failed to delete document.';
}


header('Location: dashboard_router.php');  //redirected to the dashboard_router page
exit;
