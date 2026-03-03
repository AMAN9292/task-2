<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" href="/n2-php/public/assets/custom.css">
</head>

<body>

<span class="add">
    <a class="add_btn" href="brand.php?action=create">Add Brand</a>
</span>

<div class="table">
<ul>

<li class="row head">
    <span class="cell">ID</span>
    <span class="cell">Brand Name</span>
    <span class="cell">Image</span>
    <span class="cell">Product Count</span>
    <span class="cell">Action</span>
</li>

<?php while($row = mysqli_fetch_assoc($brands)) { ?>

<li class="row">
    <span class="cell"><?= htmlspecialchars($row['id']); ?></span>
    <span class="cell"><?= htmlspecialchars($row['br_name']); ?></span>

    <span class="cell">
        <?php if(!empty($row['image'])) { ?>
            <img src="/n2-php/public/uploads/<?= htmlspecialchars($row['image']) ?>" width="70" alt="Brand Image">
        <?php } else { ?>
            No image
        <?php } ?>
    </span>
    <span class="cell"><?php echo $row['total_products']; ?></span>

    <span class="cell">
        <!-- <a class="update" href="brand.php?action=edit&id=<?= $row['id']; ?>">Edit</a> -->
         <a class="update"href="brand.php?action=edit&id=<?= $row['id'] ?>">Edit</a>
        <a class="delete" href="brand.php?action=delete&id=<?= $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
    </span>
</li>

<?php } ?>

</ul>
</div>

</body>
</html>