<?php

 
 
 

/*
require   '/opt/bitnami/apache/htdocs/vh/vendor/twilio/sdk/src/Twilio/autoload.php';
use Twilio\Rest\Client;


function sendSMS($data) {


	// Your Account SID and Auth Token from twilio.com/console
	  $sid = setting('sms_sid');
	  $token = setting('sms_token');
	  $client = new Client($sid, $token);
	 
	 

	  // Use the client to do fun stuff like send text messages!
	   return $client->messages->create(
		  // the number you'd like to send the message to
		  $data['phone'],
		  array(
			  // A Twilio phone number you purchased at twilio.com/console
			  "from" => setting('sms_phone'),
			  // the body of the text message you'd like to send
			  'body' => $data['text']
		  )
	  );
}

*/

function stringToColorCode($text,$min_brightness=100,$spec=10)
{
	// Check inputs
	if(!is_int($min_brightness)) throw new Exception("$min_brightness is not an integer");
	if(!is_int($spec)) throw new Exception("$spec is not an integer");
	if($spec < 2 or $spec > 10) throw new Exception("$spec is out of range");
	if($min_brightness < 0 or $min_brightness > 255) throw new Exception("$min_brightness is out of range");
	
	
	$hash = md5($text);  //Gen hash of text
	$colors = array();
	for($i=0;$i<3;$i++)
		$colors[$i] = max(array(round(((hexdec(substr($hash,$spec*$i,$spec)))/hexdec(str_pad('',$spec,'F')))*255),$min_brightness)); //convert hash into 3 decimal values between 0 and 255
		
	if($min_brightness > 0)  //only check brightness requirements if min_brightness is about 100
		while( array_sum($colors)/3 < $min_brightness )  //loop until brightness is above or equal to min_brightness
			for($i=0;$i<3;$i++)
				$colors[$i] += 10;	//increase each color by 10
				
	$output = '';
	
	for($i=0;$i<3;$i++)
		$output .= str_pad(dechex($colors[$i]),2,0,STR_PAD_LEFT);  //convert each color to hex and append to output
	
	return '#'.$output;
}


function abbreviateNumber($num) {
	if ($num >= 0 && $num < 1000) {
	  $format = floor($num);
	  $suffix = '';
	} 
	else if ($num >= 1000 && $num < 1000000) {
	  $format = floor($num / 1000);
	  $suffix = 'K+';
	} 
	else if ($num >= 1000000 && $num < 1000000000) {
	  $format = floor($num / 1000000);
	  $suffix = 'M+';
	} 
	else if ($num >= 1000000000 && $num < 1000000000000) {
	  $format = floor($num / 1000000000);
	  $suffix = 'B+';
	} 
	else if ($num >= 1000000000000) {
	  $format = floor($num / 1000000000000);
	  $suffix = 'T+';
	}
	
	return !empty($format . $suffix) ? $format . $suffix : 0;
  }


function SKU_gen($string, $id = null, $l = 2){
	$results = ''; // empty string
	$vowels = array('a', 'e', 'i', 'o', 'u', 'y'); // vowels
	preg_match_all('/[A-Z][a-z]*/', ucfirst($string), $m); // Match every word that begins with a capital letter, added ucfirst() in case there is no uppercase letter
	foreach($m[0] as $substring){
		$substring = str_replace($vowels, '', strtolower($substring)); // String to lower case and remove all vowels
		$results .= preg_replace('/([a-z]{'.$l.'})(.*)/', '$1', $substring); // Extract the first N letters.
	}
	// $results .= '-'. str_pad($id, 4, 0, STR_PAD_LEFT); // Add the ID
	$results=substr($results, 0, 5);
	return strtoupper($results);
	 
}




function format_to_currency($num,$smallcents=true){
	 
	$fraction=intval(setting("currency_fraction"));
    $symbol=setting("currency_symbol");
	$locale=setting("currency_locale");

	$formatter = new NumberFormatter($locale, NumberFormatter::DECIMAL);
	$formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, $fraction);
	$formatter->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, $fraction);

	$numberstring=$formatter->format($num);
 	if ($smallcents==true){   // SMALLER CENTS
		$newstring = substr($numberstring, -$fraction-1);
	    $numberstring=substr($numberstring, 0, 	-$fraction-1);
	    return  $symbol.$numberstring."<sup class='centimos'><small>".$newstring."</small></sup>";
	}else{
	   return  $symbol.$numberstring;
	}
}

