<?= $this->section('content') ?>
<div class="modal fade" id="modal-fund_deposit">
    <div class="modal-dialog">
          <div class="modal-content">
        
            <div class="modal-header" style="background:#efefef;border: 0px;">
                       <div style="display:flex;width:100%;margin-top: 5px;">
                              <div style="width:80px;">  
                                  <div id="contract_logo" style="width:70px;height:70px;border-radius:12%;overflow:hidden;"><img id="depo_logo" src="assets/admin/img/credit/xrp.png" width="70">  </div>
                               </div>  
                                <div style="width:100%;margin-left:10px;">  
                                
                                <div style="font-size:19px;font-weight:300;line-height:110%;">  <span id="contract_type" > <?php echo strtoupper(lang('App.deposit_funds')); ?>  </span> | <span id="contract_sku" style="font-weight:800;"> XRP </span></div>  
                                     <div id="contract_name" style="font-size:18px;text-overflow: ellipsis;"></div>
                                     <div id="underline_text"><span id="contract_price" style="margin-right:0px;font-size:32px;line-height:28px;font-weight:800;"></span><span style="font-size:14px"><?php echo lang('App.send_just');?> <span id="coinis"> XRP </span> <?php echo lang('App.to_this_account');?></span>   </div> 
                                 </div>
                      </div>  

                      <div style="width:30px;top:-5px;"> 
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                   </button>
                       </div>


            </div>

            <div class="modal-body" style="padding:0px">
                    <div class="card-body">

                          <div id="gatewey-trf" style="display:none;margin:auto;text-align:center"> 
                          
                            <div id="msg"> SORRY. NOT AVAILABLE IN YOUR ZONE  </div>
                          </div> 

                         <div id="gatewey-xrp" style="display:none;margin:auto;text-align:center"> 
                              
                        <!--     <img   src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo  setting('wallet_xrp'); ?>%2F&choe=UTF-8" title="QR CODE" style="max-width:200px" />  -->
                        <img  src="<?php echo  url("assets/admin/img/XRP-01-VIHOLDER.png"); ?>" title="QR CODE" style="max-width:200px" /> 
                            
                         
                        <div style="display:flex" class="btn_copy" data-wallet="<?php echo setting('wallet_xrp'); ?>">
                                   <div   style="width:20px;"></div>
                                   <div   style="width:100%;padding:10px;font-weight:800;font-size:13px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;background:#000000;border-radius:12px;color:#fff;"><?php echo setting('wallet_xrp'); ?></div> 
                                   <div   style="width:20px;display:block-inline;"> 
                                    <i style="padding:10px;font-size:20px;" class="fas fa-copy"></i> 
                                  </div>
                              </div>
                         </div>  

                         <div id="gatewey-btc" style="display:none;margin:auto;text-align:center"> 
                         <!--   <img  src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo  setting('wallet_btc'); ?>%2F&choe=UTF-8" title="QR CODE" style="max-width:200px" />  -->
                         <img  src="<?php echo  url("assets/admin/img/BTC-01-VIHOLDER.png"); ?>" title="QR CODE" style="max-width:200px" /> 

                              <div style="display:flex" class="btn_copy" data-wallet="<?php echo setting('wallet_btc'); ?>">
                                   <div   style="width:20px;"></div>
                                   <div   style="width:100%;padding:10px;font-weight:800;font-size:13px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;background:#000000;border-radius:12px;color:#fff;"><?php echo setting('wallet_btc'); ?></div> 
                                   <div   style="width:20px;display:block-inline;"> 
                                    <i style="padding:10px;font-size:20px;" class="fas fa-copy"></i> 
                                  </div>
                              </div>
                         </div> 

                         <div id="gatewey-eth" style="display:none;margin:auto;text-align:center"> 
                          <!--    <img  src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo  setting('wallet_eth'); ?>%2F&choe=UTF-8" title="QR CODE" style="max-width:200px" />  -->
                          <img  src="<?php echo  url("assets/admin/img/ETH-01-VIHOLDER.png"); ?>" title="QR CODE" style="max-width:200px" /> 

                              <div style="display:flex" class="btn_copy" data-wallet="<?php echo setting('wallet_eth'); ?>">
                                   <div   style="width:20px;"></div>
                                   <div   style="width:100%;padding:10px;font-weight:800;font-size:13px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;background:#000000;border-radius:12px;color:#fff;"><?php echo setting('wallet_eth'); ?></div> 
                                   <div   style="width:20px;display:block-inline;"> 
                                    <i style="padding:10px;font-size:20px;" class="fas fa-copy"></i> 
                                  </div>
                              </div>
                         </div> 

                         <div id="gatewey-usdt" style="display:none;margin:auto;text-align:center"> 
                         <b>Network: Ethereum (ERC-20)</b><br>
                           <!--   <img  src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo  setting('wallet_tether'); ?>%2F&choe=UTF-8" title="QR CODE" style="max-width:200px" /> -->
                           <img  src="<?php echo  url("assets/admin/img/USDT-01-VIHOLDER.png"); ?>" title="QR CODE" style="max-width:200px" /> 

                           <div style="display:flex" class="btn_copy" data-wallet="<?php echo setting('wallet_tether'); ?>">
                                   <div   style="width:20px;"></div>
                                   <div   style="width:100%;padding:10px;font-weight:800;font-size:13px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;background:#000000;border-radius:12px;color:#fff;"><?php echo setting('wallet_tether'); ?></div> 
                                   <div   style="width:20px;display:block-inline;"> 
                                    <i style="padding:10px;font-size:20px;" class="fas fa-copy"></i> 
                                  </div>
                              </div>
                         </div> 


                         <div id="gatewey-sol" style="display:none;margin:auto;text-align:center"> 
                         <b>Solana</b><br>
                           <!--    <img  src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo  setting('wallet_sol'); ?>%2F&choe=UTF-8" title="QR CODE" style="max-width:200px" />   
                            <img  src="<?php echo  url("assets/admin/img/logo-solana.png"); ?>" title="QR CODE" style="max-width:200px" /> -->
 
                           <div style="display:flex" class="btn_copy" data-wallet="<?php echo setting('wallet_sol'); ?>">
                                   <div   style="width:20px;"></div>
                                   <div   style="width:100%;padding:10px;font-weight:800;font-size:13px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;background:#000000;border-radius:12px;color:#fff;"><?php echo setting('wallet_sol'); ?>  </div> 
                                   <div   style="width:20px;display:block-inline;"> 
                                    <i style="padding:10px;font-size:20px;" class="fas fa-copy"></i> 
                                  </div>
                              </div>
                         </div> 




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

  
$(function () {

 
  

  $(document).on('click', '.btn_fund_deposit', function(){
     gatewayname= $(this).data("name");

      $('#gatewey-xrp').css("display", "none");
     $('#gatewey-eth').css("display", "none");
     $('#gatewey-usdt').css("display", "none");
     $('#gatewey-btc').css("display", "none");
     $('#gatewey-trf').css("display", "none");
     $('#gatewey-sol').css("display", "none");

        if (gatewayname=="XRP"){
           $('#gatewey-xrp').css("display", "block");
           $("#depo_logo").attr("src","assets/admin/img/credit/xrp.png");
           $("#contract_sku").html("XRP")
           $("#coinis").html("XRP")
          
        }
        if (gatewayname=="ETH"){
           $('#gatewey-eth').css("display", "block");
           $("#depo_logo").attr("src","assets/admin/img/credit/ethereum-eth-logo.png");
           $("#contract_sku").html("ETH")
           $("#coinis").html("ETH")
       
        }
        if (gatewayname=="USDT"){
           $('#gatewey-usdt').css("display", "block");
           $("#depo_logo").attr("src","assets/admin/img/credit/tether-usdt-logo.png");
           $("#contract_sku").html("USDT")
           $("#coinis").html("USDT")
          
        }
        if (gatewayname=="BTC"){
           $('#gatewey-btc').css("display", "block");
           $("#depo_logo").attr("src","assets/admin/img/credit/bitcoin-btc-logo.png");
           $("#contract_sku").html("BTC")
           $("#coinis").html("BTC")
         
        }

        if (gatewayname=="SOL"){
           $('#gatewey-sol').css("display", "block");
           $("#depo_logo").attr("src","assets/admin/img/logo-solana.png");
           $("#contract_sku").html("SOL")
           $("#coinis").html("SOL")
         
        }


        if (gatewayname=="pay_method_transfer_box"){
           $('#gatewey-trf').css("display", "block");
           $("#depo_logo").attr("src","assets/admin/img/credit/left-right.png");
           $("#contract_sku").html("<?php echo strtoupper(lang("App.pay_method_transfer")); ?>")
           $("#underline_text").html(" ")
            
        }

        if (gatewayname=="pay_method_cash_on_delivery_box"){
           $('#gatewey-trf').css("display", "block");
           $("#depo_logo").attr("src","assets/admin/img/credit/money.png");
           $("#contract_sku").html("<?php echo strtoupper(lang("App.pay_method_cash_on_delivery")); ?>")
    
         
        }


       
        $('#modal-fund_deposit').modal('show'); 
  });
    

  $(document).on('click', '.btn_copy', function(){
     tocopyadd=$(this).data("wallet")


    const textToCopy = tocopyadd; //document.querySelector('#'+tocopyadd).innerText

  
     // copywalletaddress(tocopyadd)
      navigator.clipboard.writeText(textToCopy).then(
            function() {
              /* clipboard successfully set */
              window.alert('Copied: '+textToCopy) 
            }, 
            function() {
              /* clipboard write failed */
              window.alert('Opps! Your browser does not support the Clipboard API')
            }
          )


    });


});
 
 
 
</script>
<?=  $this->endSection('js') ?>



