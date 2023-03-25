 <!-- /.content-wrapper -->
 
 
            <div style="font-size:14px;text-align:center;"><b> VIHOLDER LTD </b></div>
            <div style="font-size:12px;text-align:center;">UK Companies House, Company number 14281322</div>
            <div style="font-size:12px;text-align:center;">20-22 Wenlock Road, London, England, N1 7GU</div>
            <br>
            <div style="font-size:12px;text-align:center;"><a href="https://viholder.com/vh/auth/login/terms/" target="_blank">  <?php echo lang('App.terms_and_conditions'); ?> </a></div>
<div style="height:150px;display:block">             
</div>
  <footer class="main-footer mobil-menu">
     
    <?php  echo view('exchange/notifications'); ?>
  
    <div style="display:flex;align-content: flex-end;justify-content: center;text-align:center;">

          <div id="btn_portfolio" style="width:25%;border-right:2px solid #efefef;font-size:12px;"> <i class="fas fa-suitcase"  style="font-size:20px;width:100%;"></i> Portfolio  </div>
          <div id="btn_wallet" style="width:25%;border-right:2px solid #efefef;font-size:12px;"> <i class="fas fa-wallet"  style="font-size:20px;width:100%;"></i> Wallet </div>
          <div id="btn_market" style="width:25%;border-right:2px solid #efefef;font-size:12px;"> <i class="fas fa-store"  style="font-size:20px;width:100%;"></i>  Market  </div>
          <div id="btn_contracts" style="width:25%;font-size:12px;"> <i class="fas fa-file" style="font-size:20px;width:100%;"></i> Contracts </div>
     </div>
  </footer>
  <?= $this->section('js') ?>
<script src="<?php echo assets_url('admin') ?>/js/viholder-portfolio.js"></script>

<!-- page script -->
<script>

var url2="<?php echo url('/portfolio'); ?>"

///// UPDATE PORFTOLIO 
 
      var datatoload2= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "id": "",  "active": 1};   
     
      top_dashboard(datatoload2,url2);
      
      let actualizar = setInterval(myTimer2, <?php echo setting("update_interval"); ?>);
      
      function myTimer2() {
       
        top_dashboard(datatoload2,url2);
      }
      

///// END UPDATE PORFTOLIO 

  $(function () {

 
        $(document).on('click','#btn_portfolio',function(event) {

             window.location.href = "<?php  echo url("portfolio");?>"
          
        });
        $(document).on('click','#btn_wallet',function(event) {

             window.location.href =  "<?php  echo url("wallet");?>"

        });
        $(document).on('click','#btn_market',function(event) {

              window.location.href =  "<?php  echo url("market");?>" 

        });
        $(document).on('click','#btn_contracts',function(event) {

              window.location.href = "<?php  echo url("contracts");?>" 

        });
   
});


 



</script>
<?=  $this->endSection() ?>
    