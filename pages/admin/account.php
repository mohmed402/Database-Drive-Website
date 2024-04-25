<?php
require '../../actions/log.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Account</title>
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
            <li><a href="./product.php">Products</a></li>
            <li><a href="./messages.php">Messages</a></li>
            <li><a class="selected" href="./account.php">Members</a></li>            
            <li>Orders</li>
            <!-- manage member accounts -->
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
          <h1 class="welcome-text">User accounts</h1>
        </header>
        <section style="margin: auto;" id="product-container">
        <table><thead><tr><th>ID</th><th>Email</th><th>First Name</th><th>Last Name</th><th>Account type</th></tr></thead><tbody><?php
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=store', 'mohammed', '1429015');

        // Retrieve products and colors
        $stmt = $pdo->query("SELECT * FROM account");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            // Extract product details
            $accountId = $row['account_id'];
            $email = $row['email'];
            $fName = $row['firstName'];
            $lName = $row['lastName'];
            $accountType = ($row['account_type'] == 0) ? 'Customer' : 'Admin';
           

            // Echo table row with dynamic data
            echo '<tr><td>' . $accountId . '</td><td>' . $email . '</td><td>' . $fName . '</td><td>' . $lName . '</td><td>' . $accountType . '</td></tr>';
        }
    ?></tbody></table>
            </section>
      </section>
    </main>
    
</body>
</html>