<?php
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>
 
<!-- Content Header (Page header) -->
 

  <section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-2">
        <h1><?php echo lang('App.edit_contract') ?></h1>
      </div>
              <div class="col-sm-10  page-vh-menu">

              <?= $this->include("admin/layout/partials/contracts-menu") ?>

              </div> 
    </div>
  </div>
</section>


<?php
 

   if (isset($error )){  
    
      foreach ($error["errors"] as $key => $value):
      
       echo '<script>   $(function () {     
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 15000
        });
       
        $(document).Toasts("create", {
          class: "bg-warning", 
          icon: "warning",
          title: "'.lang('App.attention').'",
          subtitle: "",
          body: "'.$value.'"
        })

      $("#'.$key.'").css("background","#fffcc2");
    })  
      </script>  
   
    ';
    endforeach;
  }
?>
 

<?php if (isset($_POST['contract_start_date_input'])){  
    
    $start_date_is= date("d/m/Y", substr($_POST['contract_start_date_input'], 0, 10)); 
    
    }else{ $start_date_is= date("d/m/Y"); }; 
?>

<?php if (isset($_POST['contract_duration_input'])){  
    
    $duration_date_is= date("d/m/Y", substr($_POST['contract_duration_input'], 0, 10)); 
    
    }else{ $duration_date_is= date("d/m/Y"); }; 
?>
 

<?php if (isset($_POST['contract_exp_date_input'])){  
    
    $expiration_date_is= date("d/m/Y", substr($_POST['contract_exp_date_input'], 0, 10)); 
    
    }else{ $expiration_date_is= date("d/m/Y"); }; 

?>
 

 <!-- IS EDIT -->
 <?php if (isset($contract['starting_date'])){  
    
    $start_date_is= date("d/m/Y", substr($contract['starting_date'], 0, 10)); 
    
    }else{ $start_date_is= date("d/m/Y"); }; 
?>

<?php if (isset($contract['lifetime_days'])){  
    
    $duration_date_is= date("d/m/Y", substr($contract['lifetime_days'], 0, 10)); 
    
    }else{ $duration_date_is= date("d/m/Y"); }; 
?>
 

<?php if (isset($contract['expiration_date'])){  
    
    $expiration_date_is= date("d/m/Y", substr($contract['expiration_date'], 0, 10)); 
    
    }else{ $expiration_date_is= date("d/m/Y"); }; 

?>
 
 
 
 

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
 
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo lang('App.contract') ?> <?php echo lang('App.settings') ?></h3>

                <div class="card-tools">
                   
                </div>
              </div>

            
              <div class="card-body p-0">

