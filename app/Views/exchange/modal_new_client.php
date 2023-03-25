<?= $this->section('content') ?>
<div class="modal fade" id="modal-new-client">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
 
                    <div id="loader2" class="overlay justify-content-center align-items-center">
                            <i class="fas fa-2x fa-sync fa-spin"></i>
                    </div>
 
                    <div class="modal-header" style="background:#efefef;border: 0px;">
                            <h1> Nuevo Cliente / Proveedor </h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>          
                              
                    </div>  
        
     
                
                  <div class="modal-body" style="padding:20px">
                        


                
                   <div class="row">

                        <div class="col-sm-12">
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Nombre</span>
                              </div>
                              <input id="input_nombre" type="text" class="form-control" placeholder="nombre">
                          </div>
                          </br> 
                        </div>   


                        <div class="col-sm-12">
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Email</span>
                              </div>
                              <input id="input_email" type="text" class="form-control" placeholder="email">
                          </div>
                          </br> 
                        </div> 

                        <div class="col-sm-12">
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Dirección</span>
                              </div>
                              <input id="input_address" type="text" class="form-control" placeholder="Dirección"  >
                          </div>
                          </br> 
                        </div> 

                        <div class="col-sm-12">
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">RFC</span>
                              </div>
                              <input id="input_rfc" type="text" class="form-control" placeholder="RFC" >
                          </div>
                          </br> 
                        </div> 

                        <div class="col-sm-12">
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Tel</span>
                              </div>
                              <input id="input_tel" type="text" class="form-control" placeholder="Tel" value=" ">
                          </div>
                          </br> 
                        </div>


                    </div>

              
       </div>  

                   
                  
          
           <div style="display:flex;padding:20px;">
                   <div style="width:100%;margin:5px;"><input id="btn_save_client" class="btn btn-block btn-danger" type="submit" value="Nuevo" /></div>
           </div>
           
          
                </div>
                <!-- /.modal-content -->
           </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
</div>
 <?=  $this->endSection() ?>

<?= $this->section('content') ?>
 
 
<script>

  var action="";
  var total="";

 $(function () {
   
  $ 
  $(document).on('click', '#btn_save_client', function(){ 
    if ( $('#input_nombre').val()==""){ alert("Falta Nombre"); return false}
   if ( $('#input_email').val()==""){ alert("Falta email"); return false}

    new_client()
          
  });


   

  // VIEW 
$(document).on('click', '.btn_new', function(){ 
   
 
    $('#modal-new-client').modal('show');   
    $('#loader2').css('display','none');
});


     




 function new_client(){   

        name =  $('#input_nombre').val();  
        email =  $('#input_email').val();
        address =  $('#input_address').val();
        tel =  $('#input_tel').val(); 
        //userType = 
    
        //action =   

    var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "name": name ,"email":email, "address":address, "tel":tel};

    $.ajax({
        url: "<?php  echo url("metals/new_client");?>",
        type: "POST",
        cache: false,
        "data": data,  
        success: function(data){
					 const myObj = JSON.parse(data);  
          
           if (myObj["error"]){
            $('#modal-new-client').modal('hide'); 
            alert("error")
            
           }else{
            $('#modal-new-client').modal('hide'); 

            populate_clients();
                let timerInterval
                        Swal.fire({
                          title: 'Captura correcta',
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


  function populate_clients(){
    var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"getusers"};

          $.ajax({
              url: "<?php  echo url("metals/get_users");?>",
              type: "POST",
              cache: false,
              "data": data,  
              success: function(data){
                  const myObj = JSON.parse(data);

                  var max=myObj.length;
                  $('#listausers').empty();
                  for (var i = 0; i < max; i++) {
                    $('#listausers').append( "<option value='"+ myObj[i]['userID']+"'>"+ myObj[i]['name'] + " ("+ myObj[i]['username'] + ") </option>")
                    
                  }
             
               
                
              }

       
            });
  }


});

    </script>

 
<?=  $this->endSection() ?>



