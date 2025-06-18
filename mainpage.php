
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Changing Background</title>
<style>
  body {
    margin: 0;
    padding: 0;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    transition: background-image 1s ease;
  }
</style>
</head>
<body>
<script>
 
  var backgrounds = [
    'https://thehouseofrare.com/cdn/shop/files/awaken-_desktop_1900x.jpg?v=1710846274',
    'https://thehouseofrare.com/cdn/shop/files/shirts_9e6ed4e8-b38a-4e32-90e4-55aacf3ecb5f.jpg?v=1706105607',
    'https://thehouseofrare.com/cdn/shop/files/static_banner_landing_page_5caaaec4-4543-46d1-a553-c276c290fb5d.jpg?v=1712062529',
    'https://thehouseofrare.com/cdn/shop/files/1st_banner_-_tshirt_ae1f7ed3-5ae5-422a-b748-fa1e40ff5a54.png?v=1709899467'
  ];


  function changeBackground() {
    var randomIndex = Math.floor(Math.random() * backgrounds.length);
    document.body.style.backgroundImage = 'url(' + backgrounds[randomIndex] + ')';
  }


  changeBackground();

  setInterval(changeBackground, 5000);
</script>
</body>
</html>