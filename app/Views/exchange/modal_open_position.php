<?= $this->section('content') ?>
<div class="modal fade" id="modal-open-poistion">
        <div class="modal-dialog">
         

          <div class="modal-content">
            <div class="modal-header" style="background:#efefef;border: 0px;">
               
              <!-- ////////////////////////////////////// -->                
              <div style="display:flex;width:100%;margin-top: 5px;">
                              <div style="width:80px;">  
                                  <div id="contract_logo" style="width:70px;height:70px;border-radius:12%;overflow:hidden;">  </div>
                               </div>  
                                <div style="width:72%;margin-left:10px;">  
                                
                                     <div style="font-size:19px;font-weight:300;line-height:18px;">  <span id="contract_type" > </span> | <span id="contract_sku" style="font-weight:800;"></span></div>  
                                     <div id="contract_name" style="font-size:15px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;width:100%"></div>
                                     <div> <span id="contract_price" style="margin-right:5px;font-size:32px;line-height:28px;font-weight:800;"></span> <span style="font-size:14px"><?php echo setting("base_currency"); ?></span></div> 
 
                                 </div>
                                 <!--
                                 <div style="width:30px;top:-5px;"> 
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                   </button>
                                 </div>
-->
                      </div>  

       <!-- ////////////////////////////////////// -->  
       
              
            </div>
            <div class="modal-body" style="padding:0px">
                   
                
                

                 <div style="display:flex;width:100%">
                   <div style="display:flex;width:60px;padding-left:15px;" class="input_atm">
                        <?php // echo setting("currency_symbol"); ?>
                    </div>   
                    <div style="display:flex;width:100%">
                      <input type="text"  class="forma decimal  input_atm" id="amount" name="amount">
                    </div>    
                 </div>    

                 <div style="display:flex;width:100%">
                      <div style="display:flex;width:90px;padding-left:15px;" class="units_atm" >
                        <?php echo  lang('App.units'); ?>
                     </div>  
                       <div style="display:flex;width:100%">
                          <input type="text"  class="forma units_atm" id="units" name="units">
                       </div>    
                 </div>
                 <div style="display:flex;width:100%">
                     <div data-number="1" class="digits_atm"> 1 </div>
                     <div data-number="2" class="digits_atm"> 2 </div>
                     <div data-number="3" class="digits_atm"> 3 </div>
                     <div id="cancel" class="digits_atm" style="font-size:12px"> <?php echo strtoupper(lang('App.cancel')) ?>  </div>
 
                 </div>
                 <div style="display:flex;width:100%">
                     <div data-number="4" class="digits_atm"> 4 </div>
                     <div data-number="5" class="digits_atm"> 5 </div>
                     <div data-number="6" class="digits_atm"> 6 </div>
                     <div id="clear" class="digits_atm" style="font-size:12px"> <?php echo strtoupper(lang('App.clear')) ?> </div>
                 </div>
                 <div style="display:flex;width:100%">
                     <div data-number="7" class="digits_atm"> 7 </div>
                     <div data-number="8" class="digits_atm"> 8 </div>
                     <div data-number="9" class="digits_atm"> 9 </div>
                     <div id="delete" class="digits_atm" style="font-size:12px"> <?php echo strtoupper(lang('App.delete')) ?>  </div>
                 </div>
                 <div style="display:flex;width:100%">
                     <div data-number="." class="digits_atm" style="width:25%"> .  </div>
                     <div data-number="0" class="digits_atm" style="width:25%"> 0 </div>
                     <div id="btn_open_poistion" class="btn btn-block btn-success" style="width:50%;padding-top:20px;"> <?php echo lang('App.accept') ?>  </div>

                 </div>
                        
                <!-- ADVACNCED -->
                    <div style="display:none;">       
                        <label for="type">Type:</label>
                        <input type="text"  class="forma" id="type" name="type"><br><br>

                        <label for="stop_loss">Stop loss:</label>
                        <input type="text"  class="forma" id="stop_loss" name="stop_loss"><br><br>

                        <label for="take_profit">Take profit:</label>
                        <input type="text"  class="forma" id="take_profit" name="take_profit"><br><br>

                        <label for="leverage">Leverage:</label>
                        <input type="text"  class="forma" id="leverage" name="leverage"><br><br>
                        
                        <label for="short_long">Short long:</label>
                        <input type="text"  class="forma" id="short_long" name="short_long"><br><br>
                        <?php echo setting('timezone') ?>   
                  </div>    
                   <!-- END ADVACNCED               
                 <button class="btn btn-block btn-danger" type="button" id="btn_open_poistion"> <?php echo lang('App.invest') ?>  </button>    
  --> 
            </div>
           <div style="text-align:center;font-size:13px"> <?php echo lang('App.by_clicking'); ?>  </div>
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
var isconfirmed=0;
var put_buying_order=0;
 
