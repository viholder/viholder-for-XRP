<?php
namespace App\Models;

use App\Models\BaseModel;

class DiscoverModel extends BaseModel
{
    protected $table      = 'instruments';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'timestamp',

    ];


 

 


}