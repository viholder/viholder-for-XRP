<?php
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>

<!-- Content Header -->
 <section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo lang('App.orders') ?></h1>
      </div>
              <div class="col-sm-6  page-vh-menu">

              <?= $this->include("admin/layout/partials/portfolio-menu") ?>

              </div> 
    </div>
  </div>
</section>

<!-- Main content -->

<!-- Main content -->
<section class="content">



        <!-- Porfolio Table -->
        <div class="row">
              <div class="col-12">
                      <div class="" style="box-shadow:none;">
                              <div class="card-body" style="padding:0px;">
                               <table id="portafolio_list" class="table table-hover table_responsive" aria-describedby="">  
                              <thead>
                                <tr>
                                     <th class="sorting sorting_asc" tabindex="0"  rowspan="1" colspan="1" aria-sort="ascending">id</th>
                                    <th><?php echo lang('App.ticker') ?></th>
                                    <th style="text-align:right"><?php echo lang('App.amount') ?></th>
                                    <th style="text-align:right"><?php echo lang('App.units') ?> </th>
                                    <th style="text-align:right"><?php echo lang('App.opened') ?></th>
                                    <th style="text-align:right"><?php echo lang('App.price') ?></th>
                        
                                    <th><?php echo lang('App.action') ?></th>   
                                </tr>
                              </thead>
                              <tbody>
                            
                              <?php  // var_dump($user_positions); ?>

                              
                                <?php 
                                if ($user_positions["val"]){  
                                foreach ($user_positions["val"] as $row): 
                                  
                                //  $price =  model('App\Models\ContractModel')->getById($row["tickerID"]);

                                  ?>
                                  <tr>
                                  <td width="5">

                                    <div style="width:80px;margin-right:5px;cursor:pointer" data-id="<?php echo $row['id']; ?>" class="btn_contract" >  
                                       <a href="<?php echo base_url().'/contracts/view/'. $row['tickerID']; ?>"> <div id="contract_logo" class="elevation-2" style="margin:0px;padding-right:0px;width:70px;height:70px;border-radius:12%;overflow:hidden;background-image: url( <?php echo base_url()."/uploads/logos/";?><?php echo $row['tickerID'].".png"; ?> ); background-size:cover;">  </div></a>
                                    </div> 

                                    </td>
                                    <td style="padding-left:0px;">
                                    <div id="ticker-<?php  echo $row["id"]; ?>" style="font-weight:800;padding:0px;"><b><?php echo $row["ticker"]; ?> </b></div> 
                                    <div id="long-short-<?php  echo $row["id"]; ?>" style="font-size:12px;">
                                      <?php

                                        if ($row["short_long"]=="long"){ echo '<i style="font-size:14px;color:#00c90b;" class="fas fa-poll"></i> '.strtoupper(lang("App.long")); }  
                                        if ($row["short_long"]=="short"){ echo '<i style="font-size:14px;color:#cc001f;" class="fas fa-poll"></i> '.strtoupper(lang("App.short")); }  

                                        ?> </div> 
                                    <div style="font-size:12px;" id="timestamp-<?php  echo $row["id"]; ?>"><?php echo $row["timestamp"]; ?> </div> 
                                    <div style="font-size:10px;color:#212121" id="id-<?php  echo $row["id"]; ?>">ID:<?php echo $row["id"]; ?> </div> 

                                    </td>
                                    <td style="text-align:right"><b> <div id="amount-<?php  echo $row["id"]; ?>"><?php  echo format_to_currency($row["amount"],false); ?> </div> </b> </td>
                                    <td style="text-align:right"> <div id="units-<?php  echo $row["id"]; ?>"><?php  echo number_format($row["units"], 4, '.', ''); ?>  </div>  </td>
                                    <td style="text-align:right"> <div id="price_open-<?php  echo $row["id"]; ?>"><?php  echo format_to_currency($row["price_open"],false); ?> </div>  </td>
                                    <td style="text-align:right"> <div id="price-<?php  echo $row["id"]; ?>"> <?php  echo format_to_currency($row["price"],false);  ?>  </div> </td>
                                    <td>
                                      <?php if ($row["active"]=="8"){ ?>
                                        <button id="button-<?php  echo $row["id"]; ?>" class="btn btn-block btn-danger btn_manage_poistion" type="button" data-status="1"  data-contract="<?php echo $row["tickerID"]; ?>"  data-id="<?php echo $row["id"]; ?>"> <?php echo lang('App.cancel') ?>  </button>    
                                      <?php } ?>
                                    </td>
                                  </tr>
                                <?php endforeach ;
                                 };
                                ?>
                               
                              </tbody>
                            </table>
 
                          </div>
                          <!-- /.card-body 
                          <div class="card-footer clearfix">
                                <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
                                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                          </div>
                 -->
      
           
                </div>
          <!-- /.col -->
        </div>
      <!-- /.row -->
  <!-- /. Porfolio Table  -->
  <!-- modals -->
     <div class="modal fade" id="modal-more-info">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">TITLE</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p></p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('App.close'); ?> </button>
             </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
 
      <?php // echo view('exchange/modal_manage_orders'); ?>

</section>

 

<!-- /.content -->
 
<?= $this->endSection() ?>
 

<?= $this->section('js') ?>
<script src="<?php echo assets_url('admin') ?>/js/viholder-portfolio.js"></script>
 
<script>

var url="<?php echo url('/portfolio'); ?>"

///// UPDATE PORFTOLIO 
 
      var datatoload= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "id": "", "active": 8};   
     // update_portfolio(datatoload,url)
      portfolio_dashboard(datatoload,url);

      let actualiza = setInterval(myTimer, <?php echo setting("update_interval"); ?>);
      
      function myTimer() {
        const d = new Date();
        // console.log(d.toLocaleTimeString());
      //  update_portfolio(datatoload,url)
        portfolio_dashboard(datatoload,url);
      }
      

///// END UPDATE PORFTOLIO 

var contractclicled
var contract_ID;

  $(function () {

  
    
    $(".dataTables_empty").text("<?php echo  lang('App.there_are_no_open_positions_yet'); ?>")

    $("#portafolio_list_info").css("display", "none")

   
 

$(document).on('click', '.btn_manage_poistion', function(){ 

 
contractclicled=this
contract_ID= $(this).data('contract'); 
position_ID=$(this).data('id'); 
update_order(position_ID)

});

$('#modal-manage-poistion .modal-body #btn_sale_poistion').click(function() {

})




function update_order(position_ID){  


$('.btn_sale_cancel').trigger("click") 

var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"cancel_order", "position_id" : position_ID };
$.ajax({
   url: "<?php  echo url("portfolio/cancel_order");?>",
   type: "POST",
   cache: false,
   "data": data,  
   success: function(data){
     const myObj = JSON.parse(data);
       
       
       if (myObj["error"]){     
                
          toastr.warning(myObj["msg"] );

       }else{  
         toastr.success('<?php echo lang("App.order_cancelled_successfully");?>');

 
          $('#modal-manage-poistion').modal('hide');
       
       } 
   }
});



$(contractclicled).parent().parent().parent().parent().toggle("slow");


}



});



</script>
<?=  $this->endSection() ?>




 


 
