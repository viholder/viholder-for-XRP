<?php
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-2">
        <h1><?php echo lang('App.my_contracts') ?></h1>
      </div>
              <div class="col-sm-10  page-vh-menu">

              <?= $this->include("admin/layout/partials/contracts-menu") ?>

              </div><!-- /.col -->
    </div>
  </div><!-- /.container-fluid -->
</section>

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
                                    <th>    </th>

                                    <th width="150px"><?php echo lang('App.contract') ?></th>
                                    <th><?php echo lang('App.target') ?></span></th>
                                    <th><?php echo lang('App.invested') ?> </th>
                                    <th><?php echo lang('App.roi') ?></th>
                                    <th width="80px" ><?php echo lang('App.deadlines') ?></th>
                                    <th> <?php echo lang('App.progress') ?></th>
                                    <th width="80px"><?php echo lang('App.status') ?></th>
                                    <th  style="min-width: 110px;text-align:center;"><?php echo lang('App.action') ?></th>   
                                </tr>
                              </thead>
                              <tbody>
                            
 
                              
                                <?php 
                                 if ($contracts["val"]){  
                                  foreach ($contracts["val"] as $row):   ?>  
 
                                  <tr>
                                     <td> <img class="img-circle elevation-2" style="border-radius:12%" src=" <?php echo base_url()."/uploads/logos/".$row["id"];?>.png" width="70" height="70" alt=""> </td>
                                    <td>  <?php echo strtoupper($row["contract_name"]); ?> 
                                     <div style="font-size:12px;color:blue"> ID: <?php echo $row["id"]; ?> </div>
                                     </td>
                                    <td style="text-align:right"><b> <?php echo  format_to_currency(($row["total_tokens"] * $row["unit_value"]),false);  ?>  </b> </td>
                                    <td style="text-align:right"> <b> <?php echo format_to_currency($row["invested"],false);  ?> </b>  
                                  <br>  <div style="width:100%;font-size:12px;line-height: .9em;padding-bottom:3px;padding-right:0px;"> <?php echo lang('App.investors') ?>: <span class='badge badge-primary' style="padding:3px;font-size:1em;"> <i class="fas fa-user-tie"></i><?php echo count($row["investors"]);  ?></span></div>
                                  </td>
                                    <td style="text-align:center"> <b><?php echo  format_to_currency($row["roi-debt"],false); ?></b> <br> <?php echo $row["roi"]; ?>%   </td>
                                    <td> <div style="width:100%;font-size:.7em;"> <?php echo date("d-M-Y", substr($row["starting_date"], 0, 10));   ?> </div>
                                         <div style="width:100%;font-size:12px;line-height: .9em;padding-bottom:3px"> <b><?php echo lang('App.start_date') ?></b> </div>
                                         <div style="width:100%;font-size:.7em;border-top: 1px dotted grey;padding-top:3px;"> <?php echo date("d-M-Y", substr($row["lifetime_days"], 0, 10)); ?> </div>
                                         <div style="width:100%;font-size:12px;line-height: .9em;padding-bottom:3px;"><b> <?php echo lang('App.funding_deadline') ?></b></div> 
                                         <div style="width:100%;font-size:.7em;border-top: 1px dotted grey;padding-top:3px;"> <?php echo date("d-M-Y", substr($row["expiration_date"], 0, 10)); ?> </div>
                                         <div style="width:100%;font-size:12px;line-height: .9em;"><b> <?php echo lang('App.expiration_date'); ?></b></div>
                                    </td>  
                                    <td style="text-align:center">  
                                    <?php /*
                                         <div style="width:100%;font-size:1em;"> <?php echo format_to_currency($row["unit_value"],false); ?> </div>
                                         <div style="width:100%;font-size:12px;line-height: .9em;"><b> <?php echo strtoupper(lang('App.'.$row['valoration'])); ?></b></div>
                                      */ ?>
                                        <?php $deadlines= deadlines_percent($row["id"]); 
 
                                        
                                        ?>

<div style="width:100px;display:block;height:auto;position:relative;margin-bottom:15px;margin-top:15px;"> 
 
        <div style="width:100%;display:block;height:30px;position:relative;background-image: url(../assets/admin/img/diagonal.jpg);background-repeat;repeat;background-size: 70px 70px;  animation: animatedBackground 5s linear infinite; -webkit-animation: animatedBackground 5s linear infinite;"> 
              <div style="width:100%;background-color:#212121;display:block;height:30px;position:absolute;top:0px;opacity:.4"> </div>
             
              <div style="width:<?php echo $deadlines['end_funding'];?>%;background:yellow;display:block;height:30px;position:absolute;top:0px;opacity:.8"> </div>
              <div style="width:<?php echo $deadlines['end_funding'];?>%;display:block;height:45px;position:absolute;top:0px;border-right:2px solid yellow;"> </div>  
              <div style="left:<?php echo $deadlines['end_funding'];?>%;display:block;position:absolute;top:30px;border:2px dotten red;font-size:10px;padding-left:5px;text-align:left;"> <?php echo  strtoupper(lang('App.funding')); ?> </div>  

              <div style="width:<?php echo $deadlines['percent_to_expire'];?>%;background:red;display:block;height:30px;position:absolute;top:0px;opacity:.8"> </div>
              <div style="width:<?php echo $deadlines['percent_to_expire'];?>%;display:block;height:45px;position:absolute;top:-15px;border-right:2px solid red;"> </div>  
              <div style="left:<?php echo $deadlines['percent_to_expire'];?>%;display:block;position:absolute;top:-18px;border:2px dotten red;font-size:10px;padding-left:5px;"> <?php echo  strtoupper(lang('App.today')); ?> </div>  
 

        </div>
</div>


                                    </td>
                                    <td style="text-align:center"> <?php echo "<small class='badge badge-primary'><i class='far fa-clock'></i> ".strtoupper(lang('App.'.$row['contract_type']))." </small>"; ?> 
                                                <?php  if ($row["active"]=="1"){ echo "<small class='badge badge-success'></i> ".strtoupper(lang('App.published'))."</small>";} ;
                                                 if ($row["active"]=="-1"){ echo "<small class='badge badge-warning'> ".strtoupper(lang('App.closing'))."</small>";};
                                                 if ($row["active"]=="0"){ echo "<small class='badge badge-secondary'> ".strtoupper(lang('App.inactive'))."</small>";};
                                                 if ($row["active"]=="3"){ echo"<small class='badge badge-secondary'> ". strtoupper(lang('App.draft'))."</small>";};
                                                 if ($row["active"]=="4"){ echo"<small class='badge badge-warning'> ". strtoupper(lang('App.finishing'))."</small>";};
                                                 if ($row["active"]=="5"){ echo"<small class='badge badge-danger'> ". strtoupper(lang('App.cancelled'))."</small>";};
                                                 if ($row["active"]=="6"){ echo"<small class='badge badge-warning'> ". strtoupper(lang('App.onsale'))."</small>";};
                                                 if ($row["active"]=="7"){ echo"<small class='badge badge-primary'> ". strtoupper(lang('App.transferring'))."</small>";};

                                                ?>
                                    </td>
                                                 
                                    
                                     <td> 
                                                  <a href="<?php echo url('contracts/edit/'.$row["id"] ) ?>" class="btn btn-sm btn-primary" title="Editar" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                                                  <a href="<?php echo url('contracts/view/'.$row["id"] ) ?>" class="btn btn-sm btn-info" title="Ver" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                                                  <div class="btn btn-sm btn-danger delete" data-id="<?php echo $row["id"]; ?>" ><i class="fa fa-trash"></i></div>
                                  
                                                </td>
                                  </tr>
                                <?php endforeach ;
                                 };
                                ?>
                               
                              </tbody>
                            </table>
 
                          </div>
                          <!-- /.card-body -->
                         
                
      
           
                </div>
          <!-- /.col -->
        </div>
      <!-- /.row -->
  <!-- /. Porfolio Table  -->
                           
   </div>
   
  </section>
  
<?= $this->endSection() ?>
<?= $this->section('js') ?>

 <script>
 $(function () { 
 


  $(document).on('click', '.delete', function(){ 
  

     
            contract_ID= $(this).data('id'); 
            
            Swal.fire({
              title: '<?php echo "¿".lang('App.delete_contract'); ?>?',
              text: "<?php echo lang("App.you_wont_be_able_to_revert_this"); ?>",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: '<?php echo lang('App.yes_delete_it'); ?>',
              cancelButtonText: '<?php echo lang('App.cancel'); ?>'
            }).then((result) => {
              if (result.isConfirmed) {
                
                  window.location.href = "<?php echo url('contracts/delete/'); ?>"+contract_ID
              }
            })
      })

      


  
   $(".dataTables_empty").text("<?php echo  lang('App.there_are_no_contracts_yet'); ?>")
   $("#portafolio_list_info").css("display", "none")
   

})

$(function () {
    $('.select2').select2()
    $("#filter_select").css("display", "block")
 })

 
</script>
  
 ?>
 <?= $this->endSection('js') ?>