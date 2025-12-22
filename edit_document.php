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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Document - ReMindMe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/add_document.css">
</head>
<body>

<?php
if (!empty($_SESSION['error'])) {
    echo '<div class="toast error">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);
}

if (!empty($_SESSION['success'])) {
    echo '<div class="toast success">'.$_SESSION['success'].'</div>';
    unset($_SESSION['success']);
}
?>

<div class="add-doc-container">

    <h2>Edit Document</h2>

  <form action="controllers/update_document.php"
      method="POST"
      enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?= (int)$doc['id'] ?>">

    <div class="form-group">
        <label>Document Name</label>
        <input type="text" name="doc_name" required value="<?= htmlspecialchars($doc['doc_name']) ?>">
    </div>

    <div class="form-group">
        <label>Document Type</label>
        <select name="category" required>
            <option value="">Select type</option>
            <?php
            $types = ['Personal','Vehicle','Education','Insurance','Other'];
            foreach ($types as $t) {
                $sel = ($doc['category'] === $t) ? 'selected' : '';
                echo "<option value=\"".htmlspecialchars($t)."\" $sel>".htmlspecialchars($t)."</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Expiry Date</label>
        <input type="date" name="expiry_date" required value="<?= htmlspecialchars($doc['expiry_date']) ?>">
    </div>

    <div class="form-group">
        <label>Replace Document</label>
        <input type="file" name="document_file">
        <?php if (!empty($doc['image_path'])): ?>
            <div style="margin-top:8px">
                <strong>Current file:</strong>
                <div class="current-file-preview" style="margin-top:6px">
                    <img src="<?= htmlspecialchars($doc['image_path']) ?>" alt="current" style="max-width:200px;border:1px solid #e3e6ef;border-radius:6px;padding:4px">
                </div>
                <label style="display:block;margin-top:8px"> Remove existing file<input type="checkbox" name="remove_image" value="1"></label>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>Notes</label>
        <textarea name="notes"><?= htmlspecialchars($doc['notes']) ?></textarea>
    </div>

    <button type="submit" class="save-btn">Save Changes</button>

</form>

</div>

<script>
setTimeout(() => {
        document.querySelectorAll('.toast').forEach(el => el.remove());
    }, 5000);
</script>

</body>
</html>