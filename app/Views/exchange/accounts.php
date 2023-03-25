<?php
 $this->extend('admin/layout/default');
 
 ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo lang('App.accounts') ?>s</h1>
      </div>
      <div class="col-sm-10  page-vh-menu">

          <?= $this->include("admin/layout/partials/menu-accounts") ?>
      </div> 
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <!-- Default card -->
  
     <br>

    
  
    <?php   foreach($wallets as $row){   ?>
 
              <div data-id="<?php echo $row['contractID']; ?>" style="display:flex;width:100%;height:60px;border-bottom:1px dotted #ededed;margin-bottom:10px;">
                    <div style=" width:60px;">
                        <div class="img-circle" style="width:50px;height:50px;background:#efefef;background-image: url(<?php echo base_url()."/uploads/logos/".$row['contractID']; ?>.png );background-repeat:no-repeat;background-size:cover;background-position: center;">  </div>
                    </div>
                    <div style=" width:100%;height:50px;padding:3px;">
                       <div style="font-size:16px;"><b> <?php echo  $row['wallet_currency']; ?> </b> <?php echo  $row['contractSKU']; ?>   </div>  
                       <div style="color:grey;font-size:12px;"> <?php echo  strtoupper($row['network']); ?> </div>  
                    </div>
                    <div style=" width:80px;padding:3px;text-align:right;">
                        <?php echo  $row['wallet_balance']; ?>
                         <br>
                    </div>
            </div>

     <?php } ?>
  

   
                
  

 
  <!-- /.card -->

</section>
<!-- /.content -->

<?= $this->endSection() ?>