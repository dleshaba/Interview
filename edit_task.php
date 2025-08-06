<?php
$conn = new mysqli("localhost", "root", "newpass", "synrgise_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

$task_id = $task_name = $description = $due_date = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $task_id = $_POST['task_id'];
    $task_name = $_POST['task_name'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'anonymous';

    $stmt = $conn->prepare("UPDATE tasks SET task_name = ?, description = ?, due_date = ?, user = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $task_name, $description, $due_date, $username, $task_id);

    if ($stmt->execute()) {
        echo "<script>alert('Task updated successfully.'); window.location.href='index.php';</script>";
    } else {
        echo "Error updating task: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit;
} elseif (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $task = $result->fetch_assoc();
        $task_name = $task['task_name'];
        $description = $task['description'];
        $due_date = $task['due_date'];
    } else {
        $task_id = "";
    }

    $stmt->close();
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/core.css" rel="stylesheet">
    <link href="assets/css/components.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <link href="assets/css/menu.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
</head>
<body>
    <div class="container" style="margin-top: 50px;">
        <div class="row new-task_panel">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-pencil"></i> Edit Task</h4>
                </div>
                <div class="panel-body">
                    <?php if ($task_id): ?>
                    <form method="POST" action="edit_task.php">
                        <input type="hidden" name="task_id" value="<?= $task_id ?>">
                                        
                        <div class="form-group">
                            <label class="control-label">Task Name</label>
                            <input type="text" class="form-control" name="task_name" value="<?= $task_name ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea class="form-control" name="description" rows="5" required><?= $description ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Due Date</label>
                            <input type="date" class="form-control" name="due_date" value="<?= $due_date ?>" required>
                        </div>
                                        
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </form>

                    <?php else: ?>
                    <div class="alert alert-danger">Task not found.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
