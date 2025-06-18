<?php
// Assuming you have a database connection established already
include 'dbconnection.php';
echo '<link rel="stylesheet" href="productview.css">';
echo '<style>

    body{
        padding-top: 80px;
    }
    .product a {
        text-decoration: none; /* Remove underline */
        color: inherit; /* Inherit color from parent */
        cursor: pointer; /* Change cursor to pointer on hover */
    }
</style>';

if (isset($_GET['query'])) {
    

    $searchQuery = $_GET['query'];

   
    $sql = "SELECT * FROM ADD_PRODUCT WHERE TITLE LIKE '%$searchQuery%' OR CATEGORY LIKE '%$searchQuery%' OR TAG LIKE '%$searchQuery%'";


   
    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
       
        echo '<div class="product-grid">';

       
        while ($row = $result->fetch_assoc()) {
            
            $title = $row['TITLE'];
            $image = $row['PRODUCT_IMG'];
            $tag = $row['TAG'];
            $category = $row['CATEGORY'];
            $price = $row['PRICE'];
            $product_id = $row['PROD_ID'];

           
            echo '<body>';
            echo '<div class="product">';
            echo "<a href='product_detail.php?id=$product_id'>";
            echo "<img src='$image' alt='$title'>";
            echo "<div class='product-info'>";
            echo "<h3>$title</h3>";
           
            echo "<p>$ $price</p>";
            echo '</div>'; 
            echo '</a>'; 
            echo '</div>'; 
            echo '</body>';
        }

      
        echo '</div>'; 
    } else {
   
        echo "No products found.";
    }
} else {
    
    echo "No search query provided.";
}


$conn->close();
?>
