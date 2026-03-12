    </div><!-- end container-fluid -->
  </section>
  <!-- section end -->

  <!-- footer start -->
  <footer class="footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 order-last order-md-first">
          <div class="copyright text-center text-md-start">
            <p class="text-sm">Admin Panel &copy; <?= date('Y') ?></p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- footer end -->
</main>
<!--main-wrapper end-->

<script src="../app/views/admin/assets/js/bootstrap.bundle.min.js"></script>
<script src="../app/views/admin/assets/js/main.js"></script>
<script>
  // Auto-dismiss flash alerts
  setTimeout(() => {
    document.querySelectorAll('.alert-flash').forEach(el => {
      let bsAlert = new bootstrap.Alert(el);
      bsAlert.close();
    });
  }, 3500);
</script>
</body>
</html>
