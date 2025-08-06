<?php
$servername = "localhost";
$username = "root";
$password = "newpass";
$dbname = "synrgise_db";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    
} else {
    die("Error creating database: " . $conn->error);
}

$conn->select_db($dbname);

$sql_tasks = "CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    due_date DATE NOT NULL,
    user VARCHAR(50),
    is_published TINYINT(1) DEFAULT 1,
    is_completed TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql_tasks) === TRUE) {
    #echo "Table 'tasks' created or already exists.<br>";
} else {
    echo "Error creating tasks table: " . $conn->error;
}

$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql_users) === TRUE) {
    #echo "Table 'users' created or already exists.<br>";
} else {
    echo "Error creating users table: " . $conn->error;
}

$conn->close();
?>