function cal_gain_lost_percentage($actual_price,$open_price){
	//https://www.investopedia.com/ask/answers/how-do-you-calculate-percentage-gain-or-loss-investment/
	$percentage_gain=($actual_price-$open_price)/$open_price*100;

	$coloer="#000000";
	if (floatval($percentage_gain) < 0 ){$coloer="#D5312C";}
	if (floatval($percentage_gain) > 0 ){$coloer="#1dcc22";}

 
	return  "<b style='color:".$coloer."'>". number_format($percentage_gain, 2, '.', '')."%"."</p>";


  }

   
  function cal_gain_lost($actual_price,$open_price,$invested){
/*
	if ($open_price >= $actual_price){  $gain_loss= $open_price-$actual_price;$gain_loss= -1 * abs($gain_loss);  }
	if ($open_price <= $actual_price){  $gain_loss= $actual_price-$open_price;} 
	if ($open_price == $actual_price){  $gain_loss= 0;}
   
	$gain =  $invested*$gain_loss;
*/
$percentage_gain=($actual_price-$open_price)/$open_price*100;

$gain = $invested/100*$percentage_gain;
	$coloer="#000000";
	if (floatval($gain) < 0 ){$coloer="#D5312C";}
	if (floatval($gain) > 0 ){$coloer="#1dcc22";}
 
	return  "<b style='color:".$coloer."'>".format_to_currency($gain,false)."</p>";
		//setting("currency_symbol").number_format($gain, 2, '.', '');

  }
  

 function get_time_ago( $time )
{
    $time_difference = time() - $time;

	 
    if( $time_difference < 1 ) { return lang("App.less_than_1_second_ago"); }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  lang("App.year"),
                30 * 24 * 60 * 60       =>  lang("App.month"),
                24 * 60 * 60            =>  lang("App.day"),  
                60 * 60                 =>  lang("App.hour"),
                60                      =>  lang("App.minute"),
                1                       =>  lang("App.second") 
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return lang("App.about").' ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' '.lang("App.ago");
        }
    }
}



function is_favorite($contract_id=0)
  {

	$favorite_id=array();
        
	$id = logged('id');

	$array = array('user_id'=> $id);
   
	$datas['favorites']=  model('App\Models\FavoritesModel')->where($array)->first();
    
	if ($datas['favorites']){ 

		$tempArray =  json_decode($datas['favorites']['contract_ids'],true);         
		if ($tempArray!=null){  
			if (in_array($contract_id, $tempArray)){
			return "isfavorite"; // css class 
			} 
		}
	}	
	return "";  
	 
 
   }


/* 
Positions active STATES
0 = inactive
2 = closed
1 = active
3 = draft
4 = finishing / closing
5 = cancelled
6 = onsale
7 = transferring
8 = buyorder
 
*/


function is_user_category($category,$id=0){

	if($id==0){  
	 $id=logged('id');
    }

    if ($category=="investors" OR $category=="investor"){

	 	$array = "userID='$id' AND (active='1' OR active='6' OR active='7')";
	 	$positions = model('App\Models\PortfolioModel')->where($array)->findall();

		if ($positions){  
			return  true;
		}else{
			return  false;
		}
   }


   if ($category=="contract_owner"){
	 
		$array = "ownerID='$id' AND (active='1')";
		$contract = model('App\Models\ContractModel')->where($array)->findall();

		if ($contract){  
			return  true;
		}else{
			return  false;
		}

   }


   if ($category=="no_active"){
	 
		$array = "ownerID='$id' AND (active='1')";
		$contract = model('App\Models\ContractModel')->where($array)->findall();
		if (count($contract)>0){  
			$hascontracts =  true;
			//return  false;
		}else{
			$hascontracts =  false;  
			//return true;
		}


		$array = "userID='$id' AND (active='1' OR active='6' OR active='7')";
	 	$positions = model('App\Models\PortfolioModel')->where($array)->findall();

		if (count($positions)>0){  
			$haspositions =  true;
			//return  false;
		}else{
			$haspositions =  false;
			//return   true;
		}

       if (!$haspositions && !$hascontracts){
		return  true;
	   }

		 
		 
    }

   if ($category=="staff"){
	 
		$id=logged('id');
		$user = model('App\Models\UserModel')->getById($id);

		if ( ucfirst(model('App\Models\RoleModel')->getRowById($user->role, 'title'))=="Manager" OR ucfirst(model('App\Models\RoleModel')->getRowById($user->role, 'title'))=="Staff" OR ucfirst(model('App\Models\RoleModel')->getRowById($user->role, 'title'))=="Admin"){  
			return true;
		}else{
		    return  false;
		}

	
	}

   
}



 

