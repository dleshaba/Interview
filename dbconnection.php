<?php
$host = 'localhost';
$db   = 'synrgise_db';
$user = 'root';
$pass = 'newpass';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
