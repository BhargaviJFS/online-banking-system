<?php
include 'db.php';
$data = json_decode(file_get_contents("php://input"));

$name = $conn->real_escape_string($data->name);
$email = $conn->real_escape_string($data->email);
$password = $data->password;

if ($conn->query("INSERT INTO users (Name, email, password) VALUES ('$name', '$email', '$password')")) {
    $user_id = $conn->insert_id;
    $account_number = rand(1000000000, 9999999999);
    $conn->query("INSERT INTO accounts (user_id, balance, account_number) VALUES ($user_id, 10000, '$account_number')");
    echo json_encode(['success' => true,'message' => 'Congratulations.... Registration Successfull']);
} else {
    echo json_encode(['success' => false, 'message' => 'Registration failed. Email might already be used.']);
}
?>
