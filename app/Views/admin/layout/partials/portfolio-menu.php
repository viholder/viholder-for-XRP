
         <?php if ( isset($pagetitle) && $pagetitle=="portfolio"  ){   $isdisbled="disabled"; }else{$isdisbled="";} ?>
         <?php if ( isset($pagetitle) && $pagetitle=="orders"  ){   $orderisdisbled="disabled"; }else{$orderisdisbled="";} ?>
         <?php if ( isset($pagetitle) && $pagetitle=="history"  ){   $historyisdisbled="disabled"; }else{$historyisdisbled="";} ?>

 
           <div class="btn-group  float-sm-right" style="display:flex;">
            
                     
                   <a  class="btn btn-default <?php echo $isdisbled; ?>"   href="<?php echo base_url()."/portfolio"; ?>"> 
                   <i class="nav-icon fas fa-chart-pie"></i>  <?php echo lang('App.assets'); ?>  </a>

                   <a  class="btn btn-default  <?php echo $orderisdisbled; ?>"  href="<?php echo base_url()."/portfolio/orders"; ?>"> 
                   <i  class="nav-icon fas fa-user-tie"> </i> <?php echo lang('App.orders'); ?>  </a>

                  <a  class="btn btn-default  <?php echo $historyisdisbled; ?>" href="<?php echo base_url()."/portfolio/history"; ?>"> 
                  <i class="nav-icon fas fa-history"></i> <?php echo lang('App.history'); ?>  </a>              
                 
 </div>