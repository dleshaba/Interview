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
    $password = trim($_POST["password"]);

    var_dump($password);
    echo "username: $username<br> pass: $password<br>";
    
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {

            echo "<script>
                alert('Login successful');
                window.location.href = 'index.html';
            </script>";
        } else {
            echo "<script>
                alert('Incorrect password');
                window.location.href = 'login.html';
            </script>";
        }
    } else {
        echo "<script>
            alert('User not found');
            window.location.href = 'login.html';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
