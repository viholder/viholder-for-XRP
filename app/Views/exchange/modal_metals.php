<?= $this->section('content') ?>
<div class="modal fade" id="modal-metals">
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
                        


                  <label>Cliente / Proveedor</label>
                      <select class="select2" id="listausers" name="client_supplier"  style="width:100%">
                            <option value="-1"><b><?php echo lang('App.anonimo'); ?></b></option>

                     </select>
                     </br></br> 
                     <label>Categoría</label>
                     <select class="form-control"  id="category">
                          <option value=""> - </option>
                          <option value="ORO"> ORO</option>
                          <option value="PLATA"> PLATA</option>
                          <option value="DOLLARS">US DOLAR</option>
                          <option value="MERCURIO">MERCURIO</option>
                          <option value="JOYAS">JOYAS</option>
                          <option value="OTROS">OTROS</option>
                     </select>
                     </br> 
                    
                     <div id="conceptos_box">
                     <label>Concepto</label>
                     <select class="select2" id="conceptos" name="conceptos"    style="width:100%">
                            <option value=""> -  </option>
                            <option value="LAMINA"><b>Lamina</b></option>
                            <option value="BARRA"><b>Barra</b></option>
                            <option value="MONEDA_FINA"><b>Moneda Fina</b></option>
                            <option value="MONEDA"><b>Moneda</b></option>
                            <option value="GRANALLA"><b>Granalla</b></option>                        
                      </select>
                     </div>
                    
                     
<br>

                      <div id="laminadatos" style="display:none">
                   
                        <div class="row">

                                <div class="col-sm-6">
                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Num Barra</span>
                                      </div>
                                      <input id="ref_number" type="text" class="form-control" placeholder="Nuemro Barra">
                                  </div>
                                  </br> 
                              </div>   
                
                              <div class="col-sm-6">
                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Polvillos</span>
                                      </div>
                                      <input id="input_gr_dust" type="text" class="form-control" placeholder="Polvillos gramos">
                                  </div>
                              </div>  

                        </div> 

                      </div>

                      <div id="datosmetales" style="display:none">
                      <div class="row">
                     
                            <div class="col-sm-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Gramos</span>
                                    </div>
                                    <input  id="input_gr" type="text" class="form-control" placeholder="gramos">
                                </div>
                                </br> 
                            </div>   
                
                            <div class="col-sm-4">
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Kilataje</span>
                                  </div>
                                  <input  id="input_karat" type="text" class="form-control" placeholder="Kilataje" value="0">
                              </div>
                            </div>  

                            <div class="col-sm-4">
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Ley</span>
                                  </div>
                                  <input  id="input_ley" type="text" class="form-control" placeholder="ley">
                              </div>
                            </div> 

                            </div>
                            
                       </div> 

                    
                     

                 


                       <div id="datoscantidad" style="display:none">
              <div class="row">
               
              <div class="col-sm-6">
              </div> 
                        <div class="col-sm-6">
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Cantidad</span>
                              </div>
                              <input  id="input_cantidad" type="text" class="form-control" placeholder="">
                          </div>
                        </div> 
                  
                 </div> 
              </div> 

              <div class="row">
            <div class="col-sm-6">
                <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="precio_label">Precio ORO (MXN)</span>
                          </div>
                           <input  id="precio_concepto" type="text" class="form-control" placeholder="" value="">
               </div>    
            </div> 

            <div class="col-sm-6">
                            <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">TOTAL $</span>
                                  </div>
                                  <input  id="input_total" type="text" class="form-control">
                                  
                          </div>
            </div>       
       </div>  

                   
                  
          
          <div style="display:flex">
                   <div style="width:50%;margin:5px;"><input id="btn_sale" class="btn btn-block btn-danger" type="submit" value="<?php echo lang('App.sale');?>" /></div>
                   <div style="width:50%;margin:5px;"><input id="btn_buy"  class="btn btn-block btn-success" type="submit" value="<?php echo lang('App.buy');?>" /></div>
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
   
  $('#loader').css('display','none');   
  $("#input_cantidad").val("0")
  
  $(document).on('click', '#btn_sale, #btn_buy', function(){ 

        if ($('#category').val()==""){
          alert("Falta seleccionar categoría");
          return false
        } 
        if ($('#input_karat').val()==""){
          alert("Falta Kilataje");
          return false
        } 
        


        $('#loader').css('display','flex'); 
       
        action=$(this).attr('id')
         
        if (action=="btn_buy"){ action="1" }else{ action ="0" }
        new_order()
          
  });


   

  // VIEW 
