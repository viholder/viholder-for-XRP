<?php
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
        <section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-2">
        <h1><?php echo lang('App.contracts') ?></h1>
      </div>
              <div class="col-sm-10  page-vh-menu">

              <?= $this->include("admin/layout/partials/contracts-menu") ?>
               </div> 
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
   
<div class="row">

  <?php foreach ($contracts["val"] as $row):  
    
    if (getUserlang()=="en"){

        if ($row["contract_name_en"]!=null){
            $row['contract_name']=htmlspecialchars_decode(stripslashes($row['contract_name_en']));
        }
        if ($row['contract_excerpt_en']!=null){
            $row['contract_excerpt']=htmlspecialchars_decode(stripslashes($row['contract_excerpt_en']));
        }
        if ($row['contract_description_en']!=null){
            $row['contract_description']=htmlspecialchars_decode(stripslashes($row['contract_description_en']));
        }
    }
    
  ?>  
  <!-- Default card -->
 
  <div class="col-md-4">
             <div class=" card-widget widget-user elevation-2"  >
              <!--RIBON    -->
              <?php if ($row['active']=="-1"){  ?>
                     <div class="ribbon-wrapper ribbon-lg" style="top: 45px;";>
                        <div class="ribbon bg-warning">
                         Closing...
                        </div>
                      </div>
              <?php } ?>
 
              

               <div class="widget-user-header" style="display:flex;width:100%;height:45px;background:#fff;padding:3px;">
                           <div style="min-width:40px;text-align:left">
                              <div  style="margin:3px;width:32px;height:32px;display:inline-block;overflow:hidden;min-width:32px">
                                <a href="<?php echo url('users/view/').$row["ownerID"] ?>">   <div class="img-circle"  style="width:32px;height:32px;background-image:url('<?php echo userProfile($row["ownerID"]); ?>'); background-repeat: no-repeat;background-size: 32px 32px;"></div> </a>
                              </div> 
                           </div> 
                           <div style="width:50%;text-align:left;padding-top:8px; font-size:15px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;width:100%">
                           
                               <?php echo model('App\Models\UserModel')->getRowById($row["ownerID"],"name"); ?>  
                          </div>
                          <div style="width:50%;text-align:right;padding-top:8px;padding-right:5px;color:#7a7a7a;">
                            <?php echo "<small class='badge badge-primary' style='padding:4px;'><i class='far fa-clock'></i> ".strtoupper(lang('App.'.$row['contract_type']))." </small>"; ?>  
                            <?php echo "<small data-id='".$row["id"]."' class='badge   bt_favorite ".is_favorite($row["id"])."' style='cursor:pointer;text-align:center;color:#b1b1b1;padding:4px;background:#ededed;' title='Favorite' > <i class='fas fa-star'></i> </small>"; ?>  
                          </div>
                </div>
              
                       <div class="" style="height:160px;overflow:hidden;padding:0px;background: url('<?php echo base_url()."/uploads/headers/".$row["id"];?>.png') top center;background-size:cover;background-color:<?php echo stringToColorCode($row["contract_name"]); ?>">
                              <div class="widget-user-header text-white" style="position:absolute;top:45px;height:135px;width:100%;display:block;background-image: linear-gradient(to top, rgba(0,0,0,.0), rgba(0,0,0,.6));">  </div>
                       </div>
                            <h3 class="widget-user-username text-white" style="text-shadow: black 0.1em 0.1em 0.2em;font-size:19px;font-weight:400;width:100%;position:absolute;top:45px;padding:15px;text-align:center;width:100%;padding:15px;"><b><?php  echo strtoupper($row["contract_name"]); ?> </b></h3>
                        <div class="widget-user-image" style="top:140px;width:60px;">
                             <a href="<?php echo url('contracts/view/').$row["id"] ?>">     <div class="img-circle elevation-2"  style="border-radius:12%;background-color:#efefef;width:90px;height:90px;background-image:url('<?php echo base_url()."/uploads/logos/".$row["id"];?>.png'); background-repeat: no-repeat;background-size:contain;background-position:center;border:2px solid #fff;"></div> </a>
                        </div>

                       <div class="card-footer card-footer-contract" style="padding-bottom:2px;padding-top: 23px;background-color:#fff;">
                               <div class="row">
                                  <div class="col-sm-4 border-right contract-listed" style="width:33%;height:60px;">
                                    <div class="description-block">
                                      <h5 class="description-header-contracts"><b><?php  echo abbreviateNumber($row["target"]); ?> </b></h5>
                                      <span class="description-text-contracts"><?php echo lang('App.target') ?></span>
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-4 border-right contract-listed" style="width:33%;height:60px;">
                                    <div class="description-block">
                                      <h5 class="description-header-contracts"><b><?php  echo abbreviateNumber($row["invested"]);  ?></b></h5>
                                      <span class="description-text-contracts"><?php echo lang('App.invested') ?></span>
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-4 contract-listed" style="width:33%;height:60px;"">
                                    <div class="description-block">
                                      <h5 class="description-header-contracts"><b> <?php  echo $row["roi"];  ?>%</b>*</h5>
                                      <span class="description-text-contracts"><?php echo lang('App.roi') ?></span>
                                    </div>
                                    <!-- /.description-block -->
                                 </div>
                              <!-- /.info-box-content -->
                            </div>
                            
                       <!-- /.col -->
                      
                       </div>            
                <!-- /.row -->
                 
                <div class="" style="margin-bottom:0px;">  
                     <div class="description-text" style="padding:12px;"> <?php  echo $row["contract_excerpt"]; ?>  </div>
                 </div>   
                 <div class="" style="display:flex;margin-bottom:0px;padding:5px;">  
                      
                      <div style="width:85%;margin:3px;" >
                         <button class="btn btn-block btn-outline-danger" type="button" onclick="location.href='contracts/view/<?php echo $row['id']; ?>'"> <?php echo lang('App.more_info') ?> </button>
                      </div> 
                      <div style="width:85%;margin:3px;" >
                         <button class="btn_invest btn btn-block btn-danger" type="button" id="<?php echo $row["id"];?>"> <?php echo lang('App.invest') ?>  </button>    
                      </div> 
                      
                 </div> 
                 <div class="" style="display:flex;margin-bottom:0px;padding:5px;text-align:center;justify-content: space-around">  
                    <div style="cursor:pointer;color:#007bff" class="btn_agreement" data-id="<?php echo $row["id"];?>">  <?php echo "*".lang('App.contract_agreement'); ?></div>
                <?php // echo $row["visibility"]; ?>
                  </div>

            <!-- /.widget-user -->
          </div>
     <!-- /.card-body -->

  </div>
  <!-- /.card -->
                         
                                      
                                   
  <?php  endforeach;  ?>
   </div>
   <?= $this->include("exchange/modal_agreements") ?>

<?= $this->include("exchange/modal_open_position") ?>

 
  </section>
  
<?= $this->endSection() ?>

              
<?= $this->section('js') ?>
<script>

$(function () {

    

 

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

<?php   // echo view('exchange/modal_open_position'); ?>
 
 
 