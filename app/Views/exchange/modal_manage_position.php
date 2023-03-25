<?= $this->section('content') ?>
<div class="modal fade" id="modal-manage-poistion" style="overflow:hidden">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background:#efefef;border: 0px;">
               <!-- ////////////////////////////////////// -->                
               <div style="display:flex;width:100%;margin-top: 5px;">
                              <div style="width:80px;">  
                                  <div id="contract_logo" style="width:70px;height:70px;border-radius:12%;overflow:hidden;">  </div>
                               </div>  
                                <div style="width:100%;margin-left:10px;">  
                                
                                <div style="font-size:19px;font-weight:300;line-height:16px;">  <span id="contract_type" > </span> | <span id="contract_sku" style="font-weight:800;"></span></div>  
                                     <div id="contract_name" style="font-size:18px;text-overflow: ellipsis;"></div>
                                     <div> <span id="contract_price" style="margin-right:5px;font-size:32px;line-height:28px;font-weight:800;"></span> <span style="font-size:14px"><?php echo setting("base_currency"); ?></span></div> 
 
                                 </div>
                      </div>  

       <!-- ////////////////////////////////////// -->  
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

      <div class="modal-body" style="padding:0px;">

 

 <!-- ////////////////////////////////////// -->   

      <div class="card card-secondary card-tabs" style="margin-bottom:0px;margin-top:0px">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="sale-tabs-five-overlay-tab" data-toggle="pill" href="#sale-tabs-five-overlay" role="tab" aria-controls="custom-tabs-five-overlay" aria-selected="true"><?php echo lang('App.sale'); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="transfer-tabs-five-overlay-dark-tab" data-toggle="pill" href="#transfer-tabs-five-overlay-dark" role="tab" aria-controls="custom-tabs-five-overlay-dark" aria-selected="false"><?php echo lang('App.transfer'); ?></a>
              </li>
               
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-five-tabContent">
             
              <div class="tab-pane fade active show" id="sale-tabs-five-overlay" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-tab">
                       
   

 <!--  /////////////////////////   

                            <div style="display:flex;border-top: 1px dotted #dedede;margin-top:10px;">  
                                  <div style="width:50%;text-align:left;"><b> <?php echo lang('App.amount'); ?> </b></div> 
                                  <div style="width:50%;text-align:right" id="actual-invested">  </div>
                            </div>
                            <div style="display:flex">  
                                  <div style="width:50%;text-align:left"><b> <?php echo lang('App.units'); ?> </b></div> 
                                  <div style="width:50%;text-align:right" id="units-invested">  </div>
                            </div>

                            <div style="display:flex">  
                                  <div style="width:50%;text-align:left"><b> <?php echo lang('App.open_price'); ?> </b></div> 
                                  <div style="width:50%;text-align:right" id="open_price"> </div>
                            </div>

                            
                            <div style="display:flex">  
                                  <div style="width:50%;text-align:left"><b> <?php echo lang('App.price'); ?> </b></div> 
                                  <div style="width:50%;text-align:right" id="price"> </div>
                            </div>

                            <div style="display:flex;width:100%;border-top: 1px dotted #dedede;"> </div>

                            -->

      <!--  /////////////////////////  -->   
                 
                 
      <div id="infobox_it" style="width:100%;display:block;height:20px;margin-bottom:15px;color:red" > </div>
      <div class="idpos"  style="text-align: right; position: absolute; padding-left: 100%; left: -79px; top: 63px; font-size: 14px; color: #767575;"> </div>

                      <div style="display:flex;margin-top:10px;">  
                              <div style="width:50%;text-align:left">
                                  <label for="Units"> <?php echo  lang('App.units'); ?></label>
                              </div>
                              <div style="width:50%;text-align:left">                            
                                  <div class="input-group">
                                        <input type="text" style="text-align:right" class="form-control calculateit unitsinput" id="units" name="units">
                                      <span class="input-group-append">
                                        <button type="button"   class="btn btn-secondary btn-flat max_units">Max</button>
                                      </span>
                                  </div>
 
                            </div>
                        </div>
                     
                        
                         <div style="display:flex;margin-top:10px;">  
                              <div style="width:50%;text-align:left">
                                 <label for="saleprice"> <?php echo  lang('App.unit-price'); ?></label>
                              </div>
                              <div style="width:50%;text-align:left">
                                  <div class="input-group">
                                      <input type="text" style="text-align:right" class="form-control calculateit" id="saleprice" name="saleprice" >
                                      <span id="labelpricetype" class="input-group-append bg-secondary" style="padding:7px;color:#fff;" >
                                         <?php echo  lang('App.market'); ?>  
                                      </span>
                                  </div>
                             
                               </div>
                        </div>

                        <!-- PERMIT FRACTIONAL -->
                        <div style="margin-top:10px;width:100%;display:flex;">
                                <div style="width:50%;text-align:left;">
                                 <b><?php echo lang('App.permit_fractional_sale');?></b>
                                </div>
                                <div style="width:50%;text-align:right;">
                                      <!--   -->
                                      <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                      </label>
                                    <!-- --> 
                                   
                                </div>
                        </div>
 
                 
                        <!-- TYPE OF PRICE -->
                        <div style="display:flex;margin-top:10px;"> 
                            <div style="width:50%;text-align:left">
                              <b> <?php echo  lang('App.market_price'); ?>   </b>
                            </div>
                            <div style="width:50%;text-align:right;">
                                       <label class="switch">
                                        <input type="checkbox"  id="pricetomarketSwitch" checked>
                                        <span class="slider round"></span>
                                      </label>

                             </div>

                        </div>


