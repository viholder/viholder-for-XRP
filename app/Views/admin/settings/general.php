<?= $this->extend('admin/layout/default') ?>
<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo lang('App.settings') ?></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo url('/') ?>"><?php echo lang('App.home') ?></a></li>
          <li class="breadcrumb-item active"><?php echo lang('App.settings') ?></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

 


  <div class="row">

  


    <div class="col-sm-3">
      <?php // die(var_dump($_page->menu)) ?>

      <?= $this->include('admin/settings/sidebar'); ?>

    </div>

        


    <div class="col-sm-5">

      <!-- Default card -->
      <div class="card card-secondary">

        <div class="card-header with-border">
          <h3 class="card-title"><?php echo lang('App.general_setings') ?></h3>
        </div>

        <?php echo form_open_multipart('settings/generalUpdate', [ 'class' => 'form-validate', 'autocomplete' => 'off', 'method' => 'post' ]); ?>
        <div class="card-body">

          <div class="form-group">
            <label for="formSetting-Company-Name" style="width:100%"><?php echo lang('App.settings_timezone') ?></label>
            <select name="timezone" id="timezone" class="form-control select2">
              <?php $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL); ?>
              <?php foreach ($tzlist as $key => $value): ?>
                <?php $sel = setting('timezone')==$value ? 'selected' : ''; ?>
                <option value="<?php echo $value ?>" <?php echo $sel ?>><?php echo $value ?></option>
              <?php endforeach ?>
            </select>
          </div>
          

          <div class="form-group">
            <label for="formSetting-Language-Name"><?php echo lang('App.default_lang') ?></label>
            <select name="default_lang" id="default_lang" class="form-control select2">
              <?php $tzlist = supported_languages(); ?>
              <?php foreach ($tzlist as $key => $value): ?>
                <?php $sel = setting('default_lang')==$key ? 'selected' : ''; ?>
                <option value="<?php echo $key ?>" <?php echo $sel ?>><?php echo $value->name.' ('.$value->nativeName.')' ?></option>
              <?php endforeach ?>
            </select>
          </div>
          

          <div class="form-group">
            <label for="formSetting-DateFormat"><?php echo lang('App.settings_date_format') ?> &nbsp; <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-info-circle"></i></a></label>
            <input type="text" class="form-control" name="date_format" id="formSetting-DateFormat" value="<?php echo setting('date_format') ?>" required placeholder="<?php echo lang('App.settings_date_format') ?>" autofocus />
          </div>

          <div class="form-group">
            <label for="formSetting-DateTimeFormat"><?php echo lang('App.settings_datetime_format') ?> &nbsp; <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-info-circle"></i></a> </label>
            <input type="text" class="form-control" name="datetime_format" id="formSetting-DateTimeFormat" value="<?php echo setting('datetime_format') ?>" required placeholder="Enter Date Time Format" autofocus />
            
          </div>

          <br>
          <h4><?php echo lang('App.settings_g_recaptcha') ?> &nbsp; &nbsp; <input type="checkbox" value="ok" class="js-switch" name="google_recaptcha_enabled" onchange="recaptchKeysHideShow( $(this).is(':checked') )" <?php echo setting('google_recaptcha_enabled') == '1' ? 'checked' : '' ?> /> </h4>
          <hr>

          <div class="form-group recaptchKeysHideShow">
            <label for="formSetting-DateTimeFormat"><?php echo lang('App.settings_gr_sitekey') ?> </label>
            <input type="text" class="form-control" name="google_recaptcha_sitekey" id="formSetting-DateTimeFormat" value="<?php echo setting('google_recaptcha_sitekey') ?>" required placeholder="<?php echo lang('App.settings_gr_sitekey') ?>" autofocus />
            
          </div>
          <div class="form-group recaptchKeysHideShow">
            <label for="formSetting-DateTimeFormat"><?php echo lang('App.settings_gr_secretkey') ?> </label>
            <input type="text" class="form-control" name="google_recaptcha_secretkey" id="formSetting-DateTimeFormat" value="<?php echo setting('google_recaptcha_secretkey') ?>" required placeholder="<?php echo lang('App.settings_gr_secretkey') ?>" autofocus />
      
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-flat btn-primary"><?php echo lang('App.submit') ?></button>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </div>


 <!-- servers card -->
          <div class="col-sm-4">

                      <div class="card card-secondary">

                            <div class="card-header with-border">
                              <h3 class="card-title"><?php echo lang('App.currency_settings') ?></h3>
                            </div>
                            <div class="card-body"> 
                                  <div class="form-group">
                                      <label for="formSetting-basecurrency" style="width:100%"> <?php echo lang('App.basecurrency') ?> &nbsp;
                                      <input type="text" class="form-control" name="base_currency" id="formSetting-basecurrency" value="<?php echo setting('base_currency') ?>" required placeholder="<?php echo lang('App.basecurrency') ?>" autofocus />
                                  </div>

                                  <div class="form-group"> 
                                    <label for="formSetting-server-xrp" style="width:100%"><?php echo lang('App.currency_symbol') ?>  
                                    <input type="text"  class="form-control" name="currency_symbol"   value="<?php echo setting('currency_symbol') ?>" required placeholder="<?php echo lang('App.currency_locale') ?>" autofocus />
                                  </div>
                                  
                                  <label for="currency_locale"><?php echo lang('App.currency_locale') ?>  </label>

                                <div class="form-group">
                                    <select name="currency_locale" id="currency_locale" class="form-control select2">
                                      <option value="">None</option>
                                      <option value="en_US"<?php if (setting('currency_locale')=="en_US"){ echo 'selected'; } ?>>en_US ($1,234.56)</option>
                                      <option value="de_DE"<?php if (setting('currency_locale')=="de_DE"){ echo 'selected'; } ?>>de_DE (1.234,56 €)</option>
                                      <option value="en_GB"<?php if (setting('currency_locale')=="en_GB"){ echo 'selected'; } ?>>en_GB (£1,234.56)</option>
                                      <option value="ja_JP"<?php if (setting('currency_locale')=="ja_JP"){ echo 'selected'; } ?>>ja_JP (YEN 1,234.56)</option>
                                    </select>
                                </div>


                                  <div class="form-group">
                                    <label for="formSetting-server-xrp" style="width:100%"><?php echo lang('App.currency_fraction') ?>  
                                    <input type="text"  class="form-control" name="currency_fraction" id="basecurrency-fraction" value="<?php echo setting('currency_fraction') ?>" required placeholder="<?php echo lang('App.currency_fraction') ?>" autofocus />
                                  </div>

                            </div>
                      </div>


                      <div class="card card-secondary">

                          <div class="card-header with-border">
                            <h3 class="card-title"><?php echo lang('App.server_settings') ?></h3>
                          </div>
                          <div class="card-body"> 

                                <div class="form-group">
                                  <label for="formSetting-server-xrp" style="width:100%"><?php echo lang('App.server') ?> &nbsp Ripple XRP
                                  <input type="text"  class="form-control" name="server_xrp" id="formSetting-server-xrp" value="<?php echo setting('server_xrp') ?>" required placeholder="<?php echo lang('App.server_xrp') ?>" autofocus />
                                </div>

                                <div class="form-group">
                                  <label for="formSetting-server-btc" style="width:100%"><?php echo lang('App.server') ?> &nbspBitcoin BTC
                                  <input type="text"  class="form-control" name="server_bitcoin" id="formSetting-server-btc" value="<?php echo setting('server_bitcoin') ?>" required placeholder="<?php echo lang('App.server_btc') ?>" autofocus />
                                </div>

                                <div class="form-group">
                                  <label for="formSetting-server-eth" style="width:100%"><?php echo lang('App.server') ?> &nbspEthereum ETH
                                  <input type="text"  class="form-control" name="server_eth" id="formSetting-server_eth" value="<?php echo setting('server_eth') ?>" required placeholder="<?php echo lang('App.server_eth') ?>" autofocus />
                                </div>

                                <div class="form-group">
                                  <label for="formSetting-server_bnb" style="width:100%"><?php echo lang('App.server') ?> &nbspSmart Chain BNB
                                  <input type="text"  class="form-control" name="server_bnb" id="formSetting-server_bnb" value="<?php echo setting('server_bnb') ?>" required placeholder="<?php echo lang('App.server_bnb') ?>" autofocus />
                                </div>


                          </div>
                      </div>

                    


                       

        </div>
            




