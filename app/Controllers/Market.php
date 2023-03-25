<?php
namespace App\Controllers;

use App\Controllers\AdminBaseController;
use App\Models\MarketModel;
use App\Models\ContractModel;
 
class Market extends AdminBaseController
{
    
    public $title = 'Market';
    public $menu = 'market';

    public function index()
    {
       $data['pagetitle']="market";
       $id=0; //LIST ALL CONTRACTS
       $status="ALL"  ;
       $data['contracts']['val'] = (new ContractModel)->list_contracts($id, $status);

       if (post('action')!=null && post('action')=="read"){ 
           return json_encode($data,true);
       }else{
       return view('exchange/market/list', $data);
       }
    }


    public function prices()
    {
     
      $restar=60000*30;
      $mtimr=microtime(true);
      return $mtimr;
      $ahora=microtime(true)."/".microtime(true);  
    //$ahora= date("Y-m-d")."/".date("Y-m-d");
    
    $ahora="1676849404000/1676849404000";
     
    //$urls="https://api.polygon.io/v2/aggs/ticker/C:XAUUSD/range/1/day/2023-02-19/2023-02-19?adjusted=true&sort=asc&limit=120&apiKey=5wQqn6Tc872SfBuPu5nWEIxD4lxpwBCu";
    $urls="https://api.polygon.io/v2/aggs/ticker/C:XAUUSD/range/1/day/".$ahora."?adjusted=true&sort=asc&limit=120&apiKey=5wQqn6Tc872SfBuPu5nWEIxD4lxpwBCu";

    $json = file_get_contents($urls);
    $obj = json_decode($json, true);


   // return  var_dump( $obj['results'][0]['c']);
    
     return var_dump($obj); // $obj->results;

    }
    public function bids()
    {
      $data['pagetitle']="bids";
      return view('exchange/market/bids', $data);


    }

    public function asking()
    {
      $data['pagetitle']="asking";


    }

    public function order_book()
    {
      $data['pagetitle']="order_book";

      // GET ALL ASKING POSITIONS
      
       if (post('action')!=null){ 
         $ask_bid= post('ask_bid');
       }else{
        $ask_bid="6"; 
       }

       $array = array('active' => $ask_bid);  
      

       $positions = model('App\Models\PortfolioModel')->where($array)->findall();
   
            if  ($positions){  
              $max = count($positions);
              for($i = 0; $i < $max;)
              {
                    if ($positions[$i]['units']>0){ 
                          $pos[$i]['price'] ="0"; 
                          $price =  model('App\Models\ContractModel')->getById($positions[$i]['tickerID']);
                          if($price){   // CONTRACT COULD BE DELETED AND NO PRICE INFO AVAILABLE
                            $pos[$i]['price'] = $price['unit_value'];
                            $pos[$i]['contract_name']= $price['contract_name'];
                            $pos[$i]['contract_type']= $price['contract_type'];
                          } 
                          $pos[$i]['id'] = ($positions[$i]['id']);
                          $pos[$i]['ticker'] = ($positions[$i]['ticker']);
                          $pos[$i]['userID'] = ($positions[$i]['userID']);
                          $pos[$i]['tickerID'] = ($positions[$i]['tickerID']);
                         // $pos[$i]['units'] = ( number_format($positions[$i]['units'],4));
                          $pos[$i]['units'] =  rtrim(rtrim((string)number_format($positions[$i]['units'], 5, ".", ""),"0"),".");

                          $pos[$i]['amount'] = ($positions[$i]['amount']);
                          $pos[$i]['type'] = ($positions[$i]['type']);
                          $pos[$i]['active'] = ($positions[$i]['active']);
                          $pos[$i]['price_open'] = ($positions[$i]['price_open']);
                          $pos[$i]['datetime_open'] = ($positions[$i]['datetime_open']);
                          $pos[$i]['stop_loss'] = ($positions[$i]['stop_loss']);
                          $pos[$i]['take_profit'] = ($positions[$i]['take_profit']);
                          $pos[$i]['leverage'] = ($positions[$i]['leverage']);
                          $pos[$i]['glp'] = cal_gain_lost_percentage( $pos[$i]['price'],$pos[$i]['price_open'] );
                          $pos[$i]['gl'] = cal_gain_lost( $pos[$i]['price'],$pos[$i]['price_open'],$pos[$i]['amount'] ); 	
                            // GET ASKING PRICE
                                    $resulta=json_decode($positions[$i]['data'],true);
                                    if ($resulta!=null){
                                        $pos[$i]['asking_price']= $resulta["sale_price"];
                                    }else{
                                        $pos[$i]['asking_price']=  $pos[$i]['price'];
                                    }

                         
                    }
                    $i++;
                }
      
          //////////// check for positions with 0 units   ////////////
            
          /////////////////////////////////////////////////////////////

              if (post('action')!=null && post('action')=="read"){ 
                 array_multisort (array_column( $pos, 'asking_price'), SORT_ASC, $pos);

                  return  json_encode($pos,true);
              }else{
                 $data['pos']=$pos;
                 array_multisort (array_column( $data['pos'], 'asking_price'), SORT_ASC, $data['pos']);

                 return view('exchange/market/order_book', $data);
              }

 
        
          }

          
   }

   

    public function deadline_timeline()
    {
        
        $array = array('active' => '6');

        //$where = "userID='$id' AND (active='6')";
    
           
         $positions = model('App\Models\PortfolioModel')->where($array)->findall();
     
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
                $pos[$i]['amount'] = ($positions[$i]['amount']);
                $pos[$i]['type'] = ($positions[$i]['type']);
                $pos[$i]['active'] = ($positions[$i]['active']);
                $pos[$i]['price_open'] = ($positions[$i]['price_open']);
                $pos[$i]['datetime_open'] = ($positions[$i]['datetime_open']);
                $pos[$i]['stop_loss'] = ($positions[$i]['stop_loss']);
                $pos[$i]['take_profit'] = ($positions[$i]['take_profit']);
                $pos[$i]['leverage'] = ($positions[$i]['leverage']);
                $pos[$i]['glp'] = cal_gain_lost_percentage( $pos[$i]['price'],$pos[$i]['price_open'] );
                $pos[$i]['gl'] = cal_gain_lost( $pos[$i]['price'],$pos[$i]['price_open'],$pos[$i]['amount'] );
                $pos[$i]['dedlines']=deadlines_percent($positions[$i]['tickerID']);
              }
     
        // return  json_encode($pos,true);
        }

        $data['pos']=$pos;

       // $data['pos']= difference_between_times("305");
        return view('exchange/market', $data);

    }

}