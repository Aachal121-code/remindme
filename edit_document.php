<?php

require_once 'session_check.php';
require_once 'config/db_connect.php';


$user_id = $_SESSION['user_id'];

/*FETCH DOCUMENT */
if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

$doc_id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM documents WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $doc_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = "Document not found.";
    header('Location: dashboard.php');
    exit;
}

$doc = $result->fetch_assoc();

/*UPDATE DOCUMENT */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $doc_name    = trim($_POST['doc_name']);
    $category    = $_POST['category'];
    $expiry_date = $_POST['expiry_date'];
    $notes       = trim($_POST['notes']);

    if (empty($doc_name) || empty($category) || empty($expiry_date)) {
        $_SESSION['error'] = "All required fields must be filled.";
        header("Location: edit_document.php?id=$doc_id");
        exit;
    }

    $image_path = $doc['image_path'];

    /*FILE UPLOAD \ */
    if (!empty($_FILES['document_file']['name'])) {

        $allowed = ['jpg','jpeg','png'];
        $ext = strtolower(pathinfo($_FILES['document_file']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            $_SESSION['error'] = "Only JPG, JPEG, PNG files allowed.";
            header("Location: edit_document.php?id=$doc_id");
            exit;
        }

        if ($_FILES['document_file']['size'] > 2 * 1024 * 1024) {
            $_SESSION['error'] = "File size must be under 2MB.";
            header("Location: edit_document.php?id=$doc_id");
            exit;
        }

        // delete old file
        if (!empty($image_path) && file_exists($image_path)) {
            unlink($image_path);
        }

        $upload_dir = 'uploads/documents/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $new_name = time() . '_' . uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['document_file']['tmp_name'], $upload_dir . $new_name);

        $image_path = $upload_dir . $new_name;
    }

    /*UPDATE QUERY */
    $stmt = $conn->prepare("
        UPDATE documents 
        SET doc_name=?, category=?, expiry_date=?, image_path=?, notes=?
        WHERE id=? AND user_id=?
    ");

    $stmt->bind_param(
        "sssssii",
        $doc_name,
        $category,
        $expiry_date,
        $image_path,
        $notes,
        $doc_id,
        $user_id
    );

    if ($stmt->execute()) {
        $_SESSION['success'] = "Document updated successfully!";
        header("Location: dashboard.php?id=$doc_id");
        exit;
    }

    $_SESSION['error'] = "Update failed.";
    header("Location: edit_document.php?id=$doc_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/Edit_document.css">
</head>
<body>

<div class="edit-doc-container">
    <a href="dashboard.php" class="back-btn">← Back</a>
    <h2>Edit Document</h2>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="form-message error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label>Document Name</label>
            <input type="text" name="doc_name" value="<?= htmlspecialchars($doc['doc_name']) ?>" required>
        </div>

        <div class="form-group">
            <label>Document Type</label>
            <select name="category" required>
                <?php
                $types = ['Personal','Vehicle','Education','Insurance','Other'];
                foreach ($types as $type) {
                    $selected = ($doc['category'] === $type) ? 'selected' : '';
                    echo "<option $selected>$type</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Expiry Date</label>
            <input type="date" name="expiry_date" value="<?= $doc['expiry_date'] ?>" required>
        </div>

        <div class="form-group">
            <label>Replace Document</label>
            <input type="file" name="document_file">
        </div>

        <div class="form-group">
            <label>Notes</label>
            <textarea name="notes"><?= htmlspecialchars($doc['notes']) ?></textarea>
        </div>

        <button type="submit" class="save-btn">Update Document</button>

    </form>

</div>

</body>
</html>
