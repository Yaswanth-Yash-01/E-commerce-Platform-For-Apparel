<?php
include 'dbconnection.php';

$sql = "SELECT PROD_ID, TITLE, PRODUCT_IMG, TAG, CATEGORY, PRICE FROM ADD_PRODUCT WHERE TAG='Women' ORDER BY PROD_ID DESC";
$result = mysqli_query($conn, $sql);

echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<title>Trends</title>';
echo '<link rel="stylesheet" href="productview.css">';
echo '</head>';
echo '<style>
body {
    margin: 0;
    padding: 0;
    
    background-repeat: no-repeat;
    background-position: center;
    transition: background-image 1s ease;
  }
    .product a {
        text-decoration: none; /* Remove underline */
        color: inherit; /* Inherit color from parent */
        cursor: pointer; /* Change cursor to pointer on hover */
    }
</style>';
echo '<body>';

if (mysqli_num_rows($result) > 0) {
    echo '<div class="product-grid">';
    
    while($row = mysqli_fetch_assoc($result)) {
        $title = $row['TITLE'];
        $image = $row['PRODUCT_IMG'];
        $tag = $row['TAG'];
        $category = $row['CATEGORY'];
        $price = $row['PRICE'];
        $product_id = $row['PROD_ID'];
        echo '<div class="product">';
        echo "<a href='product_detail.php?id=$product_id'>";
        echo "<img src='$image' alt='$title'>";
        echo "<div class='product-info'>";
        echo "<h3>$title</h3>";
        echo "<p>Category: $category</p>";
    
        echo "<p>$ $price</p>";
        echo '</div>'; 
        echo '</div>'; 
    }

    echo '</div>'; 
} else {
    echo "No products found.";
}

echo '</body>';
echo '</html>';

mysqli_close($conn);
?>
