<?php
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo lang('App.portfolio') ?></h1>    
      </div>
      <div class="col-sm-6 page-vh-menu">
      <?= $this->include("admin/layout/partials/portfolio-menu") ?>

      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-griswithe">
              <div class="inner">
                <h3><div class="dasboard-numbers" style="display:inline-block;" id="balance_label" data-balance_label=""></div></h3>
                <p><?php echo lang('App.cash_available')." <b>". setting("base_currency");?></b></p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" id="cash-modal-info-btn"   class="small-box-footer"><?php echo lang('App.dashboard_more_info');?> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-griswithe">
              <div class="inner">
                <h3><div class="dasboard-numbers" style="display:inline-block;" id="total_invested" data-totalinvested=""></div></h3>
                <p><?php echo lang('App.total_invested')." <b>". setting("base_currency");?></b></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" id="total_invested-modal-info-btn"   class="small-box-footer"><?php echo lang('App.dashboard_more_info');?> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-griswithe">
              <div class="inner">
                <h3><div  class="dasboard-numbers" style="display:inline-block;" id="gain_Loss"></div></h3>
                <p><?php echo lang('App.gain_lost')." <b>". setting("base_currency");?></b></p>
              </div>
              <div class="icon">
                <!--  <i class="ion ion-person-add"></i> -->
                <i id="gainloss_icon" class="">  </i>
              </div>
              <a href="#" id="gain_lost-modal-info-btn" class="small-box-footer"><?php echo lang('App.dashboard_more_info');?> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div id="portfolio_value_dashboard" class="small-box" style="color:#fff">
              <div class="inner">
                <h3><div  class="dasboard-numbers" style="display:inline-block;"  id="portafolio_value" ></div></h3>
                <p><?php echo lang('App.portafolio_value')." <b>". setting("base_currency");?></b></p>
               </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" id="portafolio_value-modal-info-btn"   class="small-box-footer"><?php echo lang('App.dashboard_more_info');?> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->


        <!-- Porfolio Table -->
        <div class="row">
              <div class="col-12">
                      <div class="" style="box-shadow:none;">
                              <div class="card-body" style="padding:0px;">
                               <table id="portafolio_list" class="table table-hover table_responsive" aria-describedby="">  
                              <thead>
                                <tr>
                                    <th data-priority="1" class="sorting sorting_asc" tabindex="0"  rowspan="1" colspan="1" aria-sort="ascending" style="width:40px;"> </th>
                                    <th data-priority="2"  ><?php echo lang('App.ticker') ?></th>
                                    <th style="text-align:right"><?php echo lang('App.amount') ?></th>
                                    <th style="text-align:right"><?php echo lang('App.units') ?> </th>
                                    <th style="text-align:right"><?php echo lang('App.opened') ?></th>
                                    <th style="text-align:right"><?php echo lang('App.price') ?></th>
                                    <th style="text-align:right">SL </th>
                                    <th style="text-align:right">TP </th>
                                    <th style="text-align:center">X </th>
                                    <th style="text-align:right">GP % </th>
                                    <th data-priority="3"  style="text-align:right">GP S </th>
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
                                        <a href="<?php echo base_url().'/contracts/view/'. $row['tickerID']; ?>"><div id="contract_logo" class="elevation-2" style="margin:0px;padding-right:0px;width:70px;height:70px;border-radius:12%;overflow:hidden;background-image: url( <?php echo base_url()."/uploads/logos/";?><?php echo $row['tickerID'].".png"; ?> ); background-size:cover;">  </div></a>
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
                                    <td style="text-align:right"><b> <div id="amount-<?php  echo $row["id"]; ?>">
                                        <?php  echo format_to_currency($row["amount"],false); ?> </div> </b> 
                                        <div class="percentGP" style="display:block;font-size:12px;"> <?php  echo $row["glp"];  ?> </div>
                                    </td>
                                    <td style="text-align:right"> <div id="units-<?php  echo $row["id"]; ?>"><?php  echo  rtrim(rtrim((string)number_format($row['units'], 5, ".", ""),"0"),"."); ?>  </div>  </td>
                                    <td style="text-align:right"> <div id="price_open-<?php  echo $row["id"]; ?>"><?php  echo format_to_currency($row["price_open"],false); ?> </div>  </td>
                                    <td style="text-align:right"> <div id="price-<?php  echo $row["id"]; ?>"> <?php  echo format_to_currency($row["price"],false);  ?>  </div> </td>
                                    <td style="text-align:right"> <div id="stop_loss-<?php  echo $row["id"]; ?>"><?php  echo $row["stop_loss"];  ?> </div></td>
                                    <td style="text-align:right"> <div id="take_profit-<?php  echo $row["id"]; ?>"> <?php  echo $row["take_profit"];  ?> </div></td>
                                    <td style="text-align:center"> <div id="leverage-<?php  echo $row["id"]; ?>"><?php  echo $row["leverage"];  ?></div> </td>
                                    <td style="text-align:right"> <div id="glp-<?php  echo $row["id"]; ?>"> <?php  echo $row["glp"];  ?> </div> </td>
                                    <td data-priority="2" style="text-align:right;"> <div id="gl-<?php  echo $row["id"]; ?>"> <?php  echo $row["gl"];  ?> </div></td>
                                    <td>
                                      <?php if ($row["active"]=="6"){ ?>
                                        <button id="button-<?php  echo $row["id"]; ?>" class="btn btn-block btn-warning btn_manage_poistion" type="button" data-status="6" data-contract="<?php echo $row["tickerID"]; ?>"  data-id="<?php echo $row["id"]; ?>"> <?php echo lang('App.onsale') ?>  </button>    
                                      <?php }else{ ?>
                                        <button id="button-<?php  echo $row["id"]; ?>" class="btn btn-block btn-secondary btn_manage_poistion" type="button" data-status="1"  data-contract="<?php echo $row["tickerID"]; ?>"  data-id="<?php echo $row["id"]; ?>"> <?php echo lang('App.manage') ?>  </button>    
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
 
      <?php  echo view('exchange/modal_manage_position'); ?>

</section>

 

<!-- /.content -->
 
<?= $this->endSection() ?>
 

<?= $this->section('js') ?>
<script src="<?php echo assets_url('admin') ?>/js/viholder-portfolio.js"></script>

<!-- page script -->
<script>

var url="<?php echo url('/portfolio'); ?>"

///// UPDATE PORFTOLIO 
 
      var datatoload= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "id": "",  "active": 1};   
      update_portfolio(datatoload,url)
      portfolio_dashboard(datatoload,url);
      top_dashboard(datatoload,url);
      
      let actualiza = setInterval(myTimer, <?php echo setting("update_interval"); ?>);
      
      function myTimer() {
        const d = new Date();
        // console.log(d.toLocaleTimeString());
        update_portfolio(datatoload,url)
        portfolio_dashboard(datatoload,url);
        top_dashboard(datatoload,url);
      }
      

