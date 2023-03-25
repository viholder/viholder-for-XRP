<?=  $this->extend('admin/layout/blank') ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo lang('App.metals') ?> Barajas</h1>  
 
      </div> 
      <div class="col-sm-6">
        
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
 

<!-- Main content -->
<section class="content">


<div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-griswithe">
              <div class="inner">
                <h3><div class="dasboard-numbers" style="display:inline-block;" id="total_oro" data-balance_label=""></div></h3>
                <p><?php echo "Total ORO $"." <b><span id='total_oro_value'></span>"." ". setting("base_currency");?></b></p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" id="cash-modal-info-btn"   class="small-box-footer"><?php echo lang('App.dashboard_more_info');?> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-griswithe">
              <div class="inner">
                <h3><div class="dasboard-numbers" style="display:inline-block;" id="total_plata" data-totalinvested=""></div></h3>
                <p><?php echo "Total Plata $"." <b><span id='total_plata_value'></span>". " ".setting("base_currency");?></b></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" id="total_invested-modal-info-btn" class="small-box-footer"><?php echo lang('App.dashboard_more_info');?> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-griswithe">
              <div class="inner">
                <h3><div  class="dasboard-numbers" style="display:inline-block;" id="total_inventario"></div></h3>
                <p><?php echo "Total Inventario"." <b>". " ".setting("base_currency");?></b></p>
              </div>
              <div class="icon">
                <!--  <i class="ion ion-person-add"></i> -->
                <i id="gainloss_icon" class="">  </i>
              </div>
              <a href="#" id="gain_lost-modal-info-btn" class="small-box-footer"><?php echo lang('App.dashboard_more_info');?> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
           
        </div>
        <!-- /.row -->




<div class="row">
    


    <div class="col-md-6">
          <div class="btn_new btn card btn_secondary">
            NUEVO CLIENTE/PROVEEDOR
        </div>
    </div>

    <div class="col-md-6">
          <div class="btn_metals btn card btn_secondary">
            NUEVA OPERACIÓN
         </div>
    </div>

<?php //echo $gold; ?>
<br>
<?php // echo $silver; ?>
</div>

<div class="row">
 <div class="listinvetory" style="width:100%">  </div>

</div>
   <?= $this->include("exchange/modal_metals") ?>
 
</section>
              

<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
 $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

   function  get_inventory_totals(){
      var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"getusers"};

      $.ajax({
         url: "<?php  echo url("metals/get_inventory_totals");?>",
         type: "POST",
         cache: false,
         "data": data,  
         success: function(data){
            const myObj = JSON.parse(data);

            var max=myObj.length;
            $('#total_oro_value').html( myObj['totalOroValue'])
            $('#total_oro').html(  myObj['totalOroGr']+"gr")

            $('#total_plata').html(myObj['totalPlataGr']+"gr")
            $('#total_plata_value').html(myObj['totalPlataValue'])
           
            $('#total_inventario').html("$"+myObj['granTotal']+" ")

            
             
           

         }

      });

   }

   get_inventory_totals()
   

    var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"getusers"};

          $.ajax({
              url: "<?php  echo url("metals/get_users");?>",
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

  
   list_inventroy()
   

   $('#total_oro').html("0");
   $('#total_plata').html("0");
   $('#total_inventario').html("0");
    

   $(document).on('click', '.paid_btn', function(){ 

         updateID=$(this).parent().parent().attr('id')
        
        update_inventroy(updateID)
   })       

   function update_inventroy(){  
      var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"update", "updateID":updateID };
      $.ajax({
            url: "<?php  echo url("metals/update_inventory");?>",
            type: "POST",
            cache: false,
            "data": data,  
            success: function(data){
               
                 $('.listinvetory').empty();
                 list_inventroy()
                 let timerInterval
                        Swal.fire({
                          title: 'Captura correcta',
                          icon: 'success',
                          timer: 2000,
                          timerProgressBar: true,
                          didOpen: () => {
                             
                          },
                          willClose: () => {
                            clearInterval(timerInterval)
                          }
                        }).then((result) => {
                          
                        })
            }
            
       })

      } 


 })

 function list_inventroy(){  
       var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"listinvetory"};

         $.ajax({
            url: "<?php  echo url("metals/get_inventory");?>",
            type: "POST",
            cache: false,
            "data": data,  
            success: function(data){
               const myObj = JSON.parse(data);

               var max=myObj.length;
               for (var i = 0; i < max; i++) {

                  div_contractname="<div style='width:20%'>"+ myObj[i]['contractName']+"</div>"
                  div_gramos="<div style='width:15%'>"+ myObj[i]['gr']+"gr</div>"
                  div_kilataje="<div style='width:15%'>"+myObj[i]['karat']+"</div>"
                  div_ref="<div style='width:15%'>" +myObj[i]['ref_number']+"</div>"
                  div_value="<div style='width:15%'>"+myObj[i]['value']+"</div>"

                      if  (myObj[i]['status']=="1"){classstatus="badge-success";statusText="Pagado" }
                      if  (myObj[i]['status']=="0"){classstatus="badge-primary";statusText="Procesando" }
                  div_badge= "<div style='width:15%'><small class='badge "+classstatus+"' style='padding:4px;'><i class='far fa-clock'></i> "+statusText+" </small></div>"
                  
                   if  (myObj[i]['action']=="1"){classaction="badge-success";actionText="COMPRA" }
                   if  (myObj[i]['action']=="0"){classaction="badge-danger";actionText="VENTA" }


                  div_action= "<div style='width:10%'><small class='badge "+classaction+"' style='padding:4px;'><i class='far'></i> "+actionText+" </small></div>"

                  div_boton="<div style='width:15%'><button class='btn_invest btn btn-block btn-danger paid_btn' type='button'> Aceptar Pago  </button> </div>"
                  div_inventory=div_action+div_contractname+div_gramos+div_kilataje+div_ref+div_value+div_badge+div_boton
                  $('.listinvetory').append( "<div class='card' style='width:100%;height:50px;display:flex; align-items: center;flex-direction: row; justify-content: space-between;padding: 10px;' id='"+ myObj[i]['id']+"'>"+div_inventory+ "</div>")
                  //$('.listinvetory').append( "<div class='card' style='width:100%;height:30px' id='"+ myObj[i]['id']+"'>"+ myObj[i]['contractName'] + " ("+ myObj[i]['gr'] + ")gr |  "+ myObj[i]['karat'] +"  | "+ myObj[i]['ref_number'] +"  | "+ myObj[i]['value'] +" > "+ badge +" </div>")
                  
               }
            
               
            }
            
   })
   
} 
    
    </script>
<?=  $this->endSection() ?>


<?= $this->include("exchange/modal_new_client") ?>

  
 