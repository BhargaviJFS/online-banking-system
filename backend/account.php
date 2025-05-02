<?php
include 'db.php';
$data = json_decode(file_get_contents("php://input"));
$user_id = intval($data->user_id);

$result = $conn->query("SELECT account_number, balance FROM accounts WHERE user_id=$user_id");
if ($row = $result->fetch_assoc()) {
    echo json_encode(['success' => true, 'account' => $row]);
} else {
    echo json_encode(['success' => false, 'message' => 'Account not found']);
}
?>