</div>



<div class="row">
  <!-- -->
                     <div class="col-sm-4">
                          <div class="card card-secondary">
                              <div class="card-header with-border">
                                <h3 class="card-title"><?php echo lang('App.contracts') ?></h3>
                              </div>
                                  <div class="card-body"> 


                                        <label for="can_use_contract_funds"><?php echo lang('App.can_use_contract_funds') ?>  </label>

                                        <div class="form-group">
                                            <select name="can_use_contract_funds" id="can_use_contract_funds" class="form-control select2">
                                              <option value="true"<?php if (setting('can_use_contract_funds')=="true"){ echo 'selected'; } ?>>  <?php echo lang('App.yes'); ?></option>
                                              <option value="false"<?php if (setting('can_use_contract_funds')=="false"){ echo 'selected'; } ?>> <?php echo lang('App.no'); ?></option>
                                            </select>
                                        </div>


                                        <label for="permit_pay_with_contract_funds"><?php echo lang('App.permit_pay_with_contract_funds') ?>  </label>

                                        <div class="form-group">
                                            <select name="permit_pay_with_contract_funds" id="permit_pay_with_contract_funds" class="form-control select2">
                                              <option value="true"<?php if (setting('permit_pay_with_contract_funds')=="true"){ echo 'selected'; } ?>>  <?php echo lang('App.yes'); ?></option>
                                              <option value="false"<?php if (setting('permit_pay_with_contract_funds')=="false"){ echo 'selected'; } ?>> <?php echo lang('App.no'); ?></option>
                                            </select>
                                        </div> 

                                  </div>
                           </div>
                       </div>
        
 
