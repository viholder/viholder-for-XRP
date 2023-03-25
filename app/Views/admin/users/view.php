<?= $this->extend('admin/layout/default') ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
      
      </div><!-- /.container-fluid -->
    </section>
<!-- Main content -->

<!-- Main content -->
<section class="content">


<div class="row">


 <!-- ////////////////////////////////////////////////////// -->
 <?php $balance=   json_decode(get_user_balances($user->id));  ?>

<div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="<?php echo userProfile($user->id) ?>" alt="User profile picture">
				        </div>
			 
                <h3 class="profile-username text-center"><?php echo $user->name ?></h3>

                <p class="text-muted text-center"><?php echo $user->username ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b><?php echo lang('App.Diversification'); ?></b> <a class="float-right"> <?php echo number_of_contracts_user_investing($user->id); ?></a>
                  </li>
				  <?php if (hasPermissions('users_edit')): ?>
                  <li class="list-group-item">
                    <b><?php echo lang('App.invested'); ?></b> <a class="float-right"><?php echo user_total_invested($user->id); ?></a>
                  </li>
				  <?php endif ?>
                  <li class="list-group-item">
                    <b><?php echo lang('App.gain_lost'); ?> </b> <i class="float-right <?php  echo $balance->class; ?> " style="color:<?php  echo $balance->gain_loss_color; ?>;font-size:18px;opacity:1"></i>

                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
   </div>


 <!-- ////////////////////////////////////////////////////// -->

          <div class="col-9">
            <!-- Custom Tabs -->
            <div class="card">
     <?php if (hasPermissions('users_edit')): ?>
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3"><?php echo lang('App.view_user') ?></h3>
                <ul class="nav nav-pills ml-auto p-2">

					<li class="nav-item active"><a class="nav-link active" href="#tab_1" data-toggle="tab"><?php echo lang('App.overview') ?></a></li>
					<li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab"><?php echo lang('App.activity') ?></a></li>
				 
						<li class="nav-item"><a class="nav-link" href="<?php echo url('users/edit/'.$user->id) ?>"><?php echo lang('App.edit_user') ?></a></li>
			 

                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
				  <div class="row">
      		<div class="col-sm-2" style="padding-left: 50px;">
      			<br>
      			<img src="<?php echo userProfile($user->id) ?>" width="150" class="img-circle" alt="">
      			<br>
      		</div>
      		<div class="col-sm-10" style="padding-left: 50px;">
      			<table class="table table-bordered table-striped">
      				<tbody>
      					<tr>
      						<td width="160"><strong><?php echo lang('App.user_name') ?></strong>:</td>
      						<td><?php echo $user->name ?></td>
      					</tr>
      					<tr>
      						<td><strong><?php echo lang('App.user_email') ?></strong>:</td>
      						<td><?php echo $user->email ?></td>
      					</tr>
      					<tr>
      						<td><strong><?php echo lang('App.user_contact') ?></strong>:</td>
      						<td><?php echo $user->phone ?></td>
      					</tr>
      					<tr>
      						<td><strong><?php echo lang('App.user_last_login') ?></strong>:</td>
      						<td><?php echo ($user->last_login!='0000-00-00 00:00:00')?date( setting('datetime_format'), strtotime($user->last_login)):'No Record' ?></td>
      					</tr>
      					<tr>
      						<td><strong><?php echo lang('App.user_username') ?></strong>:</td>
      						<td><?php echo $user->username ?></td>
      					</tr>
      					<tr>
      						<td><strong><?php echo lang('App.user_role') ?></strong>:</td>
      						<td><?php echo $user->role->title ?></td>
      					</tr>
      				</tbody>
      			</table>
      		</div>
      	</div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
				  <table id="dataTable1" class="table table-bordered table-striped">
					<thead>
					<tr>
						<th><?php echo lang('App.id') ?></th>
						<th><?php echo lang('App.activity_ip_address') ?></th>
						<th><?php echo lang('App.activity_message') ?></th>
						<th><?php echo lang('App.activity_datetime') ?></th>
						<th><?php echo lang('App.action') ?></th>
					</tr>
					</thead>
					<tbody>

					<?php foreach ($user->activity as $row): ?>
						<tr>
						<td width="60"><?php echo $row->id ?></td>
						<td><?php echo !empty($row->ip_address)?'<a href="'.url('activity_logs/index?ip='.urlencode($row->ip_address)).'">'.$row->ip_address.'</a>':'N.A' ?></td>
						<td>
							<a href="<?php echo url('activity_logs/view/'.$row->id) ?>"><?php echo $row->title ?></a>
						</td>
						<td><?php echo date('d M, Y', strtotime($row->created_at)) ?></td>
						<td>
							<a href="<?php echo url('activity_logs/view/'.$row->id) ?>" class="btn btn-sm btn-default" title="View Activity" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
						</td>
						</tr>
					<?php endforeach ?>

					</tbody>
				</table>
                  </div>
				  
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
       <?php endif ?>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END CUSTOM TABS -->

</section>

<?= $this->endSection() ?>
<?= $this->section('js') ?>

<script>
	$('#dataTable1').DataTable({
    "order": []
  });
</script>
<?= $this->endSection() ?>
