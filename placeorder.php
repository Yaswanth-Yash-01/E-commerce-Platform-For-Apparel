<?php
session_start();
include 'dbconnection.php'; 

if (isset($_SESSION['username'])  && isset($_SESSION['totalPrice'])) {
    $username = $_SESSION['username'];
    $totalPrice=$_SESSION['totalPrice'] ;
   
    $cust_id_query = "SELECT cust_id FROM customers WHERE cust_name = '$username'";
    $cust_id_result = mysqli_query($conn, $cust_id_query);

    if ($cust_id_result && mysqli_num_rows($cust_id_result) > 0) {
        $cust_row = mysqli_fetch_assoc($cust_id_result);
        $cust_id = $cust_row['cust_id'];
       
      
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $pincode = $_POST['pincode'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];

        
        $insert_order_query = "INSERT INTO orders (cust_id, name, phone, address, pincode, city, state, country,total_price) 
                               VALUES ('$cust_id', '$name', '$phone', '$address', '$pincode', '$city', '$state', '$country','$totalPrice')";
        $insert_order_result = mysqli_query($conn, $insert_order_query);

        if ($insert_order_result) {
         
            $order_id = mysqli_insert_id($conn);

           
            $cart_query = "SELECT * FROM user_cart WHERE cust_id = '$cust_id'";
            $cart_result = mysqli_query($conn, $cart_query);


            while ($cart_row = mysqli_fetch_assoc($cart_result)) {
                $prod_id = $cart_row['product_id'];
                $quantity = $cart_row['quantity'];
                $insert_item_query = "INSERT INTO order_items (order_id, product_id, quantity, cust_id) 
                                      VALUES ('$order_id', '$prod_id', '$quantity', '$cust_id')";
                mysqli_query($conn, $insert_item_query);
            }


            $clear_cart_query = "DELETE FROM user_cart WHERE cust_id = '$cust_id'";
            mysqli_query($conn, $clear_cart_query);
            
            echo "<style>
            body {
                background-image: url('https://img.freepik.com/free-vector/gradient-black-background-with-wavy-lines_23-2149151738.jpg?size=626&ext=jpg&ga=GA1.1.553209589.1713830400&semt=ais');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }
            
            .container {
                position: relative;
                width: 100%;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            
            .button {
                position: absolute;
                top: 10px;
                right: 10px;
                padding: 10px 20px;
                background-color: #ffffff;
                color: #007bff;
                border: none;
                border-radius: 5px;
                text-decoration: none;
                transition: background-color 0.3s;
            }
            
            .button:hover {
                background-color: #0056b3;
            }
        </style>";
        
        echo "<body>";
        echo "<div class='container'>";
        echo "<a href='main.php' class='button'>Go Back</a>";
        echo "<img src='https://cdn.dribbble.com/users/583807/screenshots/5187139/media/f8efa8395bed7a55fdb2ed424c301d51.gif'>";
        echo "</div>";
        echo "</body>";
        } else {
            echo "Error placing order: " . mysqli_error($conn);
        }
    } else {
        echo "Customer ID not found for username: $username";
    }
} else {
    echo "<script>alert('Please log in to place an order.'); window.location.href='login.html';</script>";
  
}

mysqli_close($conn);
?>
