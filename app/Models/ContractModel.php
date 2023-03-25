<?php
namespace App\Models;

use App\Models\BaseModel;

class ContractModel extends BaseModel
{
    protected $table      = 'contracts';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'contract_name',
        'contract_description',
        'contract_excerpt',
        'data',
        'active',
        'contract_address',
        'network',
        'total_tokens',
        'ownerID',
        'active',
        'expiration_date',
        'autorenew',
        'is_smart_contract',
        'is_fixed',
        'contract_type',
        'unit_value',
        'target',
        'valoration',
        'roi',
        'lifetime_days',
        'starting_date',
        'expires',
        'visibility',
        'category',
        'timestamp'
       ]; 

       
       function list_contracts($id=0,$status=0, $contractID=0)
       {
         
            // LIST ALL USER´s CONTRACTS WITH SELECTED STATS
            $array = array('ownerID'=> $id,'active' => $status);

 
            
            // LIST ALL ACTIVE CONTRACTS 
            if($id=="0"){    
             // $array = array('active' => '1');
             $array = "active='1' OR ( active='-1')";

             } 

            // LIST ALL USER´S CONTRACT WITH ANY CONTRACT STATUS
            if($status=="0"){   
              $array = array('ownerID'=> $id);
            }      

            if($contractID>0){
                // $array = array('ownerID'=> $id, 'id'=> $contractID);
                // $array = "ownerID='$id' AND (id='311'  OR  id='305' ) ";
               
                // $contractID = explode(',', $contractID);
              if (is_array($contractID)==true) {  
                if (count($contractID)>0){ 
                 
                    $array = "id='".$contractID[0]."'";
                  
                    for ($x = 1; $x <= count($contractID)-1; $x++) {
                      $array .= " OR id='".$contractID[$x]."'";
                    }
                } 
              }else{
                $array = array('id'=> $contractID);
              }
            }

         

            $q = $this->where($array)->findall();
            $i=0;
            foreach ($q as $key => $value) {
              
              
                 //  echo "{$key} => {$value} ";
             
                // $q[$key]=$value;

                  $price =  model('App\Models\PortfolioModel')->invested_in_position($q[$i]['id']);
                  $q[$i]['invested'] = $price;

                  // INVESTORS
                  $investors =  model('App\Models\PortfolioModel')->list_investors_per_contract($q[$i]['id']);
                  $q[$i]['investors'] = $investors;
                  //
                  $q[$i]['roi-debt'] = floatval($q[$i]['invested']/100)*floatval( $q[$i]['roi'] );
                 
                   
                  // CHECK VISIBILITY 
                  if ($q[$i]['visibility']==null){   
                    
                  }else{
                      
                    // IF ITS ONWER IS ALWAYS VISIBLE
                     if( $q[$i]['ownerID']==logged('id')){}else{ 
                      
                         
                          $favs=json_decode($q[$i]['visibility']);
                          if(is_array($favs)){  
                            if (in_array(logged('id'), $favs)) {
                                $q[$i]['visibility'] ="";
                                
                            }else{
                              unset($q[$i]);
                            }
                          }
                        
                     }
                      
                  } 
                 // END VISIBILITY
                  $i++;     
                  
            }

         return  $q;
       }

 

       
   

     
}