 <!-- /.content-wrapper -->
 
 <div style="display:flex;" class="contract-menu-conteiner">  
 
 
       <div class="btn-group  float-sm-left contract-menu" style="width:50%;margin-right:10px;">
       <?php if ( isset($pagetitle) && $pagetitle=="contracts" OR  $pagetitle=="ownership"  ){   ?>
              <div id="filter_select" style="display:none;width:100%;border:0px;">
               <select class="select2" id="listcontracts" name="listcontracts[]" multiple="multiple" style="width:100%;border:0px;">
                            <option value="all" selected><b><?php echo lang('App.viewall'); ?></b></option>
                            <option value="future"><b><?php echo lang('App.future'); ?></b></option>
                            <option value="closing"><b><?php echo lang('App.closing'); ?></b></option>
                            <option value="new"><b><?php echo lang('App.new'); ?></b></option>
                            <option value="funded"><b><?php echo lang('App.funded'); ?></b></option>
                     </select>
               </div>

        <?php   }  
        // CONTRACT INVESTORS DROPDOWN FILTER SELECTOR
           if ( isset($pagetitle) && $pagetitle=="myinvestors"  ){   ?>
              <div id="filter_select" style="display:none;width:100%;border:0px;">
               <select class="select2" id="listcontracts" name="listcontracts[]" multiple="multiple" style="width:100%;border:0px;">
                            
                      <?php if ($contract_selected>0){ $isfilter="" ;}else{  $isfilter="selected"; } ?>
                           <option value="0"  <?php echo $isfilter; ?> ><b><?php echo lang('App.viewall'); ?></b></option>
                     <?php 
                     /*
                     if ($investors['val']>0){  
                             foreach ($investors["val"] as $key => $value){ 
                                    $userdata =  model('App\Models\UserModel')->getById($key);
                                    ?>  
                                    <option value="<?php echo $userdata->id; ?>"><b><?php echo $userdata->name; ?></b></option> 
                                    <?php  
                             }
                      }
                     */
                     ?>
                     
                     </select>
               </div>

           
               <?php  }  ?>
        
       
           
        </div>
       

       
        <div class="btn-group  float-sm-right  contract-menu" style="width:50%">
         
 
            <?php if (hasPermissions('create_contract')): ?>
                  

                   <a  class="btn btn-default"   href="<?php echo base_url()."/contracts/ownership"; ?>"> 
                   <i class="nav-icon fas fa-file"> </i>  <?php echo lang('App.my_contracts'); ?>  </a>

                 
                   <a  class="btn btn-default" href="<?php echo base_url()."/contracts/myinvestors"; ?>"> 
                   <i  class="nav-icon fas fa-user-tie"> </i> <?php echo lang('App.my_investors'); ?>  </a>
                   
         
                  <a  class="btn btn-default" href="<?php echo base_url()."/contracts/create"; ?>"> 
                  <i class="nav-icon fas fa-plus-square"></i> <?php echo lang('App.create_new_contract'); ?>  </a>
             <?php endif; ?>     

         </div>
  

 
  
 </div> 
    




 
             
            
   
 
                 
 