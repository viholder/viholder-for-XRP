<?php
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo lang('App.notifications') ?></h1>
      </div>
      <div class="col-sm-6">
       </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <!-- Default card -->
  <?php 
  
 
    if($notify){
      
      foreach ($notify['notify'] as $row){
    
       
     
     ?>  

       <div  class="post" style="border-bottom: 1px solid #ededed;cursor:pointer;">
        
                      <div class="user-block" style="margin-bottom:0px;display:flex;align-items: center;width:100%">
                         <div style="display:flex;width:30px;"> 
                            <?php if ($row['active']==1){ ?>  <span class="float-right text-sm text-danger"> <i class="fas fa-circle"></i> </span>  <?php }else{ ?> <span class="float-right text-sm text-light"> <i class="fas fa-circle"></i> <?php } ?>
                         </div>
                         <div style="display:flex;width:100%"> 
                                <div style="width:80%" class="notify" data-id="<?php echo $row['id'];?>">  
 
                              <img class="img-circle img-bordered-sm" src="<?php echo base_url()."/uploads/users/". $row['msg_from'].".".$row['img_type']; ?>" alt="">  
                                <span class="username">
                                    <a href="#"><?php echo $row['name'];?></a>
                                 </span>
                                 <span class="description"><?php echo $row['since'];?></span>
                            </div>
                                <div style="width:20%">  
                               
                                 <span  data-id="<?php echo $row['id'];?>" class="float-right text-sm text-secondary trashit" style="cursor:pointer;"> <i class="fas fa-trash-alt" style="font-size:19px;"></i> </span>  
                              
                              </div> 
                                
                         </div>     
                      </div>
                      <!-- /.user-block -->
                      <p style="margin-left: 80px;" class="notify" data-id="<?php echo $row['id'];?>" >
                      <?php echo html_entity_decode($row['msg_subject']);?> &nbsp;
                      </p>

              
         </div>

       
      <?php 
      
     }   
        
  }else{ echo lang("App.you_have_no_notifications"); } 
  
 ?>


</section>
<!-- /.content -->

<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>

$(function () {

    

$(document).on('click','.notify',function(event) {
   var noti=$(this).data("id")
   // window.location.href = "view/"+noti;
    window.location.href = "<?php  echo url("notifications/view/");?>"+noti
   
   });

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