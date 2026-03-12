<?php
$pageTitle = 'Products | Admin Panel';
$activeMenu = 'product';
$activeSubMenu = 'product_list';
include __DIR__ . '/layout_header.php';
?>

<div class="title-wrapper pt-30">
  <div class="row align-items-center">
    <div class="col-md-6">
      <div class="title"><h2>Products</h2></div>
    </div>
    <div class="col-md-6">
      <div class="breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/product_admin/public/index.php?module=admin">Dashboard</a></li>
            <li class="breadcrumb-item active">Products</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="card-style mb-30">
  <div class="d-flex justify-content-between align-items-center mb-20">
    <h6 class="mb-0">All Products</h6>
    <a href="/product_admin/public/index.php?module=admin&action=product_create" class="main-btn primary-btn btn-hover btn-sm">
      <i class="lni lni-plus me-1"></i> Add Product
    </a>
  </div>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Image</th>
          <th>Product Name</th>
          <th>Price</th>
          <th>Brand</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; while ($row = mysqli_fetch_assoc($products)): ?>
        <tr>
          <td><?= $i++ ?></td>
          <td>
            <?php if (!empty($row['product_image'])): ?>
              <img src="/product_admin/public/uploads/<?= htmlspecialchars($row['product_image']) ?>" width="55" height="55" style="border-radius:8px;object-fit:cover;">
            <?php else: ?>
              <span class="text-muted">No image</span>
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($row['product_name']) ?></td>
          <td>$<?= number_format($row['price'], 2) ?></td>
          <td><?= htmlspecialchars($row['br_name'] ?? '—') ?></td>
          <td>
            <?php if ($row['status'] == 'active'): ?>
              <span class="badge-active">Active</span>
            <?php else: ?>
              <span class="badge-inactive">Inactive</span>
            <?php endif; ?>
          </td>
          <td>
            <a href="/product_admin/public/index.php?module=admin&action=product_edit&id=<?= $row['id'] ?>" class="main-btn primary-btn btn-hover btn-sm me-1">Edit</a>
            <a href="/product_admin/public/index.php?module=admin&action=product_delete&id=<?= $row['id'] ?>"
               class="main-btn danger-btn btn-hover btn-sm"
               onclick="return confirm('Delete this product?')">Delete</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include __DIR__ . '/layout_footer.php'; ?>