<!-- BUTTONS-->                   
               
                        <div style="display:flex;margin-top:10px;">  
                              <div style="width:50%;text-align:left">
                                 <div> <b><?php echo  lang('App.total-sale-price'); ?> </b></div>
                              </div>
                              <div style="width:50%;text-align:left">
                                 <h3><div class="total-sale-price"  style="text-align:right;"> - </div></h3>
                            </div>
                        </div>

        
                          <div style="margin-top:20px;width:100%;display:flex;justify-content: space-between;">
                                <div style="width:49%;">
                                     <button style="display:none;width:100%;"  class="btn btn-block btn-outline-danger" type="button" id="btn_sale_cancel"> <?php echo lang('App.cancel_sale'); ?>  </button>    
                                </div>
                                <div style="width:49%;">
                                   <button style="width:100%;" class="btn btn-danger" type="button" id="btn_sale_poistion"> <?php echo lang('App.sale'); ?>  </button>    
                                 </div>
                          </div>

                          

              </div>

              <div class="tab-pane fade" id="transfer-tabs-five-overlay-dark" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-dark-tab">
                
              <!-- /.//////////////////////////////////////////// -->
     
                     <div class="idpos" style="text-align: right; position: absolute; padding-left: 100%; left: -73px; top: 63px; font-size: 14px; color: #767575;"> </div>
<br>
                      <div style="display:flex;margin-top:10px;">  
                              <div style="width:50%;text-align:left">
                                  <label for="Units"> <?php echo  lang('App.units'); ?></label>
                              </div>
                              <div style="width:50%;text-align:left">                            
                                  <div class="input-group">
                                        <input type="text" style="text-align:right"  id="units2" class="form-control calculateit unitsinput">
                                      <span class="input-group-append">
                                        <button type="button"  class="btn btn-secondary btn-flat max_units">Max</button>
                                      </span>
                                  </div>

                            </div>
                        </div>
<br>
  
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                          </div>
                          <input type="text" class="form-control" name="transfer_email" placeholder="email">
                        </div>


<br>
<!-- TRANSFER BOTTONS -->
                        <div style="display:flex;margin-top:10px;">  
                              <div style="width:50%;text-align:left">
                                 <div> <b><?php echo  lang('App.total-sale-price'); ?> </b></div>
                              </div>
                              <div style="width:50%;text-align:left">
                                 <h3><div class="total-sale-price"  style="text-align:right;"> - </div></h3>
                            </div>
                        </div>

        
                          <div style="margin-top:20px;width:100%;display:flex;justify-content: space-between;">
                                <div style="width:49%;">

                                </div>
                                <div style="width:49%;">
                                   <button style="width:100%;" class="btn btn-danger" type="button" id="btn_transfer"> <?php echo lang('App.transfer'); ?>  </button>    
                                 </div>
                          </div>



              </div>
              
            </div>
          </div>
          <!-- /.card -->
        </div>

 
  
            </div>
             

            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

 <?=  $this->endSection() ?>

