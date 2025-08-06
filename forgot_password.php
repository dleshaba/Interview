<?php
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "newpass";
$dbName = "synrgise_db";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);

    echo "username: $username<br>";
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo "<script>
            alert('Username not found.');
            window.location.href = 'forgot_password.html';
        </script>";
    } else {
        $newPassword = "newpass123";
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt->close();

        $update = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $update->bind_param("ss", $hashed, $username);
        $update->execute();

        echo "<script>
            alert('Your password has been reset to: $newPassword');
            window.location.href = 'login.html';
        </script>";
    }
}

$conn->close();
?>