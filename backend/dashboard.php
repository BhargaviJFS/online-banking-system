<?php
include 'db.php';
$data = json_decode(file_get_contents("php://input"));
$user_id = intval($data->user_id);

$userResult = $conn->query("SELECT name, email, lastLogin FROM users WHERE id=$user_id");
$user = $userResult->fetch_assoc();
$accountResult = $conn->query("SELECT balance, account_number FROM accounts WHERE user_id=$user_id");
$account = $accountResult->fetch_assoc();
$transactionsResult = $conn->query("SELECT type, amount, date FROM transactions WHERE user_id=$user_id ORDER BY date DESC LIMIT 5");
$transactions = [];
while ($row = $transactionsResult->fetch_assoc()) {
    $transactions[] = $row;
}
echo json_encode([
    'success' => true,
    'user' => $user,
    'account' => $account,
    'transactions' => $transactions
]);
?>
