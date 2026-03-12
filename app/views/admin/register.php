
<?php

$pageTitle = 'Users | Admin Panel';
$activeMenu = 'User';
$activeSubMenu = 'user_create';
include __DIR__ . '/layout_header.php';
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>

<link rel="stylesheet" href="../app/views/admin/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../app/views/admin/assets/css/lineicons.css">
<link rel="stylesheet" href="../app/views/admin/assets/css/main.css">

</head>
<body>

<div id="preloader"><div class="spinner"></div></div>

<div class="d-flex align-items-center justify-content-center" style="min-height:100vh;background:#f0fdf4;padding:20px 0;">

<div class="card shadow-sm" style="width:100%;max-width:440px;border-radius:12px;overflow:hidden;">

<div class="text-center p-4" style="background:#16a34a;">
<div style="font-size:32px;color:#fff;">📝</div>
<h5 class="text-white mt-2 mb-0 fw-bold">Create Account</h5>
<p class="text-white mt-1 mb-0" style="font-size:13px;opacity:0.85;">Join us today</p>
</div>

<div class="card-body p-4"> -->

<form method="POST" action="/product_admin/public/index.php?module=admin&action=user_store">

<div class="row">

<div class="col-6 mb-3">
<label class="form-label fw-bold">First Name</label>
<input type="text" name="firstname" class="form-control" required>
</div>

<div class="col-6 mb-3">
<label class="form-label fw-bold">Last Name</label>
<input type="text" name="lastname" class="form-control" required>
</div>

</div>

<div class="mb-3">
<label class="form-label fw-bold">Email Address</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label fw-bold">Password</label>

<div class="input-group">
<input type="password" name="password" id="pw1" class="form-control" required>

<button type="button" class="btn btn-outline-secondary" onclick="togglePw('pw1','eye1')" tabindex="-1">
<i class="lni lni-eye" id="eye1"></i>
</button>

</div>
</div>

<div class="mb-3">
<label class="form-label fw-bold">Role</label>

<select name="role" class="form-control" required>
<option value="user">User</option>
<option value="admin">Admin</option>
</select>

</div>

<button type="submit" name="submit" class="btn w-100 text-white fw-bold py-2" style="background:#16a34a;border-radius:8px;">
Create Account <i class="lni lni-arrow-right ms-2"></i>
</button>

</form>

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

<?php include __DIR__ . '/layout_footer.php'; ?>