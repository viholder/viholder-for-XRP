<?php
 
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>

 <!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
     <h1> <?php echo lang('App.agreements'); ?> </h1>
      </div>
      <div class="col-sm-6">
      <?= $this->include("admin/layout/partials/menu-agreements") ?>

      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

 


<!-- Main content -->
<section class="content">
<div class="row">
  <?php 
  
  //echo var_dump($agreements);
  
  if ($agreements!=false){

   

    foreach ($agreements as $row): ?>

<div class="col-md-12"  >
             <div   class="card-widget widget-user " style="padding:15px;background:#efefef;margin-bottom:10px;border-radius: 12px;" >
  
                  <div style="display:flex;width:100%;">
                            <?php /*
                              <div style="width:80px;margin-right:5px;cursor:pointer" data-id="<?php echo $row['id']; ?>" class="btn_contract" >  
                                 <div id="contract_logo" class="elevation-2" style="width:70px;height:70px;border-radius:12%;overflow:hidden;background-image: url( <?php echo base_url()."/uploads/logos/";?><?php echo $row['id'].".png"; ?> ); background-size:cover;">  </div>
                              </div>  
                              */ ?>
                              <div style="width:65%;margin-left:5px;cursor:pointer"  data-id="<?php echo $row->id; ?>" class="btn_withdrawal"  data-id="<?php echo  $row->id; ?>">  
                            
                                   <div   style="font-size:15px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;width:100%">  <?php echo $row->contractID; ?> |
                                    <?php  $contractName = model('App\Models\ContractModel')->getById($row->contractID);
                                    if($contractName){   echo $contractName['contract_name']; } ?> 
      </div>
        
   
                              </div>
                               
                              <div class="btn_delete_bank_account" style="font-size:14px;position: absolute;top: 10px;right: 10px;padding: 2px;border-radius:12%;cursor:pointer;">  
                                  <div  data-id="<?php echo $row->contractID ;?>" class="btn_agreement_edit btn btn-sm btn-info" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></div>

                                 <div  data-id="<?php echo $row->contractID ;?>" class="btn_agreement btn btn-sm btn-info" title="Ver" data-toggle="tooltip"><i class="fa fa-eye"></i></div>
                                 <div class="btn btn-sm btn-danger delete" data-id="<?php echo $row->id; ?>" ><i class="fa fa-trash"></i></div>
                                 
                              </div>
                            
                              
                             
                          
                  </div>  
   
                         
            </div>
       </div> 
                              
      <?php  endforeach;  
      
      }else{  

     // NO Agreements
  
     ?> 
        <br> <br>
        <div style="width:100%;text-align:center;"> 
            <?php echo lang("App.currently_there_are_not_any_agreements"); ?>
            <br> <br>
            <div class="btn-secondary btn_new_agreement"  style="height:40px;width: 200px;margin:auto;padding: 7px;"> 
                <?php echo lang("App.add_new_agreement");?>
            </div>  
      </div>

     <?php  } ?>

     <?= $this->include("exchange/modal_select_contract") ?>

     <?= $this->include("exchange/modal_agreements") ?>
      

  </section>
  
<?= $this->endSection() ?>
<?= $this->section('js') ?>

 <script>
 $(function () { 
 


  $(document).on('click', '.delete', function(){ 
  

     
    agreement_ID= $(this).data('id'); 
            
            Swal.fire({
              title: '<?php echo "¿".lang('App.delete_contract'); ?>?',
              text: "<?php echo lang("App.you_wont_be_able_to_revert_this"); ?>",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: '<?php echo lang('App.yes_delete_it'); ?>',
              cancelButtonText: '<?php echo lang('App.cancel'); ?>'
            }).then((result) => {
              if (result.isConfirmed) {
                
                  window.location.href = "<?php echo url('agreements/delete/'); ?>"+agreement_ID
              }
            })
      })

 

})

$(function () {
    $('.select2').select2()
    $("#filter_select").css("display", "block")
 })

 
</script>
  
 ?>
 <?= $this->endSection('js') ?>