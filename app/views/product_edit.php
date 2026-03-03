<?php
// controller to $product come
$row = $product;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="/n2-php/public/assets/custom.css">
</head>

<body>

    <h2 style="text-align:center;">Edit Product</h2>

    <div class="form-container">

        <form action="index.php?action=update" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="hidden" name="old_image" value="<?= $row['product_image'] ?>">

            <label>Product Name:</label>
            <input type="text" name="product_name" value="<?= $row['product_name'] ?>">

            <label>Description:</label>
            <textarea name="description"><?= $row['description'] ?></textarea>

            <label>Old Image:</label><br>
            <?php if (!empty($row['product_image'])) { ?>
                <img src="/n2-php/public/uploads/<?= $row['product_image'] ?>" width="80"><br><br>
            <?php } else { ?>
                No Image<br><br>
            <?php } ?>

            <label>New Image:</label>
            <input type="file" name="product_image"><br><br>

            <label>Price:</label>
            <input type="text" name="price" value="<?= $row['price'] ?>">

            <label>Status:</label>
            <select name="status">
                <option value="">Select Status</option>
                <option value="Active" <?= ($row['status'] == "Active") ? "selected" : "" ?>>Active</option>
                <option value="Inactive" <?= ($row['status'] == "Inactive") ? "selected" : "" ?>>Inactive</option>
            </select>

            <br><br>

            <!-- Brand edit page code -->
            <label>Brand:</label>
            <select name="brand_id">
                <option value="">Select Brand Id</option>
                <?php foreach ($brand as $brand): ?>
                    <option value="<?= $brand['id'] ?>" <?= ($row['brand_id'] == $brand['id']) ? "selected" : "" ?>>
                        <?= $brand['br_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Update Product</button>

            <a href="index.php">Back to View</a>

        </form>

    </div>

</body>

</html>