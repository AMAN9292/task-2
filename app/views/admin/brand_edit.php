<?php
$pageTitle = 'Edit Brand | Admin Panel';
$activeMenu = 'brand';
$activeSubMenu = 'brand_list';
include __DIR__ . '/layout_header.php';
?>

<div class="title-wrapper pt-30">
  <div class="row align-items-center">
    <div class="col-md-6">
      <div class="title"><h2>Edit Brand</h2></div>
    </div>
    <div class="col-md-6">
      <div class="breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/product_admin/public/index.php?module=admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/product_admin/public/index.php?module=admin&action=brands">Brands</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card-style mb-30">
      <form method="POST" action="/product_admin/public/index.php?module=admin&action=brand_update" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $brand['id'] ?>">
        <input type="hidden" name="old_image" value="<?= $brand['image'] ?>">

        <div class="mb-3">
          <label class="form-label fw-bold">Brand Name <span class="text-danger">*</span></label>
          <input type="text" name="br_name" class="form-control"
                 value="<?= htmlspecialchars($brand['br_name']) ?>">
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold">Brand Logo <small class="text-muted">(leave empty to keep current)</small></label>
          <?php if (!empty($brand['image'])): ?>
            <div class="mb-2">
              <img src="/product_admin/public/uploads/<?= htmlspecialchars($brand['image']) ?>" width="80" style="border-radius:8px;">
              <p class="text-muted small mt-1">Current logo</p>
            </div>
          <?php endif; ?>
          <input type="file" name="image" accept="image/*" class="form-control" onchange="previewImage(this)">
          <div id="imagePreview" class="mt-2"></div>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="main-btn primary-btn btn-hover">Update Brand</button>
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
