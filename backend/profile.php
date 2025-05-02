<?php
include 'db.php';
$data = json_decode(file_get_contents("php://input"));
$user_id = intval($data->user_id);

if (isset($data->update)) {
    $name = $conn->real_escape_string($data->name);
    $email = $conn->real_escape_string($data->email);
    $conn->query("UPDATE users SET name='$name', email='$email' WHERE id=$user_id");
    echo json_encode(['success' => true, 'message' => 'Profile updated']);
} else {
    $result = $conn->query("SELECT name, email FROM users WHERE id=$user_id");
    if ($row = $result->fetch_assoc()) {
        echo json_encode(['success' => true, 'profile' => $row]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
}
?>