<!-- -->
        <div class="col-sm-4">
          
                         <div class="card card-secondary">
                            <div class="card-header with-border">
                              <h3 class="card-title"><?php echo lang('App.messages') ?></h3>
                            </div>
                                  <div class="card-body"> 

                                      <div class="form-group">
                                        <label for="formSetting-server-xrp" style="width:100%"><?php echo lang('App.update_msg_interval') ?> (<?php echo lang('App.milliseconds') ?>)
                                        <input type="text"  class="form-control" name="update_msg_interval" id="formSetting-update_msg_interval" value="<?php echo setting('update_msg_interval') ?>" required placeholder="<?php echo lang('App.update_msg_interval') ?>" autofocus />
                                      </div>
                                  </div>
                          </div>


        </div>


<!-- -->
        <div class="col-sm-4">

                       <div class="card card-secondary">
                          <div class="card-header with-border">
                            <h3 class="card-title"><?php echo lang('App.portfolio') ?></h3>
                          </div>
                          <div class="card-body"> 

                                <div class="form-group">
                                  <label for="formSetting-server-xrp" style="width:100%"><?php echo lang('App.update_interval') ?> (<?php echo lang('App.milliseconds') ?>)
                                  <input type="text"  class="form-control" name="update_interval" id="formSetting-update_interval" value="<?php echo setting('update_interval') ?>" required placeholder="<?php echo lang('App.update_interval') ?>" autofocus />
                                </div>

                          </div>
                      </div>

        </div>



<!-- -->
 
