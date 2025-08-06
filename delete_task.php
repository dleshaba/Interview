<?php
session_start();
include_once 'Config.php';

$conn = new mysqli("$servername", "$dbUsername", "$dbPassword", "$dbName");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];
    $username = $_SESSION['username'];

    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ? AND user = ?");
    $stmt->bind_param("is", $task_id, $username);

    if ($stmt->execute()) {
        header("Location: index.php?message=Task+deleted+successfully");
        exit();
    } else {
        echo "Error deleting task: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
