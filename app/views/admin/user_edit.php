<?php
$pageTitle = 'Edit User | Admin Panel';
$activeMenu = 'user';
$activeSubMenu = 'user_list';
include __DIR__ . '/layout_header.php';
?>

<div class="title-wrapper pt-30">
  <div class="row align-items-center">
    <div class="col-md-6">
      <div class="title"><h2>Edit User</h2></div>
    </div>
    <div class="col-md-6">
      <div class="breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/product_admin/public/index.php?module=admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/product_admin/public/index.php?module=admin&action=users">Users</a></li>
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

      <form method="POST" action="/product_admin/public/index.php?module=admin&action=user_update">

        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <div class="mb-3">
          <label class="form-label fw-bold">First Name <span class="text-danger">*</span></label>
          <input type="text" name="firstname" class="form-control <?= isset($errors['firstname']) ? 'is-invalid' : '' ?>"
                 value="<?= htmlspecialchars($user['firstname']) ?>">
          <?php if (isset($errors['firstname'])): ?>
            <div class="invalid-feedback"><?= $errors['firstname'] ?></div>
          <?php endif; ?>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Last Name <span class="text-danger">*</span></label>
          <input type="text" name="lastname" class="form-control <?= isset($errors['lastname']) ? 'is-invalid' : '' ?>"
                 value="<?= htmlspecialchars($user['lastname']) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
          <input type="email" name="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                 value="<?= htmlspecialchars($user['email']) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Password <small class="text-muted">(Leave blank to keep current)</small></label>
          <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold">Role</label>
          <select name="role" class="form-select">
            <option value="user" <?= ($user['role'] === 'user') ? 'selected' : '' ?>>User</option>
            <option value="admin" <?= ($user['role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
          </select>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="main-btn primary-btn btn-hover">Update User</button>
          <a href="/product_admin/public/index.php?module=admin&action=users" class="main-btn secondary-btn btn-hover">Cancel</a>
        </div>

      </form>

    </div>
  </div>
</div>

<?php include __DIR__ . '/layout_footer.php'; ?>