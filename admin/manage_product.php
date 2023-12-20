<?php
require('./top.inc.php');
require('../connection.inc.php');
$msg = '';

if (isset($_POST['submit'])) {
    // Retrieve form data
    $categories_id = $_POST['categories_id'];
    $productID = $_POST['productID'];
    $name = $_POST['name'];
    $mrp = $_POST['mrp'];
    $price = $_POST['price'];
    $sizes = implode(',', $_POST['sizes']);
    $quantity_S = $_POST['quantity']['S'];
    $quantity_M = $_POST['quantity']['M'];
    $quantity_L = $_POST['quantity']['L'];
    $quantity_XL = $_POST['quantity']['XL'];
    $quantity_XXL = $_POST['quantity']['XXL'];
    // Handle image upload separately
    $image = ''; // Replace this with your image upload code
    $imageVariable1 = $_POST['imageVariable1'];
    $imageVariable2 = $_POST['imageVariable2'];
    $imageVariable3 = $_POST['imageVariable3'];
    $imageVariable4 = $_POST['imageVariable4'];
    $short_desc = $_POST['short_desc'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_desc = $_POST['meta_desc'];
    $meta_keyword = $_POST['meta_keyword'];

    // Sanitize inputs to prevent SQL injection
    $categories_id = mysqli_real_escape_string($con, $categories_id);
    $productID = mysqli_real_escape_string($con, $productID);
    $name = mysqli_real_escape_string($con, $name);
    $mrp = mysqli_real_escape_string($con, $mrp);
    $price = mysqli_real_escape_string($con, $price);
    // ... (sanitize other inputs similarly)

    if (!empty($_GET['id'])) {
        // Update existing product using prepared statement
        $product_id = $_GET['id'];
        $update_query = "UPDATE products SET 
            categories_id = ?,
            productID = ?,
            name = ?,
            mrp = ?,
            price = ?,
            sizes = ?,
            quantity_S = ?,
            quantity_M = ?,
            quantity_L = ?,
            quantity_XL = ?,
            quantity_XXL = ?,
            image = ?,
            imageVariable1 = ?,
            imageVariable2 = ?,
            imageVariable3 = ?,
            imageVariable4 = ?,
            short_desc = ?,
            description = ?,
            meta_title = ?,
            meta_desc = ?,
            meta_keyword = ?
            WHERE id = ?";

        $stmt = mysqli_prepare($con, $update_query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "isssssiiiiississssssi", $categories_id, $productID, $name, $mrp, $price, $sizes,
                $quantity_S, $quantity_M, $quantity_L, $quantity_XL, $quantity_XXL, $image,
                $imageVariable1, $imageVariable2, $imageVariable3, $imageVariable4,
                $short_desc, $description, $meta_title, $meta_desc, $meta_keyword, $product_id);

            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $msg = "Product updated successfully";
            } else {
                $msg = "Error updating product: " . mysqli_error($con);
            }

            mysqli_stmt_close($stmt);
        }
    } else {
        // Insert new product using prepared statement
        $insert_query = "INSERT INTO products (categories_id, productID, name, mrp, price, sizes, quantity_S, quantity_M, quantity_L, quantity_XL, quantity_XXL, image, imageVariable1, imageVariable2, imageVariable3, imageVariable4, short_desc, description, meta_title, meta_desc, meta_keyword)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($con, $insert_query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "isssssiiiiississsss", $categories_id, $productID, $name, $mrp, $price, $sizes,
                $quantity_S, $quantity_M, $quantity_L, $quantity_XL, $quantity_XXL, $image,
                $imageVariable1, $imageVariable2, $imageVariable3, $imageVariable4,
                $short_desc, $description, $meta_title, $meta_desc, $meta_keyword);

            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $msg = "Product inserted successfully";
            } else {
                $msg = "Error inserting product: " . mysqli_error($con);
            }

            mysqli_stmt_close($stmt);
        }
    }
}
?>

