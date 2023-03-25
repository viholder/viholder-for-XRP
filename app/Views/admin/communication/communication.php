<?= $this->extend('admin/layout/default') ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo lang('App.communication') ?></h1>  
 
      </div> 
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo url('/') ?>"><?php echo lang('App.home') ?></a></li>
          <li class="breadcrumb-item active"><?php echo lang('App.communication') ?></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<?= $validation->listErrors(); if ($validation->listErrors()){ } 

  
?>

<!-- Main content -->
<section class="content">

<div class="row">
  <div class="col-md-6">
            
            <?php echo form_open_multipart('communication', [ 'class' => 'form-validate' ]); ?>

 
                  <label><?php echo lang('App.to'); ?></label>
                  <select class="select2" id="listausers" name="sendto[]" multiple="multiple" style="width:100%">
                            <option value="all_users"><b><?php echo lang('App.all_users'); ?></b></option>
                            <option value="users"><b><?php echo lang('App.users_no_investors_no_contracts'); ?></b></option>
                            <option value="investors"><b><?php echo lang('App.investors'); ?></b></option>
                            <option value="contract_owners"><b><?php echo lang('App.contract_owners'); ?></b></option>
                            <option value="staff"><b><?php echo lang('App.staff'); ?></b></option>


                     </select>

                   </br></br> 
                   <label><?php echo lang('App.subject'); ?></label>
                   <input class="form-control" type="text" placeholder="" name="msg_subject">
                   </br> 
                   <label><?php echo lang('App.message'); ?></label>
                   <textarea id="msg_to_send" name="msg_to_send" rows="4" style="width:100%"></textarea>

                   <div><input class="btn btn-block btn-danger" type="submit" value="<?php echo lang('App.submit');?>" /></div>

            </form>
    </div>

    <div class="col-md-6">
          <div id="com_activity"></div>
    </div>


   </div>
   
</section>
              

<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
 $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
 

    var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"getusers"};

          $.ajax({
              url: "<?php  echo url("communication/get_users");?>",
              type: "POST",
              cache: false,
              "data": data,  
              success: function(data){
                  const myObj = JSON.parse(data);

                  var max=myObj.length;
                  for (var i = 0; i < max; i++) {
                    $('#listausers').append( "<option value='"+ myObj[i]['userID']+"'>"+ myObj[i]['name'] + " ("+ myObj[i]['username'] + ") </option>")
                    
                  }
             
               
                
              }

          });

          comunication_activity()
          function comunication_activity(){

              $.ajax({
                url: "<?php  echo url("communication/activity");?>",
                type: "POST",
                cache: false,
                "data": data,  
                success: function(data){
                    const myObj = JSON.parse(data);
                   console.log(data)
                    var max=myObj.length;
                    for (var i = 0; i < max; i++) {
                     $('#com_activity').append( "<div data-id='"+ myObj[i]['id']+"'> from:"+ myObj[i]['msg_from'] + " to:"+ myObj[i]['msg_to'] + " msg:"+ myObj[i]['msg_txt'] + " </div>")
                         

                    }
              
               
                  
                }

            });
          }


 })
    
    </script>
<?=  $this->endSection() ?>

