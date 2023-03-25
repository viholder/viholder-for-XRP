<?php
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo lang('App.monitor') ?></h1>
      </div>
      <div class="col-sm-6">
      

       </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
<h5> <?php echo lang('App.most_followed'); ?> </h5>
<div class="row">
 
<?php 
 $i = 0;
 foreach ($most_followed as $row => $value){  
 
  if($i++ > 5) break;

  $contract =  model('App\Models\ContractModel')->getById($row); 


   // CHECK VISIBILITY 
   /*
   if ($contract['visibility']==null){   
                    
   }else{
       
     // IF ITS ONWER IS ALWAYS VISIBLE
      if( $contract['ownerID']==logged('id')){}else{ 
       
          
           $favs=json_decode($contract['visibility']);
           if(is_array($favs)){  
             if (in_array(logged('id'), $favs)) {
                 $contract['visibility'] ="";
                 
             }else{
               unset($contract);
             }
           }
         
      }
       
   } 
  // END VISIBILITY
*/

  ?>
        <div class="col-md-2 col-sm-2 col-6">
            <div class="small-box" style="background:#efefef;">
                  <div style="display:flex;width:100%;overflow:hidden;padding:5px; ">
                            <div style="width:80px;margin-right:5px;">  
                           <a href='contracts/view/<?php echo $row; ?>'>     <div id="contract_logo" class="" style="width:70px;height:70px;border-radius:12%;overflow:hidden;background-image: url( <?php echo base_url()."/uploads/logos/";?><?php echo $row.".png"; ?> ); background-size:cover;">  </div></a>
                            </div>  
                            <div style="width:100%;margin-left:5px;">  
                              
                                    <div style="text-align:center;font-size:13px;font-weight:300;line-height:18px;">  <span id="contract_type" ><span id="contract_sku" style="font-weight:800;"> <?php echo SKU_gen($contract['contract_name'],$value,2);?> </span></div>  
                                    <!--   <div id="contract_name" style="font-size:15px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;width:100%"><?php echo $contract['contract_name']; ?></div>
                                    <div> <span id="contract_price" style="margin-right:0px;font-size:32px;line-height:28px;font-weight:800;"><?php echo $value ?></span> <span style="font-size:14px"> </span></div>  -->
                                  <div   style="text-align:center;font-size:17px;font-weight:600;position: relative;background: #efefef;padding: 3px;;cursor:pointer;color:#7e7e7e;">  
                                     <?php echo $value ?>  <i style="color:#c1c1c1;" class="fas fa-star"></i>
                                 </div>
                                 <div style="font-weight:200;font-size:13px;background:#efefef;color:black;padding:0px;text-align:center;"><b> <?php echo lang('App.followers'); ?> </b></div>
                            </div>
                            
                           
                            
                  </div>  

              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <?php } ?>
</div>

<h5> <?php echo lang('App.monitoring'); ?> </h5>
<div class="row">
 
