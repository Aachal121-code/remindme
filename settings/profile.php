<?php
require_once __DIR__ . '/../config/db_connect.php';
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $timezone = trim($_POST['timezone'] ?? 'UTC');

    if (empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Valid name and email are required.';
        header('Location: settings.php?page=profile');
        exit;
    }

    // Check duplicate email
    $stmt = $conn->prepare('SELECT id FROM users WHERE email = ? AND id != ?');
    $stmt->bind_param('si', $email, $user_id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows > 0) {
        $_SESSION['error'] = 'Email already in use.';
        header('Location: settings.php?page=profile');
        exit;
    }

        // Update users table (only name & email)
    $stmt = $conn->prepare('UPDATE users SET name = ?, email = ? WHERE id = ?');
    $stmt->bind_param('ssi', $name, $email, $user_id);
    if ($stmt->execute()) {
        $_SESSION['success'] = 'Profile updated.';
        $_SESSION['user_name'] = $name;
        header('Location: settings.php?page=profile');
        exit;
    } else {
        $_SESSION['error'] = 'Update failed.';
        header('Location: settings.php?page=profile');
        exit;
    }
}

// Fetch current info
$stmt = $conn->prepare('SELECT name, email FROM users WHERE id = ?');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$name = $row['name'] ?? '';
$email = $row['email'] ?? '';
?>

<h3>Profile & Account</h3>

<div class="card profile-view">
    <div style="display:flex;justify-content:space-between;align-items:center">
        <div>
            <div style="font-weight:600;color:#333">Name</div>
            <div style="margin-top:6px;font-size:1.05rem;color:#111"><?= htmlspecialchars($name) ?></div>

            <div style="margin-top:12px;font-weight:600;color:#333">Email</div>
            <div style="margin-top:6px;color:#111"><?= htmlspecialchars($email) ?></div>
        </div>
        <div>
            <button class="edit-profile-btn">Edit</button>
        </div>
    </div>
</div>

<form method="post" class="card profile-edit-form" style="display:none;margin-top:12px">
    <label>Name</label>
    <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>

    <div style="margin-top:12px;display:flex;gap:8px">
        <button type="submit" name="update_profile">Save</button>
        <button type="button" class="cancel-edit-btn">Cancel</button>
    </div>
</form>
