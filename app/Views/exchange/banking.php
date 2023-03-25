<?php
 $this->extend('admin/layout/default');
 
 ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?php echo lang('App.banking') ?>s</h1>
            </div>
            <div class="col-sm-12  page-vh-menu">

                <?= $this->include("admin/layout/partials/menu-accredit") ?>
            </div> 
          </div>
        </div><!-- /.container-fluid -->
        <?= $this->include("exchange/modal_accredit") ?>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default card -->
  
    <div> a </div>

    
   

   
                
  

 
  <!-- /.card -->
   

</section>
<!-- /.content -->

<?= $this->endSection() ?>