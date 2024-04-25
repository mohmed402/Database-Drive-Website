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
      <img class="logo" src="../media/rideitWhite.png" alt="" />

      <nav class="nav-bar">
        <ul style="background-color: #c0dfe8;">
          <a href="./index.html"><li>Home</li></a>
          <a href="./store.php"><li>Store</li></a>
          <a href="./contactus.html"> <li>Contact</li></a>
          <a href="./admin/dashbord.php"><li>Account</li></a>
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
        <p>Short description about the company or website.</p>
      </section>

      <nav class="footer-links">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Contact</a></li>
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
  </body>
</html>
