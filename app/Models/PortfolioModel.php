<?php

namespace App\Models;

 use CodeIgniter\Model;
  

class PortfolioModel extends Model 

{
   protected $table = 'positions';

   protected $allowedFields = [
    'ticker',
    'userID',
    'tickerID',
    'units',
    'amount',
    'type',
    'active',
    'price_open',
    'datetime_open',
    'stop_loss',
    'take_profit',
    'leverage',
    'short_long',
    'timestamp',
    'data'
   ];



   function invested_in_position($id)
	{
    
   // $array = array('tickerID' => $id, 'active' => '1');
    $array = "tickerID='$id' AND (active='1' OR active='6' OR active='7')";

    $positions = $this->where($array)->findall();
    $i=0;
      $total_invested=0;
    if ($positions){  
    
        $max = count($positions);
        
            for($i = 0; $i < $max;$i++)
            {
                $total_invested += ($positions[$i]['amount']);
            }
          }
      return  $total_invested;
 }


	function list_positions($id,$active=1)
	{
    
    
      $array = array('userID' => $id, 'active' => $active);
      $q = $this->where($array)->findall();
  
      return  $q;
 }

 

 function list_positions_actual_price($id,$active=1)
 {
   
    $where = "userID='$id' AND (active='$active')";

 if ($active==1){  
    $where = "userID='$id' AND (active='1' OR active='6' OR active='7')";
  }
  
     
  
     $positions = $this->where($where)->findall();
 
      if  ($positions){  
        $max = count($positions);
        for($i = 0; $i < $max;$i++)
        {
             $pos[$i]['price'] ="0"; 
            $price =  model('App\Models\ContractModel')->getById($positions[$i]['tickerID']);
            if($price){   // CONTRACT COULD BE DELETED AND NO PRICE INFO AVAILABLE
              $pos[$i]['price'] = $price['unit_value'];
            } 
            $pos[$i]['id'] = ($positions[$i]['id']);
            $pos[$i]['ticker'] = ($positions[$i]['ticker']);
            $pos[$i]['userID'] = ($positions[$i]['userID']);
            $pos[$i]['tickerID'] = ($positions[$i]['tickerID']);
            $pos[$i]['units'] = ($positions[$i]['units']);
            $pos[$i]['units_format'] = rtrim(rtrim((string)number_format($positions[$i]['units'], 5, ".", ""),"0"),".");
            $pos[$i]['amount'] = ($positions[$i]['amount']);
            $pos[$i]['type'] = ($positions[$i]['type']);
            $pos[$i]['active'] = ($positions[$i]['active']);
            $pos[$i]['price_open'] = ($positions[$i]['price_open']);
            $pos[$i]['datetime_open'] = ($positions[$i]['datetime_open']);
            $pos[$i]['stop_loss'] = ($positions[$i]['stop_loss']);
            $pos[$i]['take_profit'] = ($positions[$i]['take_profit']);
            $pos[$i]['leverage'] = ($positions[$i]['leverage']);
            $pos[$i]['timestamp'] = ($positions[$i]['timestamp']);
            $pos[$i]['short_long'] = ($positions[$i]['short_long']);

            $pos[$i]['glp'] = cal_gain_lost_percentage( $pos[$i]['price'],$pos[$i]['price_open'] );
            $pos[$i]['gl'] = cal_gain_lost( $pos[$i]['price'],$pos[$i]['price_open'],$pos[$i]['amount'] );
          }
 
     return  $pos;
    }

}

 


 function get_position($id)
	{
    
      $array = array('id' => $id);
      $q = $this->where($array)->first();
  
      return  $q;
 }



  function add_open_position($contract_ID,$data)
	{
     
    date_default_timezone_set(setting('timezone'));

    $data = [
      'ticker' => SKU_gen($data['contract_name'],$contract_ID,2),
      'userID'    => logged('id'),
      'tickerID' => $contract_ID,
      'units' => $data["units"],
      'amount' => $data["amount"] ,
      'price_open'  =>$data['unit_value'],
      'datetime_open' => date('Y-m-d H:i:s'),
      'active' => $data["active"] ,
      'type' => $data["type"],
      'stop_loss' => $data["stop_loss"],
      'take_profit' => $data["take_profit"],
      'leverage' =>  $data["leverage"],
      'short_long' => $data["short_long"],
      'timestamp' => date('Y-m-d H:i:s'),
      
   ];
  
    // Inserts data and returns inserted row's primary key
    $q=$this->insert($data);

    return json_encode($q, true);

  }




  function list_investors_per_contract($id){  
    
    $array = "tickerID='$id' AND (active='1' OR active='6' OR active='7')";

    $positions = $this->where($array)->findall();
    $i=0;
    
     $investor= array();
    
    if ($positions){  
    
        $max = count($positions);
        $amount=0;
        
        if ($max>0){ 
            for($i = 0; $i < $max;$i++)
            {
              
                  $user=$positions[$i]['userID'];
                  
                  $userdata = (new UserModel)->getById($user);
                  $investor[$user]['name']=  $userdata->name;
                  $investor[$user]['username']=  $userdata->username;
                  $investor[$user]['email']=  $userdata->email;
                  $investor[$user]['phone']=  $userdata->phone;
                  $investor[$user]['address']=  $userdata->address;  
                  $investor[$user]['amount']= model('App\Models\PortfolioModel')->investor_has_invested_in_position($id,$user);


 
               }
          }
    }
      return  $investor;
 }
     
  


  function duplicate($id) {
    $array = array('id' => $id);
    $position = $this->where($array)->first();
    if  ($position){  
      foreach ($position as $clave => $valor){
        if($clave != 'id'){
          $data[$clave]=$valor;
        }
      }
    }  
      $q=$this->insert($data);
   
      return  $q;
    
  }



  function investor_has_invested_in_position($tickerID, $userID)
	{
    
   // $array = array('tickerID' => $id, 'active' => '1');
    $array = "tickerID='$tickerID' AND userID='$userID' AND (active='1' OR active='6' OR active='7')";

    $positions = $this->where($array)->findall();
    $i=0;
      $total_invested=0;
    if ($positions){  
    
        $max = count($positions);
        
            for($i = 0; $i < $max;$i++)
            {
                $total_invested += ($positions[$i]['amount']);
            }
          }
      return  $total_invested;
 }

  
}

 