<div class="col-sm-6">

        <div class="card card-secondary">
          <div class="card-header with-border">
            <h3 class="card-title"><?php echo lang('App.payment_methods') ?></h3>
          </div>
                  <div class="card-body"> 
                  
                            <div class="row">
                                <div class="col-sm-6"> 
                                  <div class="form-group">
                                                <div class="form-check">
                                                    <input name="pay_method_transfer" type="checkbox" class="form-check-input" <?php if (setting('pay_method_transfer')==true){ echo 'checked'; } ?>>
                                                    <label class="form-check-label"><?php echo lang('App.pay_method_transfer') ?></label>
                                                </div>

                                                <div class="form-check">
                                                    <input name="pay_method_creditcard" type="checkbox" class="form-check-input" <?php if (setting('pay_method_creditcard')==true){ echo 'checked'; } ?>>
                                                    <label class="form-check-label"><?php echo lang('App.pay_method_creditcard') ?></label>
                                                </div>

                                                <div class="form-check">
                                                    <input name="pay_method_creditcard_fragmented" type="checkbox" class="form-check-input" <?php if (setting('pay_method_creditcard_fragmented')==true){ echo 'checked'; } ?>>
                                                    <label class="form-check-label"><?php echo lang('App.pay_method_creditcard_fragmented') ?></label>
                                                </div>

                                                <div class="form-check">
                                                    <input name="pay_method_cash_on_delivery" type="checkbox" class="form-check-input" <?php if (setting('pay_method_cash_on_delivery')==true){ echo 'checked'; } ?>>
                                                    <label class="form-check-label"><?php echo lang('App.pay_method_cash_on_delivery') ?></label>
                                                </div>
                                  </div>
                              </div>

                              <div class="col-sm-6"> 
                                    <div class="form-group">
                                                <div class="form-check">
                                                    <input name="pay_method_oxxo" type="checkbox" class="form-check-input" <?php if (setting('pay_method_oxxo')==true){ echo 'checked'; } ?>>
                                                    <label class="form-check-label"><?php echo lang('App.pay_method_oxxo') ?></label>
                                                </div>

                                                <div class="form-check">
                                                    <input name="pay_method_paypal" type="checkbox" class="form-check-input" <?php if (setting('pay_method_paypal')==true){ echo 'checked'; } ?>>
                                                    <label class="form-check-label"><?php echo lang('App.pay_method_paypal') ?></label>
                                                </div>

                                                <div class="form-check">
                                                    <input name="pay_method_crypto_eth" type="checkbox" class="form-check-input" <?php if (setting('pay_method_crypto_eth')==true){ echo 'checked'; } ?>>
                                                    <label class="form-check-label"><?php echo lang('App.pay_method_crypto_eth') ?></label>
                                                </div>

                                                <div class="form-check">
                                                    <input name="pay_method_crypto_bnb" type="checkbox" class="form-check-input" <?php if (setting('pay_method_crypto_bnb')==true){ echo 'checked'; } ?>>
                                                    <label class="form-check-label"><?php echo lang('App.pay_method_crypto_bnb') ?></label>
                                                </div>

                                    </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-sm-6"> 
                                  <div class="form-group">
                                                <div class="form-check">
                                                    <input name="pay_method_crypto_xrp" type="checkbox" class="form-check-input" <?php if (setting('pay_method_crypto_xrp')==true){ echo 'checked'; } ?>>
                                                    <label class="form-check-label"><?php echo lang('App.pay_method_crypto_xrp') ?></label>
                                                </div>

                                                <div class="form-check">
                                                    <input name="pay_method_crypto_btc" type="checkbox" class="form-check-input" <?php if (setting('pay_method_crypto_btc')==true){ echo 'checked'; } ?>>
                                                    <label class="form-check-label"><?php echo lang('App.pay_method_crypto_btc') ?></label>
                                                </div>

                                                <div class="form-check">
                                                    <input name="pay_method_metamask" type="checkbox" class="form-check-input" <?php if (setting('pay_method_metamask')==true){ echo 'checked'; } ?>>
                                                    <label class="form-check-label"><?php echo lang('App.pay_method_metamask') ?></label>
                                                </div>

                                                <div class="form-check">
                                                    <input name="pay_method_crypto_usdt" type="checkbox" class="form-check-input" <?php if (setting('pay_method_crypto_usdt')==true){ echo 'checked'; } ?>>
                                                    <label class="form-check-label"><?php echo lang('App.pay_method_crypto_usdt') ?></label>
                                                </div>

                                                <div class="form-check">
                                                    <input name="pay_method_crypto_sol" type="checkbox" class="form-check-input" <?php if (setting('pay_method_crypto_sol')==true){ echo 'checked'; } ?>>
                                                    <label class="form-check-label"><?php echo lang('App.pay_method_crypto_sol') ?></label>
                                                </div>


                                                 

                                  </div>
                              </div>
                          </div>
                </div>

        </div>
 </div>
 
                           


