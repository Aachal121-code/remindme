<?php

require_once 'session_check.php';
require_once 'popup.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to RemindMe</title>
    <link rel="stylesheet" href="assets/css/Home.css">
</head>


<body>

<header class="site-header">
    <div class="header-inner">
        <a href="home.php" class="logo">RemindMe</a>
    </div>
</header>

<main>
<section class="hero">
    <div class="content">
            <div class="left">
            <h1>Never Forget Important Documents — Secure & Private</h1>
            <p>ReMindMe helps you keep documents organized, receive simple reminders, and protects your data with privacy-first storage.</p>

            <ul class="features">
                <li>Encrypted document storage</li>
                <li>Automatic expiry reminders</li>
                <li>Organize documents securely</li>
                <li>Privacy-first — only you can access</li>
            </ul>

            <div class="actions">
                <a href="add_document.php" class="cta-btn">➕ Add Your First Document</a>
            </div>
            <p class="note text-muted">No ads · No sharing · Built for privacy.</p>
        </div>

        <aside class="right-card" aria-labelledby="right-heading">
            <h3 id="right-heading">Security & Privacy</h3>
            <p class="text-muted">Encrypted storage and access controls keep your documents safe and private.</p>

            <div class="kv-group">
                <div class="kv">
                    <div>
                        <div class="label">Documents</div>
                        <div class="value">12</div>
                    </div>
                    <div class="label-icon">📁</div>
                </div>

                <div class="kv">
                    <div>
                        <div class="label">Upcoming</div>
                        <div class="value">3</div>
                    </div>
                    <div class="label-icon">⏰</div>
                </div>
            </div>

            <div class="secure-note">
                <span class="lock">🔒</span>
                <span class="small">Encrypted storage • Private by design</span>
            </div>

            <!-- Simple inline SVG illustration -->
            <div class="illustration" aria-hidden="true">
                <svg width="160" height="120" viewBox="0 0 160 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="8" y="10" width="144" height="100" rx="10" fill="#EFF6FF" />
                    <rect x="20" y="28" width="60" height="8" rx="4" fill="#DBEAFE" />
                    <rect x="20" y="44" width="110" height="8" rx="4" fill="#DBEAFE" />
                    <rect x="20" y="60" width="90" height="8" rx="4" fill="#DBEAFE" />
                    <circle cx="120" cy="86" r="18" fill="#2563eb" />
                    <path d="M114 82 L120 88 L132 76" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </aside>
    </div>
</section>
</main>

<footer class="site-footer">
    <div class="container center">
        <p>&copy; <?php echo date("Y"); ?> RemindMe. All rights reserved.</p>
    </div>
</footer>


</body>
</html>
