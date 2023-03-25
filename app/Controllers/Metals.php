<?php

namespace App\Controllers;

use App\Controllers\AdminBaseController;

use Config\Services;
use App\Models\NotificationsModel;
use App\Models\UserModel;
use App\Models\PortfolioModel;
use App\Models\MetalModel;
 
 

class Metals extends AdminBaseController
{

    public $title = 'Metals';
    public $menu = 'metals';
 
    protected $helpers = ['form', 'viholder_helper'];

    public function index()
    {
         /*
        $cur="mxn";
        $url = "https://api.coingecko.com/api/v3/simple/price?ids=tether-gold&vs_currencies=".$cur;
        $json = file_get_contents($url);
        $obj = json_decode($json, true);
            //	var_dump($obj["tether-gold"]["mxn"]);
                $valorOZ = $obj["tether-gold"][$cur];
                $valorGR = $obj["tether-gold"][$cur]/28.3495;
              
            //  $valorGR= number_format($valorGR, 2  );
            //   $valorOZ= number_format($valorOZ, 2 );
            
       

        $url = "https://api.coingecko.com/api/v3/simple/price?ids=tsilver&vs_currencies=".$cur;
        $json = file_get_contents($url);
        $obj = json_decode($json, true);
            //	var_dump($obj["tether-gold"]["mxn"]);
                $valorOZ = $obj["tsilver"][$cur]*28.3495;
                $valorGR = $obj["tsilver"][$cur] ;
           
           //    $valorGR= number_format($valorGR, 2);
            //   $valorOZ= number_format($valorOZ, 2);
            
        */

        

        $data['gold']= 1110; //$valorGR;
        $data['silver']=16; //$valorGR;

   
        return view('exchange/metals', $data);
     
     
    }

    

    public function get_users()
    {

    $users = (new UserModel)->findAll();
    $i=0;
    foreach ( $users as $row){
        $userdata[$i]['userID'] =  $row->id;
        $userdata[$i]['username'] =  $row->username;
        $userdata[$i]['name'] =  $row->name;
        $i++;
    }

    return json_encode($userdata);

    }

   
    public function get_inventory_totals()
    {
        $invetory = (new MetalModel)->findAll();
        $i=0;
        $totalOroGr="0";
        $totalPlataGr="0";
        $totalPlataValue="0";
        $totalOroValue="0";
        foreach ( $invetory as $row){

            if ($row->contractID>1000 AND $row->contractID<2000 ){
                $totalOroGr=$totalOroGr+$row->gr+$row->gr_dust;
                 $totalOroValue=$totalOroValue+$row->value;
            }
    
            if ($row->contractID>2000 AND $row->contractID<3000 ){
                $totalPlataGr=$totalPlataGr+$row->gr+$row->gr_dust;
                 $totalPlataValue=$totalPlataValue+$row->value;
            }

        }


        $data["totalPlataGr"]= $totalPlataGr;
        $data["totalOroGr"]= $totalOroGr;
        $data["totalPlataValue"]= $totalPlataValue;
        $data["totalOroValue"]= $totalOroValue;
       
        $data["granTotal"]=$totalPlataValue+$totalOroValue;
        return json_encode($data, true); 

    }

