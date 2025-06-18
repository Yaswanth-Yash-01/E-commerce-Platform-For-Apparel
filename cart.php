<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="main1.css">
    <style>
        body{
            align-items: center;
        }
        .h2{
            align-content: center;
        }
       .cart-image {
            max-width: 100px;
            max-height: 100px;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .cart {
            flex: 1;
            margin-right: 10px;
        }
        .address-form {
            flex: 5;
        }
        .address-form input {
            width: 50%;
            margin-bottom: 10px;
            margin-left: 20;
        }
        .address-form button {
            width: 50%;
        }
    </style>
</head>
<body>
    

    <div class="container">
        <div class="cart">
            <?php
            session_start();
            include 'dbconnection.php'; 

            $totalPrice = 0;

            
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];


                $query = "SELECT * FROM user_cart 
                        INNER JOIN ADD_PRODUCT ON user_cart.product_id = ADD_PRODUCT.PROD_ID 
                        WHERE cust_id = (SELECT cust_id FROM customers WHERE cust_name = '$username')";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        $title = $row['TITLE'];
                        $image = $row['PRODUCT_IMG'];
                        $price = $row['PRICE'];

                        echo "<img src='$image' alt='$title' class='cart-image'>";
                        echo "<div>";
                        echo "<h3>$title</h3>";
                        echo "<p>Price: $ $price</p>";
                        echo "</div>";

                        $totalPrice += $price;
                    }
                } else {
                    echo "<p>Your cart is empty.</p>";
                }
            } else {
                echo "<p>Please login to view your cart.</p>";
            }

           
            echo "<h3>Total Price: $ $totalPrice</h3>";
            $_SESSION['totalPrice'] = $totalPrice;
            mysqli_close($conn);
            ?>
        </div>

        <div class="address-form">
            <h2>Shipping Address</h2>
            <form action="placeorder.php" method="post">
                <input type="text" name="name" placeholder="Name" required>
                <input type="text" name="phone" placeholder="Phone Number" required>
                <input type="text" name="address" placeholder="Address" required>
                <input type="text" name="pincode" placeholder="Pincode" required>
                <input type="text" name="city" placeholder="City" required>
                <input type="text" name="state" placeholder="State" required>
                <input type="text" name="country" placeholder="Country" required>
                <button type="submit">Place Order</button>
            </form>
        </div>
    </div>
</body>
</html>
