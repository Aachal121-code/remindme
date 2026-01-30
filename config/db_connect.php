<?php
$DB_HOST = 'localhost';
$DB_USER = 'remindme_db';
$DB_PASS = 'ReMindMe@2829'; 
$DB_NAME = 'remindme';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>