<!-- -->

<div class="col-sm-6">

<div class="card card-secondary">
   <div class="card-header with-border">
     <h3 class="card-title"><?php echo lang('App.wallets_deposit_funds') ?></h3>
   </div>
   <div class="card-body"> 
    
         <div class="form-group">
           <label for="formSetting-server-xrp" style="width:100%"><?php echo lang('App.wallet') ?> BTC (bitcoin)
           <input type="text"  class="form-control" name="wallet_btc" id="formSetting-wallet_btc" value="<?php echo setting('wallet_btc') ?>" required placeholder="<?php echo lang('App.wallet_btc') ?>"  />
         </div>

         <div class="form-group">
           <label for="formSetting-server-xrp" style="width:100%"><?php echo lang('App.wallet') ?> XRP (ripple)
           <input type="text"  class="form-control" name="wallet_xrp" id="formSetting-wallet_xrp" value="<?php echo setting('wallet_xrp') ?>" required placeholder="<?php echo lang('App.wallet_xrp') ?>"  />
         </div>

         <div class="form-group">
           <label for="formSetting-server-xrp" style="width:100%"><?php echo lang('App.wallet') ?> Ethereum (ETH)
           <input type="text"  class="form-control" name="wallet_eth" id="formSetting-wallet_eth" value="<?php echo setting('wallet_eth') ?>" required placeholder="<?php echo lang('App.wallet_eth') ?>"  />
         </div>

         <div class="form-group">
           <label for="formSetting-server-xrp" style="width:100%"><?php echo lang('App.wallet') ?> Tether (usdt) erc20
           <input type="text"  class="form-control" name="wallet_tether" id="formSetting-wallet_tether" value="<?php echo setting('wallet_tether') ?>" required placeholder="<?php echo lang('App.wallet_tether') ?>"  />
         </div>


   </div>
</div>

</div>

<!-- -->

<div class="col-sm-6">

<div class="card card-secondary">
   <div class="card-header with-border">
     <h3 class="card-title"><?php echo lang('App.bank_account_for_transfers') ?></h3>
   </div>
   <div class="card-body"> 
     
          <div class="form-group">
              <label for="formSetting-bank_account_for_transfers" style="width:100%"><?php echo lang('App.bank_account') ?>  
              <input type="text"  class="form-control" name="bank_account_for_transfers" id="bank_account_for_transfers" value="<?php echo setting('bank_account_for_transfers') ?>"  placeholder="<?php echo lang('App.bank_account') ?>"  />
            </div>
   </div>

</div>
</div>

<!-- -->
        <div class="col-sm-4">
          
                         <div class="card card-secondary">
                            <div class="card-header with-border">
                              <h3 class="card-title"><?php echo lang('App.market') ?></h3>
                            </div>
                                  <div class="card-body"> 
                                 
                                  <label for="matching_algorithm"><?php echo lang('App.matching_algorithm') ?>  </label>

                                      <div class="form-group">
 
                                          <select name="matching_algorithm" id="can_use_contract_funds" class="form-control select2">
                                            <option value="A"<?php if (setting('matching_algorithm')=="A"){ echo 'selected'; } ?>>  <?php echo lang('App.allocation'); ?></option>
                                            <option value="F"<?php if (setting('matching_algorithm')=="F"){ echo 'selected'; } ?>> <?php echo lang('App.fifo'); ?></option>
                                            <option value="T"<?php if (setting('matching_algorithm')=="T"){ echo 'selected'; } ?>> <?php echo lang('App.fifo_with_lmm'); ?></option>
                                            <option value="S"<?php if (setting('matching_algorithm')=="S"){ echo 'selected'; } ?>> <?php echo lang('App.fifo_with_top_order_and_lmm'); ?></option>
                                            <option value="C"<?php if (setting('matching_algorithm')=="C"){ echo 'selected'; } ?>> <?php echo lang('App.pro-rata'); ?></option>
                                            <option value="K"<?php if (setting('matching_algorithm')=="K"){ echo 'selected'; } ?>> <?php echo lang('App.configurable'); ?></option>
                                            <option value="O"<?php if (setting('matching_algorithm')=="O"){ echo 'selected'; } ?>> <?php echo lang('App.threshold_pro-rata'); ?></option>
                                            <option value="Q"<?php if (setting('matching_algorithm')=="Q"){ echo 'selected'; } ?>> <?php echo lang('App.threshold_pro_rata_with_lmm'); ?></option>
                                           
                                          </select>

                                             <a href="https://www.cmegroup.com/confluence/display/EPICSANDBOX/Supported+Matching+Algorithms"> Supported Matching Algorithms </a>
                                       </div>
                                 
                                    </div>
                          </div>


        </div>

