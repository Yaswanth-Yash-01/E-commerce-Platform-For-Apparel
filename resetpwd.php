<?php
session_start();
include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $finalpassword = $_POST["finalpassword"];

   
    $checkUserQuery = "SELECT cust_name FROM customers WHERE cust_name = '$username'";
    $userResult = mysqli_query($conn, $checkUserQuery);

    if (mysqli_num_rows($userResult) > 0) {
       
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        
        $hashInfo = password_get_info($hashedPassword);
        if ($hashInfo['algo'] === 0) {
            echo "Hashing error: " . $hashInfo['algoName'];
        } else {
            echo "Password updated successfully";
            
            
            $sql = "UPDATE customers SET cust_password = '$hashedPassword' WHERE cust_name = '$username'";
            if (mysqli_query($conn, $sql)) {
                echo '<span id="successMsg" style="color: green;">Password updated successfully!</span>';
            } else {
                echo '<span id="errorMsg" style="color: red;">Error updating password: ' . mysqli_error($conn) . '</span>';
            }
        }
    } else {
        echo '<span id="errorMsg" style="color: red;">User does not exist!</span>';
    }
}

mysqli_close($conn);
?>
<script>

    setTimeout(function() {
        window.location.href = "login.html";
    }, 2000);
</script>