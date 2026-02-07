<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RenewMe</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <img src="assets/logo.png" alt="RenewMe Logo" class="logo">
            </div>
            <div class="nav-links">
                <a href="#features">Features</a>
                <a href="#advantages">Advantages</a>
                <a href="#security">Security</a>
                <a href="#about">About</a>
            </div>
            <div class="nav-actions">
                <a href="register.php" class="btn-register">Get Started</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title">
                    Never Miss an Important<br>
                    <span class="highlight">Document Expiry Date</span> Again
                </h1>
                <p class="hero-description">
                    RenewMe is your personal document expiry reminder system. Track documents, 
                    warranty cards, licenses, insurance, and more. Get automatic reminders 
                    before expiry dates and keep everything organized in one secure place.
                </p>
                <div class="hero-actions">
                    <a href="register.php" class="btn-primary">
                        <i class="fas fa-rocket"></i> Start Free Today
                    </a>
                    <a href="#features" class="btn-secondary">
                        <i class="fas fa-info-circle"></i> Learn More
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Secure</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">0</div>
                        <div class="stat-label">Ads</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">Free</div>
                        <div class="stat-label">Forever</div>
                    </div>
                </div>
            </div>
            <div class="hero-visual">
                <div class="visual-card">
                    <div class="card-header">
                        <span class="card-dot"></span>
                        <span class="card-dot"></span>
                        <span class="card-dot"></span>
                    </div>
                    <div class="card-content">
                        <div class="doc-item valid">
                            <i class="fas fa-id-card"></i>
                            <div>
                                <strong>Driver's License</strong>
                                <span>Expires: 15 Dec 2024</span>
                            </div>
                            <span class="status-badge valid">Valid</span>
                        </div>
                        <div class="doc-item warning">
                            <i class="fas fa-shield-alt"></i>
                            <div>
                                <strong>Health Insurance</strong>
                                <span>Expires: 05 Jan 2025</span>
                            </div>
                            <span class="status-badge warning">Expiring Soon</span>
                        </div>
                        <div class="doc-item expired">
                            <i class="fas fa-certificate"></i>
                            <div>
                                <strong>Vehicle Registration</strong>
                                <span>Expired: 20 Nov 2024</span>
                            </div>
                            <span class="status-badge expired">Expired</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Powerful Features</h2>
                <p class="section-subtitle">Everything you need to manage your important documents</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3>Automatic Reminders</h3>
                    <p>Get notified before your documents expire. Never miss a renewal deadline again.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h3>Organized Categories</h3>
                    <p>Categorize documents by type: Personal, Vehicle, Education, Insurance, and more.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-upload"></i>
                    </div>
                    <h3>Document Upload</h3>
                    <p>Upload and store digital copies of your documents securely in one place.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h3>Dashboard Overview</h3>
                    <p>Quick status view showing valid, expiring soon, and expired documents at a glance.</p>
                </div>
                <!-- <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>Easy Search & Filter</h3>
                    <p>Quickly find any document with search and filter options. Stay organized effortlessly.</p>
                </div> -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <h3>Edit & Update</h3>
                    <p>Update document details, expiry dates, and notes anytime. Full control over your data.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <h3>Download Documents</h3>
                    <p>Download your stored documents anytime you need them. Access from anywhere.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <h3>Customizable Settings</h3>
                    <p>Manage your profile, preferences, security settings, and notification preferences.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Advantages Section -->
    <section id="advantages" class="advantages-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Why Choose RenewMe?</h2>
                <p class="section-subtitle">The advantages that make us the best choice for document management</p>
            </div>
            <div class="advantages-grid">
                <div class="advantage-item">
                    <div class="advantage-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Save Time</h3>
                    <p>No more searching through files or calendars. All your expiry dates in one place.</p>
                </div>
                <div class="advantage-item">
                    <div class="advantage-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h3>Avoid Penalties</h3>
                    <p>Never pay late fees or penalties again. Get reminders before documents expire.</p>
                </div>
                <div class="advantage-item">
                    <div class="advantage-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Peace of Mind</h3>
                    <p>Sleep better knowing you won't miss important renewal deadlines.</p>
                </div>
                <div class="advantage-item">
                    <div class="advantage-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Access Anywhere</h3>
                    <p>Web-based platform works on any device - desktop, tablet, or mobile.</p>
                </div>
                <div class="advantage-item">
                    <div class="advantage-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h3>Privacy First</h3>
                    <p>Your documents are private. No sharing, no ads, no third-party access.</p>
                </div>
                <div class="advantage-item">
                    <div class="advantage-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <h3>Completely Free</h3>
                    <p>No hidden costs, no premium tiers. All features available to everyone.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why You Need This Section -->
    <section class="why-section">
        <div class="container">
            <div class="why-content">
                <div class="why-text">
                    <h2>Why You Need RenewMe</h2>
                    <p class="why-intro">
                        Life is busy, and important document expiry dates are easy to forget. 
                        But the consequences of missing them can be costly and stressful.
                    </p>
                    <div class="why-list">
                        <div class="why-item">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <h4>Avoid Fines & Penalties</h4>
                                <p>Late renewals often result in hefty fines. RenewMe ensures you renew on time.</p>
                            </div>
                        </div>
                        <div class="why-item">
                            <i class="fas fa-ban"></i>
                            <div>
                                <h4>Prevent Service Interruptions</h4>
                                <p>Expired documents can halt services. Stay ahead with timely reminders.</p>
                            </div>
                        </div>
                        <div class="why-item">
                            <i class="fas fa-file-invoice"></i>
                            <div>
                                <h4>Track Multiple Documents</h4>
                                <p>Manage licenses, insurance, warranties, certificates, and more in one place.</p>
                            </div>
                        </div>
                        <div class="why-item">
                            <i class="fas fa-check-circle"></i>
                            <div>
                                <h4>Stay Organized</h4>
                                <p>No more scattered papers or forgotten dates. Everything organized digitally.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="why-visual">
                    <div class="problem-card">
                        <h4>❌ Without RenewMe</h4>
                        <ul>
                            <li>Missed renewal deadlines</li>
                            <li>Late fees and penalties</li>
                            <li>Lost or forgotten documents</li>
                            <li>Stress and last-minute rush</li>
                            <li>Service interruptions</li>
                        </ul>
                    </div>
                    <div class="solution-card">
                        <h4>✅ With RenewMe</h4>
                        <ul>
                            <li>Timely reminders</li>
                            <li>No late fees</li>
                            <li>All documents organized</li>
                            <li>Peace of mind</li>
                            <li>Continuous service</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Security Section -->
    <section id="security" class="security-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Your Documents Are Safe With Us</h2>
                <p class="section-subtitle">Enterprise-grade security to protect your sensitive information</p>
            </div>
            <div class="security-grid">
                <div class="security-card">
                    <div class="security-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3>Encrypted Storage</h3>
                    <p>Your documents are stored securely with encryption. Only you can access your data.</p>
                </div>
                <div class="security-card">
                    <div class="security-icon">
                        <i class="fas fa-key"></i>
                    </div>
                    <h3>Password Protection</h3>
                    <p>Strong password hashing ensures your account remains secure from unauthorized access.</p>
                </div>
                <div class="security-card">
                    <div class="security-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>SQL Injection Prevention</h3>
                    <p>Prepared statements and input sanitization protect against database attacks.</p>
                </div>
                <div class="security-card">
                    <div class="security-icon">
                        <i class="fas fa-user-lock"></i>
                    </div>
                    <h3>Session Security</h3>
                    <p>Secure session management ensures only authenticated users can access their data.</p>
                </div>
                <div class="security-card">
                    <div class="security-icon">
                        <i class="fas fa-file-shield"></i>
                    </div>
                    <h3>File Validation</h3>
                    <p>Strict file type and size validation prevents malicious uploads and protects your system.</p>
                </div>
                <div class="security-card">
                    <div class="security-icon">
                        <i class="fas fa-eye-slash"></i>
                    </div>
                    <h3>Privacy by Design</h3>
                    <p>Your documents are private. We don't share, sell, or access your data. Ever.</p>
                </div>
            </div>
            <div class="security-badge">
                <i class="fas fa-check-circle"></i>
                <span>Your data is encrypted, secure, and private. We take your security seriously.</span>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>About RenewMe</h2>
                    <p>
                        RenewMe is a web-based document expiry reminder system designed to help individuals 
                        and families keep track of important document expiration dates. Whether it's your 
                        driver's license, passport, insurance policies, warranty cards, vehicle registration, 
                        or educational certificates, RenewMe ensures you never miss a renewal deadline.
                    </p>
                    <p>
                        Built with modern web technologies (PHP, MySQL, HTML5, CSS3, JavaScript), RenewMe 
                        offers a clean, intuitive interface that's easy to use for everyone. Our mission is 
                        to help you stay organized, avoid penalties, and maintain peace of mind when it comes 
                        to managing your important documents.
                    </p>
                    <div class="about-features">
                        <div class="about-feature">
                            <i class="fas fa-check"></i>
                            <span>Simple & User-Friendly</span>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-check"></i>
                            <span>100% Free Forever</span>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-check"></i>
                            <span>No Ads, No Tracking</span>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-check"></i>
                            <span>Privacy-Focused</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Never Miss an Expiry Date Again?</h2>
                <p>Join thousands of users who trust RenewMe to keep their documents organized</p>
                <div class="cta-actions">
                    <a href="register.php" class="btn-cta-primary">
                        <i class="fas fa-user-plus"></i> Create Free Account
                    </a>
                    <a href="login.php" class="btn-cta-secondary">
                        <i class="fas fa-sign-in-alt"></i> Already have an account? Login
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>RenewMe</h3>
                    <p>Your trusted document expiry reminder system. Never miss an important date again.</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#advantages">Advantages</a></li>
                        <li><a href="#security">Security</a></li>
                        <li><a href="#about">About</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Account</h4>
                    <ul>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="settings/settings.php?page=about">About App</a></li>
                        <li><a href="settings/settings.php?page=privacy">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date("Y"); ?> RenewMe. All rights reserved. Built with ❤️ for better document management.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>

