<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  <title><?= $_page->title ?> | <?= setting('company_name') ?></title>
  
  <?= $this->include("admin/layout/partials/styles") ?>
  
</head>
<body class="hold-transition sidebar-mini layout-boxed">
<div class="wrapper">
  
  <?= $this->include("admin/layout/partials/header") ?>
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?= $this->include('admin/layout/partials/notification') ?>
    <?= $this->renderSection("content") ?>
  </div>

  <?= $this->include("admin/layout/partials/footer") ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?= $this->include("admin/layout/partials/scripts") ?>
</body>
</html>