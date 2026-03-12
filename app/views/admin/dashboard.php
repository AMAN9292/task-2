<?php
$pageTitle = 'Dashboard | Admin Panel';
$activeMenu = 'dashboard';
include __DIR__ . '/layout_header.php';
?>

<div class="title-wrapper pt-30">
  <div class="row align-items-center">
    <div class="col-md-6">
      <div class="title"><h2>Dashboard</h2></div>
    </div>
    <div class="col-md-6">
      <div class="breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="icon-card mb-30">
      <div class="icon purple">
        <i class="lni lni-cart-full"></i>
      </div>
      <div class="content">
        <h6 class="mb-10">Total Products</h6>
        <h3 class="text-bold mb-10"><?= $totalProducts ?></h3>
        <a href="/product_admin/public/index.php?module=admin&action=products" class="text-sm text-primary">View All →</a>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="icon-card mb-30">
      <div class="icon purple">
        <i class="lni lni-tag"></i>
      </div>
      <div class="content">
        <h6 class="mb-10">Total Brands</h6>
        <h3 class="text-bold mb-10"><?= $totalBrands ?></h3>
        <a href="/product_admin/public/index.php?module=admin&action=brands" class="text-sm text-primary">View All →</a>
      </div>
    </div>
  </div>
  
  <div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="icon-card mb-30">
      <div class="icon danger">
        <i class="lni lni-users"></i>
      </div>
      <div class="content">
        <h6 class="mb-10">Total Users</h6>
        <h3 class="text-bold mb-10"><?= $totalUsers ?></h3>
        <a href="/product_admin/public/index.php?module=admin&action=users" class="text-sm text-primary">View All →</a>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/layout_footer.php'; ?>
