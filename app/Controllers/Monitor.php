<?php
namespace App\Controllers;

use App\Controllers\AdminBaseController;
use App\Controllers\FavoritesModel;

class Monitor extends AdminBaseController
{
    
    public $title = 'Monitor';
    public $menu = 'monitor';


    

    


    public function most_followers()
    { 

        $followers= model('App\Models\FavoritesModel')->findall();
        $ides=array();
       
       foreach ($followers as $row){  
          $fav=json_decode($row['contract_ids']);
            foreach ($fav as $row => $value ){   
                array_push($ides,$value);
            }
       }
       
     $most_folowers=(array_count_values($ides));
       
      return json_encode( $most_folowers, true);
    }



    public function index()
    {       
       
        $favorite_id=array();
        $id = logged('id');
        $array = array('user_id'=> $id);
        $datas['favorites']=  model('App\Models\FavoritesModel')->where($array)->first();
        $following= model('App\Models\FavoritesModel')->findall();
     
        $ides=array();
        // CNOTRACTS MOST FOLLOWED
        foreach ($following as $row){  
            $fav=json_decode($row['contract_ids']);
            if ($fav!=null){  
              foreach ($fav as $row => $value ){   

                // Check if is an active contract
               $active_contract =  model('App\Models\ContractModel')->getById($value); 
                 if ( $active_contract){  
                         array_push($ides,$value);
                  }
             }
            }
        }
        
        
        $most_folowers=  array_count_values($ides);
        arsort($most_folowers);

       
 
        // ADD ALL CONTRACTS IF NO FAVORITES 
        if ($datas['favorites']==null OR $datas['favorites']["contract_ids"]=="[]" ){ 
            $i=0;
            $array = array('active'=> "1");
            $all_contract= model('App\Models\ContractModel')->where($array)->findall();
            
            if ($all_contract!=null){  

                foreach ($all_contract as $row ){ 
                    $pos[$i]['id']=$row['id'];
                    $i++;
                    array_push($fav,$row['id']);
                }
            }

            $datas['favorites']['contract_ids']=json_encode($fav);

        }
        ////   

// USERS FAVORITES CONTRACTS
    $i=0;
    if ($datas['favorites']!=null){  

        $favs=json_decode($datas['favorites']['contract_ids']);
                

        if ($favs!=null){  

                foreach ($favs as $row => $value ){  
                            $pos[$i]['price'] ="0"; 
                            $contract =  model('App\Models\ContractModel')->getById($value);       
                        
            
                        if ($contract ){ 
                            $pos[$i]['id']=$value;

                            $pos[$i]['ticker']=SKU_gen($contract['contract_name'],$value,2);
                            $pos[$i]['contract_name']=$contract['contract_name'];
                            $pos[$i]['contract_type']=strtoupper(lang("App.".$contract['contract_type']));
                            $pos[$i]['expiration_date']=$contract['expiration_date'];
                            $pos[$i]['lifetime_days']=$contract['lifetime_days'];
                            
                            $totalinvestors=model('App\Models\PortfolioModel')->list_investors_per_contract($value);
                            $pos[$i]['investors']= count($totalinvestors);

                            $pos[$i]['price'] = $contract['unit_value'];
                            $pos[$i]['dedlines']=deadlines_percent($value);

                            $pos[$i]['followers']=has_followers($value);

                            if (getUserlang()=="en"){

                                if ($contract["contract_name_en"]!=null){
                                    $pos[$i]['contract_name']=htmlspecialchars_decode(stripslashes($contract['contract_name_en']));
                                }
                                if ($contract['contract_excerpt_en']!=null){
                                    $pos[$i]['contract_excerpt']=htmlspecialchars_decode(stripslashes($contract['contract_excerpt_en']));
                                }
                                if ($contract['contract_description_en']!=null){
                                    $pos[$i]['contract_description']=htmlspecialchars_decode(stripslashes($contract['contract_description_en']));
                                }
                            }
                            
                            $i++;     
                        }else{
                            // THE CONTRACT DOES NOT EXIST OR DELETED
                            $pos[$i]['id']="0";
                            $i++; 
                        }
                }  
            } else {   $pos=false;} ;
    
    }else{
       $data['favorites']=false;
       $pos=false;

    }
         $data['pos']=$pos;
         $data['favorites']= $datas['favorites'];
         $data['most_followed']=$most_folowers;
         return view('exchange/monitor', $data);

 
    }

     
    public function set_favorite()
    {
        
       // postAllowed();
        $favorite_id=array();
        $id = logged('id');
        $array = array('user_id'=> $id);
        $datas['favorites']=  model('App\Models\FavoritesModel')->where($array)->first();
     
        if  (!$datas['favorites']){        
              $datas['favorites']=  model('App\Models\FavoritesModel')->getById($id);        
              $favorite_id[0]=post('favID');
              $favorite = model('App\Models\FavoritesModel')->create([
                 'user_id' =>$id ,
                 'contract_ids' => json_encode($favorite_id),
                ]);

            }else{

                $tempArray =  json_decode($datas['favorites']['contract_ids'],true);         
                if (in_array(post('favID'), $tempArray)){ $tempArray = array_diff($tempArray, array(post('favID')));
                
                }else{ 

                    array_push($tempArray, post('favID'));

                }

                $uniquevale= array_unique($tempArray);

                $data = [ 
                    'contract_ids' =>  json_encode($uniquevale),
                ];

                 $favorite = model('App\Models\FavoritesModel')->update($datas['favorites'], $data );
                 return json_encode($data, true);
           }

        return json_encode($data, true);
    }
        


    public function get_favorites(){

        $favorite_id=array();
        $id = logged('id');
        $array = array('user_id'=> $id);
        $datas['favorites']=  model('App\Models\FavoritesModel')->where($array)->findAll();
      
        return json_encode($data, true);
      
    }
  

}