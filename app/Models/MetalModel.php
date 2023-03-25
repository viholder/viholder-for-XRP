<?php

namespace App\Models;

use App\Models\BaseModel;

class MetalModel extends BaseModel
{
    protected $table      = 'inventory';
    protected $primaryKey = 'id';
    protected $returnType     = 'object';
    protected $allowedFields = [
        'userID' ,
        'userType' ,
        'contractID',
        'ref_number',
        'gr',
        'gr_dust',
        'karat',
        'status',
        'action',
        'value',
        'timestamp',        
    ];
}
 
