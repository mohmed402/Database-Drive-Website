<?php
// Establish database connection
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=store', 'mohammed', '1429015');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error reporting

// Check if product ID is received
if (isset($_POST['product_id'])) {
    // Retrieve product ID
    $productId = $_POST['product_id'];

    try {
        // Construct SQL query to delete product
        $query = "DELETE FROM product WHERE product_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$productId]);

        // Redirect back to product page after deletion
        header("Location: ../pages/admin/product.php");
        exit();
    } catch (PDOException $e) {
        // Error occurred while executing SQL query
        echo 'Error deleting product: ' . $e->getMessage();
    }
} else {
    // Product ID not received
    echo 'Product ID not provided.';
}
?>
