<?php

require_once 'session_check.php';
require_once('config/db_connect.php');


if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

$doc_id = (int)$_GET['id'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT * FROM documents 
    WHERE id = ? AND user_id = ?
");
$stmt->bind_param("ii", $doc_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: dashboard.php');
    exit;
}

$doc = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Document - RenewMe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/view_document.css">
</head>

<body>

<div class="view-container">

    <div class="top-bar">
        <a href="dashboard.php" class="back-btn">← Back</a>

        <div class="actions">
            <a href="edit_document.php?id=<?= $doc['id'] ?>">✏️ Edit</a>
            <a href="delete_document.php?id=<?= $doc['id'] ?>"
               onclick="return confirm('Delete this document?')">🗑️ Delete</a>
            <a href="download_document.php?id=<?= $doc['id'] ?>" class="download" title="Download">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                 Download      
            </a>
        </div>
    </div>

    <h2><?= htmlspecialchars($doc['doc_name']) ?></h2>

    <div class="info-grid">
        <div><strong>Type:</strong> <?= htmlspecialchars($doc['category']) ?></div>
        <div><strong>Expiry Date:</strong> <?= $doc['expiry_date'] ?></div>
        <div><strong>Status:</strong> 
            <?php
                $today = date('Y-m-d');
                $diff = (strtotime($doc['expiry_date']) - strtotime($today)) / 86400;

                if ($diff < 0) echo '<span class="status expired">Expired</span>';
                elseif ($diff <= 30) echo '<span class="status soon">Expiring Soon</span>';
                else echo '<span class="status valid">Valid</span>';
            ?>
        </div>
    </div>

    <?php if (!empty($doc['image_path'])): ?>
        <div class="doc-image">
            <img src="<?= $doc['image_path'] ?>" alt="Document Image">
        </div>
    <?php endif; ?>

    <?php if (!empty($doc['notes'])): ?>
        <div class="notes">
            <h3>Notes</h3>
            <p><?= nl2br(htmlspecialchars($doc['notes'])) ?></p>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