<?php echo form_open_multipart('contracts/update', [ 'class' => 'form-validate' ]); ?>


                <ul class="nav nav-pills flex-column">
                    <li class="nav-item contract-item">
                        <div class="nav-link">
                          <i class="fas fa-filter"></i> <?php echo lang('App.type') ?>
                          <span class="float-right">
                           <select class="form-select"  id="contract-type" name="contract_type">
                                  <option value="future" selected ><?php echo lang('App.future') ?></option>
                                  <option value="IPO" ><?php echo lang('App.ipo') ?></option>
                                  <option value="crowdfunding">Crowdfunding</option>
                                  <option value="token">Token</option>
                                  <option value="loan">Loan</option>
                                  <option value="DAO">DAO</option>
                            </select>
                            <i class="fas fa-info-circle" style="color:blue"></i>
                             
                          </span>
                        </div>
                      </li>

                  <li class="nav-item contract-item">
                    <div class="nav-link">  
                     <i class="fas fa-comment-dollar"></i> <?php echo lang('App.unit_value') ?> 
                      <span class="float-right">
                         <input id="contract-und-value" name="contract-und-value" type="text" aria-label="contract-und-value" aria-describedby="contract-und-value" style="width:105px;text-align:right" >
                         <i class="fas fa-info-circle" style="color:blue"></i>
                       </span>
                    </div>  
                 </li>
                   <li class="nav-item  contract-item">
                    <div class="nav-link">
                    <i class="fas fa-coins"></i> <?php echo lang('App.units') ?>
                      <span class="float-right">
                         <input id="contract-units" name="contract-units" type="text" aria-label="contract-units" aria-describedby="contract-units" style="width:105px;text-align:right">
                         <i class="fas fa-info-circle" style="color:blue"></i>

                        </span>
                    </div>
                  </li>

                  <li class="nav-item contract-item">
                    <div class="nav-link">
                      <i class="fas fa-calendar contract_start_date_box"></i> <?php echo lang('App.start_date') ?>
                      <span class="float-right">
                         <button id="contract_start_date" name="contract_start_date" type="button" class="btn btn-primary btn-sm daterange"   data-toggle="tooltip" title="start date">
                         <input type="hidden" id="contract_start_date_input" name="contract_start_date_input"   value="<?php if (isset($_POST['contract_start_date_input'])){ echo $_POST['contract_start_date_input'];}else{ echo time(); } ?>" />
                         <i class="far fa-calendar-alt"></i>
                          </button>
                          <i class="fas fa-info-circle" style="color:blue"></i>
                      </span>
                    </div>
                  </li>

                  <li class="nav-item contract-item" id="contract_exp_date_box">
                       <div class="nav-link">
                            <i class="fas fa-calendar"></i> <?php echo lang('App.expiration_date') ?>  
                              <span class="float-right">
                              <button id="contract_exp_date" name="contract_exp_date" type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="contract_exp_date" value="" >
                              <input type="hidden" id="contract_exp_date_input" name="contract_exp_date_input" value="<?php if (isset($_POST['contract_exp_date_input'])){ echo $_POST['contract_exp_date_input'];}else{  echo time(); }?>" />

                              <i class="far fa-calendar-alt"></i>
                                </button>
                                <i class="fas fa-info-circle" style="color:blue"></i>

                            </span>
                      </div>
                  </li>

                  <li class="nav-item contract-item" style="display:none">>
                    <div class="nav-link">
                      <i class="fas fa-unlock"></i> <?php echo lang('App.expires') ?>
                      <span class="float-right">
                           <select class="form-select" id="contract-expires" name="contract-expires">
                              <option value="0" selected><?php echo lang('App.no') ?></option>
                              <option value="1"><?php echo lang('App.yes') ?></option>
                          </select>
                          <i class="fas fa-info-circle" style="color:blue"></i>

                      </span>
                    </div>
                  </li>
                   
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

             
    <!-- CARD -->
    <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo lang('App.behavior') ?>  </h3>

                <div class="card-tools">
                  
                </div>
              </div>

        
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">

                <li class="nav-item contract-item">
                    <div class="nav-link">
                     <i class="fas fa-chart-bar"></i></i> <?php echo lang('App.valoration_type') ?>  
                      <span class="float-right">
                              <select class="form-select" id="contract-valoration" name="contract-valoration">
                              <option value="fixed" selected><?php echo lang('App.fixed') ?></option>
                              <option value="market"><?php echo lang('App.market') ?></option>
                              <option value="progress"><?php echo lang('App.progressive') ?></option>
                              <option value="oracle"><?php echo lang('App.oracle') ?></option>
                            </select>
                            <i class="fas fa-info-circle" style="color:blue"></i>

                      </span>
                    </div>
                  </li>

                        <li class="nav-item  contract-item">
                          <div class="nav-link">
                            <i class="fas fa-clock"></i> <?php echo lang('App.funding_deadline') ?>
                            <span class="float-right">
                              <button id="contract_duration" name="contract_duration" type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="funding_deadline">
                              <input type="hidden" id="contract_duration_input" name="contract_duration_input" value="<?php if (isset($_POST['contract_duration_input'])){ echo $_POST['contract_duration_input'];}else{  echo time(); } ?>" />
                              <i class="far fa-calendar-alt"></i>
                                </button>
                                <i class="fas fa-info-circle" style="color:blue"></i>

                            </span>
                          </div>
                        </li>

                        

 

 
                      
                        <li class="nav-item contract-item">
                          <div class="nav-link">
                            <i class="fas fa-undo"></i> <?php echo lang('App.fixed-funding') ?>
                            <span class="float-right">
                                <select class="form-select" id="contract-fixed-funding" name="contract-fixed-funding">
                                    <option value="0" selected><?php echo lang('App.no') ?></option>
                                    <option value="1"><?php echo lang('App.yes') ?></option>
                                </select>
                                <i class="fas fa-info-circle" style="color:blue"></i>

                            </span>
                          </div>
                        </li>
                         
                        <li id="autorenwebox" class="nav-item contract-item" style="display:none">
                          <div  class="nav-link">
                            <i class="fas fa-sync-alt"></i> <?php echo lang('App.autorenew') ?>  
                            <span class="float-right">
                                <select class="form-select" id="contract-autorenew" name="contract-autorenew">
                                    <option value="0"  ><?php echo lang('App.no') ?></option>
                                    <option value="1" selected><?php echo lang('App.yes') ?></option>
                                </select>
                                <i class="fas fa-info-circle" style="color:blue"></i>

                            </span>
                          </div>
                        </li>



                       </ul>
