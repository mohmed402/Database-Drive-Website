<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=store', 'mohammed', '1429015');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare SQL statement
    $sql = "INSERT INTO contactUs (name, email, message) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    // Execute the statement
    $result = $stmt->execute([$name, $email, $message]);

    if ($result) {
        // Redirect after successful insertion
        header("Location: ../pages/contactus.html");
        exit();
    } else {
        // Display an error message if insertion failed
        echo "Error: Unable to insert data into the database.";
    }
}
?>