///// END UPDATE PORFTOLIO 

  $(function () {

    $(".table_responsive").DataTable({
      "responsive": true,
      "autoWidth": false,
      "paging": false,
      "searching": false,
      "responsive": {
        "details": {
            "type": 'column'
        }
    },
   
    "columnDefs": [
        { "responsivePriority": 1, "targets": 1 },
        { "responsivePriority": 2, "targets": 2 },
        { "responsivePriority": 3, "targets": 11 }
    ]
    });

    
    
    $(".dataTables_empty").text("<?php echo  lang('App.there_are_no_open_positions_yet'); ?>")

    $("#portafolio_list_info").css("display", "none")

   

 
    $('#cash-modal-info-btn').click(function() {
     
          var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "modal":"cash-modal-info"};

          $.ajax({
              url: "<?php  echo url("portfolio/get_positions");?>",
              type: "POST",
              cache: false,
              "data": data,  
              success: function(data){
                
                $('#modal-more-info .modal-title').html('<?php echo lang('App.dashboard_more_info'); ?> '); 
                $('#modal-more-info .modal-body').html('<?php echo lang('App.dashboard_more_info_description'); ?> '); 

                $('#modal-more-info').modal('show'); 
                console.log(data)
                
              }

          });

  });

  $('#total_invested-modal-info-btn').click(function() {
       $('#modal-more-info .modal-title').html('<?php echo lang('App.dashboard_more_info'); ?> '); 
       $('#modal-more-info .modal-body').html('<?php echo lang('App.total_invested_dashboard_more_info_description'); ?> '); 
      $('#modal-more-info').modal('show'); 
  });

  $('#total_invested-modal-info-btn').click(function() {
       $('#modal-more-info .modal-title').html('<?php echo lang('App.dashboard_more_info'); ?> '); 
       $('#modal-more-info .modal-body').html('<?php echo lang('App.total_invested_dashboard_more_info_description'); ?> '); 
      $('#modal-more-info').modal('show'); 
  });

  $('#gain_lost-modal-info-btn').click(function() {
       $('#modal-more-info .modal-title').html('<?php echo lang('App.dashboard_more_info'); ?> '); 
       $('#modal-more-info .modal-body').html('<?php echo lang('App.gain_lost_dashboard_more_info_description'); ?> '); 
       $('#modal-more-info').modal('show'); 
  });

  $('#portafolio_value-modal-info-btn').click(function() {
       $('#modal-more-info .modal-title').html('<?php echo lang('App.dashboard_more_info'); ?> '); 
       $('#modal-more-info .modal-body').html('<?php echo lang('App.portafolio_value_dashboard_more_info_description'); ?> '); 
       $('#modal-more-info').modal('show'); 
  });

  
});



</script>
<?=  $this->endSection() ?>




 


 