<?php 
 $l=0;
 

 if ($pos){  
     foreach ($pos as $row){  
     
     if ($row['id']=="0"){ 

     }else{ 
      
        ?>
        <div class="col-md-4"  >
           <div class=" card-widget widget-user" style="padding:15px;background:#efefef;" >

                <div style="display:flex;width:100%;">
                        <div style="width:80px;margin-right:5px;">  
                            <a href='contracts/view/<?php echo $row['id']; ?>'>    <div id="contract_logo" class="elevation-2" style="width:70px;height:70px;border-radius:12%;overflow:hidden;background-image: url( <?php echo base_url()."/uploads/logos/";?><?php echo $row['id'].".png"; ?> ); background-size:cover;">  </div></a>
                          </div>  
                          <div style="width:65%;margin-left:5px;">  
                          
                                <div style="font-size:19px;font-weight:300;line-height:18px;">  <span id="contract_type" ><?php echo $row['contract_type']; ?> </span> | <span id="contract_sku" style="font-weight:800;"> <?php echo $row['ticker']; ?> </span></div>  
                                <div id="contract_name" style="font-size:15px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;width:100%"><?php echo $row['contract_name']; ?></div>
                                <div> <span id="contract_price" style="margin-right:0px;font-size:32px;line-height:28px;font-weight:800;"><?php echo $row['price']; ?></span> <span style="font-size:14px"><?php echo setting("base_currency"); ?></span></div> 

                            </div>
                            <div data-id="<?php echo $row['id']; ?>" id="fav<?php echo $row['id']; ?>" class="bt_favorite" style="font-size:14px;position: absolute;top: 10px;right: 10px;background: #2121;padding: 2px;border-radius:12%;cursor:pointer;color:red;">  
                              <i class="fas fa-star"></i>
                           </div>
                        
                </div>  

                <div style="width:100%;display:block;height:auto;position:relative;margin-bottom:25px;margin-top:35px;"> 
                
                      <div style="width:100%;display:block;height:30px;position:relative;background-image: url(./assets/admin/img/diagonal.jpg);background-repeat;repeat;background-size: 70px 70px;  animation: animatedBackground 5s linear infinite; -webkit-animation: animatedBackground 5s linear infinite;"> 
                            <div style="width:100%;background-color:#212121;display:block;height:30px;position:absolute;top:0px;opacity:.4;"> </div>
                          
                            <div style="width:<?php echo $row['dedlines']['end_funding'];?>%;background:yellow;display:block;height:30px;position:absolute;top:0px;opacity:.8"> </div>
                            <div style="width:<?php echo $row['dedlines']['end_funding'];?>%;display:block;height:45px;position:absolute;top:0px;border-right:2px solid yellow;"> </div>  
                            <div style="padding-left:<?php echo $row['dedlines']['end_funding'];?>%;left:-20px;display:block;position:absolute;top:38px; font-size:12px;"><div style="background:yellow;color:black;padding-left:4px;padding-right:4px;font-weight: 500;  border-radius: 25px;"> <?php echo  strtoupper(lang('App.funding_deadline')); ?></div> </div>  

                            <div style="width:<?php echo $row['dedlines']['percent_to_expire'];?>%;background:red;display:block;height:30px;position:absolute;top:0px;opacity:.8"> </div>
                            <div style="width:<?php echo $row['dedlines']['percent_to_expire'];?>%;display:block;height:45px;position:absolute;top:-15px;border-right:2px solid red;"> </div>  
                            <div style="padding-left:<?php echo $row['dedlines']['percent_to_expire'];?>%;left:-20px;display:block;position:absolute;top:-25px;font-size:12px;"> <div style="background:red;color:#fff;padding-left:4px;padding-right:4px; font-weight: bold; border-radius: 25px;"><b>  <?php echo  strtoupper(lang('App.today')); ?></b> </div>  </div>  
              

                      </div>
              </div>

              <ul class="nav flex-column"  >
                  <li class="nav-item" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                    <a href="#" class="nav-link">
                    <?php echo lang('App.followers'); ?>  <span class="float-right badge bg-primary"><?php echo $row['followers']; ?></span>
                    </a>
                  </li>
                  <li class="nav-item"  style="border-bottom: 1px solid rgba(0,0,0,.125);">
                    <a href="#" class="nav-link">
                    <?php echo lang('App.investors'); ?>  <span class="float-right badge bg-info"><?php echo $row['investors']; ?></span>
                    </a>
                  </li>
                  <li class="nav-item"  style="border-bottom: 1px solid rgba(0,0,0,.125);">
                    <a href="#" class="nav-link">
                    <?php echo lang('App.end_funding'); ?>  <span class="float-right badge " style="background:yellow;color:black;">

                            <?php  $fecha = substr($row['lifetime_days'], 0, 10); ?>
                            <div  data-life="<?php echo $date =date("M d, Y",$fecha); ?>" id="life<?php echo $l; ?>"> Timer </div>
        
                     </span>
                    </a>
                  </li>
                  <li class="nav-item" >
                    <a href="#" class="nav-link">
                    <?php echo lang('App.expires'); ?>  
                     <span class="float-right badge bg-secondary"> 
                            <?php  $fecha = substr($row['expiration_date'], 0, 10); ?>
                            <div  data-exp="<?php echo $date =date("M d, Y",$fecha); ?>" id="exp<?php echo $l ?>"> Timer </div>
                     </span>
                    </a>
                  </li>
                </ul>

 

                 
                  

                 
                 <?php  $l++; ?>
                  
           </div>
        </div>

        


        <?php  } } } else{ echo "NO FOLLOWINGS"; }?>

</div> <!-- /.ROW -->


</section>
<!-- /.content -->

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script>
       
      
 
       var totalrows="<?php echo $l; ?>"

       const countDownDate=[]
       const distance=[]

       const distance2=[]
       const countDownDateLife=[]

       $(function () {

        for (let i = 0; i < totalrows; i++) {
           
           let dataExp = $("#exp"+i).attr("data-exp");
           let dataLife = $("#life"+i).attr("data-life");

           var now = new Date().getTime();

           countDownDate[i] = new Date(dataExp).getTime();

           countDownDateLife[i] = new Date(dataLife).getTime();
            
          // Find the distance between now and the count down date
            distance[i] = countDownDate[i] - now;


       }

 
       });
   

  
 var a=0;
var x = setInterval(function() {

    
 
    for (let i = 0; i < totalrows; i++) { 
         var now = new Date().getTime();
         distance[i] = countDownDate[i] - now;

          var days = Math.floor(distance[i] / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance[i] % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance[i] % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance[i] % (1000 * 60)) / 1000);

          document.getElementById("exp"+i).innerHTML = days + "d " + hours + "h "
          + minutes + "m " + seconds + "s ";

// 
          distance2[i] = countDownDateLife[i] - now;
          var days2 = Math.floor(distance2[i] / (1000 * 60 * 60 * 24));
          var hours2 = Math.floor((distance2[i] % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes2 = Math.floor((distance2[i] % (1000 * 60 * 60)) / (1000 * 60));
          var seconds2 = Math.floor((distance2[i] % (1000 * 60)) / 1000);


          document.getElementById("life"+i).innerHTML = days2 + "d " + hours2 + "h "
          + minutes2 + "m " + seconds2 + "s ";


          // If the count down is finished, write some text
          if (distance[i] < 0) {
           // clearInterval(x);
            document.getElementById("exp"+i).innerHTML = "<?php echo  strtoupper(lang('App.expired')); ?>";
          }

          if (distance2[i] < 0) {
           // clearInterval(x);
            document.getElementById("life"+i).innerHTML = "<?php echo  strtoupper(lang('App.closed')); ?>";
          }

    }

}, 1000);



$(document).on('click','.bt_favorite',function(event) {
    var favID=$(this).data("id")
     var clicked=this;
     $(clicked).toggleClass("isfavorite");
     
     $( clicked ).parent().parent().fadeOut( "slow", function() {
    
    })

     var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "favID":favID};

          $.ajax({
              url: "<?php  echo url("monitor/set_favorite");?>",
              type: "POST",
              cache: false,
              "data": data,  
              success: function(data){
               
               // $(clicked).css("background-color", "#dc3545")
              }

          });


 });

 
</script>

<?=  $this->endSection('js') ?>