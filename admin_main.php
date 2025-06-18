
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trends.admin</title>
<link rel="stylesheet" href="admin_main.css">
<link rel="stylesheet" href="products.css">
<style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 10;
            display: flex;
        }
        .nav-link {
            display: inline-block;
            margin: 10px;
            background-color: #ffffff;
            color: rgb(255, 255, 255);
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .nav-link:hover {
            background-color: #ffffff;
        }
        .sidebar {
            width: 200px;
    background-color: #ffffff;
    color: #000000;
    height: 100vh;
    padding-top: 20px; 
    position: fixed; 
    left: 0; 
    top: 0; 
    z-index: 1;
    border-right: 1px solid #ddd; /
        }
        .sidebar ul {
            padding-top: 10;
            list-style-type: square;
            padding: 0;
            margin: 0;
        }
        .sidebar ul li {
            padding: 5px;
        }
        .sidebar ul li a { 
            text-decoration: none;
            color: #000000;
            display: block;
            font-weight: bold;
            font-size: px;
        }
        .sidebar ul li a:hover {
            background-color: #a0a0a0;
        }
        .content {
    flex: 1;
    padding: 50px;
    margin-left: 200px; 
}
        .content div {
            display: none;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img class ="logo" src="Images/Logo.png">
        <ul>
            <li><a href="#" class="nav-link" onclick="showContent('orders')">Orders</a></li>
            <li><a href="#" class="nav-link" onclick="showContent('products')">Products</a></li>
            <li><a href="#" class="nav-link" onclick="showContent('add products')">Add Products</a></li>
            <li><a href="#" class="nav-link" onclick="showContent('customers')">Customers</a></li>
        </ul>
    </div>
    
    <div class="content">
        
        <div id="orders">
        <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trends.admin</title>
<link rel="stylesheet" href="admin_main.css">
<link rel="stylesheet" href="products.css">
</head>
<body>
    <div class="sidebar">
        <img class ="logo" src="Images/Logo.png">
        <ul>
            <li><a href="#" class="nav-link" onclick="showContent('orders')">Orders</a></li>
            <li><a href="#" class="nav-link" onclick="showContent('products')">Products</a></li>
            <li><a href="#" class="nav-link" onclick="showContent('add products')">Add Products</a></li>
            <li><a href="#" class="nav-link" onclick="showContent('customers')">Customers</a></li>
        </ul>
    </div>
    
    
           <h2>Orders</h2>
           <?php
          
include 'dbconnection.php'; 

$sql_query = "SELECT o.order_id, c.cust_name AS customer_name, o.address, o.pincode, o.city, o.state, o.phone AS phone_number, o.country, GROUP_CONCAT(ap.TITLE) AS product_titles, GROUP_CONCAT(ap.PRODUCT_IMG) AS product_images, SUM(ap.PRICE) AS total_order_price FROM orders o JOIN customers c ON o.cust_id = c.cust_id JOIN order_items oi ON o.order_id = oi.order_id JOIN ADD_PRODUCT ap ON oi.product_id = ap.PROD_ID GROUP BY o.order_id ORDER BY o.order_id DESC";

$result = mysqli_query($conn, $sql_query);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<thead>";
    echo "<tr>
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
              <th>Total Price</th>
          </tr>";
    echo "</thead>";
    echo "<tbody>";
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
        echo "<td>" . $row["product_titles"] . "</td>"; 
        
        echo "<td>";
        $product_images = explode(",", $row["product_images"]); 
        foreach ($product_images as $image) {
            echo "<img src='$image' alt='Product Image' style='max-width: 100px; max-height: 100px;'>";
        }
        echo "</td>";
        echo "<td>" . $row["total_order_price"]."</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No orders found.</p>";
}

mysqli_close($conn);
?>


    <script src="products.js"></script>
    <script src="admin_main.js"></script>
    
</body>
</html>



        </div>
        
        
        <div id="add products">
        <form id="productForm" action="products.php" method="post" enctype="multipart/form-data"> 
    <label for="title">Product Title:</label>
    <input type="text" id="title" name="title" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea>

    <label for="category">Category:</label>
    <input type="text" id="category" name="category" required>

    <label for="tag">Tag (e.g., men or women or kids):</label>
    <input type="text" id="tag" name="tag" required>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" step="0.01" required>

    <label for="status">Status:</label>
    <select id="status" name="status">
        <option value="active">active</option>
        <option value="draft">draft</option>
    </select>

    <label for="image">Image:</label>
    <input type="file" id="image" name="image" accept="image/*" required>
    <div id="imagePreview" class="image-preview">
        <img src="#" alt="Image Preview">
    </div>

    <input type="submit" id="submitBtn" value="Add Product">
</form>
        </div>
        <div id="products">
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
        img {
            max-width: 80px;
            max-height: 80px;
        }
    </style>
</head>
<body>
    <h2>Products</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Category</th>
                <th>Tag</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'dbconnection.php'; 
            
           
            $sql_query = "SELECT TITLE, PRODUCT_IMG, CATEGORY, TAG, PRICE FROM ADD_PRODUCT ORDER BY PROD_ID DESC";
            $result = mysqli_query($conn, $sql_query);
            
            
            if (mysqli_num_rows($result) > 0) {
              
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["TITLE"] . "</td>";
                    echo "<td>";
                    $product_images = explode(",", $row["PRODUCT_IMG"]);
                    foreach ($product_images as $image) {
                        echo "<img src='$image' alt='Product Image'>";
                    }
                    echo "</td>";
                    echo "<td>" . $row["CATEGORY"] . "</td>";
                    echo "<td>" . $row["TAG"] . "</td>";
                    echo "<td>" . $row["PRICE"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No products found.</td></tr>";
            }

         
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</body>
</html>

       
      
</div>
<div id="customers">
       
        <?php

            include 'dbconnection.php';

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM customers";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                echo "<table>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Email</th>";
                echo "<th>Name</th>";
               
                echo "</tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["cust_id"] . "</td>";
                    echo "<td>" . $row["cust_email"] . "</td>";
                    echo "<td>" . $row["cust_name"] . "</td>";
                   
                    echo "</tr>";
                }

            
                echo "</table>";
            } else {
                echo "No customers found.";
            }
            $conn->close();
        ?>

        </div>
    </div>

    <script>
    
        function showContent(sectionId) {
           
            var contentSections = document.querySelectorAll('.content > div');
            contentSections.forEach(function(section) {
                section.style.display = 'none';
            });

            
            var selectedSection = document.getElementById(sectionId);
            selectedSection.style.display = 'block';
        }

        
        document.addEventListener('DOMContentLoaded', function() {
            showContent('orders');
        });
    </script>
    <script src="products.js"></script>
    <script src="admin_main.js"></script>
</body>
</html>