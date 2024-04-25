<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $accountType = $_POST['account_type'];

    // Generate a random salt
    $salt = bin2hex(random_bytes(16));
    

    // Hash the password using bcrypt algorithm
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['salt' => $salt]);

    // echo "<script>alert('".$hashedPassword."');</script>";
    
        // Establish database connection
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=store', 'mohammed', '1429015');

        // Prepare and execute the INSERT query
    $stmt = $pdo->prepare("INSERT INTO account (`email`, `password`, `account_type`, `firstName`, `lastName`, `salt`) VALUES (?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute([$email, $hashedPassword, $accountType, $firstname, $lastname, $salt]);
    
    // $result = TRUE;
    // Check if the insertion was successful
    if ($result) {
        // Redirect or display success message
        header("Location: ../pages/account/login.php");

        exit();
    } else {
        // Display an error message if insertion failed
        echo "Error: Unable to register. Please try again.";
    }
}

?>
<?php
// Check if form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Retrieve form data
//     $firstname = $_POST['firstname'];
//     $lastname = $_POST['lastname'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $accountType = $_POST['account_type'];
//     $salt = bin2hex(random_bytes(8)); 


    
//     // Validate form data (e.g., check for empty fields, validate email format, etc.)

//     // Establish database connection
//     $pdo = new PDO('mysql:host=localhost;port=3306;dbname=store', 'mohammed', '1429015');

//     // Prepare and execute the INSERT query
//     $stmt = $pdo->prepare("INSERT INTO account (`email`, `password`, `account_type`, `firstName`, `lastName`, `salt`) VALUES (?, ?, ?, ?, ?, ?)");
//     $result = $stmt->execute([$email, $password, $accountType, $firstname, $lastname, $salt]);

//     // Check if the insertion was successful
//     if ($result) {
//         // Redirect or display success message
//         header("Location: ../pages/account/login.html");
//         exit();
//     } else {
//         // Display an error message if insertion failed
//         echo "Error: Unable to register. Please try again.";
//     }
// }
?>