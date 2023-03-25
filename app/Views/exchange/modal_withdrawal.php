<?= $this->section('content') ?>
<div class="modal fade" id="modal-withdrawal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background:#efefef;border: 0px;">
              <!-- ////////////////////////////////////// -->                
              <div style="display:flex;width:100%;margin-top: 5px;">
                    
                                <div class="form-group" style="width:100%">
                                        <label for="wallet_selector" style="width:100%;marign-bottom:10px;"><?php echo lang('App.select_wallet_to_withdrawal_from') ?>
                                            <select name="wallet_selector" id="wallet_selector" class="form-control select2">
                                              <option value="true">  accounts </option>
                                             </select>
                                        </div>
                               
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
                     <div id="clear" class="digits_atm" style="font-size:12px"> <?php echo strtoupper(lang('App.clear')) ?>  </div>
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
                     <div id="btn_request_widthdrawal" class="btn btn-block btn-success" style="width:50%;padding-top:20px;"> <?php echo lang('App.request_widthdrawal') ?>  </div>

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

var accountID;
 
 
 
$(function () {

  $("#amount").val("");
  $('.decimal').keypress(function(evt){
    return (/^[0-9]*\.?[0-9]*$/).test($(this).val()+evt.key);
});
 


$(document).on('click', '.btn_withdrawal', function(){ 

        accountID= $(this).data('id'); 
    
        $("#amount").val("");
        $('#modal-withdrawal .modal-title').html('<?php echo  lang('App.funds_withdrawal'); ?> '); 
        $('#modal-withdrawal .modal-body #texto-dialog').html('<?php echo lang('App.open_position_modal_text'); ?> '); 
        $('#modal-withdrawal').modal('show'); 
  });



  $(document).on('click', '#btn_request_widthdrawal', function(){ 
 
      withdrawal_request()
  });
   
   


 
  function withdrawal_request(){  
    
    amount= $("#amount").val(); 
 
    var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"withdrawal_request", "amount" : amount, "accountID" : accountID };
    $.ajax({
        url: "<?php  echo url("withdrawal/request_withdrawal");?>",
        type: "POST",
        cache: false,
        "data": data,  
        success: function(data){
					 const myObj = JSON.parse(data);
           
            
            if (myObj["error"]){
                    
                      $('#modal-open-poistion').modal('hide'); 
                      let timerInterval
                              Swal.fire({
                                title: '<?php echo lang("App.cant_withdrawal");?>',
                                icon: 'warning',
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
            
                      $('#modal-withdrawal').modal('hide'); 
 
                        let timerInterval
                        Swal.fire({
                          title: '<?php echo lang("App.withdrawal_request_successfully");?>',
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
        }
    });
  }

  
  load_wallets()

   // LOAD WALLETS 
function load_wallets(){  

var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"read" };

$.ajax({
    url: "<?php  echo url("wallet");?>",
    type: "POST",
    cache: false,
    "data": data,  
    success: function(data){
      
      const myObj = JSON.parse(data);
     
      console.log(myObj)
     
     if (myObj["error"]){
            
                        
          }else{  
            var max=myObj.wallets.length ;
            
           
                  for (var i = 0; i < max; i++) { 
                   console.log(myObj.wallets[i]['network'] )
                   console.log(myObj.wallets[i]['wallet_balance'] )
                  $('#wallet_selector').append('<option value="'+myObj.wallets[i]['contractID']+ '"> <b> '+myObj.wallets[i]['wallet_balance']+'</b> '+myObj.wallets[i]['network']+' </option>')                                             

                   
              } 
    
             }
          
 


    }
  })
}


 ///// KEYBOARD

      //called when key is pressed in textbox
      $("#amount").keypress(function (e) {

          var amount= parseFloat($( "#amount" ).val());  
          if (!amount){amount=0}      
 
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                      return false;
            }
      });


      $("[data-number]").on('click',function(){
        var amount= parseFloat($( "#amount" ).val());      
 
          var atm_number = $("#amount").val() + $(this).data("number");
          $("#amount").val(atm_number);

          var amount= parseFloat($( "#amount" ).val());  
          if (!amount){amount=0}      
 
      });


      $("#delete").on('click',function(){
        var atm_number = $("#amount").val().slice(0,-1);
        $("#amount").val("");
        $("#amount").val(atm_number);

        var amount= parseFloat($( "#amount" ).val());   
        if (!amount){amount=0}   
 
      });

      $("#clear").on('click',function(){
        var atm_number = "0"
        $("#amount").val("");
        
      });

      $("#cancel").on('click',function(){
        var atm_number = "0"
        $("#amount").val("");
        $('#modal-withdrawal').modal('hide'); 
                
      });

});

</script>
<?=  $this->endSection('js') ?>



