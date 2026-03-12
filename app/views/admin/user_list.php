<?php
$pageTitle = 'Users | Admin Panel';
$activeMenu = 'user';
$activeSubMenu = 'user_list';
include __DIR__ . '/layout_header.php';
?>

<div class="title-wrapper pt-30">
  <div class="row align-items-center">
    <div class="col-md-6">
      <div class="title">
        <h2>Users</h2>
      </div>
    </div>
    <div class="col-md-6">
      <div class="breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/product_admin/public/index.php?module=admin">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="card-style mb-30">
  <div class="d-flex justify-content-between align-items-center mb-20">
    <h6 class="mb-0">All Users <span class="text-muted" style="font-size:13px;font-weight:400;">(<?= count($users) ?>
        total)</span></h6>
    <a href="/product_admin/public/index.php?module=admin&action=user_create"
      class="main-btn primary-btn btn-hover btn-sm">
      <i class="lni lni-plus me-1"></i> Add User
    </a>
  </div>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Joined</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($users)): ?>
          <tr>
            <td colspan="6" class="text-center text-muted py-4">No users found.</td>
          </tr>
        <?php endif; ?>
        <?php $i = 1;
        foreach ($users as $row): ?>
          <tr>
            <td><?= $i++ ?></td>
            <td>
              <div class="d-flex align-items-center gap-2">
                <div
                  style="width:34px;height:34px;border-radius:50%;background:#365CF5;color:#fff;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;flex-shrink:0;">
                  <?= strtoupper(substr($row['firstname'] ?? '?', 0, 1)) ?>
                </div>
                <span><?= htmlspecialchars(($row['firstname'] ?? '') . ' ' . ($row['lastname'] ?? '')) ?></span>
              </div>
            </td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td>
              <?php if (($row['role'] ?? '') === 'admin'): ?>
                <span class="badge-active">Admin</span>
              <?php else: ?>
                <span
                  style="background:#dbeafe;color:#1e40af;padding:3px 10px;border-radius:20px;font-size:12px;">User</span>
              <?php endif; ?>
            </td>
            <td>
              <?php if (!empty($row['created_at'])): ?>
                <span style="font-size:13px;color:#6b7280;"><?= date('d M Y', strtotime($row['created_at'])) ?></span>
              <?php else: ?>
                <span class="text-muted">—</span>
              <?php endif; ?>
            </td>
            <td>
              <a href="/product_admin/public/index.php?module=admin&action=user_edit&id=<?= $row['id'] ?>"
  class="main-btn warning-btn btn-hover btn-sm">
  Edit
</a>

<a href="/product_admin/public/index.php?module=admin&action=user_delete&id=<?= $row['id'] ?>"
  class="main-btn danger-btn btn-hover btn-sm"
  onclick="return confirm('Delete user <?= htmlspecialchars(addslashes($row['email'])) ?>?')">
  Delete
</a>
              <!-- <?php if (($row['role'] ?? '') === 'admin'): ?>
                <span class="text-muted small">Protected</span>
              <?php else: ?>
                <a href="/product_admin/public/index.php?module=admin&action=user_edit&id=<?= $row['id'] ?>"
                  class="main-btn warning-btn btn-hover btn-sm">
                  Edit
                </a>
                <a href="/product_admin/public/index.php?module=admin&action=user_delete&id=<?= $row['id'] ?>"
                  class="main-btn danger-btn btn-hover btn-sm"
                  onclick="return confirm('Delete user <?= htmlspecialchars(addslashes($row['email'])) ?>?')">Delete</a>
              <?php endif; ?> -->
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include __DIR__ . '/layout_footer.php'; ?>