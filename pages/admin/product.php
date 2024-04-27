<?php 
require '../../actions/log.php';

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=store', 'mohammed', '1429015');

// Retrieve products and colors
$stmt = $pdo->query("SELECT * FROM product");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ride it - Product</title>
    <link rel="stylesheet" href="../../styles/admin/dashbord.css" />
    <link rel="stylesheet" href="../../styles/admin/productAdm.css" />
  </head>
  <body>
    <main>
      <section class="sideMenu">
        <img class="logo" src="../../media/rideit.png" alt="logo" />
        <nav>
          <ul>
            <li><a href="./dashbord.php">Dashbord</a></li>
            <li><a class="selected" href="./product.php">Products</a></li>
            <li><a href="./messages.php">Messages</a></li>
            <li><a href="./account.php">Members</a></li>
            <li>Orders</li>
          </ul>
        </nav>
        <section class="user-info">
          <img width="50px" src="../../media/userBlueBack.png" alt="profile icon" />
          <div style="margin-left: 23px">
            <p><?php echo $_SESSION['name'] ?></p>
            <p><?php echo ($_SESSION['account_type'] == 1) ? "Admin" : "User"; ?></p>

          </div>
          <a class="logout-icon" href="../../actions/logout.php">
          <img height="35px" src="../../media/logout.png" alt="logout icon"/>
          </a>
        </section>
      </section>
      <section class="content">
        <header>
          <h1 class="welcome-text">Products</h1>
        </header>

        <section style="flex-wrap: wrap" class="main-container">
            <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                <a class="addItemsBtn" href="./addProduct.php">
                    <button class="addItemsBtn">Add Item</button>
                </a>
                <button id="toggle-view">Toggle View</button>
            </div>
            <div id="product-container">
                <!-- Products will be displayed here -->
            </div>
        </section>
    </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleViewButton = document.getElementById('toggle-view');
            const productContainer = document.getElementById('product-container');


            renderTableView();

            toggleViewButton.addEventListener('click', function () {
                if (productContainer.classList.contains('list-view')) {
                    // Switch to table view
                    productContainer.classList.remove('list-view');
                    renderTableView();
                } else {
                    // Switch to list view
                    productContainer.classList.add('list-view');
                    renderListView();
                }
            });

            // Function to render table view
            // Function to render table view
function renderTableView() {
    productContainer.innerHTML = `<table><thead><tr><th>Image</th><th>Name</th><th>Quantity</th><th>Colour</th><th>Price</th><th>SKU</th><th>Status</th><th>Action</th></tr></thead><tbody><?php
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=store', 'mohammed', '1429015');

        // Retrieve products and colors
        $stmt = $pdo->query("SELECT * FROM product");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            // Extract product details
            $productId = $row['product_id'];
            $productName = $row['name'];
            $quantity = $row['quantity'];
            $colour = $row['colour'];
            $price = $row['price'];
            $SKU = $row['SKU'];
            $status = ($row['status_id'] == 0) ? 'Active' : 'Archive';
            $imageData = base64_encode($row['image']);

            // Echo table row with dynamic data
            echo '<tr><td style="text-align: center;"><img width="150px" height="100px"  src="data:image/jpeg;base64,' . $imageData . '" alt=""/></td><td>' . $productName . '</td><td>' . $quantity . '</td><td>' . $colour . '</td><td>' . $price . '</td><td>' . $SKU . '</td><td>' . $status . '</td><td style="text-align: center;" class="action-buttons"><button class="editBtn" data-id="' . $productId . '">Edit</button><form method="post" action="../../actions/deleteProduct.php"><input type="hidden" name="product_id" value="' . $productId . '"><button style="background: #ff5c5c;" type="submit" name="delete">Delete</button></form></td></tr>';
        }
    ?></tbody></table>`;

    // Add event listeners to edit buttons
    const editButtons = document.querySelectorAll('.editBtn');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            editProduct(productId);
        });
    });

    // Add event listeners to delete buttons
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            deleteProduct(productId);
        });
    });
}


            // Function to render list view
         // Function to render list view
function renderListView() {
    productContainer.innerHTML = '<?php
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=store', 'mohammed', '1429015');

        // Retrieve products and colors
        $stmt = $pdo->query("SELECT * FROM product");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            // Extract product details
            $productId = $row['product_id'];
            $productName = $row['name'];
            $quantity = $row['quantity'];
            $colour = $row['colour'];
            $price = $row['price'];
            $SKU = $row['SKU'];
            $status = ($row['status_id'] == 0) ? 'Active' : 'Archive';
            $imageData = base64_encode($row['image']);

            // Echo list item with dynamic data
            echo '<section class="product"><img width="150px" height="100px" src="data:image/jpeg;base64,' . $imageData . '" alt=""/><section><div><h2 style="margin-bottom: 0">' . $productName . '</h2><div class="product-details"><ul><li>IN-STOCK: ' . $quantity . '</li><li>COLOUR: ' . $colour . '</li><li>SKU: ' . $SKU . '</li></ul><ul><li>Price: £' . $price . '</li><li>Status: ' . $status . '</li><li>Total Orders: 55</li></ul></div></div></section><div style="position: relative; top: 15px"><button style="background: #2196F3" class="editBtn" data-id="' . $productId . '">Edit</button><form method="post" action="../../actions/deleteProduct.php"><input type="hidden" name="product_id" value="' . $productId . '"><button type="submit" name="delete">Delete</button></form></div></section>';
        }
    ?>';

    // Add event listeners to edit buttons
    const editButtons = document.querySelectorAll('.editBtn');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            editProduct(productId);
        });
    });

    // Add event listeners to delete buttons
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            deleteProduct(productId);
        });
    });
}

        });
        function editProduct(productId) {
    // Log the URL to ensure productId is correctly passed as a parameter
    console.log(`Editing product with ID: ${productId}`);
    
    // Redirect to the edit product page with the product ID as a URL parameter
    window.location.href = `./addProduct.php?edit=${productId}`;
}


// Add event listeners after the DOM content is loaded
document.addEventListener('DOMContentLoaded', function () {
    // Your existing code here...

    // Inside the renderListView function, attach event listeners to edit buttons
    const editButtons = document.querySelectorAll('.editBtn');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            editProduct(productId);
        });
    });
  })
    </script>
  </body>
</html>


