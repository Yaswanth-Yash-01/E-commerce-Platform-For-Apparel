document.addEventListener('DOMContentLoaded', function() {
    
    const backgrounds = ['background1', 'background2', 'background3', 'background4'];
    let currentIndex = 0;

    setInterval(() => {
        document.body.classList.remove(backgrounds[currentIndex]);
        currentIndex = (currentIndex + 1) % backgrounds.length;
        document.body.classList.add(backgrounds[currentIndex]);
    }, 5000);

  
    function loadCategoryContent(category) {
      
        var url;
        switch (category) {
            case "MEN":
                url = "menshirts.html";
                break;
            case "WOMEN":
                url = "women.php";
                break;
            case "KIDS":
                url = "kids.php";
                break;
            default:
                return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Insert the fetched content into the container
                document.querySelector(".content").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }

    // Get all dropdown links
    var dropdownLinks = document.querySelectorAll(".dropdown a");

    // Add click event listener to each dropdown link
    dropdownLinks.forEach(function(link) {
        link.addEventListener("click", function(event) {
            event.preventDefault();
            var category = this.textContent;
            loadCategoryContent(category);
        });
    });

    // Attach click event listeners to category links
    var categoryLinks = document.querySelectorAll('.category-link');
    categoryLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var page = this.getAttribute('data-page');
            loadContent(page);
        });
    });

    // Function to load content from specified page
    function loadContent(page) {
        fetch(page)
            .then(response => response.text())
            .then(data => {
                // Inject fetched content into the content area
                document.getElementById('content-area').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
});
