<?php
namespace App\Models;

use App\Models\BaseModel;

class FavoritesModel extends BaseModel
{
    protected $table      = 'favorites';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'user_id',
        'contract_ids',
       ]; 

      
 

       
   

     
}