<?php
include 'db.php';
$data = json_decode(file_get_contents("php://input"));
$user_id = intval($data->user_id);
$to_account = $conn->real_escape_string($data->to_account);
$amount = floatval($data->amount);

$accResult = $conn->query("SELECT id, balance FROM accounts WHERE user_id=$user_id");
$sender = $accResult->fetch_assoc();

if ($sender['balance'] >= $amount && $amount > 0) {
    $conn->query("UPDATE accounts SET balance = balance - $amount WHERE user_id=$user_id");
    $conn->query("UPDATE accounts SET balance = balance + $amount WHERE account_number='$to_account'");
    $conn->query("INSERT INTO transactions (user_id, type, amount, date) VALUES ($user_id, 'debit', $amount, NOW())");
    $receiverResult = $conn->query("SELECT user_id FROM accounts WHERE account_number='$to_account'");
    if ($receiver = $receiverResult->fetch_assoc()) {
        $conn->query("INSERT INTO transactions (user_id, type, amount, date) VALUES ({$receiver['user_id']}, 'credit', $amount, NOW())");
    }
    echo json_encode(['success' => true, 'message' => 'Transfer successful']);
} else {
    echo json_encode(['success' => false, 'message' => 'Insufficient balance or invalid amount']);
}
?>