function ask_market_offers($tickerID,$units=0, $amount=0){
	
	 
	$data=array();
	$data['id']=1;
	 // FIND EXACT MATCH -> SAME UNITS / PRICE
	 
	 if($units>0){	 
		$array = "active='6' AND  tickerID='$tickerID' AND (units='$units') ";
		$positions = model('App\Models\PortfolioModel')->where($array)->first();
		if  ($positions){  
        // return $units." ";//$positions['units'];
		 return $data['id']=$positions['id'];
		}
	 }
 
	// FIND SAME PRICE
 
	if($units > 0) {
		$offerPrice = $amount/$units;
		$positions = model('App\Models\PortfolioModel')->where("active='6' AND tickerID='$tickerID' AND units>='$units'")->findall();
		if($positions) {
		  foreach($positions as $row) {		

				$resulta=json_decode($row['data'],true);

				if (round($resulta["sale_price"],4) == round($offerPrice,4)){
     // SAME PRICE FOUND 
					if ($resulta["fragmented"]=="on"){  
	   
 					  // return $data['id']=$row['id']."  SI  ".$offerPrice." ".round($offerPrice,4). " ".$resulta["sale_price"];
						return $data['id']=$row['id'];
					}
				}else{

					//return $data['id']=$row['id']." NO   ".$offerPrice." ".round($offerPrice,4). " ".$resulta["sale_price"];
					return  $data['id']=-1;
					$buyOffer="no";
				}

			 
		  }

		}
	 }
	 
	 return  $data['id']=-2;

}




function transfer_from_market($position_id,$units,$buyer_id){

	 
	  $array = array('id' => $position_id);

      $position = model('App\Models\PortfolioModel')->where($array)->first();

	  $priceopen=$position['price_open'];
      // FILL DATA OF POSITION TO PURCHASE
		$data = [

			'units' =>  $units,
			'active' =>  1,
			'ticker'=> $position['ticker'],
			'tickerID'=> $position['tickerID'],
			'amount'=> $position['amount'],
			'type'=> $position['type'],
			'price_open'=> $position['price_open'],
			'datetime_open'=> $position['datetime_open'],
			'stop_loss'=> $position['stop_loss'],
			'take_profit'=> $position['take_profit'],
			'leverage'=> $position['leverage'],

		];

	  // BUY ALL UNITS 
	  if ($position['units']==$units){
		 
		 $data['userID']=$buyer_id;
		 $data['data']="";
		 $position=	model('App\Models\PortfolioModel')->update($position_id, $data);
		
		 return "1";//true;
	  }

	  // BUY SOME UNITS  - FRAGMENTED 
	  if ($position['units']>$units){
		
		$data['userID']= $position['userID'];
		$data['units']=$position['units']-$units;
		$data['active']="6";
	 	$data['amount']=($position['price_open']*$data['units']);
		$position=	model('App\Models\PortfolioModel')->update($position_id, $data);
	
		$data['userID']=$buyer_id;
		$data['units']=$units;
		$data['active']="1";
	 	$data['amount']=(offer_price_from_market($position_id)*$units);//($position['price_open']*$data['units']);
		$position=	model('App\Models\PortfolioModel')->insert($data);

 	    return "1";//true;
	 }

	 return "0"."  ".$position['units']."  ".$units; //false;
}




function offer_price_from_market($position_id){
 
		$positions = model('App\Models\PortfolioModel')->where("active='6' AND id='$position_id'")->first();
		
		if($positions) {

				foreach($positions as $row) {		

				$resulta=json_decode($row['data'],true);
				return $data['price']=$resulta["sale_price"];

			} 
		}

 }
 
function deadlines_percent($contract_id){  

	 
 
	$contract = model('App\Models\ContractModel')->where(" id='$contract_id'")->first();


	// $start = strtotime('2015-11-03 14:05:15');
	// $end = strtotime('2015-11-03 18:05:15');

if ($contract){  

	// PROGRESS PERCENT UNTIL EXPIRES
	$start = ($contract['starting_date']);
	$end =   ($contract['expiration_date']);
	// PROGRESS PERCENT UNTIL FUND ENDS
	$funding_ends =   ($contract['lifetime_days']);

	// TODAY
	$current =intval(microtime(true) * 1000); 
	             
	$completed['percent_to_expire'] = (($current - $start) / ($end - $start)) * 100;
	$completed['percent_to_end_funding'] = (($current - $start) / ($end - $funding_ends)) * 100;
	$completed['end_funding'] = (($funding_ends - $start) / ($end - $start)) * 100;
 
return $completed;
} 
 
}



