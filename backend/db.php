<?php
$host = 'localhost';
$db = 'bankdb';
$user = 'root';
$pass = ''; // Set your MySQL password
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
