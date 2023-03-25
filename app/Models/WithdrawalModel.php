<?php

namespace App\Models;

use App\Models\BaseModel;

class WithdrawalModel extends BaseModel
{
    protected $table      = 'withdrawals';
    protected $primaryKey = 'id';

    // protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    // protected $useSoftDeletes = false;
    
    protected $allowedFields = ['id', 'userID', 'accountID', 'amount', 'timestamp'];

    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    
 




function request_withdrawal($accountID,$amount)
       {
        
        $userID = logged('id');
        $data = [
            'userID'  => $userID,
            'accountID' => $accountID,
            'amount' => $amount,
            'timestamp' => date('Y-m-d H:i:s'),
            'active' => "1"
         ];
        
          $q=$this->insert($data);
        
          return json_encode($q, true);


       }


}
