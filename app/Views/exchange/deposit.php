<?php
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo lang('App.deposit_funds') ?></h1>
      </div>
      <div class="col-sm-6">
       
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
<?php 
 
 
 $title_pay_method_transfer= lang("App.pay_method_transfer");
 $iconurl_pay_method_transfer= url("assets/admin/img/credit/left-right.png");
 $description_pay_method_transfer=lang("App.description_pay_method_transfer");


 $title_pay_method_cash_on_delivery=lang("App.pay_method_cash_on_delivery");
 $iconurl_pay_method_cash_on_delivery= url("assets/admin/img/credit/money.png");
 $description_pay_method_cash_on_delivery=lang("App.description_pay_method_cash_on_delivery");

 $title_pay_method_creditcard=lang("App.pay_method_creditcard");
 $iconurl_pay_method_creditcard= url("assets/admin/img/credit/debit-cards.png"); 
 $description_pay_method_creditcard=lang("App.description_pay_method_creditcard");

 $title_pay_method_creditcard_fragmented=lang("App.pay_method_creditcard_fragmented");
 $iconurl_pay_method_creditcard_fragmented= url("assets/admin/img/credit/credit-limit.png"); 
 $description_pay_method_creditcard_fragmented=lang("App.pay_method_creditcard_fragmented");

 $title_pay_method_oxxo=lang("App.pay_method_oxxo");
 $iconurl_pay_method_oxxo= url("assets/admin/img/credit/oxo-logo.png"); 
 $description_pay_method_oxxo=lang("App.pay_method_oxxo");

 $title_pay_method_paypal=lang("App.pay_method_paypal");
 $iconurl_pay_method_paypal= url("assets/admin/img/credit/paypal.png"); 
 $description_pay_method_paypal=lang("App.pay_method_paypal");
 
 $title_pay_method_metamask=lang("App.pay_method_metamask");
 $iconurl_pay_method_metamask= url("assets/admin/img/credit/MetaMask_Fox.png"); 
 $description_pay_method_metamask=lang("App.pay_method_metamask");
 
 $title_pay_method_solana=lang("App.pay_method_solana");
 $iconurl_pay_method_solana= url("assets/admin/img/logo-solana.png"); 
 $description_pay_method_solana=lang("App.pay_method_solana");

 
 
  

 $iconBTC=url("assets/admin/img/credit/bitcoin-btc-logo.png");
 $iconUSDT=url("assets/admin/img/credit/tether-usdt-logo.png");
 $iconETH= url("assets/admin/img/credit/ethereum-eth-logo.png");
 $iconXRP= url("assets/admin/img/credit/xrp.png");
 $iconSOL= url("assets/admin/img/logo-solana.png");

 

 ?>
