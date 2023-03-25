<?= $this->extend('admin/layout/default') ?>
<?= $this->section('content') ?>
 
<!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo lang('App.dashboard');?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?php echo lang('App.home');?></a></li>
              <li class="breadcrumb-item active"><?php echo lang('App.dashboard');?> v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
     
    </section>
    <!-- /.content -->


<?= $this->endSection() ?>
<?= $this->section('js') ?>

 <script>
  window.location.href =  "contracts";
  </script> 

<?=  $this->endSection() ?>