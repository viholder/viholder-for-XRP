<?= $this->section('content') ?>
<div class="modal fade" id="modal-agreement">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

          <div id="loader" class="overlay justify-content-center align-items-center">
                <i class="fas fa-2x fa-sync fa-spin"></i>
         </div>

            <div class="modal-header" style="background:#efefef;border: 0px;">
             
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>           

                               
             </div>  
 
     
          
            <div class="modal-body" style="padding:20px">
                   <div id="content"> - </div>
                
                   
                    <div id="edit_editor">
                      <div id="summernote">  </div>
                   </div>
                    <button id="btn_close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span class="btn btn-secondary" aria-hidden="true"><?php echo lang('App.close'); ?></span>
                   </button>

                   <div id="save_agreement"  class="btn btn-primary"> <?php echo lang('App.save'); ?> </div>
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

 // EDIT AGREEMENT
  $(document).on('click', '.btn_agreement_edit', function(){ 

      agreementID= $(this).data('id');  
      $('#content').html("");
      $('#loader').css("display", "flex");
      $('#content').css("display", "none");
      $('#save_agreement').css("display", "block");
      $('#edit_editor').css("display", "block");
      $('#btn_close').css("display", "none");  
      $('#modal-agreement').modal('show');   
      view_agreement(agreementID)
 
});

// SAVE AGREEMENT
$(document).on('click', '#save_agreement', function(){ 
  
 
  save_agreement(agreementID);

});


 

// VIEW AGREEMENT
$(document).on('click', '.btn_agreement', function(){ 

       agreementID= $(this).data('id');  
       $('#content').html("");
       $('#content').css("display", "block");
       $('#loader').css("display", "flex");
       $('#save_agreement').css("display", "none");
       $('#modal-agreement').modal('show');   
       $('#btn_close').css("display", "block");
       $('#edit_editor').css("display", "none");
       view_agreement(agreementID)
        
  });


  $('#summernote').summernote({
  height: 350,   //set editable area's height
  toolbar: [
  ['style', ['style']],
  ['font', ['bold', 'underline', 'clear']],
  ['fontname', ['fontname']],
  ['color', ['color']],
  ['para', ['ul', 'ol', 'paragraph']],
  ['insert', ['link']],
  ['view', ['fullscreen', 'codeview']],
],
});
   
   

 
 
  function view_agreement(agreementID){  
    
    $('#modal-select_contract').modal('hide');
 
    var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"read", "agreementID" : agreementID };
    $.ajax({
        url: "<?php  echo url("/agreements/view");?>",
        type: "POST",
        cache: false,
        "data": data,  
        success: function(data){  
         
					 const myObj = JSON.parse(data);
            
            if (myObj["error"]){
                    
                      $('#modal-agreement').modal('hide'); 
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
               
              $('#content').html(myObj["agremment"]['content']);
              $('#loader').css("display","none");
              $('#summernote').summernote('code', myObj["agremment"]['content']);

            } 
        }, error:  function(data){
           
             $('#modal-agreement').modal('hide'); 
        },
    });
  }


function save_agreement(agreementID){  

  
  text= $('#summernote').summernote('code')
 

var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"save", "agreementID" : agreementID , "text" : text };
$.ajax({
    url: "<?php  echo url("agreements/save");?>",
    type: "POST",
    cache: false,
    "data": data,  
    success: function(data){
       const myObj = JSON.parse(data);
         console.log(myObj) 
        
        if (myObj["error"]){
          toastr.warning(myObj["msg"]);

        }else{  
          toastr.success('<?php echo lang("App.saved_successfully");?>');
          console.log(myObj["done"]) 
        $('#modal-agreement').modal('hide');
        
        } 
    }
});
}



 

});

</script>
<?=  $this->endSection('js') ?>



