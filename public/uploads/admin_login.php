<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login</title>
  <link rel="stylesheet" href="../app/views/admin/assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../app/views/admin/assets/css/lineicons.css" />
  <link rel="stylesheet" href="../app/views/admin/assets/css/main.css" />
</head>
<body>
<div id="preloader"><div class="spinner"></div></div>

<div class="d-flex align-items-center justify-content-center" style="min-height:100vh;background:#f3f4f6;">
  <div class="card shadow-sm" style="width:100%;max-width:420px;border-radius:12px;overflow:hidden;">

    <div class="text-center p-4" style="background:#365CF5;">
      <img src="../app/views/admin/assets/images/logo/logo-white.svg" alt="logo" style="height:38px;" />
      <p class="text-white mt-2 mb-0" style="font-size:13px;opacity:0.8;">Admin Panel</p>
    </div>

    <div class="card-body p-4">
      <h5 class="mb-1 fw-bold">Admin Sign In</h5>
      <p class="text-muted mb-4" style="font-size:13px;">Enter your administrator credentials</p>

      <?php if (isset($_SESSION['login_error'])): ?>
        <div class="alert alert-danger alert-dismissible py-2" role="alert">
          <i class="lni lni-warning me-1"></i> <?= $_SESSION['login_error'] ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['login_error']); ?>
      <?php endif; ?>
      <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible py-2" role="alert">
          <?= $_SESSION['success'] ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
      <?php endif; ?>

      <form method="POST" action="index.php?module=auth&action=admin_login">
        <div class="mb-3">
          <label class="form-label fw-bold" style="font-size:14px;">Email Address</label>
          <input type="email" name="email" class="form-control" placeholder="admin@admin.com" required autofocus />
        </div>
        <div class="mb-4">
          <label class="form-label fw-bold" style="font-size:14px;">Password</label>
          <div class="input-group">
            <input type="password" name="password" id="pwAdmin" class="form-control" placeholder="••••••••" required />
            <button type="button" class="btn btn-outline-secondary" onclick="togglePw('pwAdmin','eyeAdmin')" tabindex="-1">
              <i class="lni lni-eye" id="eyeAdmin"></i>
            </button>
          </div>
        </div>
        <button type="submit" class="main-btn primary-btn btn-hover w-100">
          Sign In <i class="lni lni-arrow-right ms-2"></i>
        </button>
      </form>

      <hr class="my-3">
      <p class="text-center text-muted mb-0" style="font-size:13px;">
        Not an admin?
        <a href="index.php?module=auth&action=user_login" style="color:#365CF5;text-decoration:none;font-weight:600;">User Login →</a>
      </p>
    </div>
  </div>
</div>

<script src="../app/views/admin/assets/js/bootstrap.bundle.min.js"></script>
<script src="../app/views/admin/assets/js/main.js"></script>
<script>
function togglePw(inputId, iconId) {
  const i = document.getElementById(inputId);
  const e = document.getElementById(iconId);
  i.type = i.type === 'password' ? 'text' : 'password';
  e.className = i.type === 'password' ? 'lni lni-eye' : 'lni lni-eye-off';
}
</script>
</body>
</html>
