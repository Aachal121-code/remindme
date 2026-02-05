<?php
$today = date('Y-m-d');

$sql = "
SELECT doc_name, expiry_date
FROM documents
WHERE user_id = ?
  AND expiry_date > ?
  AND expiry_date <= DATE_ADD(?, INTERVAL 30 DAY)
ORDER BY expiry_date ASC
LIMIT 5
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $user_id, $today, $today);
$stmt->execute();
$upcomingDocs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