$(document).on('click', '.btn_metals', function(){ 
     action="";
     $("#input_gr_dust").val("0")
     $("#input_cantidad").val("0")

    $('#loader').css('display','none'); 
    $('#modal-metals').modal('show');   
});


    //Initialize Select2 Elements
    $('.select2').select2()
 

    $(document).on('change', '#conceptos', function(){ 
      whatisselected()
    });
 
   function whatisselected(){
      seleccion =  $("#conceptos").val()
      $("#input_cantidad").val("0")
      $("#input_gr_dust").val("0")
      if ( $('#conceptos').val()=="LAMINA" || $('#conceptos').val()=="BARRA"  ){
         $('#laminadatos').css("display","block")
      }else{
         $('#laminadatos').css("display","none")
      }

      if ( $('#conceptos').val()=="MONEDA" || $('#conceptos').val()=="MONEDA_FINA"  ){
          if ($('#conceptos').val()=="MONEDA_FINA"){$('#input_karat').val("24"); $('#input_ley').val(".999"); } 
         $('#datoscantidad').css("display","block")
      } 
   }

   function hide_all(){
         $("#input_cantidad").val("0")
         $("#input_gr_dust").val("0")
         $('#conceptos_box').css("display","none")
         $('#precio_oro').css("display","none")
         $('#precio_concepto').val("")
         $('#precio_label').html("");
         $('#laminadatos').css("display","none")
         $('#datosmetales').css("display","none")
         $('#datoscantidad').css("display","none")
          
   }


   $('#category').change(function() {
      hide_all();
      if ( $('#category').val()=="ORO" || $('#category').val()=="PLATA" ){       
         $('#conceptos_box').css("display","block")
         $('#datosmetales').css("display","block")
      }

      if ( $('#category').val()=="ORO"){ 
        $('#precio_label').html("Precio Oro (MXN)")
       
        $('#precio_concepto').val((<?php  echo $gold; ?>).toFixed(2))
         
        
      }
      if ($('#category').val()=="PLATA"){ 
        $('#precio_label').html("Precio Plata (MXN)")
        $('#precio_concepto').val((<?php  echo $silver; ?>).toFixed(2))
        
    
      }
      if ($('#category').val()=="DOLLARS"){ 
        $('#precio_label').html("Precio US DOLAR (MXN)")
        $('#datoscantidad').css("display","block")
      }
      if ( $('#category').val()=="MERCURIO"){ 
        $('#precio_label').html("Precio Mercurio ")
      }
     
      whatisselected()
       
       
   });


    var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "action":"getusers"};

          $.ajax({
              url: "<?php  echo url("metals/get_users");?>",
              type: "POST",
              cache: false,
              "data": data,  
              success: function(data){
                  const myObj = JSON.parse(data);

                  var max=myObj.length;
                  for (var i = 0; i < max; i++) {
                    $('#listausers').append( "<option value='"+ myObj[i]['userID']+"'>"+ myObj[i]['name'] + " ("+ myObj[i]['username'] + ") </option>")
                    
                  }
             
               
                
              }

       
            });

     // CALCULATE     

          $( "#input_karat" ).keyup(function() {
            calculate_price()
          });

          $( "#input_gr" ).keyup(function() {
            calculate_price()
          });

          $( "#input_gr_dust" ).keyup(function() {
            calculate_price()
          });

          
          function calculate_price(){
  
            totalGR= parseFloat($("#input_gr").val())+parseFloat($("#input_gr_dust").val())
            console.log(totalGR);
            
            precio_concepto=parseFloat($("#precio_concepto").val())
            cantidad=parseFloat($("#input_cantidad").val())

            fino = parseFloat(totalGR)/24*parseFloat($("#input_karat").val());
            
            total=  parseFloat(fino)*parseFloat(precio_concepto)
            console.log("precio:"+precio_concepto+" gramos:"+totalGR+" fino:"+fino);
            $('#input_total').val(total.toFixed(2));

          }


 })
    




 function new_order(){   

        userID =  $('#listausers').val();   
        //userType = 
        category  =  $('#category').val();
        concept =$('#conceptos').val()
        ref_number = $('#ref_number').val();   
        gr =   $('#input_gr').val();  
        gr_dust =  $('#input_gr_dust').val();  
        karat =   $('#input_karat').val();
        input_total =   $('#input_total').val();  
        status = 0;
        //action =   

    var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "userID": userID, "category": category, "concept": concept   , "ref_number": ref_number , "gr": gr  , "gr_dust": gr_dust  , "status": status  , "input_total": input_total, "karat":karat ,"action":action };

    $.ajax({
        url: "<?php  echo url("metals/new_order");?>",
        type: "POST",
        cache: false,
        "data": data,  
        success: function(data){
					 const myObj = JSON.parse(data);  
          
           if (myObj["error"]){
            $('#modal-metals').modal('hide'); 
            alert("error")
            
           }else{
            $('#modal-metals').modal('hide'); 

            $('.listinvetory').empty();
            list_inventroy()
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


    </script>
<?=  $this->endSection() ?>



