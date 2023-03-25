<?php
namespace App\Controllers;

use App\Controllers\AdminBaseController;
use App\Models\WalletModel;

class Wallet extends AdminBaseController
{

    public $title = 'Wallet';
    public $menu = 'wallet';

    public function index()
    {
       // $this->cachePage(1);
       
        $id =  logged('id');

        $array = array('userID' => $id);
        $wallets=(new WalletModel)->where($array)->findall();
      
      

        if($wallets){  
            $i=0;
            foreach ($wallets as $row ){

                $account[$i]['contractID']=$row['contractID'];
                $account[$i]['contractSKU']="";
                 
                $account[$i]['network']=$row['network'];

                $account[$i]['wallet_address']= $row['wallet_address'];
                $account[$i]['wallet_currency']=$row['wallet_currency'];
                $account[$i]['wallet_balance']= $row['wallet_balance'];

                if ($row['contractID']>0){ 
                    $sku = model('App\Models\ContractModel')->getById($row['contractID']);
                      if ($sku){  
                         $account[$i]['contractSKU']= SKU_gen($sku['contract_name'],$id,2); 
                         $account[$i]['network']=$sku['contract_name'];
                    }
                   }

            $i++;
            }
        }else{
            $account[0]['nowallet']=true;
        }

         $data['wallets']=$account;
        

         if (post('action')!=null && post('action')=="read"){ 
            return json_encode($data,true);
        }else{
            return view('exchange/wallet',$data);
        }


 
        
  
    }

}