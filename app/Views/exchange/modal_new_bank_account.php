<?= $this->section('content') ?>
<div class="modal fade" id="modal-new_bank_account">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">New bank account</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">


                      <input class="form-control" type="text" placeholder="<?php echo lang('App.accountnumber'); ?>"  id="accountnumber" name="accountnumber">
              
                      <input class="form-control" type="text" placeholder="<?php echo lang('App.bank_name'); ?>"  id="bank_name" name="bank_name">
                      <input class="form-control" type="text" placeholder="<?php echo lang('App.bank_address'); ?>"  id="bank_address" name="bank_address">

                      <input class="form-control" type="text" placeholder="IBAN"  id="iban" name="iban">
                      <input class="form-control" type="text" placeholder="Bic / Swift"  id="swift" name="swift">
                    
                      <input class="form-control" type="text" placeholder="<?php echo lang('App.routing_number'); ?>"  id="routing_number" name="routing_number">

                  
                 
                 <button class="btn btn-block btn-danger" type="button" id="save_account"> <?php echo lang('App.save') ?>  </button>    
 
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

 

$(function () {

 


  $(document).on('click', '.btn_new_bank_account', function(){ 
  
      
       $('#modal-new_bank_account .modal-title').html('<?php echo  lang('App.new_bank_account'); ?> '); 
        
       $('#modal-new_bank_account').modal('show'); 
  });


  $('#save_account').click(function() {
     save_account() 
  })
   
 
  function save_account(){  
     
    accountnumber= $('#accountnumber').val()
    iban= $('#iban').val()
    swift= $('#swift').val()
    bank_address= $('#bank_address').val()
    bank_name= $('#bank_name').val()
    routing_number  =$('#routing_number').val()

    var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"save", "accountnumber" : accountnumber , "iban" : iban,  "swift" : swift , "bank_address" : bank_address, "bank_name" : bank_name, "routing_number" : routing_number };
    
    $.ajax({
        url: "<?php  echo url("accounts/new_bank_account");?>",
        type: "POST",
        cache: false,
        "data": data,  
        success: function(data){
					 const myObj = JSON.parse(data);
             console.log(myObj) 
            
            if (myObj["error"]){
              toastr.warning(myObj["msg"]);

            }else{  
              toastr.success('<?php echo lang("App.account_added_successfully");?>');

            $('#modal-new_bank_account').modal('hide');
            
            } 
        }
    });
  }

  
  $(document).on('click', '.btn_delete_bank_account', function(){ 
     
    accountID= $(this).data('id');
    
 
     var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"delete", "id" : accountID  };
     
     $.ajax({
         url: "<?php  echo url("accounts/delete_bank_account");?>",
         type: "POST",
         cache: false,
         "data": data,  
         success: function(data){
            const myObj = JSON.parse(data);

             if (myObj["error"]){
               toastr.warning(myObj["msg"]);
 
             }else{  
                toastr.success('<?php echo lang("App.account_deleted_successfully");?>');
 
             } 
         }
     });
   });
   
 
  
});
</script>
<?=  $this->endSection('js') ?>



