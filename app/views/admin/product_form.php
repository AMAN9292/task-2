<?php
$pageTitle = 'Add Product | Admin Panel';
$activeMenu = 'product';
$activeSubMenu = 'product_create';
include __DIR__ . '/layout_header.php';
?>

<div class="title-wrapper pt-30">
  <div class="row align-items-center">
    <div class="col-md-6">
      <div class="title"><h2>Add Product</h2></div>
    </div>
    <div class="col-md-6">
      <div class="breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/product_admin/public/index.php?module=admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/product_admin/public/index.php?module=admin&action=products">Products</a></li>
            <li class="breadcrumb-item active">Add</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="card-style mb-30">
      <form method="POST" action="/product_admin/public/index.php?module=admin&action=product_store" enctype="multipart/form-data">

        <div class="mb-3">
          <label class="form-label fw-bold">Product Name <span class="text-danger">*</span></label>
          <input type="text" name="product_name" class="form-control <?= isset($errors['product_name']) ? 'is-invalid' : '' ?>"
                 value="<?= htmlspecialchars($_POST['product_name'] ?? '') ?>">
          <?php if (isset($errors['product_name'])): ?>
            <div class="invalid-feedback"><?= $errors['product_name'] ?></div>
          <?php endif; ?>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Price <span class="text-danger">*</span></label>
          <input type="number" step="0.01" name="price" class="form-control <?= isset($errors['price']) ? 'is-invalid' : '' ?>"
                 value="<?= htmlspecialchars($_POST['price'] ?? '') ?>">
          <?php if (isset($errors['price'])): ?>
            <div class="invalid-feedback"><?= $errors['price'] ?></div>
          <?php endif; ?>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Description <span class="text-danger">*</span></label>
          <textarea name="description" rows="4" class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
          <?php if (isset($errors['description'])): ?>
            <div class="invalid-feedback"><?= $errors['description'] ?></div>
          <?php endif; ?>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Brand <span class="text-danger">*</span></label>
          <select name="brand_id" class="form-select <?= isset($errors['brand_id']) ? 'is-invalid' : '' ?>">
            <option value="">-- Select Brand --</option>
            <?php foreach ($brand as $b): ?>
              <option value="<?= $b['id'] ?>" <?= (($_POST['brand_id'] ?? '') == $b['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($b['br_name']) ?>
              </option>
            <?php endforeach; ?>
          </select>
          <?php if (isset($errors['brand_id'])): ?>
            <div class="invalid-feedback"><?= $errors['brand_id'] ?></div>
          <?php endif; ?>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-select <?= isset($errors['status']) ? 'is-invalid' : '' ?>">
            <option value="">-- Select Status --</option>
            <option value="active" <?= (($_POST['status'] ?? '') === 'active') ? 'selected' : '' ?>>Active</option>
            <option value="inactive" <?= (($_POST['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Inactive</option>
          </select>
          <?php if (isset($errors['status'])): ?>
            <div class="invalid-feedback"><?= $errors['status'] ?></div>
          <?php endif; ?>
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold">Product Image <span class="text-danger">*</span></label>
          <input type="file" name="product_image" accept="image/*" class="form-control <?= isset($errors['product_image']) ? 'is-invalid' : '' ?>"
                 onchange="previewImage(this)">
          <?php if (isset($errors['product_image'])): ?>
            <div class="invalid-feedback"><?= $errors['product_image'] ?></div>
          <?php endif; ?>
          <div id="imagePreview" class="mt-2"></div>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="main-btn primary-btn btn-hover">Save Product</button>
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
