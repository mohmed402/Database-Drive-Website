<?php
session_start();

$login_error = ""; // Initialize login error variable

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Establish database connection
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=store', 'mohammed', '1429015');

    // Prepare and execute the SELECT query to fetch the user with the provided email
    $stmt = $pdo->prepare("SELECT * FROM account WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists
    if ($user) {

        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $user['account_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['account_type'] = $user['account_type'];
            $_SESSION['name'] = $user['firstName'] . ' ' . $user['lastName'];


            

            header("Location: ../admin/dashbord.php");
            exit();
        } else {

            $login_error = "Invalid email or password.";
        }
    } else {

        $login_error = "Invalid email or password.";
    }
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="../../styles/account/login.css" />
   
</head>
<body>
    <div class="form-container">
        <p class="title">Login</p>
        <?php if(!empty($login_error)) { ?>
            <p style="color: red;"><?php echo $login_error; ?></p>
        <?php } ?>
    
        <form class="form" method="post" action="">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" />
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input
                type="password"
                name="password"
                id="password"
                placeholder="Password"
                />
                <div class="forgot">
                <a rel="noopener noreferrer" href="../admin/dashbord.php"
                    >Forgot Password ?
                </a>

                </div>
            </div>
            <button type="submit" class="sign">Login</button>
        </form>

        <p class="signup">
            Don't have an account?
            <a rel="noopener noreferrer" href="./signup.html" class="">Sign up</a>
          </p>
          <p style="margin-top: 0;" class="signup">  Return to  <a class="return" href="../index.html"> home page </a>.</p> 

    </div>
</body>
</html>
