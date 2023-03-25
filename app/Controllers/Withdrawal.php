<?php
namespace App\Controllers;

use App\Controllers\AdminBaseController;

class Withdrawal extends AdminBaseController
{
    
    public $title = 'Withdrawal';
    public $menu = 'withdrawal';

    public function index()
    {
        
        $id = logged('id');

      
        $array = array('userID' => $id);  
      
        $data['accounts'] = model('App\Models\AccountsModel')->where($array)->findall();
        
        
        if ( !$data['accounts']){
            $accounts=false;
        }
        
        return view('exchange/withdrawal',$data );
    }

                     
    public function request_withdrawal()
    {
        
        $accountID=  post('accountID');
        $amount=  post('amount');

        $data = model('App\Models\WithdrawalModel')->request_withdrawal($accountID,$amount);
        
        if ($data){
          
        }
        return json_encode($data,true);


    }

}