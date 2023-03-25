<?php
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
 <section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-2">
        <h1><?php echo lang('App.market') ?></h1>
      </div>
              <div class="col-sm-10  page-vh-menu">

              <?= $this->include("admin/layout/partials/market-menu") ?>
               </div> 
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
   
<div class="row">

  <?php foreach ($contracts["val"] as $row):   ?>  
  
    <div class="col-md-4"  >
           <div   class="card-widget widget-user" style="padding:15px;background:#efefef;" >

                <div style="display:flex;width:100%;">
                          
                            <div style="width:80px;margin-right:5px;cursor:pointer" data-id="<?php echo $row['id']; ?>" class="btn_contract" >  
                               <div id="contract_logo" class="elevation-2" style="width:70px;height:70px;border-radius:12%;overflow:hidden;background-image: url( <?php echo base_url()."/uploads/logos/";?><?php echo $row['id'].".png"; ?> ); background-size:cover;">  </div>
                            </div>  
                            <div style="width:65%;margin-left:5px;cursor:pointer"  data-id="<?php echo $row['id']; ?>" class="btn_contract" >  
                          
                                <div style="font-size:19px;font-weight:300;line-height:18px;">  <span id="contract_type" ><?php echo strtoupper(lang('App.'.$row['contract_type'])); ?> </span> | <span id="contract_sku" style="font-weight:800;"> <?php echo  SKU_gen($row['contract_name'],$row['id'],2); ?> </span></div>  
                                <div id="contract_name" style="font-size:15px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;width:100%"><?php echo $row['contract_name']; ?></div>
                                <div> <span id="contract_price" style="margin-right:0px;font-size:32px;line-height:28px;font-weight:800;"><?php echo $row['unit_value']; ?></span> <span style="font-size:14px"><?php echo setting("base_currency"); ?></span></div> 

                            </div>
                            
                            <div data-id="<?php echo $row['id']; ?>"  class=" bt_favorite <?php echo is_favorite($row["id"]);?>" style="font-size:14px;position: absolute;top: 10px;right: 10px;background: #2121;padding: 2px;border-radius:12%;cursor:pointer;">  
                              <i class="fas fa-star"></i>
                           </div>
                           
                        
                </div>  
 
                       
          </div>
     </div> 
                         
                                      
                                   
    <?php  endforeach;  ?>
 
 </div> 
</section>
  
<?= $this->endSection() ?>

              
<?= $this->section('js') ?>
<script>

$(function () {

    
  $(document).on('click','.btn_contract',function(event) {
    var contractID=$(this).data("id")
     var clicked=this;
     location.href = "contracts/view/"+contractID;
  });

 

 $(document).on('click','.bt_favorite',function(event) {
    var favID=$(this).data("id")
     var clicked=this;
     $(clicked).toggleClass("isfavorite");

     var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "favID":favID};

          $.ajax({
              url: "<?php  echo url("monitor/set_favorite");?>",
              type: "POST",
              cache: false,
              "data": data,  
              success: function(data){
                 
               // $(clicked).css("background-color", "#dc3545")
              }

          });


 });

  

})

$(function () {
    $('.select2').select2()
    $("#filter_select").css("display", "block")

 })

</script>
<?= $this->endSection('js') ?>

<?php   echo view('exchange/modal_open_position'); ?>