</div>
</div>
 


          
            <div class="card">
                  <div class="card-header">
                       <h3 class="card-title"><?php echo lang('App.investment_return') ?> </h3>
                      <div class="card-tools">
                      </div>
                  </div>
                      <ul class="nav nav-pills flex-column">
                            <li class="nav-item contract-item">
                                <div class="nav-link">  
                                     <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">ROI</span>
                                          </div>
                                          <input type="text" class="form-control" id="contract_roi" name="contract_roi" style="text-align:right">
                                          <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                          </div>
                                    </div>
                                </div>  
                            </li>
                      </ul>
             </div>
            
               <!-- CARD -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo lang('App.advanced') ?>   </h3>

                <div class="card-tools">
                  
                </div>
              </div>

        
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                
                    <li class="nav-item contract-item">
                              <div  class="nav-link">
                                <i class="fas fa-layer-group"></i> <?php echo lang('App.createsmartcontract') ?>  
                                <span class="float-right">
                                    <select class="form-select" id="create-smartcontract" name="create-smartcontract">
                                        <option value="0" selected><?php echo lang('App.no') ?></option>
                                        <option value="1"><?php echo lang('App.yes') ?></option>
                                    </select>
                                    <i class="fas fa-info-circle" style="color:blue"></i>

                                </span>
                              </div>
                     </li>

                      

                    <li class="nav-item contract-item" id="contract-network-box" style="display:none">
                          <div class="nav-link">
                          <i class="fas fa-cubes"></i> Network    
                            <span class="float-right">
                                  <select class="form-select" id="contract-network" name="contract-network">
                                    <option value="ripple" selected>Ripple</option>
                                    <option value="ethereum" selected>Ethereum</option>
                                    <option value="smartchain">Smart Chain</option>
                                    <option value="ethereum_testnet">Testnet</option>
                                  </select>
                            </span>
                          </div>
                     </li>
                      
                </ul>
              </div>
              <!-- /.card-body -->
       </div>
<!-- /.card -->
<!-- card -->
      <div class="card">
                 <div class="card-header">
                      <h3 class="card-title"><?php echo lang('App.visual_identity'); ?></h3>
                 </div>          
                 <div class="card-body p-0">
                 
                      <ul class="nav nav-pills flex-column">
                          <div class="nav-link">
                          <li class="nav-item ">
                          <div class="form-group">
                                Logo 
                                  <div class="custom-file">
                                    <input type="file" class="form-control" name="contract-logo-image" id="contract-logo-image" placeholder="<?php echo lang('App.user_upload_image') ?>" accept="image/*" >
                                    <label class="custom-file-label" for="contract-logo-image"><?php echo lang('App.chose_file') ?>  </label>
                                  </div>
                               
                              <div class="form-group" id="imagePreview" style="margin-top:10px;">
                                <img src="" class="preview-logo" alt="" width="100" height="100">
                              </div>
                            </li>
                          </div>
                          <div class="nav-link">
                            <li class="nav-item ">
                                <?php echo lang('App.header'); ?>  
                               <div class="custom-file">
                               <input type="file" class="form-control"  name="contract-header-image"   id="contract-header-image" placeholder="<?php echo lang('App.user_upload_image') ?>"  accept="image/*" >
                                  <label class="custom-file-label" for="contract-header-image"><?php echo lang('App.chose_file') ?>  </label>  
                              </div>
                              <div class="form-group" id="imagePreviewHeader" style="margin-top:10px;">
                                   <img src="" class="preview-header" alt="" width="100" height="100">
                              </div>
                          </li>  
                          </div>  
                      </ul>  
                 </div>               
       </div>     
