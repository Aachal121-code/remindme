<?php
// Preferences page: notifications (on/off)
$user_id = $_SESSION['user_id'];
$defaults = ['email_notifications' => true, 'cookie_consent' => true, 'phone' => '', 'timezone' => 'UTC', 'avatar' => '', 'two_factor' => false];
$prefs = $defaults;
if (!empty($_SESSION['prefs'][$user_id]) && is_array($_SESSION['prefs'][$user_id])) {
    $prefs = array_merge($prefs, $_SESSION['prefs'][$user_id]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_prefs'])) {
    $prefs['email_notifications'] = isset($_POST['email_notifications']) ? true : false;
    // Save into session (removing per-user JSON files)
    $_SESSION['prefs'][$user_id] = $prefs;
    $_SESSION['success'] = 'Preferences saved.';
    header('Location: settings.php?page=preference');
    exit;
}
?>
<?php
include '../popup.php';
?>

<h3>App Preferences</h3>
<form method="post">
    <div class="card">
        <label style="display:block">Notifications</label>
        <label><input type="checkbox" name="email_notifications" <?= $prefs['email_notifications'] ? 'checked' : '' ?>> Email notifications</label>

        <button type="submit" name="save_prefs">Save preferences</button>
    </div>
</form>