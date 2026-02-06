<?php
if (php_sapi_name() !== 'cli') {
    exit;
}

require_once __DIR__ . '/../config/db_connect.php';
require_once __DIR__ . '/mail_config.php';

date_default_timezone_set('UTC');

$today = new DateTime('today');

$sql = "
SELECT d.id, d.doc_name, d.expiry_date,
       d.reminder_30_sent, d.reminder_7_sent,
       u.email, u.name
FROM documents d
JOIN users u ON d.user_id = u.id
WHERE d.expiry_date > CURDATE()
  AND (d.reminder_30_sent = 0 OR d.reminder_7_sent = 0)
";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {

    $expiry = new DateTime($row['expiry_date']);
    $days   = (int)$today->diff($expiry)->format('%r%a');

    if ($days <= 30 && $days > 7 && !$row['reminder_30_sent']) {
        sendReminder($row, 30);
        markSent($conn, $row['id'], 'reminder_30_sent');
    }

    if ($days <= 7 && $days >= 0 && !$row['reminder_7_sent']) {
        sendReminder($row, 7);
        markSent($conn, $row['id'], 'reminder_7_sent');
    }
}

function sendReminder($doc, $days) {
    $mail = getMailer();
    $mail->addAddress($doc['email'], $doc['name']);
    $mail->Subject = "{$doc['doc_name']} expires in {$days} days";
    $mail->Body = "
        <p>Hello {$doc['name']},</p>
        <p>Your document <b>{$doc['doc_name']}</b> expires in <b>{$days} days</b>.</p>
        <p>Expiry Date: {$doc['expiry_date']}</p>
        <p>Please renew it before the expiry date to avoid any inconvenience.</p>
        <p>— RenewMe Team</p>
    ";
    return $mail->send();
}

function markSent($conn, $id, $column) {
    $stmt = $conn->prepare("UPDATE documents SET {$column}=1 WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
?>