<!-- /.card -->
</div>

 
                             
      



          <div class="col-md-9">

          <div class="row">
              
         



          



          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
              <h3 style="padding:0px;margin-bottom:1px;"> <b><span id="dashboard_start_date_days" style="font-size: 33px;padding:0px;margin:0px">  0 </span><sup style="font-size: 14px"> <?php echo lang('App.days'); ?><span id="indicahoy"></span> </sup> 
 </span></b></h3> <b> <span id="dashboard_start_date" style="font-size: 20px;width:100%;display:block;line-height: .9;"> <?php if (isset($_POST['contract_start_date_input'])){   echo date("d/m/Y", substr($_POST['contract_start_date_input'], 0, 10));  }else{ echo date("d/m/Y"); }; ?>  </span></b>
                </div>
              <div class="icon"></div>
              <a  href="#"  id="cash-modal-info-btn" class="small-box-footer">  <?php echo lang('App.start_date') ;?></a>
            </div>
          </div>


          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
              <h3 style="padding:0px;margin-bottom:1px;"><b><span id="dashboard_duration_founding_days" style="font-size: 33px;padding:0px;margin:0px"> 0 </span><sup style="font-size: 14px"> <?php echo lang('App.days'); ?> </sup>
 </span></b></h3> <b><span id="dashboard_duration_founding" style="font-size: 20px;width:100%;display:block;line-height: .9;">  <?php if (isset($_POST['dashboard_duration_founding'])){   echo date("d/m/Y", substr($_POST['dashboard_duration_founding'], 0, 10));  }else{ echo date("d/m/Y"); }; ?>   </span></b>
              </div>
              <div class="icon"></div>
              <a  href="#"  id="cash-modal-info-btn" class="small-box-footer">  <?php echo lang('App.dashboard_duration_founding') ;?> </a>
            </div>
          </div>


          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
              <h3 style="padding:0px;margin-bottom:1px;"><b><span id="dashboard_total_duration_days" style="font-size: 33px;padding:0px;margin:0px"> 0 </span><sup style="font-size: 14px"> <?php echo lang('App.days'); ?> </sup>
 </span></b></h3> <b><span id="dashboard_contract_exp_date" style="font-size: 20px;width:100%;display:block;line-height: .9;">  <?php if (isset($_POST['dashboard_contract_exp_date'])){   echo date("d/m/Y", substr($_POST['dashboard_contract_exp_date'], 0, 10));  }else{ echo date("d/m/Y"); }; ?>   </span></b>
              </div>
              <div class="icon"></div>
              <a  href="#"  id="cash-modal-info-btn" class="small-box-footer"> <?php echo lang('App.expires_date') ;?></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <h3 style="padding:0px;margin-bottom:1px;"> <b><span id="dashboard_target" style="font-size: 33px;padding:0px;margin:0px">  1 </span><sup style="font-size: 14px"> <?php echo " ".setting("base_currency");?> </sup> </b></h3>

               <b> <span id="dashboard_target_und" style="font-size: 20px;width:100%;display:block;line-height: .9;"> <?php if (isset($_POST['contract-units'])){ echo $_POST['contract-units'];}else{echo "0";}; ?>/Und.</span></b>
                           </div>
              <div class="icon"></div>
              <a  href="#"  id="cash-modal-info-btn" class="small-box-footer">  <?php echo lang('App.target');?></a>
            </div>
          </div>

          
          </div>

       
                
                 

            


           
           

