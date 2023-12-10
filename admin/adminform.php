<?php



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

    <form action="/Admin_submit_form" method="post">

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="productID">Product ID:</label>
        <input type="text" id="productID" name="productID" required><br>

        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required><br>

        <label for="productType">Product Type:</label>
        <input type="text" id="productType" name="productType" required><br>

        <label for="productDescription">Product Description:</label>
        <textarea id="productDescription" name="productDescription" rows="4" required></textarea><br>

        <label for="sizes">Sizes:</label>
        <select id="sizes" name="sizes[]" multiple>
            <option value="S">S</option>
            <option value="L">L</option>
            <option value="M">M</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
        </select><br>

        <label for="material">Material:</label>
        <input type="text" id="material" name="material" required><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br>

        <label for="dimensions">Dimensions:</label>
        <input type="text" id="dimensions" name="dimensions" required><br>

        <label for="supplier">Supplier:</label>
        <input type="text" id="supplier" name="supplier" required><br>

        <label for="purchaseDate">Purchase Date:</label>
        <input type="date" id="purchaseDate" name="purchaseDate" required><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*"><br>

        <label for="imageVariable1">Image path 1:</label>
        <input type="text" id="imageVariable1" name="imageVariable1" required><br>

        <label for="imageVariable2">Image path 2:</label>
        <input type="text" id="imageVariable2" name="imageVariable2" required><br>

        <label for="imageVariable3">Image path 3:</label>
        <input type="text" id="imageVariable3" name="imageVariable3" required><br>

        <label for="imageVariable4">Image path 4:</label>
        <input type="text" id="imageVariable4" name="imageVariable4" required><br>


        <label for="folderURL">Folder URL:</label>
        <input type="url" id="folderURL" name="folderURL" required><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            <option value="Upcoming">Upcoming</option>
            <option value="expired">Expired</option>
        </select><br>

        <label for="notes">Notes:</label>
        <textarea id="notes" name="notes" rows="4"></textarea><br>

        <input type="submit" value="Submit">

    </form>

</body>

</html>