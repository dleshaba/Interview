<?php

include_once 'Config.php';

session_start();

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $remember = isset($_POST["remember_me"]);

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION["username"] = $username;

            if ($remember) {
                setcookie("username", $username, time() + (86400 * 30), "/");
                setcookie("password", $password, time() + (86400 * 30), "/");
            }

            echo "<script>
                alert('Login successful');
                window.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Incorrect password');
                window.location.href = 'login_page.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('User not found');
            window.location.href = 'login_page.php';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
