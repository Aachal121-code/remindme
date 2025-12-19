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

<div class="add-doc-container">

    <h2>Add New Document</h2>

    <form>

        <div class="form-group">
            <label>Document Name</label>
            <input type="text" placeholder="Enter document name">
        </div>

        <div class="form-group">
            <label>Document Type</label>
            <select>
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
            <input type="date">
        </div>

        <div class="form-group">
            <label>Upload Document</label>
            <input type="file">
        </div>

        <div class="form-group">
            <label>Notes</label>
            <textarea rows="4" placeholder="Add any notes..."></textarea>
        </div>

        <button type="submit" class="save-btn">Save Document</button>

    </form>

</div>

</body>
</html>
