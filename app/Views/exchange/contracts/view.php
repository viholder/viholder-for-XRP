<?php
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
       <!--    --> 
       <div class=" card-widget widget-user" style="padding:15px;background:#efefef;" >

            <div style="display:flex;width:100%;">
                    <div style="width:80px;margin-right:5px;">  
                        <div id="contract_logo" class="elevation-2" style="width:70px;height:70px;border-radius:12%;overflow:hidden;background-image: url( <?php echo base_url()."/uploads/logos/";?><?php echo $contract['id'].".png"; ?> ); background-size:cover;">  </div>
                      </div>  
                      <div style="width:65%;margin-left:5px;">  
                      
                            <div style="font-size:19px;font-weight:300;line-height:18px;">  <span id="contract_type" ><?php echo strtoupper(lang('App.'.$contract['contract_type'])); ?> </span> | <span id="contract_sku" style="font-weight:800;"> <?php echo SKU_gen($contract["contract_name"], $contract["id"] , 2); ?> </span></div>  
                            <div id="contract_name" style="font-size:15px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;width:100%"><?php echo $contract['contract_name']; ?></div>
                            <div> <span id="contract_price" style="margin-right:0px;font-size:32px;line-height:28px;font-weight:800;"><?php echo $contract['unit_value']; ?></span> <span style="font-size:14px"><?php echo setting("base_currency"); ?></span></div> 

                        </div>
                        <div data-id="<?php echo $contract['id']; ?>" id="fav<?php echo $contract['id']; ?>" class="bt_favorite" style="font-size:14px;position: absolute;top: 10px;right: 10px;background: #2121;padding: 2px;border-radius:12%;cursor:pointer;color:red;">  
                          <i class="fas fa-star"></i>
                      </div>
                    
            </div>  

       </div>    

  <!--    --> 
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