<!--  /DESCRIPTION -->
               

            <!-- / DESCRIPTION -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo lang('App.description') ?></h3>  
              </div>
              <!-- /.card-header -->
              <div class="card-body">
   
                <!--  TITLE -->
                <div class="input-group mb-3">
                    <span class="input-group-text" ><?php echo lang('App.title') ?> </span>
                    <input id="contract-title" name="contract-title" type="text" class="form-control" maxlength="100"  aria-label="contract-title" required >
                  </div> 

                  <!--  /EXCERPT  -->
                 <div class="input-group mb-3">
                    <span class="input-group-text" ><?php echo lang('App.excerpt') ?>  </span>
                    <textarea id="contract-excerpt" name="contract-excerpt"   class="form-control" maxlength="200"  required ></textarea>
                  </div> 
              


              <div class="form-group" style="">
                    <textarea id="compose-textarea"  name="compose-textarea" class="form-control" style="height: 100% !important">  </textarea>
                </div>  


                 
              </div>

              <!-- /.card-body -->

              <div class="card-footer">
                <div class="float-right">
                  <button type="button" id="draft-btn" class="btn btn-default"><i class="fas fa-pencil-alt"></i> <?php echo lang('App.draft') ?>  </button>
                <?php if  ($contract['edit']==true){  ?>
                  <button type="submit" id="submit-btn" class="btn btn-primary" style="width:150px;"><i class="fas fa-wrench"></i> <?php echo lang('App.update') ?> </button>
                <?php }else{ ?>
                  <button type="submit" id="submit-btn" class="btn btn-primary" style="width:150px;"><i class="fas fa-wrench"></i> <?php echo lang('App.create') ?> </button>
                <?php } ?>
                
               
                </div>
                    <div class="form-group">
                      <div class="btn btn-default btn-file">
                        <i class="fas fa-paperclip"></i> <?php echo lang('App.attachment') ?>   
                        <input type="file" name="attachment"  class="form-control"  >
                      </div>
                      <p class="help-block">Max. 32MB</p>
                    </div>
              </div>

              <input type="hidden" id="contract-active" name="contract-active" value="1" />

              <input type="hidden" id="contract_id" name="contract_id" value="<?php echo $contract['id']; ?>" />

              <?php echo form_close(); ?>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
         </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <?=  $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Summernote -->
<script src="<?php echo assets_url('admin') ?>/plugins/summernote/summernote-bs4.min.js"></script>


<!-- Page Script -->

<script>
    
