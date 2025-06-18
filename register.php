<?php
include 'dbconnection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["email"]) || !isset($_POST["username"]) || !isset($_POST["password"])) {
        echo "Incomplete data provided";
        exit;
    }
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($email === null || $username === null || $password === null) {
        echo "One or more values are null";
        exit;
    }

   
    $checkQuery = "SELECT cust_name FROM customers WHERE cust_name = ?";
    $checkStmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($checkStmt, "s", $username);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);

    if (mysqli_stmt_num_rows($checkStmt) > 0) {
        
        echo "Username already exists";
        echo '<script>
        
        setTimeout(function() {
            window.location.href = "register.html";
        }, 1500);
    </script>';
        exit;
        
    }
    

  
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO customers (cust_email, cust_name, cust_password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "sss", $email, $username, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
        
        header("Location: login.html");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);

    mysqli_close($conn);
}

?>
