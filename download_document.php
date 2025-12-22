<?php
session_start();
require_once('config/db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

$doc_id = (int)$_GET['id'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM documents WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $doc_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: dashboard.php');
    exit;
}

$doc = $result->fetch_assoc();

// If there's an uploaded file path, attempt to serve it
if (!empty($doc['image_path'])) {
    $image = $doc['image_path'];

    // Remote URL -> redirect
    if (filter_var($image, FILTER_VALIDATE_URL)) {
        header('Location: ' . $image);
        exit;
    }

    // Local file
    $filePath = __DIR__ . '/' . ltrim($image, '/\\');
    $real = realpath($filePath);

    // Ensure file exists and is inside project root
    if ($real && is_file($real) && strpos($real, realpath(__DIR__)) === 0) {
        $filename = basename($real);
        if (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $real);
            finfo_close($finfo);
        } else {
            $mime = mime_content_type($real) ?: 'application/octet-stream';
        }

        header('Content-Description: File Transfer');
        header('Content-Type: ' . $mime);
        // Use rawurlencode for filename to be safe with UTF-8
        header('Content-Disposition: attachment; filename="' . rawurlencode($filename) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($real));
        readfile($real);
        exit;
    }
}

// Fallback: download as a simple text summary (safe, no extra libs required)
$today = date('Y-m-d');
$diff = ($doc['expiry_date']) ? ((strtotime($doc['expiry_date']) - strtotime($today)) / 86400) : 0;
$status = ($diff < 0) ? 'Expired' : (($diff <= 30) ? 'Expiring Soon' : 'Valid');

$filename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $doc['doc_name'] ?: 'document') . '.txt';
$content = "Document: " . $doc['doc_name'] . PHP_EOL;
$content .= "Type: " . $doc['category'] . PHP_EOL;
$content .= "Expiry Date: " . $doc['expiry_date'] . PHP_EOL;
$content .= "Status: " . $status . PHP_EOL . PHP_EOL;
$content .= "Notes:" . PHP_EOL . ($doc['notes'] ?: '(none)') . PHP_EOL;

header('Content-Type: text/plain; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Length: ' . strlen($content));
echo $content;
exit;