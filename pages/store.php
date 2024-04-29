<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=store', 'mohammed', '1429015');

// Retrieve product details from the database
$stmt = $pdo->query("SELECT * FROM product");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../styles/homeStyle.css" />
    <link rel="stylesheet" href="../styles/storeStyle.css" />
  </head>
  <body>
  <header style="background-color: white;">
      <a href="#main" class="skip">Skip to main content</a>
      <img
        onclick="menuHandler()"
        class="menu-icon"
        src="../media/menu.png"
        alt="menu icon"
      />

      <img class="logo" src="../media/rideitWhite.png" alt="ride-it logo" />
      <div id="myLinks">
        <a href="./index.html">Home</a>
        <a href="./store.php">Store</a>
        <a href="./contactus.html">Contact</a>
        <a href="./admin/dashbord.php">Account</a>
      </div>

      <nav class="nav-bar">
      <ul style="background-color: #c0dfe8;">
          <li><a href="./index.html">Home</a></li>
          <li><a href="./store.php">Store</a></li>
          <li><a href="./contactus.html">Contact</a></li>
          <li><a href="./admin/dashbord.php">Account</a></li>
        </ul>
      </nav>
   
    </header>
    <main>

  
    <section class="product-list">
    <?php
foreach ($products as $product) {
    $imageData = base64_encode($product['image']); // Fetching image data from the current product
    if ($product['status_id'] == "0"){
      echo '<section class="product">
          <img width="300px" src="data:image/jpeg;base64,' . $imageData . '" alt="" /> 
          <hr class="product-line" />
          <section class="product-details">
            <div>
              <h1>' . htmlspecialchars($product['name']) . '</h1>
              <p>' .htmlspecialchars($product['description']) . '</p>
            </div>
            <div class="product-info">
              <div class="colourSetter" style="background-color: ' . htmlspecialchars($product['colour']) . ';" ></div>
              <p class="color">Colour: ' . htmlspecialchars($product['colour']) . '</p>
              <p class="price">£' . htmlspecialchars($product['price']) . '</p>
            </div>
            <button class="addToCartBtn">ADD TO CART</button>
          </section>
        </section>';
    }
}
?>
    </section>
    </main>
    <footer class="site-footer">
      <section class="footer-about">
        <h3>ride it</h3>
        <p>Experience the ultimate in urban mobility with our Electric
          Self-Balancing Scooter.</p>
      </section>

      <nav class="footer-links">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="../index.html">Home</a></li>
          <li><a href="./admin/dashbord.php">Account</a></li>
          <li><a href="./store.php">Store</a></li>
          <li><a href="./contactus.html">Contact</a></li>
        </ul>
      </nav>

      <section class="footer-contact">
        <h3>Contact Us</h3>
        <address>
          <p>(123) 456-7890</p>
          <a href="mailto:info@rideit.com">info@rideit.com</a>
        </address>
      </section>
    </footer>
    <script>
      function menuHandler() {
        let navBar = document.getElementById("myLinks");
        if (navBar.style.display === "flex") {
          navBar.style.display = "none";
        } else {
          navBar.style.display = "flex";
        }
      }
    </script>
  </body>
</html>
