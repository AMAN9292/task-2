<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" href="/n2-php/public/assets/custom.css">
</head>

<body>

<span class="add">
    <a class="add_btn" href="index.php?action=create">Add Product</a>
</span>

<div class="table">
<ul>

<li class="row head">
    <span class="cell">Product Name</span>
    <span class="cell">Price</span>
    <span class="cell">Description</span>
    <span class="cell">Product Image</span>
    <span class="cell">Status</span>
    <span class="cell">Brand name</span>
    <span class="cell">Action</span>
</li>

<?php while($row = mysqli_fetch_assoc($products)) { ?>

<li class="row">
    <span class="cell"><?= $row['product_name']; ?></span>
    <span class="cell"><?= $row['price']; ?></span>
    <span class="cell"><?= $row['description']; ?></span>

    <span class="cell">
        <?php if(!empty($row['product_image'])) { ?>
            <img src="/n2-php/public/uploads/<?= $row['product_image'] ?>" width="70">
        <?php } else { ?>
            No image
        <?php } ?>
    </span>

    <span class="cell"><?= $row['status']; ?></span>
    <span class="cell"><?= $row['br_name']; ?></span>

    <span class="cell">
        <a class="update" href="index.php?action=edit&id=<?= $row['id']; ?>">Edit</a>
        <a class="delete" href="index.php?action=delete&id=<?= $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
    </span>
</li>

<?php } ?>

</ul>
</div>

</body>
</html>