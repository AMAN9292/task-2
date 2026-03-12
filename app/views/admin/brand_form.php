<?php
$pageTitle = 'Add Brand | Admin Panel';
$activeMenu = 'brand';
$activeSubMenu = 'brand_create';
include __DIR__ . '/layout_header.php';
?>

<div class="title-wrapper pt-30">
  <div class="row align-items-center">
    <div class="col-md-6">
      <div class="title"><h2>Add Brand</h2></div>
    </div>
    <div class="col-md-6">
      <div class="breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/product_admin/public/index.php?module=admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/product_admin/public/index.php?module=admin&action=brands">Brands</a></li>
            <li class="breadcrumb-item active">Add</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card-style mb-30">
      <form method="POST" action="/product_admin/public/index.php?module=admin&action=brand_store" enctype="multipart/form-data">

        <div class="mb-3">
          <label class="form-label fw-bold">Brand Name <span class="text-danger">*</span></label>
          <input type="text" name="br_name" class="form-control <?= isset($errors['br_name']) ? 'is-invalid' : '' ?>"
                 value="<?= htmlspecialchars($_POST['br_name'] ?? '') ?>">
          <?php if (isset($errors['br_name'])): ?>
            <div class="invalid-feedback"><?= $errors['br_name'] ?></div>
          <?php endif; ?>
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold">Brand Logo</label>
          <input type="file" name="br_image" accept="image/*" class="form-control" onchange="previewImage(this)">
          <div id="imagePreview" class="mt-2"></div>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="main-btn primary-btn btn-hover">Save Brand</button>
          <a href="/product_admin/public/index.php?module=admin&action=brands" class="main-btn secondary-btn btn-hover">Cancel</a>
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
