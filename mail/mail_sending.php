<?php
// mail_sending.php
session_start();
require_once '../config/db_connect.php';  // database connection
require_once 'mail_config.php';            // PHPMailer config

$today = date('Y-m-d');

// Fetch documents which have not yet sent reminders
$sql = "
SELECT d.id, d.doc_name, d.expiry_date, d.reminder_30_sent, d.reminder_7_sent,
       u.email, u.name
FROM documents d
JOIN users u ON d.user_id = u.id
WHERE d.expiry_date >= ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {

    $days = (int) ((strtotime($row['expiry_date']) - strtotime($today)) / (60*60*24));

    // ---------- 30-day reminder ----------
    if ($days === 30 && !$row['reminder_30_sent']) {
        sendReminder($row, 30);
        markSent($conn, $row['id'], 'reminder_30_sent');
    }

    // ---------- 7-day reminder ----------
    if ($days === 7 && !$row['reminder_7_sent']) {
        sendReminder($row, 7);
        markSent($conn, $row['id'], 'reminder_7_sent');
    }

    // --------- TEST MODE: uncomment for testing -----------------
    // sendReminder($row, $days);
    // markSent($conn, $row['id'], 'reminder_30_sent');      // mark 30-day as sent and will uncomment it for project explanation
    // markSent($conn, $row['id'], 'reminder_7_sent');
}

//FUNCTION: send reminder 
function sendReminder($doc, $days) {
    try {
        $mail = getMailer(); 

        $mail->clearAllRecipients();
        $mail->addAddress($doc['email'], $doc['name']);

        $mail->Subject = "{$doc['doc_name']} expires in $days day" . ($days > 1 ? "s" : "");

        $mail->Body = "
        <p>Hello <strong>{$doc['name']}</strong>,</p>

        <p>Your document '<strong>{$doc['doc_name']}</strong>' will expire in <strong>$days day" . ($days > 1 ? "s" : "") . "</strong>.</p>

        <p>Expiry Date: <strong>{$doc['expiry_date']}</strong></p>

        <p>Please renew it on time.</p>

        <p>— RemindMe Team</p>
        ";

        if (!$mail->send()) {
            echo "Failed to send email to {$doc['email']}: " . $mail->ErrorInfo . "<br>";
        } else {
            echo "Email sent to {$doc['email']} for document '{$doc['doc_name']}'<br>";
        }

    } catch (Exception $e) {
        echo "Mail error for {$doc['email']}: {$e->getMessage()}<br>";
    }
}

// mark reminder as sent 
function markSent($conn, $docId, $column) {
    $stmt = $conn->prepare("UPDATE documents SET $column = 1 WHERE id = ?");
    $stmt->bind_param("i", $docId);
    $stmt->execute();
}
?>
