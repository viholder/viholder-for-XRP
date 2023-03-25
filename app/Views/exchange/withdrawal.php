<?php
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-2">
        <h1><?php echo lang('App.funds_withdrawal') ?></h1>
      </div>
      <div class="col-sm-10  page-vh-menu">

      <?= $this->include("admin/layout/partials/menu-accounts") ?>
      </div> 
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

<div class="row">
  <?php 
  if ($accounts!=false){

   ?> <div class="col-sm-6">   <?php
    echo lang('App.select_an_account')."<br><br></div>" ;
   

    foreach ($accounts as $row): ?>
  
      <div class="col-md-12"  >
             <div   class="card-widget widget-user " style="padding:15px;background:#efefef;margin-bottom:10px;border-radius: 12px;" >
  
                  <div style="display:flex;width:100%;">
                            <?php /*
                              <div style="width:80px;margin-right:5px;cursor:pointer" data-id="<?php echo $row['id']; ?>" class="btn_contract" >  
                                 <div id="contract_logo" class="elevation-2" style="width:70px;height:70px;border-radius:12%;overflow:hidden;background-image: url( <?php echo base_url()."/uploads/logos/";?><?php echo $row['id'].".png"; ?> ); background-size:cover;">  </div>
                              </div>  
                              */ ?>
                              <div style="width:65%;margin-left:5px;cursor:pointer"  data-id="<?php echo $row->id; ?>" class="btn_withdrawal"  data-id="<?php echo  $row->id; ?>">  
                            
                                   <div   style="font-size:15px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;width:100%"> <?php echo lang('App.bank'); ?> | <?php echo $row->bank_name; ?></div>
                                  <div   style="font-size:15px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;width:100%"> <?php echo lang('App.account_number'); ?> | <?php echo $row->number; ?></div>
                                  <div   style="font-size:15px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;width:100%"> CLABE | <?php echo $row->clabe; ?></div> 
                                  <div   style="font-size:15px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;width:100%"> IBAN | <?php echo $row->iban; ?></div>
                                  <div   style="font-size:15px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;width:100%"> BIC/SWIFT| <?php echo $row->bicswift; ?></div>

   
                              </div>
                              
                              <div data-id="<?php echo $row->id; ?>"  class="btn_delete_bank_account" style="font-size:14px;position: absolute;top: 10px;right: 10px;padding: 2px;border-radius:12%;cursor:pointer;">  
                                 <i class="fas fa-trash"></i>
                              </div>
                              <div data-id="<?php echo $row->id; ?>"  class="btn_withdrawal btn btn-primary" style="font-size:14px;position: absolute;bottom: 10px;right: 10px;padding: 5px;cursor:pointer;">  
                                 <?php echo lang('App.select'); ?>
                              </div>
                             
                          
                  </div>  
   
                         
            </div>
       </div> 
                              
      <?php  endforeach;  
      
      }else{  

     // NO BANK ACCOUNTS
  
     ?> 
        <br> <br>
        <div style="width:100%;text-align:center;"> 
            <?php echo lang("App.currently_dont_have_any_bank_account"); ?>
            <br> <br>
            <div class="btn-secondary btn_new_bank_account"  style="height:40px;width: 200px;margin:auto;padding: 7px;"> 
                <?php echo lang("App.add_new_bank_account");?>
            </div>  
      </div>

     <?php  } ?>

    
 
      </div>
  <?php  echo view('exchange/modal_new_bank_account'); ?>
  <?php  echo view('exchange/modal_withdrawal'); ?>

</section>
<!-- /.content -->

<?= $this->endSection() ?>