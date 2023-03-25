<?= $this->extend('admin/auth/layout') ?>
<?= $this->section('content') ?>

 

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg"><?php echo lang('App.registernew'); ?></p>
 
 
   <div style="display:flex;margin-bottom:20px;">
      <div style="width:50%">
         <label for="langue"><?php echo lang('App.language'); ?></label>
      </div>
      <div style="width:50%;text-align:right">
      <a href="<?php echo url('auth/register/en'); ?>">  English   </a>
|
      <a href="<?php echo url('auth/register/es'); ?>">   Español  </a>
      </div>
   </div>
   <?php //echo  getUserlang(); ?>
    
 
      <?php // echo form_open_multipart('/auth/register/save', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>

        <div class="input-group mb-3">
           <input type="text" class="form-control" name="name" id="formClient-Name" required placeholder="<?php echo lang('App.user_enter_name') ?>" onkeyup="$('#formClient-Username').val(createUsername(this.value))" autofocus />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <input type="hidden" class="form-control" name="username" id="formClient-Username" required placeholder="<?php echo lang('App.user_enter_username') ?>" />


        <div class="input-group mb-3">
        <input type="email" class="form-control" name="email"  id="formClient-Email" required placeholder="<?php echo lang('App.user_enter_email') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="password" class="form-control" name="password" minlength="6" id="formClient-Password"   placeholder="<?php echo lang('App.user_password') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="password" class="form-control" name="confirm_password"  id="formClient-ConfirmPassword"   placeholder="<?php echo lang('App.user_password_confirm') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
                <?php echo lang('App.i_agree'); ?>
                <a href="https://viholder.com/vh/auth/login/terms/#<?php echo getUserlang(); ?>" target="_blank">  <?php echo lang('App.terms'); ?> </a>

              </label>
            
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
           <!--  <button type="submit" class="btn btn-primary btn-block"><?php echo lang('App.register'); ?></button> -->
           <div id="btn_register" style="cursor:pointer" class="btn btn-primary btn-block"><?php echo lang('App.register'); ?></div>

          </div>
          <!-- /.col -->
        </div>
 

        <?php // echo form_close(); ?>
<!--
      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>
-->
 
<script src="<?php echo assets_url('admin') ?>/plugins/jquery/jquery.min.js"></script>

 
    <a href="<?php echo url('/auth/login') ?>" class="text-center"> <?php echo lang('App.already_a_member'); ?></a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
 
  <?php  //  echo view('exchange/modal_manage_position'); ?>
  
 
<script>
 
$(function () {

        $("#btn_register").on('click',function(){
          
          if ($("#formClient-Password").val() != $("#formClient-ConfirmPassword").val()){
            alert("Password does not match")
            return false;
          }
          if (emailValidate($("#formClient-Email").val())==false){
            alert("Please enter valid email")
            return false;
          }

          register_new();
        });

        function register_new(){   

          formClientName=$("#formClient-Name").val();
          password= $("#formClient-Password").val();
          email=$("#formClient-Email").val();
          username=$("#formClient-Email").val();
          
          var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "email": email,  "username": username , "password": password, "name": formClientName };
          $.ajax({
              url: "<?php  echo url("/auth/register/save");?>",
              type: "POST",
              cache: false,
              "data": data,  
              success: function(data){
                const myObj = JSON.parse(data);
                
                if (myObj["error"]){
                  alert(myObj["msg"]);
                }else{
                 // alert("registered");
                 login();
                }

                
              }
          });
        }

    function emailValidate(sEmail) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(sEmail)) {
            return true;
        }
        else {
            return false;
        }
    }


    function login(){   

        formClientName=$("#formClient-Name").val();
        password= $("#formClient-Password").val();
        email=$("#formClient-Email").val();
        username=$("#formClient-Email").val();

        var data= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "email": email,  "username": username , "password": password, "name": formClientName };
        $.ajax({
            url: "<?php  echo url("/auth/register/check");?>",
            type: "POST",
            cache: false,
            "data": data,  
            success: function(data){
              const myObj = JSON.parse(data);
              console.log(myObj);
              if (myObj["error"]){
                alert(myObj["msg"]);
              }else{
                document.location.href = "<?php  echo url("/dashboard");?>";

               // document.location.href = "http://34.94.38.158/";
              }

              
            }
        });
        }

     
        function go_dashboard() {
         document.location.href = "<?php  echo url("/dashboard");?>";
        }


});

   
 function createUsername(name) {
      return name.toLowerCase()
        .replace(/ /g,'_')
        .replace(/[^\w-]+/g,'')
        ;;
  }
   
 

 
   


</script>

 

  <?=  $this->endSection() ?>

  