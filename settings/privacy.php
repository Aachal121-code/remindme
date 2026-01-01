<?php
require_once __DIR__ . '/../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$defaults = ['cookie_consent' => true];
$prefs = $defaults;
if (!empty($_SESSION['prefs'][$user_id]) && is_array($_SESSION['prefs'][$user_id])) {
    $prefs = array_merge($prefs, $_SESSION['prefs'][$user_id]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_privacy'])) {
        $prefs['cookie_consent'] = isset($_POST['cookie_consent']) ? true : false;
        $_SESSION['prefs'][$user_id] = $prefs;
        $_SESSION['success'] = 'Privacy settings saved.';
        header('Location: settings.php?page=privacy');
        exit;
    }

    if (isset($_POST['export_data'])) {
        // Export user data: user info + documents
        $stmt = $conn->prepare('SELECT id, name, email, created_at FROM users WHERE id = ?');
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        $usr = $stmt->get_result()->fetch_assoc();

        $stmt = $conn->prepare('SELECT doc_name, category, expiry_date, notes, image_path, created_at FROM documents WHERE user_id = ?');
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        $docs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $export = ['user' => $usr, 'documents' => $docs];
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="remindme_export_' . $_SESSION['user_id'] . '.json"');
        echo json_encode($export, JSON_PRETTY_PRINT);
        exit;
    }

    if (isset($_POST['delete_account'])) {
        // Delete user and cascade documents (DB has ON DELETE CASCADE)
        $stmt = $conn->prepare('DELETE FROM users WHERE id = ?');
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        session_unset();
        session_destroy();
        header('Location: ../register.php');
        exit;
    }
}
?>

<h3>Cookies & Privacy</h3>
<form method="post">
    <div class="card">
        <p>This app stores expiry dates in your account. We don't share your data.</p>
        <label><input type="checkbox" name="cookie_consent" <?= $prefs['cookie_consent'] ? 'checked' : '' ?>> Allow cookies</label>
        <br><br>
        <button type="submit" name="save_privacy">Save</button>
    </div>
</form>

<hr>

<div class="card" style="margin-top:12px">
    <form method="post" style="display:inline">
        <button type="submit" name="export_data">Export my data</button>
    </form>

    <form method="post" style="display:inline;margin-left:8px" onsubmit="return confirm('Delete your account and all documents? This cannot be undone.')">
        <button type="submit" name="delete_account">Delete my account</button>
    </form>
</div>
