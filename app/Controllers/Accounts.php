<?php
namespace App\Controllers;

use App\Controllers\AdminBaseController;
use App\Models\AccountsModel;

class Accounts extends AdminBaseController
{

    public $title = 'Accounts';
    public $menu = 'accounts';

    public function index()
    {
       
        
  
    }

    public function new_bank_account()
    {

       
        $number =  post('accountnumber');
        $iban = post('iban');
        $bicswift = post('swift');
        $bank_name = post('bank_name');  
        $bank_address = post('bank_address');
        $clabe  = post('clabe');
        $routing = post('routing_number');

        $id =  logged('id');

        $account= model('App\Models\AccountsModel')->add_new_account($id, $number, $iban, $bicswift, $bank_name, $bank_address, $clabe, $routing );

       if ($account){
          $data['done']="1";    
       }else{
          $data['error']="1";
          $data['msg']="can´t add bank account";
       }

       return json_encode($data,true);

        
    }


    public function delete_bank_account()
    {

        $id =  post('id');
        $data= model('App\Models\AccountsModel')->delete($id);
        return json_encode($data,true);
    }
     
    

}