<div class="row">
	     <!-- BANK TRANSFER -->
		 
		 <?php if (setting("pay_method_transfer")==true){ ?>
              <div class="col-md-3 col-lg-3 btn_fund_deposit" id="pay_method_transfer_box"  data-name="pay_method_transfer_box"  data-id="pay_method_transfer_modal"   data-toggle="modal" data-target="#pay_method_transfer_box_modal" > 
					 
				   <div class="mb-3 card" style="height:150px;overflow:hidden;text-align:center;margin:auto;">  
					     <div style="position:relative;top:0px;margin:auto;width:120px;height:70px;overflow:hidden;"  >

  							    <img src="<?php echo $iconurl_pay_method_transfer;  ?>"    width="60"  alt="<?php echo $title_pay_method_transfer; ?>">   
					   </div> 
					   
                            	<div style="position:relative;font-weight:bold;">  <?php echo $title_pay_method_transfer; ?> </div>
                             	<div style="font-size:11px;">  <?php // echo  $method->id." ".$method->chosen;?>  </div> 
		                  	    <div style="font-size:11px;height:30px;overflow:hidden;">  <?php echo  $description_pay_method_transfer;?></div> 
							  
					</div> 
 				</div>
			   <?php 
			}  ?>

 
				<!-- pay_method_cash_on_delivery -->
				<?php if (setting("pay_method_cash_on_delivery")==true){ ?>
					<div class="col-md-3 col-lg-3 btn_fund_deposit" id="pay_method_cash_on_delivery_box"  data-name="pay_method_cash_on_delivery_box"  data-id="pay_method_cash_on_delivery_modal"   data-toggle="modal" data-target="#pay_method_cash_on_delivery_box_modal" > 
					 
					 <div class="mb-3 card" style="height:150px;overflow:hidden;text-align:center;margin:auto;">  
						   <div style="position:relative;top:0px;margin:auto;width:120px;height:70px;overflow:hidden;"  >
  
									<img src="<?php echo $iconurl_pay_method_cash_on_delivery;  ?>"    width="70"  alt="<?php echo $title_pay_method_cash_on_delivery; ?>">   
						 </div> 
						 
								  <div style="position:relative;font-weight:bold;">  <?php echo $title_pay_method_cash_on_delivery; ?> </div>
								   <div style="font-size:11px;">  <?php // echo  $method->id." ".$method->chosen;?>  </div> 
								 <div style="font-size:11px;height:30px;overflow:hidden;">  <?php echo  $description_pay_method_cash_on_delivery;?></div> 
								
					  </div> 
				   </div>
				   <?php }  ?>

				   <!-- pay_method_creditcard_box -->
			       <?php if (setting("pay_method_creditcard")==true){ ?>
					<div class="col-md-3 col-lg-3" id="pay_method_creditcard_box"  data-name="pay_method_creditcard_box"  data-id="pay_method_creditcard_modal"   data-toggle="modal" data-target="pay_method_creditcard_box_modal" > 
					 
					 <div class="mb-3 card" style="height:150px;overflow:hidden;text-align:center;margin:auto;">  
						   <div style="position:relative;top:0px;margin:auto;width:120px;height:70px;overflow:hidden;"  >
  
									<img src="<?php echo $iconurl_pay_method_creditcard;  ?>"    width="70"  alt="<?php echo $title_pay_method_creditcard; ?>">   
						 </div> 
						 
								  <div style="position:relative;font-weight:bold;">  <?php echo $title_pay_method_creditcard; ?> </div>
								   <div style="font-size:11px;">  <?php // echo  $method->id." ".$method->chosen;?>  </div> 
								 <div style="font-size:11px;height:30px;overflow:hidden;">  <?php echo  $description_pay_method_creditcard;?></div> 
								
					  </div> 
				   </div>
                 <?php }  ?>


				  <!-- pay_method_creditcard_fragmented -->
				  <?php if (setting("pay_method_creditcard_fragmented")==true){ ?>
					<div class="col-md-3 col-lg-3" id="pay_method_creditcard_fragmented_box"  data-name="pay_method_creditcard_fragmented_box"  data-id="pay_method_creditcard_fragmented_modal"   data-toggle="modal" data-target="pay_method_creditcard_fragmented_box_modal" > 
					 
					 <div class="mb-3 card" style="height:150px;overflow:hidden;text-align:center;margin:auto;">  
						   <div style="position:relative;top:0px;margin:auto;width:120px;height:70px;overflow:hidden;"  >
  
									<img src="<?php echo $iconurl_pay_method_creditcard_fragmented;  ?>"    width="70"  alt="<?php echo $title_pay_method_creditcard_fragmented; ?>">   
						 </div> 
						 
								  <div style="position:relative;font-weight:bold;">  <?php echo $title_pay_method_creditcard_fragmented; ?> </div>
								   <div style="font-size:11px;">  <?php // echo  $method->id." ".$method->chosen;?>  </div> 
								 <div style="font-size:11px;height:30px;overflow:hidden;">  <?php echo  $description_pay_method_creditcard_fragmented;?></div> 
								
					  </div> 
				   </div>
                 <?php }  ?>


				  <!-- pay_method_creditcard_fragmented -->
				  <?php if (setting("pay_method_oxxo")==true){ ?>
					<div class="col-md-3 col-lg-3" id="pay_method_oxxo_box"  data-name="pay_method_oxxo_box"  data-id="pay_method_oxxo_modal"   data-toggle="modal" data-target="pay_method_oxxo_box_modal" > 
					 
					 <div class="mb-3 card" style="height:150px;overflow:hidden;text-align:center;margin:auto;">  
						   <div style="position:relative;top:0px;margin:auto;width:120px;height:70px;overflow:hidden;"  >
  
									<img src="<?php echo $iconurl_pay_method_oxxo;  ?>"    width="70"  alt="<?php echo $title_pay_method_oxxo; ?>">   
						 </div> 
						 
								  <div style="position:relative;font-weight:bold;">  <?php echo $title_pay_method_oxxo; ?> </div>
								   <div style="font-size:11px;">  <?php // echo  $method->id." ".$method->chosen;?>  </div> 
								 <div style="font-size:11px;height:30px;overflow:hidden;">  <?php echo  $description_pay_method_oxxo;?></div> 
								
					  </div> 
				   </div>
                 <?php }  ?>


				 	  <!-- pay_method_paypal -->
					   <?php if (setting("pay_method_paypal")==true){ ?>
					<div class="col-md-3 col-lg-3" id="pay_method_paypal_box"  data-name="pay_method_paypal_box"  data-id="pay_method_paypal_modal"   data-toggle="modal" data-target="pay_method_paypal_box_modal" > 
					 
					 <div class="mb-3 card" style="height:150px;overflow:hidden;text-align:center;margin:auto;">  
						   <div style="position:relative;top:0px;margin:auto;width:120px;height:70px;overflow:hidden;"  >
  
									<img src="<?php echo $iconurl_pay_method_paypal;  ?>"    width="70"  alt="<?php echo $title_pay_method_paypal; ?>">   
						 </div> 
						 
								  <div style="position:relative;font-weight:bold;">  <?php echo $title_pay_method_paypal; ?> </div>
								   <div style="font-size:11px;">  <?php // echo  $method->id." ".$method->chosen;?>  </div> 
								 <div style="font-size:11px;height:30px;overflow:hidden;">  <?php echo  $description_pay_method_paypal;?></div> 
								
					  </div> 
				   </div>
                 <?php }  ?>

                 <!-- pay_method_metamask -->
				  <?php if (setting("pay_method_metamask")==true){ ?>
					<div class="col-md-3 col-lg-3" id="pay_method_metamask_box"  data-name="pay_method_metamask_box"  data-id="pay_method_metamask_modal"   data-toggle="modal" data-target="pay_method_metamask_box_modal" > 
					 
					 <div class="mb-3 card" style="height:150px;overflow:hidden;text-align:center;margin:auto;">  
						   <div style="position:relative;top:0px;margin:auto;width:120px;height:70px;overflow:hidden;"  >
  
									<img src="<?php echo $iconurl_pay_method_metamask;  ?>"    width="70"  alt="<?php echo $title_pay_method_metamask; ?>">   
						 </div> 
						 
								  <div style="position:relative;font-weight:bold;">  <?php echo $title_pay_method_metamask; ?> </div>
								   <div style="font-size:11px;">  <?php // echo  $method->id." ".$method->chosen;?>  </div> 
								 <div style="font-size:11px;height:30px;overflow:hidden;">  <?php echo  $description_pay_method_metamask;?></div> 
								
					  </div> 
				   </div>
                 <?php }  ?>

 
		 
		 <?php if (setting("pay_method_crypto_btc")==true){ ?>
			<div class="col-md-3 col-lg-3 divdeposit btn_fund_deposit"  data-name="BTC"  data-id="BTC"   data-toggle="modal" data-target="#deposit_modal" >
				   <div class="mb-3 card" style="height:150px;overflow:hidden;text-align:center;margin:auto;">  
					     <div style="position:relative;top:0px;margin:auto;width:120px;height:70px;overflow:hidden;"  >

  							    <img src="<?php echo $iconBTC;  ?>"  width="60"  alt="bitcoin">   
					   </div> 
					   
                            	<div style="position:relative;font-weight:bold;">  Bitcoin  </div>
 		                  	 <div style="font-size:11px;height:30px;overflow:hidden;"> Deposita Crypto BTC en tu wallet</div> 
							  
					</div> 
 				</div>
		  <?php }  ?>

		  <?php if (setting("pay_method_crypto_usdt")==true){ ?>
 			<div class="col-md-3 col-lg-3 divdeposit btn_fund_deposit"  data-name="USDT"  data-id="USDT"   data-toggle="modal" data-target="#deposit_modal" >
				   <div class="mb-3 card" style="height:150px;overflow:hidden;text-align:center;margin:auto;">  
					     <div style="position:relative;top:0px;margin:auto;width:120px;height:70px;overflow:hidden;"  >

  							    <img src="<?php echo $iconUSDT;  ?>"  width="60"  alt="USDT">   
					   </div> 
					   
                            	<div style="position:relative;font-weight:bold;">  Tether  </div>
 		                  	 <div style="font-size:11px;height:30px;overflow:hidden;"> Deposita Crypto USDT en tu wallet</div> 
							  
					</div> 
 				</div>
		 <?php }  ?>

		 <?php if (setting("pay_method_crypto_eth")==true){ ?>

			   <div class="col-md-3 col-lg-3 divdeposit btn_fund_deposit"  data-name="ETH"  data-id="ETH"   data-toggle="modal" data-target="#deposit_modal" >
				   <div class="mb-3 card" style="height:150px;overflow:hidden;text-align:center;margin:auto;">  
					     <div style="position:relative;top:0px;margin:auto;width:120px;height:70px;overflow:hidden;"  >

  							    <img src="<?php echo $iconETH;  ?>"  width="60"  alt="ETH">   
					   </div> 
					   
                            	<div style="position:relative;font-weight:bold;">  Ethereum  </div>
 		                  	 <div style="font-size:11px;height:30px;overflow:hidden;"> Deposita Crypto ETH en tu wallet</div> 
							  
					</div> 
 				</div>
		 <?php }  ?>

		 <?php if (setting("pay_method_crypto_xrp")==true){ ?>

				 <div class="col-md-3 col-lg-3 divdeposit btn_fund_deposit"  data-name="XRP"  data-id="XRP"   data-toggle="modal" data-target="#deposit_modal" >
				   <div class="mb-3 card" style="height:150px;overflow:hidden;text-align:center;margin:auto;">  
					     <div style="position:relative;top:0px;margin:auto;width:120px;height:70px;overflow:hidden;"  >

  							    <img src="<?php echo $iconXRP;  ?>"  width="60"  alt="XRP">   
					   </div> 
					   
                            	<div style="position:relative;font-weight:bold;">  Ripple XRP  </div>
 		                  	 <div style="font-size:11px;height:30px;overflow:hidden;"> Deposita Crypto XRP en tu wallet</div> 
							  
					</div> 
 				</div>
		 <?php }  ?>

		 <?php if (setting("pay_method_crypto_sol")==true){ ?>

				<div class="col-md-3 col-lg-3 divdeposit btn_fund_deposit"  data-name="SOL"  data-id="SOL"   data-toggle="modal" data-target="#deposit_modal" >
				<div class="mb-3 card" style="height:150px;overflow:hidden;text-align:center;margin:auto;">  
						<div style="position:relative;top:0px;margin:auto;width:120px;height:70px;overflow:hidden;"  >

								<img src="<?php echo $iconSOL;  ?>"  width="60"  alt="SOL">   
					</div> 
	  
			   <div style="position:relative;font-weight:bold;">  Solana SOL  </div>
			   <div style="font-size:11px;height:30px;overflow:hidden;"> Deposita Crypto SOL en tu wallet</div> 
			 
   </div> 
</div>
<?php }  ?>

		  


	</div>

	</div> <!-- /.row -->

</section>
<!-- /.content -->

<?= $this->endSection() ?>

<?php  echo view('exchange/modal_fund_deposit'); ?>
