<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "newpass";
$dbName = "synrgise_db";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$task_name = trim($_POST['task_name']);
$description = trim($_POST['description']);
$due_date = date('Y-m-d', strtotime($_POST['due_date']));

$stmt = $conn->prepare("INSERT INTO tasks (task_name, description, due_date) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $task_name, $description, $due_date);

if ($stmt->execute()) {
    echo "<script>
        alert('Task created successfully!');
        window.location.href = 'index.php'; // change to your main page
    </script>";
} else {
    echo "<script>
        alert('Error adding task: " . $stmt->error . "');
        window.history.back();
    </script>";
}

$stmt->close();
$conn->close();
?>
