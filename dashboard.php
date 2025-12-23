<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once('config/db_connect.php');
require_once 'dashboard_status.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT * FROM documents 
    WHERE user_id = ? 
    ORDER BY expiry_date ASC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets//css//Dashboard.css" type="text/css">
    <title>RemindMe - dashboard</title>
</head>
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



<body>
    <section class="dashboard">
        <div class="navbar">
            <div class="logo">
                <p>Remind<span>Me</span></p>
            </div>
            <div class="nav-actions">
                <div class="addDocument">
                    <button id="addDocumentBtn">+ Add Document</button>
                </div>
                <div class="setting">
                    <button id="settingBtn">⚙️</button>
                </div>
            </div>
        </div>
        <div class="dashboard-container">
            <div class="quickStatus">
                <h2>Quick Status</h2>
                <div class="statusCards">
                    <div class="valid">
                        <h3>✔ Valid : <span><?php echo $valid; ?></span></h3>
                    </div>
                    <div class="expiringSoon">
                        <h3>⚠️ Expiring Soon : <span><?php echo $expiringSoon; ?></span></h3>
                    </div>
                    <div class="expired">
                        <h3>❌ Expired : <span><?php echo $expired; ?></span></h3>
                    </div>
                </div>
            </div>
            <div class="upcoming-expiry">
                <h2>Upcoming Expiry</h2>
                <div class="expiry-list" id="expiryList">
                    <p>No upcoming expiries.</p>
                </div>
            </div>
            <div class="document-list">
                <h2>Your Documents</h2>
                <div class="documents" id="documentList">
                    <!-- <p>No documents added yet.</p> -->
                    <table class="document-table">
                        <thead>
                            <tr>
                                <th>Document</th>
                                <th>Type</th>
                                <th>Expiry</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['doc_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($row['expiry_date'])); ?></td>

                                        <td>
                                            <?php
                                            $today = date('Y-m-d');
                                            $diff = (strtotime($row['expiry_date']) - strtotime($today)) / (60*60*24);

                                            if ($diff < 0) {
                                                echo '<span class="status expired">❌ Expired</span>';
                                            } elseif ($diff <= 30) {
                                                echo '<span class="status soon">⚠️ Expiring Soon</span>';
                                            } else {
                                                echo '<span class="status valid">✔ Valid</span>';
                                            }
                                            ?>
                                        </td>

                                        <td class="actions">
                                            <a href="view_document.php?id=<?php echo $row['id']; ?>">👁️</a>
                                            <a href="edit_document.php?id=<?php echo $row['id']; ?>">✏️</a>
                                            <a href="delete_document.php?id=<?php echo $row['id']; ?>" 
                                            onclick="return confirm('Delete this document?')">🗑️</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align:center;">No documents added yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>    

        </div>
    </section>
        
    <script src="assets/js/dashboard.js"></script>
    <script>
    setTimeout(() => {
        document.querySelectorAll('.toast').forEach(el => el.remove());
    }, 3000);
</script>


</body>

</html>