$(function () {
    
/*//////////////// IMAGE SELECTION  ///////////////// */ 
      $('#contract-logo-image').change(function() {
          previewImage(this, '#imagePreview')
      }); 

      $('#contract-header-image').change(function() {
          previewImage(this, '#imagePreviewHeader')
      }); 

function previewImage(input, previewDom) {

      if (input.files && input.files[0]) {
 
          $(previewDom).show();

          var reader = new FileReader();

          reader.onload = function(e) {
              $(previewDom).find('img').attr('src', e.target.result);

              elsize = input.files[0].size

              eswidth=$(".img-circle").find('img').width();
              esheight =$(previewDom).height();
              console.log(esheight+" "+eswidth+" "+elsize )
          }

            reader.readAsDataURL(input.files[0]);

      }else{
      $(previewDom).hide();
      }     
}
 
/*////////////////  PUT VALUES  ///////////////// */ 

     
      $('#contract-title').val("<?php if (isset($_POST['contract-title'])){ echo $_POST['contract-title'];}; ?>")
      $('#contract-type').val("<?php if (isset($_POST['contract_type'])){ echo $_POST['contract_type'];}else{ echo "future"; }; ?>")
      $('#contract-valoration').val("<?php if (isset($_POST['contract-valoration'])){ echo $_POST['contract-valoration'];}else{ echo "fixed"; }; ?>")
      $('#contract-fixed-funding').val("<?php if (isset($_POST['contract-fixed-funding'])){ echo $_POST['contract-fixed-funding'];}else{ echo "0"; }; ?>")
      $('#contract-autorenew').val("<?php if (isset($_POST['contract-autorenew'])){ echo $_POST['contract-autorenew'];}else{ echo "0"; }; ?>")
      $('#contract_roi').val("<?php if (isset($_POST['contract_roi'])){ echo $_POST['contract_roi'];}else{ echo "0"; }; ?>")
      $('#create-smartcontract').val("<?php if (isset($_POST['create-smartcontract'])){ echo $_POST['create-smartcontract'];}else{ echo "0"; }; ?>")
      $('#contract-network').val("<?php if (isset($_POST['contract-network'])){ echo $_POST['contract-network'];}else{ echo "ethereum"; }; ?>")
      $('#contract-und-value').val("<?php if (isset($_POST['contract-und-value'])){ echo $_POST['contract-und-value'];}else{ echo "0"; }; ?>")
      $('#contract-units').val("<?php if (isset($_POST['contract-units'])){ echo $_POST['contract-units'];}else{ echo "0"; }; ?>")
      $('#contract-excerpt').html("<?php if (isset($_POST['contract-excerpt'])){ echo $_POST['contract-excerpt'];}; ?> ")
      $('#compose-textarea').html("<?php if (isset($_POST['compose-textarea'])){ echo $_POST['compose-textarea'];}; ?>")
 
     $('#contract-title').val("<?php if (isset($contract["contract_name"])){ echo $contract["contract_name"];} ?>")
     $('#contract-type').val("<?php if (isset($contract["contract_type"])){ echo $contract["contract_type"];} ?>")
     $('#contract-valoration').val("<?php if (isset($contract["valoration"])){ echo $contract["valoration"];} ?>")
     $('#contract-autorenew').val("<?php if (isset($contract["autorenew"])){ echo $contract["autorenew"];} ?>")
     $('#contract_roi').val("<?php if (isset($contract["roi"])){ echo $contract["roi"];} ?>")
     $('#create-smartcontract').val("<?php if (isset($contract['is_smart_contract'])){ echo $contract['is_smart_contract'];}; ?>")
     $('#contract-network').val("<?php if (isset($contract['network'])){ echo $contract['network'];} ?>")
     $('#contract-und-value').val("<?php if (isset($contract["unit_value"])){ echo $contract["unit_value"];} ?>");
     $('#contract-units').val("<?php if (isset($contract['total_tokens'])){ echo $contract['total_tokens'];} ?>")
     $('#contract-excerpt').html("<?php if (isset($contract['contract_excerpt'])){ echo $contract['contract_excerpt'];}; ?>")
  
     $('#contract_start_date_input').val(<?php if (isset($contract['starting_date'])){ echo $contract['starting_date'];}; ?>)
     $('#contract_exp_date_input').val(<?php if (isset($contract['expiration_date'])){ echo $contract['expiration_date'];}; ?>)
     $('#contract_duration_input').val(<?php if (isset($contract['lifetime_days'])){ echo $contract['lifetime_days'];}; ?>)

     
    $('#contract-fixed-funding').val("<?php if (isset($contract['is_fixed'])){ echo $contract['is_fixed'];} ?>")

      

      /*
     $('#contract-fixed-funding').click();
     $('#create-smartcontract').click();
     $('#contract_duration').click();

     */

      $(".preview-logo").attr('src', ' <?php echo url('uploads/logos/'); ?><?php if (isset($contract['id'])){ echo $contract['id'].".png";}; ?>');
      
/*////////////////  DESCRIPTION EDITOR  ///////////////// */ 
    
      var t = $('#compose-textarea').summernote({ height: 420,focus: false})  
    
      var content_html='<?php if (isset($contract['contract_description2'])){ echo html_entity_decode(htmlspecialchars_decode($contract['contract_description2']));}; ?>'  
       $('#compose-textarea').summernote('code', content_html);
    
    console.log(content_html);

/*//////////////// DATES  ///////////////// */
      var now = <?php echo $contract['starting_date'] ?> ;  
      var drafnow = <?php echo $contract['expiration_date']; ?>;
      var drafnowduration =<?php echo $contract['lifetime_days']; ?>
      
      var empieza = <?php echo $contract['starting_date'] ?> ; 
      var caduca = <?php echo $contract['expiration_date']; ?> //moment().add(365, 'days');;
      var fondeoDeadline =<?php echo $contract['lifetime_days']; ?>
     
      var localdata= { "format": "DD/MM/YYYY",
          "separator": " - ",
          "applyLabel": "<?php echo lang('App.apply') ?>", 
          "cancelLabel": "<?php echo lang('App.cancel') ?>",  
          "fromLabel": "<?php echo lang('App.from') ?>",  
          "toLabel": "<?php echo lang('App.to') ?>",  
          "customRangeLabel": "<?php echo lang('App.custom') ?>",
          "daysOfWeek": [
              "<?php echo lang('App.su') ?>",  
              "<?php echo lang('App.mo') ?>", 
              "<?php echo lang('App.tu') ?>", 
              "<?php echo lang('App.we') ?>", 
              "<?php echo lang('App.th') ?>",
              "<?php echo lang('App.fr') ?>", 
              "<?php echo lang('App.sa') ?>" 
          ],
          "monthNames": [
              "<?php echo lang('App.january') ?>",  
              "<?php echo lang('App.february') ?>", 
              "<?php echo lang('App.March') ?>", 
              "<?php echo lang('App.April') ?>", 
              "<?php echo lang('App.May') ?>", 
              "<?php echo lang('App.June') ?>", 
              "<?php echo lang('App.July') ?>", 
              "<?php echo lang('App.August') ?>", 
              "<?php echo lang('App.September') ?>", 
              "<?php echo lang('App.October') ?>", 
              "<?php echo lang('App.November') ?>", 
              "<?php echo lang('App.December') ?>" 
          ],
          "firstDay": 1
      }
  
       
 
 
      $('#contract_start_date').daterangepicker({
        startDate: "<?php echo $start_date_is; ?>",
        singleDatePicker: true,
        showDropdowns: true,
        autoApply: true,
        minDate: now,
        minYear: parseInt(moment().format('YYYY'),10),
        maxYear: 2030, 
        locale: localdata,
      }, function(start, end, label,picker) {
             totaldays=(  moment().diff(end, 'days'));
            $('#dashboard_start_date_days').html(Math.abs(totaldays))
            $('#indicahoy').html("")
            if (Math.abs(totaldays)==1){   $('#indicahoy').html(" <small class='badge badge-warning'><i class='far fa-clock'></i> <?php echo lang('App.tomorrow') ?></small>");}
            if (Math.abs(totaldays)==0){  $('#indicahoy').html(" <small class='badge badge-warning'><i class='far fa-clock'></i> <?php echo lang('App.today') ?></small>");}
             empieza = moment(end);
             dashboarupdate()
      });

       
      $('#contract_duration').daterangepicker({
        startDate: <?php if (isset($error )){ echo '"'.$duration_date_is.'"';}else{ echo '"'.$duration_date_is.'"';} ?>  ,
        singleDatePicker: true,
        showDropdowns: true,
        autoApply: true,
        minDate: now,
        minYear: parseInt(moment().format('YYYY'),10),
        maxYear: 2040, 
        locale: localdata,
      }, function(start, end, label,picker) {
        totaldays=(  moment().diff(end, 'days'));
             fondeoDeadline = moment(end); 
            dashboarupdate()
      });

      $('#contract_exp_date').daterangepicker({
        startDate: <?php if (isset($error )){ echo '"'.$expiration_date_is.'"';}else{ echo '"'.$expiration_date_is.'"';} ?>  ,
        singleDatePicker: true,
        showDropdowns: true,
        autoApply: true,
        minDate: now,
        minYear: parseInt(moment().format('YYYY'),10),
        maxYear: 2030, 
        locale: localdata,
      }, function(start, end, label,picker) {
            caduca = moment(end); 
            dashboarupdate()
      });

      function dashboarupdate(){
          totaldays=(  moment(empieza).diff(caduca, 'days'));
          $('#dashboard_total_duration_days').html(Math.abs(totaldays))

          totaldays=(  moment(empieza).diff(fondeoDeadline, 'days'));
          $('#dashboard_duration_founding_days').html(Math.abs(totaldays))

           
      }
 

       
       $('#dashboard_start_date').html(moment(now).format('DD/MMM/YYYY'))
             totaldays=(  moment().diff(now, 'days'));
      $('#dashboard_start_date_days').html(Math.abs(totaldays))


      $('#dashboard_duration_founding').html(moment(drafnowduration).format('DD/MMM/YYYY'))
      $('#dashboard_duration_founding_days').html(Math.abs( moment(now).diff(drafnowduration,"days")))
      $('#dashboard_contract_exp_date').html(moment(drafnow).format('DD/MMM/YYYY'))
      $('#dashboard_total_duration_days').html(Math.abs( moment(now).diff(drafnow,"days")))


      $('#contract_duration_input').val( moment(drafnowduration).valueOf()) 
      $('#contract_start_date_input').val( moment(now).valueOf()) 
      $('#contract_exp_date_input').val( moment(drafnow).valueOf()) 

      

      $('#contract_start_date').on('apply.daterangepicker', function(ev, picker) {
           $('#dashboard_start_date').html(picker.startDate.format('DD/MMM/YYYY'))
           $('#contract_start_date_input').val( moment(picker.startDate).valueOf()) 
      }); 


      $('#contract_exp_date').on('apply.daterangepicker', function(ev, picker) {
          $('#contract_exp_date_input').val( moment(picker.startDate).valueOf()) 
          $('#dashboard_contract_exp_date').html(moment(picker.startDate).format('DD/MMM/YYYY'))

      });

      $('#contract_duration').on('apply.daterangepicker', function(ev, picker) {
          $('#contract_duration_input').val( moment(picker.startDate).valueOf()) 
          $('#dashboard_duration_founding').html(picker.startDate.format('DD/MMM/YYYY'))
      });

    
  /*//////////////// DEFAULT   ///////////////// */
 
   $('#contract-fixed-funding').change(function() {
      if ( $('#contract-fixed-funding').val()=="0"){
      $('#autorenwebox').css("display","block")
      }else{
      $('#autorenwebox').css("display","none")
      }
   });
   

   $( "#contract-und-value, #contract-units, #contract_roi" ).click(function() {
      $(this).select();
   });

  $('#contract-und-value, #contract-units').on('input',function(e){
     calculateTarget()
     })
 
     calculateTarget()

  function calculateTarget(){ 
     var  a = parseFloat($("#contract-und-value" ).val())
      var  b = parseFloat($("#contract-units" ).val())  
      var  r= (a*b);
    
      $('#dashboard_target').html(r);
      $('#dashboard_target_und').html(b+ "/und.")
 }

  $('#draft-btn').on('click',function(e){
      $("#contract-active").val("0");
      $("#submit-btn").click();
  });
     
  $('#create-smartcontract').change(function() {
      if ( $('#create-smartcontract').val()=="0"){
            $('#contract-network-box').css("display","none")
      }else{
          $('#contract-network-box').css("display","block")
      }
   });
  
   

       
   $( "#contract-units" ).trigger( "input" )

   $( "#contract-fixed-funding" ).trigger( "change" )
   $( "#create-smartcontract" ).trigger( "change" )

})

 


 
</script>
<?=  $this->endSection() ?>

<!-- daterangepicker -->
<script src="<?php echo assets_url('admin') ?>/plugins/moment/moment.min.js"></script>
<script src="<?php echo assets_url('admin') ?>/plugins/daterangepicker/daterangepicker.js"></script>

