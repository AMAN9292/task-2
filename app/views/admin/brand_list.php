<?php
$pageTitle = 'Brands | Admin Panel';
$activeMenu = 'brand';
$activeSubMenu = 'brand_list';
include __DIR__ . '/layout_header.php';
?>

<div class="title-wrapper pt-30">
  <div class="row align-items-center">
    <div class="col-md-6">
      <div class="title"><h2>Brands</h2></div>
    </div>
    <div class="col-md-6">
      <div class="breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/product_admin/public/index.php?module=admin">Dashboard</a></li>
            <li class="breadcrumb-item active">Brands</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="card-style mb-30">
  <div class="d-flex justify-content-between align-items-center mb-20">
    <h6 class="mb-0">All Brands</h6>
    <a href="/product_admin/public/index.php?module=admin&action=brand_create" class="main-btn primary-btn btn-hover btn-sm">
      <i class="lni lni-plus me-1"></i> Add Brand
    </a>
  </div>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Logo</th>
          <th>Brand Name</th>
          <th>Product Count</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; foreach ($brands as $row): ?>
        <tr>
          <td><?= $i++ ?></td>
          <td>
            <?php if (!empty($row['image'])): ?>
              <img src="/product_admin/public/uploads/<?= htmlspecialchars($row['image']) ?>" width="55" height="55" style="border-radius:8px;object-fit:cover;">
            <?php else: ?>
              <span class="text-muted">No image</span>
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($row['br_name']) ?></td>
          <td><?= htmlspecialchars($row['total_products']) ?></td>
          <td>
            <a href="/product_admin/public/index.php?module=admin&action=brand_edit&id=<?= $row['id'] ?>" class="main-btn primary-btn btn-hover btn-sm me-1">Edit</a>
            <a href="/product_admin/public/index.php?module=admin&action=brand_delete&id=<?= $row['id'] ?>"
               class="main-btn danger-btn btn-hover btn-sm"
               onclick="return confirm('Delete this brand?')">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include __DIR__ . '/layout_footer.php'; ?>
