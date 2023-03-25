<?php
namespace App\Controllers;

use App\Controllers\AdminBaseController;
use App\Models\DiscoverModel;

class Discover extends AdminBaseController
{
    
    public $title = 'Discover';
    public $menu = 'discover';

    public function index()
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
              }
     
         return  json_encode($pos,true);
        }
    }

}