<?= $this->section('content') ?>
 
<!-- page script -->
<script>

var contract_ID;
var quantity;
var unit_value;
var total_tokens;
var amount;
var position_ID;
var contract_type;
var units_to_sale
var contractclicled
var contractclicled
 $(function () {

 
  $('.decimal').keypress(function(evt){
    return (/^[0-9]*\.?[0-9]*$/).test($(this).val()+evt.key);
});
 
 
 
 

$(document).on('click', '.btn_manage_poistion', function(){ 

       contractclicled=this
       contract_ID= $(this).data('contract'); 
       position_ID=$(this).data('id'); 

       $('#modal-manage-poistion .modal-title').html('<?php echo  lang('App.manage_position_modal_title'); ?> '); 
       $('#modal-manage-poistion .modal-body #texto-dialog').html('<?php echo lang('App.manage_position_modal_text'); ?> '); 
        $('.idpos').html("ID:#"+position_ID); 
       
       $("#pricetomarketSwitch").prop('checked',true)
        contract_info()
    
  });

  $('#modal-manage-poistion .modal-body #btn_sale_poistion').click(function() {
    sale_position(position_ID)
   })
 



  function sale_position(position_ID){  

       
      saleprice= $("#saleprice").val(); 
      market_price= $("#pricetomarketSwitch").val();
      fragmented=$("#pricetomarketSwitch").val();

      
      type=$("#type").val(); 
      /*
      amount= $("#amount").val(); 
      stop_loss=$("#stop_loss").val(); 
      take_profit=$("#take_profit").val(); 
      leverage=$("#leverage").val(); 
      short_long=$("#short_long").val(); 
     */
      var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"put_position_on_sale", "position_ID" : position_ID , "saleprice" : saleprice, "units" : units_to_sale, "market_price" : market_price, "type":type, "fragmented":fragmented };
      $.ajax({
          url: "<?php  echo url("portfolio/put_position_on_sale");?>",
          type: "POST",
          cache: false,
          "data": data,  
          success: function(data){
            const myObj = JSON.parse(data);
              
              
              if (myObj["error"]){     
                       
                 toastr.warning(myObj["msg"] );

              }else{  
                toastr.success('<?php echo lang("App.position_changed_status_successfully");?>');

               
              //  $('#portafolio_list').append('<tr><td>my data</td><td>more data</td></tr>');

              //  $(contractclicled).addClass("bg-warning")
              //  $(contractclicled).css("border","0px")
             //   $(contractclicled).text("<?php echo lang("App.onsale"); ?>"); 
                 $('#modal-manage-poistion').modal('hide');
              
              } 
          }
      });
  }
 
   

// CANCEL SALE

$(document).on('click', '#btn_sale_cancel', function(){ 

contractclicled=this
 
var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"cancell_position_sale", "position_id" : position_ID };
      $.ajax({
          url: "<?php  echo url("portfolio/cancel_sale");?>",
          type: "POST",
          cache: false,
          "data": data,  
          success: function(data){
            const myObj = JSON.parse(data);
              
              
              if (myObj["error"]){     
                       
                 toastr.warning(myObj["msg"] );

              }else{  
                toastr.success('<?php echo lang("App.position_sale_cancelled_successfully");?>');

        
                 $('#modal-manage-poistion').modal('hide');
              
              } 
          }
      });
    

})
 


