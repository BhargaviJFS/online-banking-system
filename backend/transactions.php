<?php
include 'db.php';
$data = json_decode(file_get_contents("php://input"));
$user_id = intval($data->user_id);

$result = $conn->query("SELECT type, amount, date FROM transactions WHERE user_id=$user_id ORDER BY date DESC");
$transactions = [];
while ($row = $result->fetch_assoc()) {
    $transactions[] = $row;
}
echo json_encode([
    'success' => true,
    'transactions' => $transactions
]);
?>
