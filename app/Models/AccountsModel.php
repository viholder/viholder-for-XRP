<?php 

namespace App\Models;

use App\Models\BaseModel;
  

class AccountsModel extends BaseModel 

{
  protected $table      = 'accounts';
  protected $primaryKey = 'id';
  protected $returnType     = 'object';
  protected $allowedFields = [
   'userID',
   'number',
   'iban',
   'bicswift',
   'bank_name',
   'bank_address',
   'clabe',
   'routing',
   'active',
  ];
 


  function add_new_account($userID, $number, $iban, $bicswift, $bank_name, $bank_address, $clabe, $routing)
	{
      $data = [
          'userID'  => $userID,
          'number' => $number,
          'iban' => $iban,
          'bicswift' => $bicswift,
          'bank_name' => $bank_name,
          'bank_address' => $bank_address,
          'clabe => '  => $clabe,
          'routing' => $routing,
          'active' => "1"
      ];
  
    $q=$this->insert($data);

    return json_encode($q, true);

  }



}
