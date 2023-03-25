<?php
 
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>

        <!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-2">
        <h1><?php echo lang('App.my_investors') ?></h1>
      </div>
              <div class="col-sm-10  page-vh-menu">

              <?= $this->include("admin/layout/partials/contracts-menu") ?>

              </div><!-- /.col -->
    </div>
  </div><!-- /.container-fluid -->
</section>


<!-- Main content -->
<section class="content">
   

    <!--  Table -->
    <div class="row">
              <div class="col-12">
                      <div class="" style="box-shadow:none;">
                              <div class="card-body" style="padding:0px;">
                               <table id="myinvestors_list" class="table table-hover table_responsive" aria-describedby="">  
                              <thead>
                                <tr>
                                    <th width="63px">  -  </th>
                                    <th><?php echo lang('App.name') ?></th>
                                    <th> <?php echo lang('App.contracts') ?> </th>
                                    <th style="text-align:right" ><?php echo lang('App.invested') ?></th>
                                    <th style="text-align:center;min-width:130px;" ><?php echo lang('App.action') ?></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php

                            
                              if ($investors['val']>0){  
                              
                                 foreach ($investors["val"] as $key => $value){ 
                          
                                  $userdata =  model('App\Models\UserModel')->getById($key);

                                  echo "<tr>"; 
                                   ?>
                                   <td> 
                                      <div  style="margin:3px;width:60px;height:60px;display:inline-block;overflow:hidden;min-width:60px">
                                          <img class="img-circle"  src=" <?php echo userProfile($key); ?>" width="60" height="60" alt=""> 
                                      </div> 
             
                                  </td> 
                                  <?php
                                    echo "<td>". $userdata->name."</td>";
                                    echo "<td>";
                                    foreach ($investors["pos"][$key] as $row => $valor){
                                     // echo $row ." ".$valor."  ".$key."<br>";
                                     $contract = model('App\Models\ContractModel')->getById($valor);
                                     $contractURL=  url('/contracts/myinvestors/'.$contract['id']); 
                                      echo "<div style='margin-right:5px;'class='badge badge-secondary'><a style='color:#fff' href='".$contractURL."'>". $contract['contract_name']."</a></div>";
                                     }
                                      echo " </td> ";
                                      echo "<td style='text-align:right'><b>".format_to_currency($value,false)."</b></td> ";
                                  ?> 
                                  <td style="text-align:center;min-width:130px;">
                                    <div  class="btn btn-sm btn-primary btn_send_msg"  data-id="<?php echo $userdata->id; ?>" data-name="<?php echo $userdata->name; ?>"  data-img_type="<?php echo $userdata->img_type; ?>" title="<?php echo lang('App.send_msg');?>" data-toggle="tooltip"><i class="fas fa-envelope"></i></div>
                                       <a href="<?php echo url('/users/view/'.$key); ?>" class="btn btn-sm btn-info" title="<?php echo lang('App.view_user_info');?>" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                                    <div class="btn btn-sm btn-danger btn_payback"  data-id="<?php $userdata->id; ?>" title="<?php echo lang('App.payback');?>" ><i class="fas fa-comment-dollar"></i></div>
                                  </td> 
                                  <?php
                                   
                                  echo "</tr>";
                                 // echo var_dump($investors["pos"][$key]);
                                
                                 
                                  
                                }

                              
 
                              }
                              ?> 
                              </tbody>
                            </table>
 
                          </div>
           
                </div>
          <!-- /.col -->
        </div>
      <!-- /.row -->
  <!-- /. Porfolio Table  -->
                           
   </div>
   <?=   $this->include("exchange/modal_send_message"); ?>

   
  </section>
  