$(function () {

  $( "#units" ).val("");
  $("#amount").val("");
  $('.decimal').keypress(function(evt){
    return (/^[0-9]*\.?[0-9]*$/).test($(this).val()+evt.key);
});
 


  $('.btn_invest').click(function() {
    
       contract_ID= $(this).attr('id'); 
       put_buying_order=0;
       isconfirmed=0;
       $("#amount").val("");
       $( "#units" ).val("");
 
       $('#modal-open-poistion .modal-title').html('<?php echo  lang('App.open_position_modal_title'); ?> '); 
       $('#modal-open-poistion .modal-body #texto-dialog').html('<?php echo lang('App.open_position_modal_text'); ?> '); 
       $('#modal-open-poistion .modal-body #contractId').html(contract_ID); 
       contract_info()
       $('#modal-open-poistion').modal('show'); 
  });



  $('#modal-open-poistion .modal-body #btn_open_poistion').click(function() {
      open_position(contract_ID)
   })


 
  function open_position(contract_ID){  
    $('#btn_open_poistion').prop('disabled', true);
    amount= $("#amount").val(); 
    units=$("#units").val(); 
    type=$("#type").val(); 
    stop_loss=$("#stop_loss").val(); 
    take_profit=$("#take_profit").val(); 
    leverage=$("#leverage").val(); 
    short_long=$("#short_long").val(); 
   
    var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"open_position", "contract_id" : contract_ID , "amount" : amount, "units" : units, "type" : type, "stop_loss" : stop_loss, "take_profit" : take_profit, "leverage" : leverage, "short_long" : short_long, "isconfirmed" : isconfirmed, "put_buying_order" : put_buying_order};
    $.ajax({
        url: "<?php  echo url("portfolio/open_position");?>",
        type: "POST",
        cache: false,
        "data": data,  
        success: function(data){
					 const myObj = JSON.parse(data);
           
           $('#btn_open_poistion').prop('disabled', false);
          
            if (myObj["error"]){
              if (myObj["error"]=="cant_complete_order"){
                
                $('#modal-open-poistion').modal('hide'); 

                        Swal.fire({
                            title: '<?php echo lang("App.cant_complete_order");?>',
                            text: myObj["msg"],
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#458a00',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '<?php echo lang("App.yes_confirm");?>',
                            cancelButtonText:  '<?php echo lang("App.no_thanks");?>',
                          }).then((result) => {
                            if (result.isConfirmed) {
                              
                              put_buying_order=1
                              open_position(contract_ID)
                              
                            }
                          })


              }
              if (myObj["error"]=="cant_pay_with_contract_funds"){ 
                $('#modal-open-poistion').modal('hide'); 
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text:  myObj["msg"],
                       })
                
              }
               
              if (myObj["error"]=="not_enogh_funds"){ 
                  toastr.warning('<?php echo lang("App.not_enogh_funds");?>');
                  
              }

              if (myObj["error"]=="confirm_funds"){
 
                $('#modal-open-poistion').modal('hide'); 
                         
                        Swal.fire({
                            title: '<?php echo lang("App.not_enogh_funds");?>',
                            text: myObj["msg"],
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#458a00',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '<?php echo lang("App.yes_confirm");?>',
                            cancelButtonText:  '<?php echo lang("App.no_thanks");?>',
                          }).then((result) => {
                            if (result.isConfirmed) {
                              isconfirmed=1;
                              open_position(contract_ID)
                              
                            }
                          })
                }
            }else{  
              if (put_buying_order==1){
 
                let timerInterval
                        Swal.fire({
                          title: '<?php echo lang("App.buying_order_setted_successfully");?>',
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

              }else{  
 
                      let timerInterval
                        Swal.fire({
                          title: '<?php echo lang("App.position_opened_successfully");?>',
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
            $('#modal-open-poistion').modal('hide'); 
           
            } 
        }
    });
  }

  
 
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
           console.log(data) 
           unit_value=myObj["unit_value"] 

           $('#contract_type').text(myObj["contract_type"])
           $('#contract_name').text(myObj["contract_name"])
           $('#contract_sku').text(myObj["contract_sku"])
           $('#contract_price').text(myObj["unit_value"])
            

           contract_logo()
        }
    });
  }

  function contract_logo(){  

      imageUrl="<?php echo base_url()."/uploads/logos/"; ?>"

      $("#contract_logo").css("background-image", "url('"+ imageUrl + contract_ID+".png')");
      $("#contract_logo").css("background-size", "70px 70px");

    }

// IF PASTE

$("#amount").change(function() {
 
})


$("#amount").bind('paste', function (e){
 
})

 ///// KEYBOARD

      //called when key is pressed in textbox
    $("#amount").keyup(function (e) {
      
       var amount= parseFloat($( "#amount" ).val());  
       if (!amount){amount=0;}   
        
        $( "#units" ).val(amount/unit_value)

        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
                  return false;
        }
       
      });


      function atm_change(clicked){
          var amount= parseFloat($( "#amount" ).val());      
          $( "#units" ).val(amount/unit_value)

          var atm_number = $("#amount").val() + $(clicked).data("number");
          $("#amount").val(atm_number);

          var amount= parseFloat($( "#amount" ).val());  
          if (!amount){amount=0}      
          $("#units").val(amount/unit_value)
      }



      $("[data-number]").on('click',function(){
        atm_change(this)
      });


      $("#delete").on('click',function(){
        var atm_number = $("#amount").val().slice(0,-1);
        $("#amount").val("");
        $("#amount").val(atm_number);

        var amount= parseFloat($( "#amount" ).val());   
        if (!amount){amount=0}   
        $( "#units" ).val(amount/unit_value)

      });

      $("#clear").on('click',function(){
        var atm_number = "0"
        $("#amount").val("");
        $( "#units" ).val("0");
      });

      $("#cancel").on('click',function(){
        var atm_number = "0"
        $("#amount").val("");
        $('#modal-open-poistion').modal('hide'); 
                
      });

});

</script>
<?=  $this->endSection('js') ?>



