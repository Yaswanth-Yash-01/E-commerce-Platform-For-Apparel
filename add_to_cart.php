<?php
session_start();
include 'dbconnection.php'; 


if(isset($_POST['product_id']) && isset($_SESSION['username'])) {
    $productId = $_POST['product_id'];
    $username = $_SESSION['username'];


    $query = "INSERT INTO user_cart (cust_id, product_id) VALUES (
        (SELECT cust_id FROM customers WHERE cust_name = '$username'), 
        '$productId'
    )";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "Product added to cart.";
    } else {
        echo "Error adding product to cart: " . mysqli_error($conn);
    }
} else {
    echo "Product ID not provided or user not logged in.";
}
?>