<!-- -->

<div class="col-sm-6">

<div class="card card-secondary">
   <div class="card-header with-border">
     <h3 class="card-title"><?php echo lang('App.send_sms') ?></h3>
   </div>
   <div class="card-body"> 
     
   <div class="form-group">
              <label for="sms_phone" style="width:100%"><?php echo lang('App.sms_phone') ?>  
              <input type="text"  class="form-control" name="sms_phone" id="sms_phone" value="<?php echo setting('sms_phone') ?>"  placeholder="<?php echo lang('App.sms_phone') ?>"  />
            </div>

          <div class="form-group">
              <label for="sms_sid" style="width:100%"><?php echo lang('App.sms_sid') ?>  
              <input type="text"  class="form-control" name="sms_sid" id="sms_sid" value="<?php echo setting('sms_sid') ?>"  placeholder="<?php echo lang('App.sms_sid') ?>"  />
            </div>

            <div class="form-group">
              <label for="sms_token" style="width:100%"><?php echo lang('App.sms_token') ?>  
              <input type="text"  class="form-control" name="sms_token" id="sms_token" value="<?php echo setting('sms_token') ?>"  placeholder="<?php echo lang('App.sms_token') ?>"  />
            </div>

            <div class="form-group">
              <label for="sms_phone_to" style="width:100%"><?php echo lang('App.sms_phone_to') ?>  
              <input type="text"  class="form-control" name="sms_phone_to" id="sms_phone_to" value="<?php echo setting('sms_phone_to') ?>"  placeholder="<?php echo lang('App.sms_phone_to') ?>"  />
            </div>

   </div>

</div>
</div>

<!-- -->

<!-- -->

<div class="col-sm-6">

<div class="card card-secondary">
   <div class="card-header with-border">
     <h3 class="card-title"> EMAIL SMPT SERVER</h3>
   </div>
   <div class="card-body"> 
     
   <div class="form-group">
              <label for="smpt_server" style="width:100%"><?php echo lang('App.smpt_server') ?>  
              <input type="text"  class="form-control" name="smpt_server" id="smpt_server" value="<?php echo setting('smpt_server') ?>"  placeholder="<?php echo lang('App.smpt_server') ?>"  />
            </div>

          <div class="form-group">
              <label for="smpt_port" style="width:100%"><?php echo lang('App.smpt_port') ?>  
              <input type="text"  class="form-control" name="smpt_port" id="smpt_port" value="<?php echo setting('smpt_port') ?>"  placeholder="<?php echo lang('App.smpt_port') ?>"  />
            </div>

            <div class="form-group">
              <label for="smpt_username" style="width:100%"><?php echo lang('App.smpt_username') ?>  
              <input type="text"  class="form-control" name="smpt_username" id="smpt_username" value="<?php echo setting('smpt_username') ?>"  placeholder="<?php echo lang('App.smpt_username') ?>"  />
            </div>

            <div class="form-group">
              <label for="smpt_password" style="width:100%"><?php echo lang('App.smpt_password') ?>  
              <input type="text"  class="form-control" name="smpt_password" id="smpt_password" value="<?php echo setting('smpt_password') ?>"  placeholder="<?php echo lang('App.smpt_password') ?>"  />
            </div>

   </div>

