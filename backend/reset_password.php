<?php
include 'db.php';
$data = json_decode(file_get_contents("php://input"));
$token = $conn->real_escape_string($data->token);
$password = $data->password;

$result = $conn->query("SELECT email FROM password_resets WHERE token='$token' AND expires_at > NOW()");
if ($row = $result->fetch_assoc()) {
    $email = $row['email'];
    $conn->query("UPDATE users SET password='$password' WHERE email='$email'");
    $conn->query("DELETE FROM password_resets WHERE email='$email'");
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid or expired token.']);
}
?>
