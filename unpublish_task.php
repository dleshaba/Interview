<?php
include_once 'Config.php';

$conn = new mysqli("$servername", "$dbUsername", "$dbPassword", "$dbName");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $task_id = $_POST['task_id'];

    $stmt = $conn->prepare("UPDATE tasks SET is_published = 0 WHERE id = ?");
    $stmt->bind_param("i", $task_id);

    if ($stmt->execute()) {
        echo "<script>
                window.location.href = 'index.php';
            </script>";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>

