<?php

$servername = "localhost";
$username = "root"; 
$password = "newpass";
$dbname = "synrgise_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST["username"]);
    $pass = $_POST["password"];
    $confirm = $_POST["confirm_password"];

    if ($pass !== $confirm) {
        echo "<script>
            alert('Passwords do not match!');
            window.history.back();
        </script>";
        exit;
    }

    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $hashedPassword);

    if ($stmt->execute()) {
        echo "<script>
            alert('Registration successful! You will now be redirected to the login page.');
            window.location.href = 'login.html';
        </script>";
        exit;
    } else {
        echo "<script>
        alert('Registration unsuccessful! You will now be redirected to create an account again.');
        window.location.href = 'register.html';
    </script>";
        exit;
    }

    $stmt->close();
}

$conn->close();
?>