<?= $this->endSection() ?>
<?= $this->section('js') ?>

 <script>
 $(function () { 
 
    $('.select2').select2()
    $("#filter_select").css("display", "block")

   // $("#filter_select").fadeIn( "slow", function() { });
// 
   $(".dataTables_empty").text("<?php echo  lang('App.there_are_no_investors_yet'); ?>")
   $("#myinvestors_list_info").css("display", "none")

    $(document).on('click', '.delete', function(){ 
  
    })

    $('.select2').on('change', function() {
     // $('#myinvestors_list').empty();  
     list_investors_in_contract();
  });


function list_investors_in_contract(id){  
   
  id="";
  data="";
  myObj="";
  id=$('.select2').val()

   if (id==0){ window.location.href = '<?php  echo url("contracts/myinvestors");?>' }{   }

        var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "id" : id };
        $.ajax({
            url: "<?php  echo url("contracts/myinvestors");?>",
            type: "POST",
            cache: false,
            "data": data,  
            success: function(data){
               
                const myObj = JSON.parse(data);
               // console.log(myObj) 
               
                if (myObj["error"]){
                  toastr.warning(myObj["msg"]);

                }else{  
                     //  toastr.success('<?php echo lang("App.msg_sent_successfully");?>');
                    $('#myinvestors_list').find("tr:gt(0)").remove();
                    
                    for (const [key, value] of Object.entries(myObj['investors']['val'])) {
                          // console.log(key, value);
                          // console.log(myObj['investors']["name"][key])
                          // console.log(myObj['investors']["val"][key])
                          // console.log(myObj['investors']["pos"][key])
                       
                          $contracts_investor="";
                          for (const [key2, value2] of Object.entries(myObj['investors']["pos"][key])) {
                
                                  $contracts_investor= $contracts_investor+ '<div style="margin-right:5px;" class="badge badge-secondary"><a style="color:#fff" href="./myinvestors/'+value2+'">'+ myObj['contract']["name"][value2] +'</a></div>'
                          
                           }
    
                          var invstor_image='<div  style="margin:3px;width:60px;height:60px;display:inline-block;overflow:hidden;min-width:60px"> <img class="img-circle"  src="'+myObj['investors']["image"][key]+'" width="60" height="60" alt="">  </div>'

                          var investor_actions='<div  class="btn btn-sm btn-primary btn_send_msg"  data-id="'+key+'" data-name="'+myObj['investors']["name"][key]+'"  data-img_type=" " title="<?php echo lang('App.send_msg');?>" data-toggle="tooltip"><i class="fas fa-envelope"></i></div> <a href="/users/view/'+key+'" class="btn btn-sm btn-info" title="<?php echo lang('App.view_user_info');?>" data-toggle="tooltip"><i class="fa fa-eye"></i></a> <div class="btn btn-sm btn-danger btn_payback"  data-id="'+key+'" title="<?php echo lang('App.payback');?>" ><i class="fas fa-comment-dollar"></i></div>'

                          $('#myinvestors_list').append('<tr> <td style="width:63px"> '+ invstor_image+' </td> <td>'+myObj['investors']["name"][key]+' </td> <td> '+ $contracts_investor+'</td><td style="text-align:right"><b>'+myObj['investors']["val"][key]+'</b></td> <td style="text-align:center;min-width:130px;">'+investor_actions+'</td></tr>');


                     }

                  

                 // console.log(myObj);
               
                
                } 
            }
        });
}

                     
onwers_contracts();

function onwers_contracts(){

  var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action" : "read" };

      $.ajax({
            url: "<?php  echo url("contracts/ownership");?>",
            type: "POST",
            cache: false,
            "data": data,  
            success: function(data){
               
                const myObj = JSON.parse(data);
                console.log(myObj) 
               
                if (myObj["error"]){
                  toastr.warning(myObj["msg"]);

                }else{  

                   //  $('#listcontracts').empty();
                   $("option:selected").prop("selected", false)

                   for (const [key, value] of Object.entries(myObj['contracts']["val"])) {
                           // console.log( key+" "+value)
                           // console.log( myObj['contracts']["val"][key]['id'])
                           //  console.log( myObj['contracts']["val"][key]['contract_name'])

                            isselected=""
                            if (myObj['contracts']["val"][key]['id']=="<?php  echo $contract_selected; ?>"){ isselected="selected" }
                             $('#listcontracts').append(' <option '+isselected+'  value="'+myObj['contracts']["val"][key]['id']+'"><b>'+myObj['contracts']["val"][key]['contract_name']+'</b></option>')

                       }
                  
                   
                 }
                 
            
            }
        });



  }

   
    

})
</script>
  
 
 <?= $this->endSection('js') ?>

 <?=   $this->include("exchange/modal_payback"); ?>
 
 
  <?php //  echo view('exchange/modal_send_message'); ?>




