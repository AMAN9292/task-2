<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Product Add Form</title>

  <!-- CSS LINK -->
  <link rel="stylesheet" href="/n2-php/public/assets/custom.css">
</head>

<body>

  <h2>Product Form</h2>

  <div class="form-container">
    <form method="POST" action="index.php?action=store" enctype="multipart/form-data">

      <label for="name">Product Name: </label>
      <input type="text" name="product_name" value="<?= $_POST['product_name'] ?? '' ?>">
      <small><?= $errors['product_name'] ?? '' ?></small>

      <label for="desc">Description:</label>
      <textarea name="description"><?= $_POST['description'] ?? '' ?></textarea>
      <small><?= $errors['description'] ?? '' ?></small>

      <label for="pic">Upload Image:</label>
      <input id="pic" type="file" name="product_image" accept=".jpg,.jpeg,.png">
      <small><?= $errors['product_image'] ?? '' ?></small>

      <label for="price">Price:</label>
      <input type="number" name="price" value="<?= $_POST['price'] ?? '' ?>">
      <small><?= $errors['price'] ?? '' ?></small>

     

      <label for="status">Status:</label>
      <select name="status">
        <option value="">Select</option>
        <option value="Active" <?= (($_POST['status'] ?? '') == "Active") ? 'selected' : '' ?>>Active</option>
        <option value="Inactive" <?= (($_POST['status'] ?? '') == "Inactive") ? 'selected' : '' ?>>Inactive</option>
      </select>
      <small><?= $errors['status'] ?? '' ?></small>


      <!-- Brand section add-->
       <label for="brand">Brand:</label>
       <select name="brand_id" required>
        <option value="">Select Brand Id</option>
        <?php foreach($brand as $brands): ?>
          <option value="<?= $brands['id']?>">
            <?= $brands['br_name'] ?>
        </option>
        <?php endforeach; ?>
        </select>



      <div class="btn-group">
        <button class="submit-btn" name="submit1" type="submit">Submit</button>
        <button type="button" onclick="window.location='index.php?action=create'">
          Reset
        </button>
      </div>

      <a class="view-btn" href="index.php">Go to View Page</a>

    </form>
  </div>

</body>

</html>