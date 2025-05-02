/*<?php
include 'db.php';
$data = json_decode(file_get_contents("php://input"));
$email = $conn->real_escape_string($data->email);

$result = $conn->query("SELECT * FROM users WHERE email='$email' ");
if ($result->num_rows > 0) {
    $token = bin2hex(random_bytes(32));
    $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $conn->query("DELETE FROM password_resets WHERE email='$email'");
    $conn->query("INSERT INTO password_resets (email, token, expires_at) VALUES ('$email', '$token', '$expires')");
    $resetLink = "http://localhost/online-banking-system/frontend/#/reset/$token";
    echo json_encode([
        'success' => true,
        'message' => 'A password reset link has been generated.',
        'reset_link' => $resetLink // For demo/testing only
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No account found with that email address.'
    ]);
}
?>*/


<?php
include 'db.php';
$data = json_decode(file_get_contents("php://input"));

if (!$data || !isset($data->email)) {
    echo json_encode([
        'success' => false,
        'message' => 'No email provided.'
    ]);
    exit;
}

$email = $conn->real_escape_string($data->email);

$result = $conn->query("SELECT * FROM users WHERE email='$email'");
if ($result && $result->num_rows > 0) {
    $token = bin2hex(random_bytes(32));
    $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $conn->query("DELETE FROM password_resets WHERE email='$email'");
    $conn->query("INSERT INTO password_resets (email, token, expires_at) VALUES ('$email', '$token', '$expires')");
    $resetLink = "http://localhost/online-banking-system/frontend/#/reset/$token";
    echo json_encode([
        'success' => true,
        'message' => 'A password reset link has been generated.',
        'reset_link' => $resetLink // For demo/testing only
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No account found with that email address.'
    ]);
}
?>

