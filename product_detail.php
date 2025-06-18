<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
   
    <link rel="stylesheet" href="main1.css"> 
</head>
<body>


<nav>
            <ul class="nav_links">
                <li><a><img class="logo" src="Images/Logo.png" id="logo"></a></li>
                <li><a href="#" id="men">MEN</a></li>
                <li><a href="#" id="women">WOMEN</a></li>
                <li><a href="#" id="kids">KIDS</a></li>
                <li style="float:right"><a href="#" id="cart">My Cart</a></li>
                
                <?php
                    session_start(); 
                    if (isset($_SESSION['username'])) {
                        echo'<li style="float:right"><a href="logout.php">Logout</a></li>';
                        echo "<h2 style='color: red; font-size: 12px;'>Hello, " . $_SESSION['username'] . "!</h2>";


                    } else {
                        echo'<li style="float:right"><a href="register.html">Signup</a></li>';
                        echo'<li style="float:right"><a href="login.html">Login</a></li>';
                    }
                ?>
                
                <div style="float:right; margin-left: 10px;">
                    <input type="text" id="searchInput" placeholder="Search">
                    <button id="searchButton">Search</button>
                </div>
            </ul>
        </nav>
        <script>
               document.getElementById("searchButton").addEventListener("click", function() {
   
    document.getElementById("content-area").style.display = "none";

 
    var searchQuery = document.getElementById("searchInput").value;

   
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "search.php?query=" + encodeURIComponent(searchQuery), true);
    xhr.onload = function() {
        if (xhr.status == 200) {
         
            document.getElementById("searchResults").innerHTML = xhr.responseText;
        } else {
            console.error('Error:', xhr.statusText);
        }
    };
    xhr.onerror = function() {
        console.error('Request failed.');
    };
    xhr.send();
});

   
    function loadContent(page) {
        
        fetch(page)
            .then(response => response.text())
            .then(data => {

                document.getElementById('content-area').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

  
    var menLink = document.getElementById('men');
    var womenLink = document.getElementById('women');
    var kidsLink = document.getElementById('kids');
    var cartLink =document.getElementById('cart');


    menLink.addEventListener('click', function(event) {
        event.preventDefault(); 
    
        loadContent('fetchproducts.php');
    });

    womenLink.addEventListener('click', function(event) {
        event.preventDefault(); 
     
        loadContent('women.php');
    });

    kidsLink.addEventListener('click', function(event) {
        event.preventDefault(); 
      
        loadContent('kids.php');
    });

    cartLink.addEventListener('click', function(event) {
        event.preventDefault(); 

        loadContent('cart.php');
    });
    
   

  
</script>



<div id="content-area">
    <?php
    include 'dbconnection.php';

    if(isset($_GET['id'])) {
        $productId = $_GET['id'];


        $sql = "SELECT * FROM ADD_PRODUCT WHERE PROD_ID = '$productId'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            $title = $row['TITLE'];
            $image = $row['PRODUCT_IMG'];
            $tag = $row['TAG'];
            $category = $row['CATEGORY'];
            $price = $row['PRICE'];
            $desc = $row['DESCRIPTION'];
        
            
      echo"<div class='container'>";
      echo"<div class='image'>";
      echo"<img src='$image'  alt='$title'>";
      echo"</div>";
      echo"<div class='text'>";
      echo"<h2> $title </h2>";
      echo"<p><small>$desc</small></p>";
      echo"<p><Strong>$ $price</strong></p>";
      
      echo '<form id="add-to-cart-form">';
      echo '    <input type="hidden" id="product_id" name="product_id" value="' . $productId . '">';
      echo '    <button type="button" id="add-to-cart-button">Add to Cart</button>';
      echo '</form>';

      echo"</div>";
    echo"</div>";
    
           
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Product ID not specified.";
    }
    

    mysqli_close($conn);
    ?>
</div>

<script>
     document.getElementById('add-to-cart-button').addEventListener('click', function() {
            var productId = document.getElementById('product_id').value;

            var isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;
    if (!isLoggedIn) {
        alert('Please login to add the product to your cart.');
        return;
    }

            addToCart(productId);
        });

        function addToCart(productId) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'add_to_cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert('Product added to cart!');
                }
            };
            xhr.send('product_id=' + productId);
        }
        function removeProductIdFromUrl(newUrl) {
 
        var currentUrl = window.location.href;

        if (new URL(newUrl).origin === window.location.origin) {
        
            if (currentUrl.includes("?id=")) {

                var newUrlWithoutProductId = currentUrl.split("?id=")[0];

                window.history.replaceState(null, null, newUrlWithoutProductId);
            }
        }
    }
    removeProductIdFromUrl('product_detail.php');
</script>

<style>
    body {
    margin: 0;
    padding: 0;
    background: none; 
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    transition: background-image 1s ease;
}
    img {
    max-width: 500px; 
    max-height: 500px;  
}
#content {
    padding-top: 80px; 
}
.container {
    padding-top: 70px;
 display: grid;
 align-items: top; 
 grid-template-columns: 1fr 5fr 1fr;
 column-gap: 100px;
 padding-left: 200px
}


.text {
  font-size: 30px;
}
.text small {
  font-size: 20px; 
 
}
</style>
<div id="searchResults"></div>
<div id="content-area"></div> 
<script src="main.js"></script>
</body>
</html>