</div>
</div>

<!-- -->

   
 </div>       <!-- ROW  --> 



<!-- servers card -->

</div>



  
  <?php echo form_close(); ?>

</section>
<!-- /.content -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Date & Date Time Formats</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-info">Supports <code>date</code> function available characters. For more info  <a href="https://www.php.net/manual/en/function.date.php">link</a></div>
        <ul>
            <li>d - The day of the month (from 01 to 31)</li>
            <li>D - A textual representation of a day (three letters)</li>
            <li>j - The day of the month without leading zeros (1 to 31)</li>
            <li>l (lowercase 'L') - A full textual representation of a day</li>
            <li>N - The ISO-8601 numeric representation of a day (1 for Monday, 7 for Sunday)</li>
            <li>S - The English ordinal suffix for the day of the month (2 characters st, nd, rd or th. Works well with j)</li>
            <li>w - A numeric representation of the day (0 for Sunday, 6 for Saturday)</li>
            <li>z - The day of the year (from 0 through 365)</li>
            <li>W - The ISO-8601 week number of year (weeks starting on Monday)</li>
            <li>F - A full textual representation of a month (January through December)</li>
            <li>m - A numeric representation of a month (from 01 to 12)</li>
            <li>M - A short textual representation of a month (three letters)</li>
            <li>n - A numeric representation of a month, without leading zeros (1 to 12)</li>
            <li>t - The number of days in the given month</li>
            <li>L - Whether it's a leap year (1 if it is a leap year, 0 otherwise)</li>
            <li>o - The ISO-8601 year number</li>
            <li>Y - A four digit representation of a year</li>
            <li>y - A two digit representation of a year</li>
            <li>a - Lowercase am or pm</li>
            <li>A - Uppercase AM or PM</li>
            <li>B - Swatch Internet time (000 to 999)</li>
            <li>g - 12-hour format of an hour (1 to 12)</li>
            <li>G - 24-hour format of an hour (0 to 23)</li>
            <li>h - 12-hour format of an hour (01 to 12)</li>
            <li>H - 24-hour format of an hour (00 to 23)</li>
            <li>i - Minutes with leading zeros (00 to 59)</li>
            <li>s - Seconds, with leading zeros (00 to 59)</li>
            <li>u - Microseconds (added in PHP 5.2.2)</li>
            <li>e - The timezone identifier (Examples: UTC, GMT, Atlantic/Azores)</li>
            <li>I (capital i) - Whether the date is in daylights savings time (1 if Daylight Savings Time, 0 otherwise)</li>
            <li>O - Difference to Greenwich time (GMT) in hours (Example: +0100)</li>
            <li>P - Difference to Greenwich time (GMT) in hours:minutes (added in  PHP 5.1.3)</li>
            <li>T - Timezone abbreviations (Examples: EST, MDT)</li>
            <li>Z - Timezone offset in seconds. The offset for timezones west of UTC is negative (-43200 to  50400)</li>
            <li>c - The ISO-8601 date (e.g. 2013-05-05T16:34:42+00:00)</li>
            <li>r - The RFC 2822 formatted date (e.g. Fri, 12 Apr 2013 12:01:05 +0200)</li>
            <li>U - The seconds since the Unix Epoch (January 1 1970 00:00:00 GMT)</li>
         </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>

<script>
  $(document).ready(function() {
    $('.form-validate').validate();

      //Initialize Select2 Elements
    $('.select2').select2()



var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html, {size: 'small'});
});

  })

  function previewImage(input, previewDom) {

    if (input.files && input.files[0]) {

      $(previewDom).show();

      var reader = new FileReader();

      reader.onload = function(e) {
        $(previewDom).find('img').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }else{
      $(previewDom).hide();
    }

  }

  function recaptchKeysHideShow(checked) {

    if(!checked)
      $('.recaptchKeysHideShow').hide(300);
    else
      $('.recaptchKeysHideShow').show(300);
    
  }

  recaptchKeysHideShow(<?php echo setting('google_recaptcha_enabled') ?>);
</script>

<?=  $this->endSection() ?>

