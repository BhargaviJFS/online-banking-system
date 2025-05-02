<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db.php';
$data = json_decode(file_get_contents("php://input"));
$email = $conn->real_escape_string($data->email);
$password = $conn->real_escape_string($data->password);

// Query the users table for a matching user
$result = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Only update lastLogin if id exists
    if (isset($user['ID'])) {
        $conn->query("UPDATE users SET lastLogin=NOW() WHERE ID=" . intval($user['ID']));
        echo json_encode(['success' => true, 'user_id' => $user['ID'], 'name' => $user['Name']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User ID not found in database.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
}
?>
