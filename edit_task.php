<?php
$conn = new mysqli("localhost", "root", "newpass", "synrgise_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$taskId = $_GET['id'];
$task = null;

if ($stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ?")) {
    $stmt->bind_param("i", $taskId);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['task_name'];
    $desc = $_POST['description'];
    $due = $_POST['due_date'];

    if ($updateStmt = $conn->prepare("UPDATE tasks SET task_name = ?, description = ?, due_date = ? WHERE id = ?")) {
        $updateStmt->bind_param("sssi", $name, $desc, $due, $taskId);
        $updateStmt->execute();
        $updateStmt->close();
        header("Location: dashboard.php");
        exit();
    }
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
                    <?php if ($task): ?>
                    <form role="form" method="POST">
                        <div class="form-group">
                            <label class="control-label">Task Name</label>
                            <input type="text" name="task_name" class="form-control" value="<?= htmlspecialchars($task['task_name']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="description" class="form-control" rows="5" required><?= htmlspecialchars($task['description']) ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label class="col-md-4">Due Date</label>
                                <div class="input-group col-md-8">
                                    <input type="date" class="form-control" name="due_date" value="<?= $task['due_date'] ?>" required>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right" style="margin-top: 25px;">
                                <button type="submit" class="create-btn btn btn-primary waves-effect waves-light">Update</button>
                                <a href="dashboard.php" class="btn btn-default">Cancel</a>
                            </div>
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
