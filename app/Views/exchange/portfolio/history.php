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
                                    <td width="5"><div id="id-<?php  echo $row["id"]; ?>"> <?php  echo $row["id"]; ?> </div></td>
                                    <td>  <div id="ticker-<?php  echo $row["id"]; ?>"><?php echo $row["refID"]; ?> </div> </td>
                                    <td style="text-align:right"><b> <div id="amount-<?php  echo $row["id"]; ?>"><?php // echo format_to_currency($row["amount"],false); ?> </div> </b> </td>
                                    <td style="text-align:right"> <div id="units-<?php  echo $row["id"]; ?>"><?php // echo number_format($row["units"], 4, '.', ''); ?>  </div>  </td>
                                    <td style="text-align:right"> <div id="price_open-<?php  echo $row["id"]; ?>"><?php // echo format_to_currency($row["price_open"],false); ?> </div>  </td>
                                    <td style="text-align:right"> <div id="price-<?php  echo $row["id"]; ?>"> <?php // echo format_to_currency($row["price"],false);  ?>  </div> </td>
                                    <td style="text-align:left"> <div id="action-<?php  echo $row["refID"]; ?>">  <?php echo lang("App.".$row["ref"]);  ?>  </div> </td>

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

  $(function () {

  
    
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




 


 
