<?php
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo lang('App.market') ?></h1>
      </div>
      <div class="col-sm-6">
       
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <!-- Default card -->
  <div class="card">
    <div class="card-header with-border">
      <h3 class="card-title"><?php echo lang('App.market') ?></h3>
    </div>

    <div class="card-body">
 <?php 
 
 foreach ($pos as $row){  
 
 ?>
 
  <div style="width:280px;display:block;height:auto;position:relative;margin-bottom:15px;"> 
  <?php echo $row['ticker']; ?>
        <div style="width:100%;display:block;height:30px;position:relative;background-image: url(./assets/admin/img/diagonal.jpg);background-repeat;repeat;background-size: 70px 70px;  animation: animatedBackground 5s linear infinite; -webkit-animation: animatedBackground 5s linear infinite;"> 
              <div style="width:100%;background-color:#212121;display:block;height:30px;position:absolute;top:0px;opacity:.4"> </div>
             
              <div style="width:<?php echo $row['dedlines']['end_funding'];?>%;background:yellow;display:block;height:30px;position:absolute;top:0px;opacity:.8"> </div>
              <div style="width:<?php echo $row['dedlines']['end_funding'];?>%;display:block;height:45px;position:absolute;top:0px;border-right:2px solid yellow;"> </div>  
              <div style="left:<?php echo $row['dedlines']['end_funding'];?>%;display:block;position:absolute;top:30px;border:2px dotten red;font-size:12px;padding-left:5px;"> <?php echo  strtoupper(lang('App.funding_deadline')); ?> </div>  

              <div style="width:<?php echo $row['dedlines']['percent_to_expire'];?>%;background:red;display:block;height:30px;position:absolute;top:0px;opacity:.8"> </div>
              <div style="width:<?php echo $row['dedlines']['percent_to_expire'];?>%;display:block;height:45px;position:absolute;top:-15px;border-right:2px solid red;"> </div>  
              <div style="left:<?php echo $row['dedlines']['percent_to_expire'];?>%;display:block;position:absolute;top:-18px;border:2px dotten red;font-size:12px;padding-left:5px;background:#fff;"> <?php echo  strtoupper(lang('App.today')); ?> </div>  
 

        </div>
</div>
 
<?php } ?>
    <!-- /.card-body -->
    </div>
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->

<?= $this->endSection() ?>