<div class="row">
      <div class="col-md-8">

      <!-- Default card -->
        <div class="" style="overflow:hidden">
          <div class="card-header">
            <h3 class="card-title"><b><?php echo SKU_gen($contract["contract_name"], $contract["id"] , 2); ?> </b> <?php echo $contract["contract_name"]; ?>  </h3>
          </div>

           <div class="card-body">
 
 
                  <?php // var_dump($data); ?>

 

                      <?php //echo $contract["contract_description"]; ?>

                    <?php echo htmlspecialchars_decode(stripslashes($contract["contract_description"])); ?>

                      <?php 
                      /*
                      $contract['contract_excerpt'];
                      $contract['data'];
                      $contract['active'];
                      $contract['contract_address'];
                      $contract['network'];
                      $contract['total_tokens'];
                      $contract['ownerID'];
                      $contract['active'];
                      $contract['expiration_date'];
                      $contract['autorenew'];
                      $contract['is_smart_contract'];
                      $contract['is_fixed'];
                      $contract['contract_type'];
                      $contract['unit_value'];
                      $contract['valoration'];
                      $contract['roi'];
                      $contract['lifetime_days'];
                      $contract['starting_date'];
                      $contract['expires'];
                      $contract['timestamp'];
                      */
                      ?>

                <div class="" style="display:flex;margin-bottom:0px;padding:5px;text-align:center;justify-content: space-around">  
                    <div style="cursor:pointer;color:#fff" class="btn_agreement btn btn-danger" data-id="<?php echo $contract["id"];?>">  <?php echo "*".lang('App.contract_agreement'); ?></div>
                 </div>

        </div>
      <!-- /.card -->
      </div>
  </div>


 

   
 

 
      <div class="col-md-4">

          <div class=" card-widget widget-user elevation-2"  >
              <!--RIBON    -->
              <?php if ($contract['active']=="-1"){  ?>
                     <div class="ribbon-wrapper ribbon-lg" style="top: 45px;";>
                        <div class="ribbon bg-warning">
                         Closing...
                        </div>
                      </div>
              <?php } ?>
 
              

               <div class="widget-user-header" style="display:flex;width:100%;height:45px;background:#fff;padding:3px;">
                           <div style="min-width:40px;text-align:left">
                              <div  style="margin:3px;width:32px;height:32px;display:inline-block;overflow:hidden;min-width:32px">
                                  <div class="img-circle"  style="width:32px;height:32px;background-image:url('<?php echo userProfile($contract["ownerID"]); ?>'); background-repeat: no-repeat;background-size: 32px 32px;"></div> 
                              </div> 
                           </div> 
                           <div style="width:50%;text-align:left;padding-top:8px;">
                               <?php echo model('App\Models\UserModel')->getRowById($contract["ownerID"],"name"); ?>  
                          </div>
                          <div style="width:50%;text-align:right;padding-top:8px;padding-right:5px;color:#7a7a7a;">
                            <?php echo "<small class='badge badge-primary' style='padding:4px;'><i class='far fa-clock'></i> ".strtoupper(lang('App.'.$contract['contract_type']))." </small>"; ?>  
                            <?php echo "<small data-id='".$contract["id"]."' class='badge   bt_favorite ".is_favorite($contract["id"])."' style='cursor:pointer;text-align:center;color:#b1b1b1;padding:4px;background:#ededed;' title='Favorite' > <i class='fas fa-star'></i> </small>"; ?>  
                          </div>
                </div>
              
                       <div class="" style="height:160px;overflow:hidden;padding:0px;background: url('<?php echo base_url()."/uploads/headers/".$contract["id"];?>.png') top center;background-size:cover;background-color:<?php echo stringToColorCode($contract["contract_name"]); ?>">
                              <div class="widget-user-header text-white" style="position:absolute;top:45px;height:135px;width:100%;display:block;background-image: linear-gradient(to top, rgba(0,0,0,.0), rgba(0,0,0,.6));">  </div>
                       </div>
                            <h3 class="widget-user-username text-white" style="text-shadow: black 0.1em 0.1em 0.2em;font-size:19px;font-weight:400;width:100%;position:absolute;top:45px;padding:15px;text-align:center;width:100%;padding:15px;"><b><?php  echo $contract["contract_name"]; ?> </b></h3>
                        <div class="widget-user-image" style="top:140px;width:60px;">
                           <div class="img-circle elevation-2"  style="border-radius:12%;background-color:#efefef;width:90px;height:90px;background-image:url('<?php echo base_url()."/uploads/logos/".$contract["id"];?>.png'); background-repeat: no-repeat;background-size:contain;background-position:center;border:2px solid #fff;"></div> 

                        </div>

                       <div class="card-footer card-footer-contract" style="padding-bottom:2px;padding-top: 23px;background-color:#fff;">
                               <div class="row">
                                  <div class="col-sm-4 border-right contract-listed" style="width:33%;height:60px;">
                                    <div class="description-block">
                                      <h5 class="description-header-contracts"><b><?php  echo abbreviateNumber($contract["target"]); ?> </b></h5>
                                      <span class="description-text-contracts"><?php echo lang('App.target') ?></span>
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-4 border-right contract-listed" style="width:33%;height:60px;">
                                    <div class="description-block">
                                      <h5 class="description-header-contracts"><b><?php  echo abbreviateNumber($contract["invested"]);  ?></b></h5>
                                      <span class="description-text-contracts"><?php echo lang('App.invested') ?></span>
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-4 contract-listed" style="width:33%;height:60px;">
                                    <div class="description-block">
                                      <h5 class="description-header-contracts"><b> <?php  echo $contract["roi"];  ?>% *</b></h5>
                                      <span class="description-text-contracts"><?php echo lang('App.roi') ?></span>
                                    </div>
                                    <!-- /.description-block -->
                                 </div>
                              <!-- /.info-box-content -->
                            </div>
                            
                       <!-- /.col -->
                      
                       </div>            
                  
                <div class="" style="margin-bottom:0px;">  <!-- Start contract exrept --> 
                     <div class="description-text" style="padding:12px;"> <?php  echo $contract["contract_excerpt"]; ?>  </div>
                
                
