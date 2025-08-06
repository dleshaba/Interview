<?php
#include 'db_connection.php';
session_start();

$conn = new mysqli("localhost", "root", "newpass", "synrgise_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $task_name = $_POST['task_name'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'anonymous';

    $stmt = $conn->prepare("INSERT INTO tasks (task_name, description, due_date, user) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $task_name, $description, $due_date, $username);

    if ($stmt->execute()) {
        echo "<script>alert('Task added successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
