<?= $this->section('content') ?>
<div class="modal fade" id="modal-send_msg">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Send Message</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div style="display:flex;width:100%;margin-bottom:10px;">
                     <div style="width:80px;">  
                       <div id="user_profile_picture"  class="img-circle" style="width:50px;height:50px;">  </div>
                     </div> 
                     <div style="width:100%;">    
                        <div id="touserID" style="width:100%;color:#000000;"> touserID  </div>
                      </div>
                   </div>
 
                   <input class="form-control" type="text" placeholder="<?php echo lang('App.subject'); ?>"  id="msg_subject" name="msg_subject">
<br>
                   <div id="summernote" style="height:300px"> </div>

                 
                 <button class="btn btn-block btn-danger" type="button" id="btn_send_msge"> <?php echo lang('App.send_msg') ?>  </button>    
 
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

  
  $('#summernote').summernote({
  height: 150,   //set editable area's height
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


  $(document).on('click', '.btn_send_msg', function(){ 
  
       touserName= $(this).data('name');
       touserID= $(this).data('id'); 
       img_type=$(this).data('img_type'); 
       $('#modal-send_msg .modal-title').html('<?php echo  lang('App.send_msg'); ?> '); 
       $('#modal-send_msg .modal-body #texto-dialog').html('<?php echo lang('App.textto'); ?> '); 
       $('#modal-send_msg .modal-body #touserID').html("<b>"+touserName+"</b>"); 
       user_profile_image()
       $('#modal-send_msg').modal('show'); 
  });


  $('#btn_send_msge').click(function() {
    send_msg(touserID)
  })
   
 
  function send_msg(touserID){  

    msg_text= $('#summernote').summernote('code')
    msg_subject= $('#msg_subject').val()

    var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"sendmsg", "touserID" : touserID , "msg_to_send" : msg_text,  "msg_subject" : msg_subject  };
    $.ajax({
        url: "<?php  echo url("communication/send_msg");?>",
        type: "POST",
        cache: false,
        "data": data,  
        success: function(data){
					 const myObj = JSON.parse(data);
             console.log(myObj) 
            
            if (myObj["error"]){
              toastr.warning(myObj["msg"]);

            }else{  
              toastr.success('<?php echo lang("App.msg_sent_successfully");?>');

            $('#modal-send_msg').modal('hide');
            
            } 
        }
    });
  }

  
   

 

  function user_profile_image(){  
    
      imageUrl="<?php echo base_url()."/uploads/users/"; ?>"

      $("#user_profile_picture").css("background-image", "url('"+ imageUrl + touserID+"."+img_type);
      $("#user_profile_picture").css("background-size", "50px 50px");
 
    }
  
});
</script>
<?=  $this->endSection('js') ?>



