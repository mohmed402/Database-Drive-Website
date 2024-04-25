<?php
require '../../actions/log.php';

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=store', 'mohammed', '1429015');
$stmtColour = $pdo->query("SELECT * FROM colour");
$colourRows = $stmtColour->fetchAll(PDO::FETCH_ASSOC);

// Debugging

// Check if the productId parameter is set in the URL
if(isset($_GET['edit'])) {
  $productId = $_GET['edit'];
  
  // Log the retrieved product ID to ensure it's correct
  echo "<script>console.log('Product ID: $productId');</script>";
  
  // Fetch the product details from the database based on the productId
  $stmt = $pdo->prepare("SELECT * FROM product WHERE product_id = ?");
  $stmt->execute([$productId]);
  $product = $stmt->fetch(PDO::FETCH_ASSOC);
  
  // echo "<script>console.log('" . 'data:image/jpeg;base64,' . base64_encode($product['image']) . "' );</script>";

    // Populate the input fields with the fetched product details
    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", function() {';
    echo 'document.getElementById("name").value = "' . $product['name'] . '";';
    echo 'document.getElementById("SKU").value = "' . $product['SKU'] . '";';
    echo 'document.getElementById("quantity").value = "' . $product['quantity'] . '";';
    echo 'document.getElementById("description").value = "' . $product['description'] . '";';
    echo 'document.getElementById("colour").value = "' . $product['colour'] . '";';
    echo 'document.getElementById("price").value = "' . $product['price'] . '";';
    echo 'document.getElementById("status").value = "' . $product['status_id'] . '";';
    // Set the previewImage src to display the product image
    echo 'document.getElementById("previewImage").src = "data:image/jpeg;base64,' . base64_encode($product['image']) . '";';
    echo '});';
    echo '</script>';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="../../styles/admin/addProduct.css">
  
</head>
<body class="background">

    <main style="padding: 12px;">
      <section class="container">
        <h1
          style="
            margin: 15px;
            margin-top: 40px;
            display: block;
            position: relative;
            left: 40px;
          "
        >
          New Product
        </h1>

        <section class="content-1">
          <label for="file" class="custum-file-upload">
            <section class="icon">
              <svg
                viewBox="0 0 24 24"
                fill=""
                xmlns="http://www.w3.org/2000/svg"
              >
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g
                  id="SVGRepo_tracerCarrier"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                ></g>
                <g id="SVGRepo_iconCarrier">
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                    fill=""
                  ></path>
                </g>
              </svg>
            </section>
            <section class="text">
              <span>Click to upload image</span>
            </section>
          </label>
          <!-- <form method="post" action="addProduct.php"> -->
          <img src="#" alt="Preview" id="previewImage" style="max-width: 300px; max-height: 300px; display:none">


          <form method="post" enctype="multipart/form-data" action="../../actions/addProducts.php">
          <input type="hidden" name="action" id="action" value="<?php echo isset($productId) ? 'update' : 'add'; ?>">

            <input style="display: none" type="file" id="file" name="image" accept="image/*">
            <label class="labelTag" for="name"
              ><div class="line-corve"></div>
              Name</label
            >
            <input type="text" name="name" id="name" />

            <fieldset class="display: flex; border: 0; padding: 6px 0;">
              <div>
                <label style="width: 170px" class="labelTag" for="SKU"
                  ><div class="line-corve"></div>
                  SKU</label
                >
                <input style="width: 162px" type="number" name="SKU" id="SKU" />
              </div>
              <div>
                <label style="width: 145px" class="labelTag" for="quantity"
                  ><div class="line-corve"></div>
                  Quantity</label
                >
                <input
                  style="width: 137px"
                  type="number"
                  name="quantity"
                  id="quantity"
                />
              </div>
            </fieldset>
            <label class="labelTag" for="description"
              ><div class="line-corve"></div>
              Description</label
            >
            <textarea
              id="description"
              name="description"
              rows="5"
              cols="50"
              style="
                height: 108px;
                width: 330px;
                position: relative;
                left: 9px;
                resize: none;
              "
            ></textarea>

            <section class="content-2">
              <label class="labelTag" for="colour"
                ><div class="line-corve"></div>
                Colour</label
              >
              <select name="colour" id="colour">
              <?php
                foreach ($colourRows as $rowColour) {
                    echo "<option value='red' class='". $rowColour['colour_id']."'> ".($rowColour['name'])." </option>";
                } ?>
              </select>

              <label class="labelTag" for="price"
                ><div class="line-corve"></div>
                Price</label
              >
              <input type="text" name="price" id="price" />

              <label class="labelTag" for="statusId"
                ><div class="line-corve"></div>
                Status</label
              >
              <select name="statusId" id="status">
                <option value="0">Active</option>
                <option value="1">Archive</option>
              </select>

              <div class="buttonsSec">
                <a href="./product.php">Cancel</a>
                <button
                  type="submit"
                  value="Submit"
                  style="background: #2196f3; color: aliceblue"
                >
                  Save
                </button>
              </div>
            </section>
          </form>
        </section>
      </section>
    </main>
    <script>
    // Get references to the file input and image elements
    const fileInput = document.getElementById('file');
    const previewImage = document.getElementById('previewImage');

    // Add an event listener to the file input element
    fileInput.addEventListener('change', function(event) {
      // Get the selected file from the input element
      const file = event.target.files[0];

      // Check if a file was selected
      if (file) {
        // Create a FileReader object
        const reader = new FileReader();
        previewImage.style.display= "inline-block";
        // Set up the FileReader onload event handler
        reader.onload = function(e) {
          // Set the src attribute of the image element with the data URL of the selected file
          previewImage.src = e.target.result;
        };

        // Read the selected file as a data URL
        reader.readAsDataURL(file);
      } else {
        // If no file was selected, reset the image source
        previewImage.src = '#';
      }
    });

    function editProduct(productId) {
    // Redirect to the edit product page with the product ID as a URL parameter
    window.location.href = `./addProduct.php?edit=${productId}`;
}

  </script>

</body>
</html>
