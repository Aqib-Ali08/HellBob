<?php
require('../config/db.php');

$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $category = mysqli_real_escape_string($conn, $_POST["category"]);
    $productID = mysqli_real_escape_string($conn, $_POST["productID"]);
    $productName = mysqli_real_escape_string($conn, $_POST["productName"]);
    $productDescription = mysqli_real_escape_string($conn, $_POST["productDescription"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $dimensions = mysqli_real_escape_string($conn, $_POST["dimensions"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);


    $imageVariable1 = $_POST["imageVariable1"];
    $imageVariable2 = $_POST["imageVariable2"];
    $imageVariable3 = $_POST["imageVariable3"];
    $imageVariable4 = $_POST["imageVariable4"];
    // Insert data into 'products' table using prepared statement
    $products_sql = "INSERT INTO products (product_id, product_name, product_description, category, price, dimensions, status)
                     VALUES (?, ?, ?, ?, ?, ?, ?)";
    $products_stmt = $conn->prepare($products_sql);
    $products_stmt->bind_param("ssssdss", $productID, $productName, $productDescription, $category, $price, $dimensions, $status);

    if ($products_stmt->execute()) {
        // Insert successful, proceed to insert data into 'product_sizes' table
        foreach ($_POST["sizes"] as $size) {
            $quantity = $_POST["quantity"][$size];

            // Insert data into 'product_sizes' table using prepared statement
            $products_sizes_sql = "INSERT INTO product_sizes (product_id, size_name, quantity) VALUES (?, ?, ?)";
            $products_sizes_stmt = $conn->prepare($products_sizes_sql);
            $products_sizes_stmt->bind_param("ssi", $productID, $size, $quantity);

            if (!$products_sizes_stmt->execute()) {
                echo "Error inserting product sizes: " . $products_sizes_stmt->error;
            }

            $products_sizes_stmt->close();
        }

        $product_images_sql = "INSERT INTO product_images (product_id, image_path1,image_path2,image_path3,image_path4) VALUES (?, ?,?,?,?)";
        $product_images_stmt = $conn->prepare($product_images_sql);
        $product_images_stmt->bind_param("sssss", $productID, $imageVariable1,$imageVariable2,$imageVariable3,$imageVariable4);
        $product_images_stmt->execute();
        $product_images_stmt->close();

        // Set success message
        $successMessage = "Product information inserted successfully!";
    } else {
        echo "Error inserting product: " . $products_stmt->error;
    }

    $products_stmt->close();
    $conn->close();
}
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information Form</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="sucessmessage"><?php echo $successMessage;?></div>
    <form method="post">
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required><br>
        <label for="productID">Product ID:</label>
        <input type="text" id="productID" name="productID" required><br>

        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required><br>

        <label for="productDescription">Product Description:</label>
        <textarea id="productDescription" name="productDescription" rows="4" required></textarea><br>

        <label for="sizes">Sizes:</label>
        <select id="sizes" name="sizes[]" multiple>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
        </select><br>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity_S" name="quantity[S]" placeholder="S Quantity" required>
        <input type="number" id="quantity_M" name="quantity[M]" placeholder="M Quantity" required>
        <input type="number" id="quantity_L" name="quantity[L]" placeholder="L Quantity" required>
        <input type="number" id="quantity_XL" name="quantity[XL]" placeholder="XL Quantity" required>
        <input type="number" id="quantity_XXL" name="quantity[XXL]" placeholder="XXL Quantity" required><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required><br>

        <label for="dimensions">Dimensions:</label>
        <input type="text" id="dimensions" name="dimensions" required><br>

        <label for="imageVariable1">Image path 1:</label>
        <input type="text" id="imageVariable1" name="imageVariable1" required><br>

        <label for="imageVariable2">Image path 2:</label>
        <input type="text" id="imageVariable2" name="imageVariable2" required><br>

        <label for="imageVariable3">Image path 3:</label>
        <input type="text" id="imageVariable3" name="imageVariable3" required><br>

        <label for="imageVariable4">Image path 4:</label>
        <input type="text" id="imageVariable4" name="imageVariable4" required><br>


        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            <option value="Upcoming">Upcoming</option>
            <option value="expired">Expired</option>
        </select><br>
        <input type="submit" value="Submit">

    </form>

</body>

</html>