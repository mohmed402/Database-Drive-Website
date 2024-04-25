<?php

echo "<script>console.log('lodaing');</script>";
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=store', 'mohammed', '1429015');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form is submitted
    echo '<script>console.log("' . $_POST['action']. '");</script>';
    echo '<script>alert("Please");</script>';


    if(isset($_POST['action'])) {
        // Check if the action is for adding a new product
        if ($_POST['action'] == 'add') {
            // Check if an image was uploaded
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Retrieve image data
                $imageData = file_get_contents($_FILES['image']['tmp_name']);
                // Escape special characters to prevent SQL injection
                $name = htmlspecialchars($_POST['name']);
                $SKU = intval($_POST['SKU']);
                $quantity = intval($_POST['quantity']);
                $description = htmlspecialchars($_POST['description']);
                $colour = htmlspecialchars($_POST['colour']);
                $price = floatval($_POST['price']);
                $statusId = intval($_POST['statusId']);

                // Prepare and execute the INSERT query
                $stmt = $pdo->prepare("INSERT INTO `product` (`name`, `SKU`, `price`, `quantity`, `colour`, `status_id`, `description`, `image`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $result = $stmt->execute([$name, $SKU, $price, $quantity, $colour, $statusId, $description, $imageData]);

                // Check if the insertion was successful
                if ($result) {
                    header("Location: ../pages/admin/product.php");
                    exit();
                } else {
                    echo "Error: Unable to insert data into the database.";
                }
            } else {
                // Display an error message if no image was uploaded
                echo "Error: No image uploaded.";
            }
        } elseif ($_POST['action'] == 'update') {
           echo "<script>console.log('updating');</script>";

            // Retrieve product details from the form
            $productId = intval($_POST['productId']);
            $name = htmlspecialchars($_POST['name']);
            $SKU = intval($_POST['SKU']);
            $quantity = intval($_POST['quantity']);
            $description = htmlspecialchars($_POST['description']);
            $colour = htmlspecialchars($_POST['colour']);
            $price = intval($_POST['price']);
            $statusId = intval($_POST['statusId']);
            echo '<script>alert("' . $quantity. '");</script>';

        
            // Check if an image was uploaded
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Retrieve image data
                $imageData = file_get_contents($_FILES['image']['tmp_name']);
        
                // Prepare and execute the UPDATE query with the image
                $stmt = $pdo->prepare("UPDATE `product` SET `name` = ?, `SKU` = ?, `price` = ?, `quantity` = ?, `colour` = ?, `status_id` = ?, `description` = ?, `image` = ? WHERE `product_id` = ?");


                $result = $stmt->execute([$name, $SKU, $price, $quantity, $colour, $statusId, $description, $imageData, $productId]);
            } else {
                // Prepare and execute the UPDATE query without updating the image
                
                $stmt = $pdo->prepare("UPDATE `product` SET `name` = ?, `SKU` = ?, `price` = ?, `quantity` = ?, `colour` = ?, `status_id` = ?, `description` = ? WHERE `product_id` = ?");

                $result = $stmt->execute([$name, $SKU, $price, $quantity, $colour, $statusId, $description, $productId]);

                echo '<script>console.log("' . gettype($SKU). '");</script>';
            }

                
            if ($result) {

                header("Location: ../pages/admin/product.php");
                echo '<script>console.log("' . $quantity. '");</script>';



                exit();
            } else {
                // Display an error message if update failed
                echo "Error: Unable to update data in the database.";
            }
        }
        
    }
}

?>