<div class="content pb-0">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>Product</strong><small> Form</small></div>
					<form method="post" enctype="multipart/form-data">
						<div class="card-body card-block">
							<div class="form-group">
								<label for="categories" class=" form-control-label">Categories</label>
								<select class="form-control" name="categories_id">
									<option>Select Category</option>
									<?php
									$res = mysqli_query($con, "select id,categories from categories order by categories asc");
									while ($row = mysqli_fetch_assoc($res)) {
										if ($row['id'] == $categories_id) {
											echo "<option selected value=" . $row['id'] . ">" . $row['categories'] . "</option>";
										} else {
											echo "<option value=" . $row['id'] . ">" . $row['categories'] . "</option>";
										}
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="categories" class=" form-control-label">Product Id</label>
								<input type="text" id="id" name="productID" class="form-control" required>
							</div>

							<div class="form-group">
								<label for="categories" class=" form-control-label">Product Name</label>
								<input type="text" name="name" placeholder="Enter product name" class="form-control" required>
							</div>

							<div class="form-group">
								<label for="categories" class=" form-control-label">MRP</label>
								<input type="text" name="mrp" placeholder="Enter product mrp" class="form-control" required>
							</div>

							<div class="form-group">
								<label for="categories" class=" form-control-label">Price</label>
								<input type="text" name="price" placeholder="Enter product price" class="form-control" required ?>
							</div>
							<div class="form-group">
								<label for="categories" class=" form-control-label">Sizes:</label>
								<select id="sizes" name="sizes[]" class="form-control" style="height: 133px;" multiple>
									<option value="S">S</option>
									<option value="M">M</option>
									<option value="L">L</option>
									<option value="XL">XL</option>
									<option value="XXL">XXL</option>
								</select><br>
							</div>
							<div class="form-group">
								<label for="categories" class=" form-control-label">Quantity: </label>
								<input type="number" id="quantity_S" name="quantity[S]" placeholder="S Quantity" required>
								<input type="number" id="quantity_M" name="quantity[M]" placeholder="M Quantity" required>
								<input type="number" id="quantity_L" name="quantity[L]" placeholder="L Quantity" required>
								<input type="number" id="quantity_XL" name="quantity[XL]" placeholder="XL Quantity" required>
								<input type="number" id="quantity_XXL" name="quantity[XXL]" placeholder="XXL Quantity" required><br>
							</div>

							<div class="form-group">
								<label for="categories" class=" form-control-label">Image</label>
								<input type="file" name="image" class="form-control">
							</div>
							<div class="form-group">
								<label for="categories" class=" form-control-label">Image Path 1</label>
								<input type="text" id="imageVariable1" class="form-control" name="imageVariable1" required><br>
							</div>
							<div class="form-group">
								<label for="categories" class=" form-control-label">Image Path 2</label>
								<input type="text" id="imageVariable2" class="form-control" name="imageVariable2" required><br>
							</div>
							<div class="form-group">
								<label for="categories" class=" form-control-label">Image Path 3</label>
								<input type="text" id="imageVariable3" class="form-control" name="imageVariable3" required><br>
							</div>
							<div class="form-group">
								<label for="categories" class=" form-control-label">Image Path 4</label>
								<input type="text" id="imageVariable4" class="form-control" name="imageVariable4" required><br>
							</div>
							<div class="form-group">
								<label for="categories" class=" form-control-label">Short Description</label>
								<textarea name="short_desc" placeholder="Enter product short description" class="form-control" required></textarea>
							</div>

							<div class="form-group">
								<label for="categories" class=" form-control-label">Description</label>
								<textarea name="description" placeholder="Enter product description" class="form-control" required>></textarea>
							</div>

							<div class="form-group">
								<label for="categories" class=" form-control-label">Meta Title</label>
								<textarea name="meta_title" placeholder="Enter product meta title" class="form-control"></textarea>
							</div>

							<div class="form-group">
								<label for="categories" class=" form-control-label">Meta Description</label>
								<textarea name="meta_desc" placeholder="Enter product meta description" class="form-control"></textarea>
							</div>

							<div class="form-group">
								<label for="categories" class=" form-control-label">Meta Keyword</label>
								<textarea name="meta_keyword" placeholder="Enter product meta keyword" class="form-control"></textarea>
							</div>


							<button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
								<span id="payment-button-amount">Submit</span>
							</button>
							<div class="field_error"><?php echo $msg ?></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
require('footer.inc.php');
?>