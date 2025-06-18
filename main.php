<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trends</title>
    <link rel="stylesheet" href="main1.css">
    <style>
        
        #cookies-banner {
    background-color: #f0f0f0;
    color: #333;
    padding: 20px;
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
    z-index: 9999;
    display: flex; 
    justify-content: center; 
    align-items: center; 
}

#cookies-banner button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
    margin: 0 10px; 
}
    </style>
</head>
<body>
    <header>
        
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
                        echo'<li style="float:right"><a href="login.html">Login</a></li>';
                        echo'<li style="float:right"><a href="register.html">Signup</a></li>';
                        
                    }
                ?>
                
                <div style="float:right; margin-left: 10px;">
                    <input type="text" id="searchInput" placeholder="Search">
                    <button id="searchButton">Search</button>
                </div>
            </ul>
        </nav>
        <div id="cookies-banner">
        <p>This website uses cookies to ensure you get the best experience on our website.</p>
        <button id="accept-cookies">Accept</button>
        <button id="reject-cookies">Reject</button>
    </div>
        <script>
    document.getElementById("searchButton").addEventListener("click", function() {
    // Hide the content-area when search is performed
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
    document.getElementById('searchResults').innerHTML = ''; // Clear search results
    document.getElementById('content-area').style.display = "block"; // Make sure content-area is visible
    fetch(page)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            document.getElementById('content-area').innerHTML = data; // Load new content
        })
        .catch(error => {
            console.error('Error loading content:', error);
        });
}
function clearSearchResults() {
    document.getElementById('searchResults').innerHTML = '';
}

            var searchlink =document.getElementById('searchInput');
            var menLink = document.getElementById('men');
            var womenLink = document.getElementById('women');
            var kidsLink = document.getElementById('kids');
            var cartLink = document.getElementById('cart');
            menLink.addEventListener('click', function(event) {
    event.preventDefault();
    clearSearchResults(); // Clear search results before loading new content
    loadContent('fetchproducts.php');
});

womenLink.addEventListener('click', function(event) {
    event.preventDefault(); 
    clearSearchResults(); 
    loadContent('women.php');
});

kidsLink.addEventListener('click', function(event) {
    event.preventDefault(); 
    clearSearchResults();
    loadContent('kids.php');
});

cartLink.addEventListener('click', function(event) {
    event.preventDefault(); 
    clearSearchResults(); 
    loadContent('cart.php');
});

            window.onload = function() {
                loadContent('landingpage.html');
                var cookiesAccepted = localStorage.getItem('cookiesAccepted');
            if (!cookiesAccepted) {
               
                document.getElementById('cookies-banner').style.display = 'block';
            }
            };
        
        document.getElementById('accept-cookies').addEventListener('click', function() {
           
            localStorage.setItem('cookiesAccepted', true);

            document.getElementById('cookies-banner').style.display = 'none';
        });

        document.getElementById('reject-cookies').addEventListener('click', function() {
            localStorage.setItem("cookiesPreference", "rejected");
            hideBanner();
        });
        function hideBanner() {
                document.getElementById("cookies-banner").style.display = "none";
            }
        </script>
    </header>
    <div id="searchResults"></div>
    <div id="content-area"></div> 
    
    <script src="main.js"></script>
</body>
</html>
