<?php
include 'dbconnection.php';
session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT cust_password FROM customers WHERE cust_name=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPasswordFromDB = $row['cust_password'];
        if (password_verify($password, $hashedPasswordFromDB)) {
            $_SESSION['username'] = $username;
            $_SESSION['redirectUrl'] = isset($_SESSION['redirectUrl']) ? $_SESSION['redirectUrl'] : 'main.php';
            header("Location: main.php");
            exit;
        } else {
            $errorMessage = "Wrong Credentials";
        }
    } else {
        $errorMessage = "Wrong Credentials";
    }
    $stmt->close();
}

$conn->close();
?>