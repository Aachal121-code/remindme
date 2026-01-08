<?php
// Security: change password and toggle two-factor (stored in session prefs)
require_once __DIR__ . '/../config/db_connect.php';
$user_id = $_SESSION['user_id'];
$defaults = ['two_factor' => false];
$prefs = $defaults;
if (!empty($_SESSION['prefs'][$user_id]) && is_array($_SESSION['prefs'][$user_id])) {
    $prefs = array_merge($prefs, $_SESSION['prefs'][$user_id]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['change_password'])) {
        $current = $_POST['current_password'] ?? '';
        $new = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if (empty($current) || empty($new) || empty($confirm)) {
            $_SESSION['error'] = 'All fields are required.';
            header('Location: settings.php?page=security');
            exit;
        }
        if ($new !== $confirm) {
            $_SESSION['error'] = 'New passwords do not match.';
            header('Location: settings.php?page=security');
            exit;
        }

        $stmt = $conn->prepare('SELECT password FROM users WHERE id = ?');
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();

        if (!$row || !password_verify($current, $row['password'])) {
            $_SESSION['error'] = 'Current password is incorrect.';
            header('Location: settings.php?page=security');
            exit;
        }

        $hashed = password_hash($new, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('UPDATE users SET password = ? WHERE id = ?');
        $stmt->bind_param('si', $hashed, $_SESSION['user_id']);
        $stmt->execute();

        $_SESSION['success'] = 'Password updated.';
        header('Location: settings.php?page=security');
        exit;
    }

    if (isset($_POST['toggle_2fa'])) {
        $prefs['two_factor'] = isset($_POST['two_factor']) ? true : false;
        $_SESSION['prefs'][$user_id] = $prefs;
        $_SESSION['success'] = 'Security settings updated.';
        header('Location: settings.php?page=security');
        exit;
    }
}
?>
<?php
include '../popup.php';
?>
<h3>Security</h3>

<form method="post">
    <div class="card">
        <label>Two-factor authentication</label>
        <label><input type="checkbox" name="two_factor" <?= $prefs['two_factor'] ? 'checked' : '' ?>> Enable two-factor (simulated)</label>
        <br><br>
        <button type="submit" name="toggle_2fa">Save Security Settings</button>
    </div>
</form>

<hr>

<form method="post">
    <div class="card" style="margin-top:12px">
        <label>Current password</label>
        <input type="password" name="current_password" required>

        <label>New password</label>
        <input type="password" name="new_password" required>

        <label>Confirm new password</label>
        <input type="password" name="confirm_password" required>

        <button type="submit" name="change_password">Change password</button>
    </div>
</form>
