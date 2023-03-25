<?= $this->section('content') ?>
<div class="modal fade" id="modal-select_contract">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

          <div   class="overlay justify-content-center align-items-center loadericon">
                <i class="fas fa-2x fa-sync fa-spin"></i>
         </div>

            <div class="modal-header" style="background:#efefef;border: 0px;">
             
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>           

                               
             </div>  
 
     
          
            <div class="modal-body" style="padding:20px" >
          
                   <div id="list_content" style="height:200px;overflow:hidden;overflow-y: scroll;">  
                     
                      <div id="contract_list" style="" > </div>

                   </div>
                
                   
                <!--      
                    <button id="btn_close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span class="btn btn-secondary" aria-hidden="true"><?php echo lang('App.close'); ?></span>
                   </button>

                   <div id="save_agreement"  class="btn btn-primary"> <?php echo lang('App.save'); ?> </div>
           
-->
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

 <?=  $this->endSection() ?>

<?= $this->section('content') ?>
 
<script src="<?php echo assets_url('admin') ?>/plugins/summernote/summernote-bs4.min.js"></script>

<!-- page script -->
<script>

 var agreementID;

$(function () {

 
 


 

// VIEW AGREEMENT
$(document).on('click', '#new_agreement', function(){ 

        $('#modal-select_contract').modal('show');
 
        $('.loadericon').css("display", "flex");
 
   load_contracts()
        
  });



 
 
  function load_contracts(){  
    
    
    var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"read"};
    $.ajax({
        url: "<?php  echo url("/contracts");?>",
        type: "POST",
        cache: false,
        "data": data,  
        success: function(data){  
         
					 const myObj = JSON.parse(data);
            
            if (myObj["error"]){
                    
                      $('#modal-select_contract').modal('hide'); 
                      let timerInterval
                              Swal.fire({
                                title: '<?php echo lang("App.error");?>',
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
             
              var max=myObj['contracts']['val'].length;
          console.log(max)
              if (max>0){ 
                  for (var i = 0; i < max; i++) {  
                    
                  botonaddagree=' <div  data-id="'+myObj['contracts']['val'][i]['id']+'" class="btn_agreement_edit btn btn-sm btn-info" style="right: 0px; position: absolute; margin-right: 10px;" ><i class="fa fa-plus"></i> </div>'
                  

                    $('#contract_list').append("<div  style='margin-bottom:10px;position:relative;'>"+myObj['contracts']['val'][i]['contract_name']+botonaddagree+"</div>")
                  }
               }
          
              $('.loadericon').css("display", "none");
              

            } 
        }, error:  function(data){
           
             $('#modal-select_contract').modal('hide'); 
        },
    });
  }



 

});

</script>
<?=  $this->endSection('js') ?>



