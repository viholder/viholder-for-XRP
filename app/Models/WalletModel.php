<?php 

namespace App\Models;

use App\Models\BaseModel;
  

class WalletModel extends BaseModel 

{
   protected $table      = 'wallets';
   protected $primaryKey = 'id';
   protected $returnType     = 'array';
   protected $allowedFields = [
    'userID',
    'contractID',
    'network',
    'wallet_address',
    'wallet_public',
    'wallet_key',
    'wallet_seed',
    'wallet_currency',
    'wallet_balance',
   ];

   
 
   function get_cash_available($id)
    {
      $array = array('userID' => $id, 'network' => 'viholder', );
      $wallets = $this->where($array)->findall();
  
          $sumas=0;
          $max = count($wallets);
          for($i = 0; $i < $max;$i++)
          {
             // $data["wallet"]["balance"][$i]=$wallets[$i]['wallet_balance'];
             // $data["wallet"]["id"][$i]=$wallets[$i]['id'];
             // $data["wallet"]["contractID"][$i]=$wallets[$i]['contractID'];
              $sumas += ($wallets[$i]['wallet_balance']);
             
          }
          
          $data["wallet_balance"]=$sumas;


        return  $data ;
    

    }


    function subtract_cash($id,$chash,$ref,$refID,$fromwallet=0){

      if ($fromwallet>0){
        $array = array('id' => $fromwallet, 'network' => 'viholder');
      }else{  
        $array = array('userID' => $id, 'contractID' => '0', 'network' => 'viholder');
      }
 
      $wallets = $this->where($array)->first();

      if(floatval($wallets['wallet_balance'])<floatval($chash)){
        return false;
      }


      $value=floatval($wallets['wallet_balance'])-floatval($chash);  
      
      $subtract = $this->where($array)->set('wallet_balance', $value)->update( $wallets['id']);

      model('App\Models\ActivityLogModel')->add("Cash Subtracted ".$chash." From User: #".logged('id'),$id,0,$ref,$refID);
 
      return $subtract;
     
    }

    function desposit_on_contract($contractID,$chash,$ref,$refID){
     
      
     $array = "contractID='$contractID' AND network='viholder'";
 
     $wallets = $this->where($array)->first();



     $value=($wallets['wallet_balance'])+($chash);
      
     $walletID=$wallets['id'];
     $array = "contractID='$contractID' AND id='$walletID' AND network='viholder'";
       
     $addition = $this->where($array)->set('wallet_balance', $value)->update();

     model('App\Models\ActivityLogModel')->add("Deposit ".$chash." From User: #".logged('id'),logged('id'),0,"contract_investment",$refID);

     return $addition;

    }

}
