<?php
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo lang('App.order_book') ?></h1>
      </div>
      <div class="col-sm-6">
      

       </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
 
 <div class="row">
 
<?php 
 $l=0;
 

 if ($pos){  
  /*
     foreach ($pos as $row){  
     
     if ($row['id']=="0"){ 

      }else{ 
        ?>
        <div class="col-md-6"  >
           <div class=" card-widget widget-user" style="padding:15px;" >

                <div style="display:flex;width:100%;background:rgb(29, 204, 34);overflow:hidden;">
                        <div style="width:80px;margin-right:5px;">  
                            <div id="contract_logo" class="elevation-2" style="width:70px;height:70px;border-radius:12%;overflow:hidden;background-image: url( <?php echo base_url()."/uploads/logos/";?><?php echo $row['id'].".png"; ?> ); background-size:cover;">  </div>
                          </div>  
                          <div style="width:65%;margin-left:5px;">  

                          <?php echo $row['id']; ?>
                        
                        
                                <div style="font-size:19px;font-weight:300;line-height:18px;">  <span id="contract_type" ><?php echo $row['contract_type']; ?> </span> | <span id="contract_sku" style="font-weight:800;"> <?php echo $row['ticker']; ?> </span></div>  
                                <div id="contract_name" style="font-size:15px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;width:100%"><?php echo $row['contract_name']; ?></div>
                             
                                <div> <span id="contract_price" style="margin-right:0px;font-size:32px;line-height:28px;font-weight:800;"><?php echo $row['asking_price']; ?></span> <span style="font-size:14px"><?php echo setting("base_currency"); ?></span></div> 
                          
                            </div>
                            <div data-id="<?php echo $row['id']; ?>" id="fav<?php echo $row['id']; ?>" class="bt_favorite" style="font-size:14px;position: absolute;top: 10px;right: 10px;background: #2121;padding: 2px;border-radius:12%;cursor:pointer;color:red;">  
                              <i class="fas fa-star"></i>
                           </div>
                        
                </div>  

                 
                 <?php  $l++; ?>
                  
           </div>
        </div>

        


        <?php  } } 
      */
      }?>


</div> <!-- /.ROW -->

<div style="display:flex">

     <div style="width:50%;"> 
           <div style="width:100%;text-align:center;background:rgb(29, 204, 34);"> Bid </div> 
               <div id="bid" style="oveflow:hidden"> </div>
     </div>

     <div style="width:50%">  
           <div style="width:100%;text-align:center;background:red"> Ask </div> 
           <div id="ask" style="oveflow:hidden"> </div>  
    </div>
    
     
 

  
    
 
 
   
</table>

</section>
<!-- /.content -->

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script>
       
      

$(document).on('click','.bt_favorite',function(event) {
    var favID=$(this).data("id")
     var clicked=this;
     $(clicked).toggleClass("isfavorite");
     
     $( clicked ).parent().parent().fadeOut( "slow", function() {
    
    })

      
 });



 // LOAD ASK
         var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action": "read", "ask_bid" : "6"};

          $.ajax({
              url: "<?php  echo url("market/order_book");?>",
              type: "POST",
              cache: false,
              "data": data,  
              success: function(data){
               
                   const myObj = JSON.parse(data);
                 
                    var max=myObj.length;
                     $('#ask').append("<div style='border:1px solid #efefef;width:100%;height:30px;display:flex;padding:5px;'><div style='width:50%;text-align:left;'><b> Price </b> </div><div style='width:50%;text-align:left;'> <b> Units </b> </div></div>");

                    for (var i = 0; i < max; i++) {        
                      imagecontract= '<div style="width:20px;margin-right:5px;">   <div class="" style="width:20px;height:20px;border-radius:12%;overflow:hidden;background-image: url(<?php echo base_url()."/uploads/logos/";?>'+myObj[i]['tickerID']+".png"+');background-size:cover;">  </div> </div>  ';
         
                       $('#ask').append("<div style='border:1px solid #efefef;width:100%;height:30px;display:flex;padding:5px;'><div style='width:50%;text-align:left;color:red'>"+myObj[i]['asking_price']+"</div><div style='width:50%;text-align:left;'>"+myObj[i]['units']+"</div>"+imagecontract+"</div>");

 
                    }

              
              }

          });


 // LOAD BID
         var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action": "read", "ask_bid" : "8"};

$.ajax({
    url: "<?php  echo url("market/order_book");?>",
    type: "POST",
    cache: false,
    "data": data,  
    success: function(data){
     
         const myObj = JSON.parse(data);
       
          var max=myObj.length;
               $('#bid').append("<div style='border:1px solid #efefef;width:100%;height:30px;display:flex;padding:5px;'><div style='width:50%;text-align:right'><b> Units </b></div><div style='width:50%;text-align:right;'><b> Price </b></div></div>");

          for (var i = 0; i < max; i++) {      
               imagecontract= '<div style="width:20px;margin-right:5px;">  <div class="" style="width:20px;height:20px;border-radius:12%;overflow:hidden;background-image: url(<?php echo base_url()."/uploads/logos/";?>'+myObj[i]['tickerID']+".png"+');background-size:cover;">  </div> </div>  ';
           
               $('#bid').append("<div style='border:1px solid #efefef;width:100%;height:30px;display:flex;padding:5px;'>"+imagecontract+"<div style='width:50%;text-align:right'>"+myObj[i]['units']+"</div><div style='width:50%;text-align:right;color:rgb(29, 204, 34);'>"+myObj[i]['asking_price']+"</div></div>");
 
 
          }

    
    }

});


 
</script>

<?=  $this->endSection('js') ?>