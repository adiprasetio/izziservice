<!DOCTYPE html>
<html>
<?php $this->load->view('template/head') ?>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php $this->load->view('template/navbar') ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php $this->load->view('template/sidebar') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php $this->load->view('template/dashboard') ?>
    </div>
    <!-- /.content-wrapper -->
    <?php $this->load->view('template/footer') ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <?php $this->load->view('template/script') ?>
</body>
</html>
