<?php 

namespace App\Models;

use App\Models\BaseModel;
  

class AgreementModel extends BaseModel 

{
  protected $table      = 'agreements';
  protected $primaryKey = 'id';
  protected $returnType     = 'object';
  protected $allowedFields = [
   'contractID',
   'content',
   'content_en',
   'date',
  ];
 





}