// LOAD CONTRACT INFO;

  function contract_info(){   
    
      var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "id": contract_ID};
      $.ajax({
          url: "<?php  echo url("contracts/contract_data");?>",
          type: "POST",
          cache: false,
          "data": data,  
          success: function(data){
              const myObj = JSON.parse(data);
              unit_value  =  myObj["unit_value"] 
              contract_type  =  myObj["contract_type"] 
              contract_name  =  myObj["contract_name"] 
              contract_sku  =  myObj["contract_sku"]
            
               
              $("#actual-price").html(unit_value);
              $("#contract_type").html(contract_type);
              $("#contract_name").html(contract_name);
              $("#contract_sku").html(contract_sku);
              $("#contract_price").html(unit_value);
 
              contract_logo()
          }
      });
    }

 
     
  function position_info(){   
    var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "position_id": position_ID};
    $.ajax({
        url: "<?php  echo url("portfolio/get_position_partial");?>",
        type: "POST",
        cache: false,
        "data": data,  
        success: function(data){
					 const myObj = JSON.parse(data);
           //console.log(data) 
            units = myObj["units"] 
            amount= myObj["amount"]  
            price_open= myObj["price_open"]  
            price=myObj["price"] 
            $("#actual-invested").html(amount);
            $("#units-invested").html(parseFloat(units).toFixed(5)); 
            $("#open_price").html(price_open);
            $(".unitsinput").val(parseFloat(units).toFixed(5));
            units_to_sale= myObj["units"] ;
            $("#saleprice").val(unit_value);
            $("#price").html(unit_value);
             
            if (myObj["active"]==6){
              $("#btn_sale_cancel").css("display","block"); 
              $("#btn_sale_poistion").text("<?php echo lang('App.update'); ?>")

            }else{
              $("#btn_sale_cancel").css("display","none"); 
              $("#btn_sale_poistion").text("<?php echo lang('App.sale'); ?>")
            } 

           $('.max_units').trigger("click") 
           $( ".calculateit" ).trigger("keyup")
           $(".unitsinput").val(parseFloat(units).toFixed(5));
            
            $('#modal-manage-poistion').modal('show'); 
 
        }
    });
  }


  function contract_logo(){  

      imageUrl="<?php echo base_url()."/uploads/logos/"; ?>"

      $("#contract_logo").css("background-image", "url('"+ imageUrl + contract_ID+".png')");
      $("#contract_logo").css("background-size", "70px 70px");
      position_info()
     }


    $(document).on('click', '.max_units', function(){ 
      $(".unitsinput").val(units)
      units_to_sale=units;
      sale_price()
    });

    
   
  function sale_price(){ 
    
      input_price = parseFloat($("#saleprice").val())
      units_to_sale = parseFloat($(".unitsinput").val())
 
     
      price =  input_price*units_to_sale

      if (isNaN(price)){price=0}
      $(".total-sale-price").html("<?php echo setting('currency_symbol');?>" + price.toFixed(2))
     
       

      
      if (parseFloat(parseFloat(units_to_sale).toFixed(5)) > parseFloat(parseFloat(units).toFixed(5))) {  
         $("#infobox_it").html("<?php echo lang('App.not_enogh_units'); ?>");
         $(".unitsinput").css("background","#fdffa1")             
      }else{
         $("#infobox_it").html("")
         $(".unitsinput").css("background","#fff")

      }

    }


   


    $( ".calculateit" ).keyup(function( e ) {
         sale_price()
    }).keydown(function( e ) {
      
      if ( e.which == 13 ) {
          e.preventDefault();
      }
    });

    $("#units2").keyup(function( e ) {
      $("#units").val( $("#units2").val() )
    }).keydown(function( e ) {  
      
    });
    $("#units").keyup(function( e ) {
      $("#units2").val( $("#units").val() )
    }).keydown(function( e ) {  
      
    });


 


    


    $(document).on('click', '#labelpricetype', function(){ 
      $("#pricetomarketSwitch").trigger("click");
    });


    $("#saleprice").prop( "disabled", true );

    $("#pricetomarketSwitch").change(function() {
    if ($("#pricetomarketSwitch").prop('checked')==false){ 
         $('#labelpricetype').text("<?php echo  lang('App.limit'); ?> "); 
         $("#saleprice").val(unit_value)
         $("#saleprice").prop( "disabled", false );


      }else{
        $('#labelpricetype').text("<?php echo  lang('App.market'); ?> "); 
        $("#saleprice").prop( "disabled", true );

        $("#saleprice").val(unit_value)
     }

         
   });  

});
</script>
<?=  $this->endSection('js') ?>

