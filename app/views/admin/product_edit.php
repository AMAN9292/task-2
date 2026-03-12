<?php
$pageTitle = 'Edit Product | Admin Panel';
$activeMenu = 'product';
$activeSubMenu = 'product_list';
include __DIR__ . '/layout_header.php';
?>

<div class="title-wrapper pt-30">
  <div class="row align-items-center">
    <div class="col-md-6">
      <div class="title"><h2>Edit Product</h2></div>
    </div>
    <div class="col-md-6">
      <div class="breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/product_admin/public/index.php?module=admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/product_admin/public/index.php?module=admin&action=products">Products</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="card-style mb-30">
      <form method="POST" action="/product_admin/public/index.php?module=admin&action=product_update" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <input type="hidden" name="old_image" value="<?= $product['product_image'] ?>">

        <div class="mb-3">
          <label class="form-label fw-bold">Product Name <span class="text-danger">*</span></label>
          <input type="text" name="product_name" class="form-control <?= isset($errors['product_name']) ? 'is-invalid' : '' ?>"
                 value="<?= htmlspecialchars($product['product_name']) ?>">
          <?php if (isset($errors['product_name'])): ?>
            <div class="invalid-feedback"><?= $errors['product_name'] ?></div>
          <?php endif; ?>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Price <span class="text-danger">*</span></label>
          <input type="number" step="0.01" name="price" class="form-control"
                 value="<?= htmlspecialchars($product['price']) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Description</label>
          <textarea name="description" rows="4" class="form-control"><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Brand</label>
          <select name="brand_id" class="form-select">
            <option value="">-- Select Brand --</option>
            <?php foreach ($brand as $b): ?>
              <option value="<?= $b['id'] ?>" <?= ($product['brand_id'] == $b['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($b['br_name']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Status</label>
          <select name="status" class="form-select">
            <option value="active" <?= ($product['status'] === 'active') ? 'selected' : '' ?>>Active</option>
            <option value="inactive" <?= ($product['status'] === 'inactive') ? 'selected' : '' ?>>Inactive</option>
          </select>
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold">Product Image <small class="text-muted">(leave empty to keep current)</small></label>
          <?php if (!empty($product['product_image'])): ?>
            <div class="mb-2">
              <img src="/product_admin/public/uploads/<?= htmlspecialchars($product['product_image']) ?>" width="100" style="border-radius:8px;">
              <p class="text-muted small mt-1">Current image</p>
            </div>
          <?php endif; ?>
          <input type="file" name="product_image" accept="image/*" class="form-control" onchange="previewImage(this)">
          <div id="imagePreview" class="mt-2"></div>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="main-btn primary-btn btn-hover">Update Product</button>
          <a href="/product_admin/public/index.php?module=admin&action=products" class="main-btn secondary-btn btn-hover">Cancel</a>
        </div>

      </form>
    </div>
  </div>
</div>

<script>
function previewImage(input) {
  const preview = document.getElementById('imagePreview');
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      preview.innerHTML = `<img src="${e.target.result}" style="max-width:150px;border-radius:8px;margin-top:8px;">`;
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>

<?php include __DIR__ . '/layout_footer.php'; ?>
