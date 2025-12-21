<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Document - ReMindMe</title>
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


    <h2>Add New Document</h2>

  <form action="controllers/document_controller.php"
      method="POST"
      enctype="multipart/form-data">

    <div class="form-group">
        <label>Document Name</label>
        <input type="text" name="doc_name" required>
    </div>

    <div class="form-group">
        <label>Document Type</label>
        <select name="category" required>
            <option value="">Select type</option>
            <option>Personal</option>
            <option>Vehicle</option>
            <option>Education</option>
            <option>Insurance</option>
            <option>Other</option>
        </select>
    </div>

    <div class="form-group">
        <label>Expiry Date</label>
        <input type="date" name="expiry_date" required>
    </div>

    <div class="form-group">
        <label>Upload Document</label>
        <input type="file" name="document_file">
    </div>

    <div class="form-group">
        <label>Notes</label>
        <textarea name="notes"></textarea>
    </div>

    <button type="submit" class="save-btn">Save Document</button>

</form>

</div>
    <script>
    setTimeout(() => {
        document.querySelectorAll('.toast').forEach(el => el.remove());
    }, 3000);
</script>

</body>
</html>
