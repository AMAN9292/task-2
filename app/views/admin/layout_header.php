<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../app/views/admin/assets/images/favicon.svg" type="image/x-icon" />
  <title><?= $pageTitle ?? 'Admin Panel' ?></title>
  <link rel="stylesheet" href="../app/views/admin/assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../app/views/admin/assets/css/lineicons.css" />
  <link rel="stylesheet" href="../app/views/admin/assets/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="../app/views/admin/assets/css/main.css" />
  <style>
    .table img { border-radius: 6px; object-fit: cover; }
    .badge-active { background: #d1fae5; color: #065f46; padding: 3px 10px; border-radius: 20px; font-size: 12px; }
    .badge-inactive { background: #fee2e2; color: #991b1b; padding: 3px 10px; border-radius: 20px; font-size: 12px; }
    .alert-flash { position: fixed; top: 80px; right: 20px; z-index: 9999; min-width: 280px; }
  </style>
</head>
<body>

<?php if (isset($_SESSION['success'])): ?>
  <div class="alert alert-success alert-dismissible alert-flash shadow" role="alert">
    <strong>✓</strong> <?= $_SESSION['success']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>
<?php if (isset($_SESSION['error'])): ?>
  <div class="alert alert-danger alert-dismissible alert-flash shadow" role="alert">
    <strong>✗</strong> <?= $_SESSION['error']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<!--  Preloader -->
<div id="preloader"><div class="spinner"></div></div>

<!--  sidebar-nav start -->
<aside class="sidebar-nav-wrapper">
  <div class="navbar-logo">
    <a href="/product_admin/public/index.php?module=admin">
      <img src="../app/views/admin/assets/images/logo/logo.svg" alt="logo" />
    </a>
  </div>
  <nav class="sidebar-nav">
    <ul>

      <!-- Dashboard -->
      <li class="nav-item <?= ($activeMenu ?? '') === 'dashboard' ? 'active' : '' ?>">
        <a href="/product_admin/public/index.php?module=admin">
          <span class="icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M8.74999 18.3333C12.2376 18.3333 15.1364 15.8128 15.7244 12.4941C15.8448 11.8143 15.2737 11.25 14.5833 11.25H9.99999C9.30966 11.25 8.74999 10.6903 8.74999 10V5.41666C8.74999 4.7263 8.18563 4.15512 7.50586 4.27556C4.18711 4.86357 1.66666 7.76243 1.66666 11.25C1.66666 15.162 4.83797 18.3333 8.74999 18.3333Z" />
              <path d="M17.0833 10C17.7737 10 18.3432 9.43708 18.2408 8.75433C17.7005 5.14918 14.8508 2.29947 11.2457 1.75912C10.5629 1.6568 10 2.2263 10 2.91665V9.16666C10 9.62691 10.3731 10 10.8333 10H17.0833Z" />
            </svg>
          </span>
          <span class="text">Dashboard</span>
        </a>
      </li>

      <span class="divider"><hr /></span>

      <!-- Products -->
      <li class="nav-item nav-item-has-children">
        <a href="#0" class="<?= ($activeMenu ?? '') === 'product' ? '' : 'collapsed' ?>"
           data-bs-toggle="collapse" data-bs-target="#ddmenu_product"
           aria-controls="ddmenu_product" aria-expanded="<?= ($activeMenu ?? '') === 'product' ? 'true' : 'false' ?>">
          <span class="icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M3.33334 3.33334H16.6667L15 12.5H5L3.33334 3.33334Z"/>
              <path d="M1.66666 1.66667H4.16666L3.33334 3.33334"/>
              <path d="M6.66666 15.8333C6.66666 16.2936 6.29357 16.6667 5.83332 16.6667C5.37308 16.6667 5 16.2936 5 15.8333C5 15.3731 5.37308 15 5.83332 15C6.29357 15 6.66666 15.3731 6.66666 15.8333Z"/>
              <path d="M14.1667 15.8333C14.1667 16.2936 13.7936 16.6667 13.3333 16.6667C12.8731 16.6667 12.5 16.2936 12.5 15.8333C12.5 15.3731 12.8731 15 13.3333 15C13.7936 15 14.1667 15.3731 14.1667 15.8333Z"/>
            </svg>
          </span>
          <span class="text">Products</span>
        </a>
        <ul id="ddmenu_product" class="collapse <?= ($activeMenu ?? '') === 'product' ? 'show' : '' ?> dropdown-nav">
          <li><a href="/product_admin/public/index.php?module=admin&action=products" class="<?= ($activeSubMenu ?? '') === 'product_list' ? 'active' : '' ?>">All Products</a></li>
          <li><a href="/product_admin/public/index.php?module=admin&action=product_create" class="<?= ($activeSubMenu ?? '') === 'product_create' ? 'active' : '' ?>">Add Product</a></li>
        </ul>
      </li>

      <!-- Brands -->
      <li class="nav-item nav-item-has-children">
        <a href="#0" class="<?= ($activeMenu ?? '') === 'brand' ? '' : 'collapsed' ?>"
           data-bs-toggle="collapse" data-bs-target="#ddmenu_brand"
           aria-controls="ddmenu_brand" aria-expanded="<?= ($activeMenu ?? '') === 'brand' ? 'true' : 'false' ?>">
          <span class="icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 1.66667L12.5 6.66667H17.5L13.75 10L15.25 15L10 12L4.75 15L6.25 10L2.5 6.66667H7.5L10 1.66667Z"/>
            </svg>
          </span>
          <span class="text">Brands</span>
        </a>
        <ul id="ddmenu_brand" class="collapse <?= ($activeMenu ?? '') === 'brand' ? 'show' : '' ?> dropdown-nav">
          <li><a href="/product_admin/public/index.php?module=admin&action=brands" class="<?= ($activeSubMenu ?? '') === 'brand_list' ? 'active' : '' ?>">All Brands</a></li>
          <li><a href="/product_admin/public/index.php?module=admin&action=brand_create" class="<?= ($activeSubMenu ?? '') === 'brand_create' ? 'active' : '' ?>">Add Brand</a></li>
        </ul>
      </li>

      <!-- Users -->
      <li class="nav-item nav-item-has-children">
        <a href="#0" class="<?= ($activeMenu ?? '') === 'user' ? '' : 'collapsed' ?>"
           data-bs-toggle="collapse" data-bs-target="#ddmenu_user"
           aria-controls="ddmenu_user" aria-expanded="<?= ($activeMenu ?? '') === 'user' ? 'true' : 'false' ?>">
          <span class="icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 10C12.3012 10 14.1667 8.13452 14.1667 5.83333C14.1667 3.53215 12.3012 1.66667 10 1.66667C7.69882 1.66667 5.83334 3.53215 5.83334 5.83333C5.83334 8.13452 7.69882 10 10 10Z"/>
              <path d="M10 11.6667C5.8175 11.6667 2.5 13.8242 2.5 16.5V18.3333H17.5V16.5C17.5 13.8242 14.1825 11.6667 10 11.6667Z"/>
            </svg>
          </span>
          <span class="text">Users</span>
        </a>
        <ul id="ddmenu_user" class="collapse <?= ($activeMenu ?? '') === 'user' ? 'show' : '' ?> dropdown-nav">
          <li><a href="/product_admin/public/index.php?module=admin&action=users" class="<?= ($activeSubMenu ?? '') === 'user_list' ? 'active' : '' ?>">All Users</a></li>
        </ul>
      </li>

      <span class="divider"><hr /></span>

    </ul>
  </nav>
</aside>
<div class="overlay"></div>
<!-- sidebar-nav end -->

<!--main-wrapper start  -->
<main class="main-wrapper">
  <!--header start -->
  <header class="header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-5 col-md-5 col-6">
          <div class="header-left d-flex align-items-center">
            <div class="menu-toggle-btn mr-15">
              <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                <i class="lni lni-chevron-left me-2"></i> Menu
              </button>
            </div>
          </div>
        </div>
        <div class="col-lg-7 col-md-7 col-6">
          <div class="header-right">
            <div class="profile-box ml-15">
              <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                data-bs-toggle="dropdown" aria-expanded="false">
                <div class="profile-info">
                  <div class="info">
                    <div class="image">
                      <img src="../app/views/admin/assets/images/profile/profile-image.png" alt="">
                    </div>
                    <div>
                      <h6 class="fw-500"><?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?></h6>
                      <p>Administrator</p>
                    </div>
                  </div>
                </div>
              </button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                <li class="divider"></li>
                <li>
                  <a href="/product_admin/public/index.php?module=auth&action=logout">
                    <i class="lni lni-exit"></i> Sign Out
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- header end -->

  <!--  section start-->
  <section class="section">
    <div class="container-fluid">