function has_followers($contract_id=0)
    { 
 
        if ($contract_id>0){  
                $followers= model('App\Models\FavoritesModel')->findall();
                $ides=array();
            
            foreach ($followers as $row){  
                $fav=json_decode($row['contract_ids']);
				if ($fav!=null){  
                    foreach ($fav as $row => $value ){   
                        array_push($ides,$value);
                    }
				}
            }
            
            $most_folowers=(array_count_values($ides));
 

 
			if(isset($most_folowers[$contract_id])){  
				return json_encode($most_folowers[$contract_id], true);
		    } 
        }
		return "0";
    }
 

	// USER TOTAL AMOUNT IN OPEN POSITIONS
	function user_total_invested($user_id=0)
    { 

		 
		$array = "userID='$user_id' AND (active='1' OR active='6' OR active='7')";

		$positions = model('App\Models\PortfolioModel')->where($array)->findall();
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

	 
	 function user_total_invested_icons($user_id=0){
       if ($user_id>0){
		$figuer=user_total_invested($user_id);
			if ($figuer<=0){
				return "0";
			}else{  
			   return  strlen((string)$figuer);
			}
	   }
	 }
	 

	// ACTUAL NUMBER OF CONTRACTS USER IS INVESTING ON
	function number_of_contracts_user_investing($user_id=0)
    { 

        $array = "userID='$user_id' AND (active='1' OR active='6' OR active='7')";

		$positions = model('App\Models\PortfolioModel')->where($array)->findall();
		$i=0;
		$total_invested=[];
		if ($positions){  
		
			$max = count($positions);
			
				for($i = 0; $i < $max;$i++)
				{
					$total_invested[$i]=$positions[$i]['tickerID'];
				}
			  }
		  return  count(array_unique($total_invested));		 

	}




	function get_user_balances($userID=0)
    {


       if ($userID>0){ }else{ return false; }
        $id =  $userID;
        $positions =model('App\Models\PortfolioModel')->list_positions_actual_price($id);
         
        $sumas=0;
        $total_invested=0;
        $actual_units_val=0;
        $actual_position_val=0;
        $actual_position_price=0;

        if ($positions){  
        $max = count($positions);
        
            for($i = 0; $i < $max;$i++)
            {
                $total_invested += ($positions[$i]['amount']);
                $actual_position_price += ($positions[$i]['price']);
                $actual_units_val += ($positions[$i]['units']);
                $actual_position_val  += ($positions[$i]['price']) * ($positions[$i]['units']);

            // $actual_val += ($positions[$i]['price']);;//($positions[$i]['units']);
                
            }

        
        
            // Total Invested
            $data["total_invested"]=$total_invested;

            // Gain_loss
            
            if ($total_invested >= $actual_position_val){  $data["gain_loss"]= $total_invested-$actual_position_val;$data["gain_loss"]= -1 * abs($data["gain_loss"]);  $data["gain_loss_color"]="#d40000";$data["class"]="fas fa-arrow-alt-circle-down transapernte5";}
            if ($total_invested <= $actual_position_val){  $data["gain_loss"]=  $actual_position_val-$total_invested; $data["gain_loss_color"]="#1dcc22";$data["class"]="fas fa-arrow-alt-circle-up transapernte5";} 
            if ($total_invested == $actual_position_val){  $data["gain_loss"]= 0;$data["gain_loss_color"]="#000000";$data["class"]="fas fa-equals transapernte5";}
             
            
            // Calculate Portfolio value
            $id = $userID;
            $cash = model('App\Models\WalletModel')->get_cash_available($id);
            $data["portafolio_value"]=($cash["wallet_balance"])+$data["total_invested"]+($data["gain_loss"]);
             // Wallet Balance
            $data["wallet_balance"]=format_to_currency($cash["wallet_balance"],true);
            // FORMATING TO CURRENCY
            $data["gain_loss"]=format_to_currency($data["gain_loss"],true);
            $data["total_invested"]=format_to_currency($data["total_invested"],true);
            $data["portafolio_value"]=format_to_currency($data["portafolio_value"],true);
        }else{ 
           
            $data["gain_loss"]=format_to_currency("0",true);
            $data["total_invested"]=format_to_currency("0",true);
            $data["portafolio_value"]=format_to_currency("0",true);
            // Total Invested
            $data["gain_loss_color"]="#000000";$data["class"]="fas fa-equals transapernte5";

            // Wallet Balance
            $id = $userID;
            $cash = model('App\Models\WalletModel')->get_cash_available($id);
            $data["wallet_balance"]=format_to_currency($cash["wallet_balance"],true);
    }
        
        
        return json_encode($data, true);
        
    }









