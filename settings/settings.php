<?php

require_once '../session_check.php';

require_once '../popup.php'; 
// page can be 'menu', 'profile', 'security', 'preference', 'privacy', 'about'
$page = $_GET['page'] ?? 'menu';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Settings - RenewMe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/setting.css">
</head>
<body class="<?= $page==='menu' ? 'menu-page' : '' ?>">

<div class="settings-layout">
    <!-- Sidebar -->
    <aside class="settings-sidebar">
        <a href="../dashboard.php" class="back-btn">← Back</a>
        <h2>⚙️ Settings</h2>
        
        <a href="?page=profile" class="<?= $page=='profile'?'active':'' ?>">Profile</a>
        <a href="?page=security" class="<?= $page=='security'?'active':'' ?>">Security</a>
        <a href="?page=preference" class="<?= $page=='preference'?'active':'' ?>">Preferences</a>
        <a href="?page=privacy" class="<?= $page=='privacy'?'active':'' ?>">Privacy</a>
        <a href="?page=about" class="<?= $page=='about'?'active':'' ?>">About</a>
        
        <a href="../logout.php" class="logout">Logout</a>
    </aside>
    
    <!-- Content -->
    <main class="settings-content">
        <?php
        
        $allowed = ['menu','profile','security','preference','privacy','about'];
        if (!in_array($page, $allowed)) {
            $page = 'menu';
        }
        
        // If we're on the menu page, show a simple list of settings
        if ($page === 'menu') {
            ?>
            <a href="../dashboard.php" class="back-btn">← Back</a>
            <div class="settings-menu">
                <a class="setting-card" href="settings.php?page=profile">
                    <h4>Profile & Account</h4>
                    <p>View and edit name, email, phone and avatar</p>
                </a>
                <a class="setting-card" href="settings.php?page=security">
                    <h4>Security</h4>
                    <p>Change password and security settings</p>
                </a>
                <a class="setting-card" href="settings.php?page=preference">
                    <h4>Preferences</h4>
                    <p>Notification preferences</p>
                </a>
                <a class="setting-card" href="settings.php?page=privacy">
                    <h4>Privacy</h4>
                    <p>Cookie consent, export data, delete account</p>
                </a>
                <a class="setting-card" href="settings.php?page=about">
                    <h4>About</h4>
                    <p>About the app and support</p>
                </a>
                <a class="setting-card" href="../logout.php">
                    <h4>Logout</h4>
                    <p>Logout from your account</p>
                </a>
            </div>
            <?php

        } else {
            // Show a small back button (useful on mobile) and include page-specific files
            ?>
            <a class="back-btn" href="settings.php?page=menu">← Back</a>
            <?php
            include __DIR__ . '/' . $page . '.php';
        }
        ?>
    </main>

</div>

<script src="../assets/js/setting.js"></script>
<script>
    setTimeout(() => {
        document.querySelectorAll('.toast').forEach(el => el.remove());
    }, 3000);
</script>
</body>
</html>
