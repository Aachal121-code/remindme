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

$doc_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

// Fetch document
$stmt = $conn->prepare("
    SELECT * FROM documents 
    WHERE id = ? AND user_id = ?
");
$stmt->bind_param("ii", $doc_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = 'Document not found.';
    header('Location: dashboard.php');
    exit;
}

$doc = $result->fetch_assoc();

// Calculate status
$today = date('Y-m-d');
$expiry = $doc['expiry_date'];

if ($expiry < $today) {
    $status = '❌ Expired';
} elseif ($expiry <= date('Y-m-d', strtotime('+30 days'))) {
    $status = '⚠️ Expiring Soon';
} else {
    $status = '✔ Valid';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Document</title>
    <link rel="stylesheet" href="assets/css/view_document.css">
</head>
<body>

<div class="view-container">

    <div class="top-bar">
        <a href="dashboard.php">← Back</a>
        <div>
            <a href="edit_document.php?id=<?php echo $doc['id']; ?>">✏️ Edit</a>
            <a href="delete_document.php?id=<?php echo $doc['id']; ?>"
               onclick="return confirm('Are you sure?')">🗑️ Delete</a>
        </div>
    </div>

    <h2><?php echo htmlspecialchars($doc['doc_name']); ?></h2>

    <div class="info">
        <p><strong>Type:</strong> <?php echo $doc['category']; ?></p>
        <p><strong>Expiry Date:</strong> <?php echo $doc['expiry_date']; ?></p>
        <p><strong>Status:</strong> <?php echo $status; ?></p>
    </div>

    <?php if (!empty($doc['image_path'])): ?>
        <div class="doc-image">
            <img src="<?php echo $doc['image_path']; ?>" alt="Document Image">
        </div>
    <?php endif; ?>

    <?php if (!empty($doc['notes'])): ?>
        <div class="notes">
            <h4>Notes</h4>
            <p><?php echo nl2br(htmlspecialchars($doc['notes'])); ?></p>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
