<?php
include 'dbconnection.php';
session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM ADMIN WHERE admin_name='$username' AND admin_pwd='$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;

        $_SESSION['redirectUrl'] = isset($_SESSION['redirectUrl']) ? $_SESSION['redirectUrl'] : 'main.php';

        header("Location: admin_main.php");
        exit;
    } else {
        echo "Invalid username or password";
    }
}

$conn->close();
?>