    public function get_inventory()
    {

    $invetory = (new MetalModel)->findAll();
    $i=0;
    $totalOroGr=0;
    $totalPlataGr=0;
    foreach ( $invetory as $row){
        $invetoryData[$i]['id'] =  $row->id;

         if($row->contractID=="1001"){ $invetoryData[$i]['contractName'] = "ORO - LAMINA"; } 
         if($row->contractID=="1002"){ $invetoryData[$i]['contractName'] = "ORO - BARRA"; } 
         if($row->contractID=="1003"){ $invetoryData[$i]['contractName'] = "ORO - MONEDA"; } 
         if($row->contractID=="1004"){ $invetoryData[$i]['contractName'] = "ORO - MONEDA FINA"; } 
         if($row->contractID=="1005"){ $invetoryData[$i]['contractName'] = "ORO - GRANALLA"; } 

         if($row->contractID=="2001"){ $invetoryData[$i]['contractName'] = "PLATA - LAMINA"; } 
         if($row->contractID=="2002"){ $invetoryData[$i]['contractName'] = "PLATA - BARRA"; } 
         if($row->contractID=="2003"){ $invetoryData[$i]['contractName'] = "PLATA - MONEDA"; } 
         if($row->contractID=="2004"){ $invetoryData[$i]['contractName'] = "PLATA - MONEDA FINA"; } 
         if($row->contractID=="2005"){ $invetoryData[$i]['contractName'] = "PLATA - GRANALLA"; } 

         if($row->contractID=="3000"){ $invetoryData[$i]['contractName'] = "DIVISA - DOLARES"; } 
         
         if($row->contractID=="4000"){ $invetoryData[$i]['contractName'] = "METAL - MERCURIO"; } 

         if($row->contractID=="5000"){ $invetoryData[$i]['contractName'] = "OTROS "; } 


        $invetoryData[$i]['gr'] =  $row->gr+$row->gr_dust;
        $invetoryData[$i]['ref_number'] = "ref:".$row->ref_number;
        $invetoryData[$i]['karat'] =$row->karat."k";
        $invetoryData[$i]['value'] ="$".$row->value."MXN";
        $invetoryData[$i]['action'] =$row->action;
        $invetoryData[$i]['status'] =$row->status;

/*

        if ($row->contractID>1000 AND $row->contractID<2000 ){
            $totalOroGr=$totalOroGr+$invetoryData[$i]['gr'];
        }

        if ($row->contractID>2000 AND $row->contractID<3000 ){
            $totalPlataGr=$totalPlataGr+$invetoryData[$i]['gr'];
        }
*/
        $i++;
    }
 
    
    return json_encode($invetoryData);

    }

    public function update_inventory()
    {

        $id= post('updateID');

        $data['status'] ="1";

        (new MetalModel)->update($id, $data);
        $done['done']="1";
        return json_encode($done);
    }

     


    public function new_order()
    {

         
        $capturedBY = logged('id');
        $userID = post('userID');

        if (post('userID')=="-1"){ $userType = "7";}else{ $userType = "8" ;}
        // $userType= $userRoll : 7=client, 8=provider

        
        $ref_number =  post('ref_number');
        $gr =  post('gr');
        $gr_dust =  post('gr_dust');
        $karat =  post('karat');
        $status =  post('status');
        $action =  post('action');
        $value =  post('input_total');

        if (post('category')=="ORO"){
            if (post('concept')=="LAMINA"){
                $contractID="1001";
            } 
            if (post('concept')=="BARRA"){
                $contractID="1002";
            }
            if (post('concept')=="MONEDA"){
                $contractID="1003";
            }  
            if (post('concept')=="MONEDA_FINA"){
                $contractID="1004";
            }
            if (post('concept')=="GRANALLA"){
                $contractID="1005";
            }
        }
        if (post('category')=="PLATA"){
            if (post('concept')=="LAMINA"){
                $contractID="2001";
            } 
            if (post('concept')=="BARRA"){
                $contractID="2002";
            }
            if (post('concept')=="MONEDA"){
                $contractID="2003";
            }  
            if (post('concept')=="MONEDA_FINA"){
                $contractID="2004";
            }
            if (post('concept')=="GRANALLA"){
                $contractID="2005";
            }
        }
        if (post('category')=="DOLLARS"){
             $contractID="3000";
        }
        if (post('category')=="MERCURIO"){
            $contractID="4000";
        }
        if (post('category')=="OTROS"){
            $contractID="5000";
        }


        

        $new_order = (new MetalModel)->create([
            'userID'  => $userID, 
            'userType'  => $userType, 
            'contractID'  => $contractID,
            'ref_number'  => $ref_number,
            'gr'  => $gr,
            'gr_dust'  => $gr_dust,
            'karat'  => $karat,
            'status'  => $status,
            'action'  => $action,
            'value'  => $value,
            'timestamp'  => date('Y-m-d H:i:s')
        ]);
        $data["done"]="1";
        return json_encode($data, true); 
     

    }


    public function new_client()
    {

    $id = (new UserModel)->create([
        'role' => "7",
        'name' => post('name'),
        'username' => post('email'),
        'email' => post('email'),
        'phone' => post('tel'),
        'address' => post('address'),
        'password' => hash( "sha256", "071174" ),
        
    ]);
    $data["done"]="1";
    return json_encode($data, true); 
 
}

}