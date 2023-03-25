<?php
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo lang('App.message') ?></h1>
      </div>
      <div class="col-sm-6">
       
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
<?php if($message){
 ?>

 
 
   
<div  class="post" style="border-bottom: 1px solid #ededed;cursor:pointer;">
        
                      <div class="user-block" style="margin-bottom:0px;display:flex;justify-content: space-between;width:100%">
                         <div style="display:flex;width:30px;"> 
                            <span class="float-right text-sm text-light"> <i class="fas fa-circle"></i> 
                         </div>
                         <div style="display:flex;width:100%"> 
                                <div style="width:100%" class="notify" data-id="<?php echo $message['id'];?>">  
 
                                <img class="img-circle img-bordered-sm" src="<?php echo base_url()."/uploads/users/". $message['msg_from'].".".$message['img_type']; ?>" alt="">
                                <span class="username">
                                    <a href="#"><?php echo $message['name'];?></a>
                                 </span>
                                 <span class="description"><?php echo $message['since'];?></span>
                            </div>
                                
                                  
                                 <span  data-id="<?php echo $message['id'];?>" class="float-right text-sm text-secondary trashit" style="cursor:pointer;"> <i class="fas fa-trash-alt" style="font-size:19px;"></i> </span>  
                               
                                
                         </div>     
                      </div>
                      <!-- /.user-block -->
                      <p style="margin-left: 80px;" class="notify" data-id="<?php echo $message['id'];?>" >
                     <b> <?php echo html_entity_decode($message['msg_subject']);?> </b>
                      </p>  
                      <?php echo html_entity_decode($message['msg_txt']);?>
                      </p>

              
         </div>

 
   </div>
 
</div>
  <!-- /.card -->
  <?php }else{ echo lang("App.this_message_has_being_deleted"); } ?>
</section>
<!-- /.content -->

<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>

$(function () {


$(document).on('click','.trashit',function(event) {
    var noti=$(this).data("id")
 
 $(this).parent().parent().parent().parent().toggle("slow");

     var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "id":noti};

          $.ajax({
              url: "<?php  echo url("notifications/delete");?>",
              type: "POST",
              cache: false,
              "data": data,  
              success: function(data){
                  
                
              }

          });


 });
})

</script>
<?= $this->endSection('js') ?>