<!-- /////////////////////////////////////// -->
       <div style="width:100%;display:block;height:auto;position:relative;margin-bottom:25px;margin-top:35px;"> 
                
                <div style="width:100%;display:block;height:30px;position:relative;background-image: url(./assets/admin/img/diagonal.jpg);background-repeat;repeat;background-size: 70px 70px;  animation: animatedBackground 5s linear infinite; -webkit-animation: animatedBackground 5s linear infinite;"> 
                      <div style="width:100%;background-color:#212121;display:block;height:30px;position:absolute;top:0px;opacity:.4;"> </div>
                    
                      <div style="width:<?php echo $contract['dedlines']['end_funding'];?>%;background:yellow;display:block;height:30px;position:absolute;top:0px;opacity:.8"> </div>
                      <div style="width:<?php echo $contract['dedlines']['end_funding'];?>%;display:block;height:45px;position:absolute;top:0px;border-right:2px solid yellow;"> </div>  
                      <div style="padding-left:<?php echo $contract['dedlines']['end_funding'];?>%;left:-20px;display:block;position:absolute;top:38px; font-size:12px;"><div style="background:yellow;color:black;padding-left:4px;padding-right:4px;font-weight: 500;  border-radius: 25px;"> <?php echo  strtoupper(lang('App.funding_deadline')); ?></div> </div>  

                      <div style="width:<?php echo $contract['dedlines']['percent_to_expire'];?>%;background:red;display:block;height:30px;position:absolute;top:0px;opacity:.8"> </div>
                      <div style="width:<?php echo $contract['dedlines']['percent_to_expire'];?>%;display:block;height:45px;position:absolute;top:-15px;border-right:2px solid red;"> </div>  
                      <div style="padding-left:<?php echo $contract['dedlines']['percent_to_expire'];?>%;left:-20px;display:block;position:absolute;top:-25px;font-size:12px;"> <div style="background:red;color:#fff;padding-left:4px;padding-right:4px; font-weight: bold; border-radius: 25px;"><b>  <?php echo  strtoupper(lang('App.today')); ?></b> </div>  </div>  
        

                </div>
                
        </div>
<!-- /////////////////////////////////////// -->

<ul class="nav flex-column"  >
            <li class="nav-item" style="border-bottom: 1px solid rgba(0,0,0,.125);">
              <a href="#" class="nav-link">
              <?php echo lang('App.followers'); ?>  <span class="float-right badge bg-primary"><?php echo $contract['followers']; ?></span>
              </a>
            </li>
            <li class="nav-item"  style="border-bottom: 1px solid rgba(0,0,0,.125);">
              <a href="#" class="nav-link">
              <?php echo lang('App.investors'); ?>  <span class="float-right badge bg-info"><?php echo $contract['investors']; ?></span>
              </a>
            </li>
            <li class="nav-item"  style="border-bottom: 1px solid rgba(0,0,0,.125);">
              <a href="#" class="nav-link">
              <?php echo lang('App.end_funding'); ?>  <span class="float-right badge " style="background:yellow;color:black;">

                      <?php  $fecha = substr($contract['lifetime_days'], 0, 10); ?>
                      <div  data-life="<?php echo $date =date("M d, Y",$fecha); ?>" id="life<?php echo $fecha; ?>"> <?php echo date("M d, Y",$fecha) ?> </div>
  
               </span>
              </a>
            </li>
            <li class="nav-item" >
              <a href="#" class="nav-link">
              <?php echo lang('App.expires'); ?>  
               <span class="float-right badge bg-secondary"> 
                      <?php $fecha = substr($contract['expiration_date'], 0, 10); ?>
                      <div  data-exp="<?php echo $date =date("M d, Y",$fecha); ?>" id="exp<?php echo $fecha ?>"> <?php echo date("M d, Y",$fecha) ?> </div>
               </span>
              </a>
            </li>
          </ul>
<!-- /////////////////////////////////////// -->


                
                
                </div>   <!-- END contract exrept -->
                
                 
                 <div class="" style="display:flex;margin-bottom:0px;padding:5px;">  
                      
                        
                      <div style="width:100%;margin:3px;" >
                         <button class="btn_invest btn btn-block btn-danger" type="button" id="<?php echo $contract["id"];?>"> <?php echo lang('App.invest') ?>  </button>    
                      </div> 
                 </div> 
                 <div class="" style="display:flex;margin-bottom:0px;padding:5px;text-align:center;justify-content: space-around">  
                    <div style="cursor:pointer;color:#007bff" class="btn_agreement" data-id="<?php echo $contract["id"];?>">  <?php echo "*".lang('App.contract_agreement'); ?></div>
                 </div>
            </div>
     <!-- /.card-body -->

       
     




  </div>
          
             
</div>
<?= $this->include("exchange/modal_agreements") ?>

<?php   echo view('exchange/modal_open_position'); ?>


</section>
<!-- /.content -->

<?= $this->endSection() ?>