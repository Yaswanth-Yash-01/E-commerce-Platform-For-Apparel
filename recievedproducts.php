<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Order Details</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Pincode</th>
                <th>City</th>
                <th>State</th>
                <th>Phone Number</th>
                <th>Country</th>
                <th>Product Title</th>
                <th>Product Image</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'dbconnection.php'; 
            
       
            $sql_query = "SELECT oi.order_id, c.cust_name AS customer_name, o.address, o.pincode, o.city, o.state, o.phone AS phone_number, o.country, ap.TITLE, ap.PRODUCT_IMG 
                          FROM order_items oi 
                          JOIN ADD_PRODUCT ap ON oi.product_id = ap.PROD_ID 
                          JOIN orders o ON oi.order_id = o.order_id 
                          JOIN customers c ON o.cust_id = c.cust_id";
            $result = mysqli_query($conn, $sql_query);
            
      
            if (mysqli_num_rows($result) > 0) {
            
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["order_id"] . "</td>";
                    echo "<td>" . $row["customer_name"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["pincode"] . "</td>";
                    echo "<td>" . $row["city"] . "</td>";
                    echo "<td>" . $row["state"] . "</td>";
                    echo "<td>" . $row["phone_number"] . "</td>";
                    echo "<td>" . $row["country"] . "</td>";
                    echo "<td>" . $row["TITLE"] . "</td>";
                    echo "<td><img src='" . $row["PRODUCT_IMG"] . "' alt='Product Image' style='max-width: 100px; max-height: 100px;'></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No orders found.</td></tr>";
            }

           
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</body>
</html>