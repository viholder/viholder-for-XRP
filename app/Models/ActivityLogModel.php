<?php

namespace App\Models;

use App\Models\BaseModel;

class ActivityLogModel extends BaseModel
{
    protected $table      = 'activity_logs';
    protected $primaryKey = 'id';
    protected $returnType     = 'object';

	public function add($message, $user_id = 0, $ip_address = false, $ref = 0, $refID = 0)
	{
		//if(!$ref){$ref="-";} 
		$ref=$ref;
		  
		return $this->create([
			'title' => $message,
			'user' => ($user_id==0) ? logged('id') : $user_id,
			'ip_address' => !empty($ip_address) ? $ip_address : ip_address(),
			'ref' =>  ($ref==0) ? $ref : $ref,
			'refID' =>  ($refID==0) ? $refID : $refID,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_At' => date('Y-m-d H:i:s'),

		]);
	}
}