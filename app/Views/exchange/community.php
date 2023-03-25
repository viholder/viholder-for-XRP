<?php
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo lang('App.community') ?></h1>
      </div>
      <div class="col-sm-6">
       
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

						 
   <div class="row">
   <?php foreach ($users as $row): ?>
				<div class="col-md-3">
					
				<div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-clear">
			  <a href="<?php echo url('users/view/').$row->id ?>"> 
                <div class="widget-user-image">
                   <img class="profile-user-online img-fluid img-circle" src="<?php echo userProfile($row->id) ?>" alt="User Avatar" width="50"> 
                </div>
				</a>
                <!-- /.widget-user-image -->
				 
                <h2 class="lead" style="padding:10px;font-size:15px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;"> <?php echo $row->name ?> </h2>
                <!-- <p  style="padding:10px;font-size:15px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;"> <?php // echo $row->username ?> </p> -->

              </div>
              <div class="card-footer p-0">
                
                  <div class="text-right"  style="padding:15px;">
				             <a href="#" class="btn btn-sm bg-warning">
                     
                     <i class="fas fa-coins"></i>  <?php echo user_total_invested_icons($row->id);  ?>
                    </a>

                    <a href="#" class="btn btn-sm bg-secondary">
                    <i class="nav-icon fas fa-file"></i>  <?php echo number_of_contracts_user_investing($row->id); ?> 
                    </a>

				          	<a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i>
                    </a>
                    
                    <a href="<?php echo url('users/view/').$row->id ?>" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> 
                    </a>
               
              
                  <?php $balance=   json_decode(get_user_balances($row->id));  ?>
                  
                  <a href="#" class="btn btn-sm">
                     <i class="<?php  echo $balance->class; ?> " style="color:<?php  echo $balance->gain_loss_color; ?>;font-size:18px;opacity:1"></i>
                 </a>

                </div>
              </div>
            </div>


						 

					</div>
			 	

		<?php endforeach ?>
	 
	</div> <!-- /.row -->

</section>
<!-- /.content -->

<?= $this->endSection() ?>