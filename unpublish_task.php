<?php
$conn = new mysqli("localhost", "root", "newpass", "synrgise_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $task_id = $_POST['task_id'];

    $stmt = $conn->prepare("UPDATE tasks SET is_published = 0 WHERE id = ?");
    $stmt->bind_param("i", $task_id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>

