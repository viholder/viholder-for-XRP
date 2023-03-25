<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  <title><?= $_page->title ?> </title>

    <meta name="csrf-token" content="<?= csrf_hash() ?>"/>
    <meta name="google" content="notranslate">

  <?= $this->include("admin/layout/partials/styles") ?>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  
<div class="wrapper">
  
     
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <?= $this->renderSection("content") ?>
  </div>

 
  <!-- Control Sidebar 
  <aside class="control-sidebar control-sidebar-dark"> 
 
     
  </aside>
  -->
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?= $this->include("admin/layout/partials/scripts") ?>
</body>
</html>