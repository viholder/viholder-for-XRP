<?php
namespace App\Controllers;

use App\Controllers\AdminBaseController;
use App\Models\PortfolioModel;
use App\Models\ContractModel;
use App\Models\WalletModel; 
use App\Models\UserModel;

class Portfolio extends AdminBaseController
{
    
    public $title = 'Portfolio';
    public $menu = 'portfolio';


    public function index()
    {  
       $id = logged('id');
       $data['user_positions']['val'] = (new PortfolioModel)->list_positions_actual_price($id);
       $data['pagetitle']="portfolio";
       return  view('exchange/portfolio', $data);
    }

    public function orders()
    {  
       $id = logged('id');
       $data['user_positions']['val'] = (new PortfolioModel)->list_positions_actual_price($id,"8");
       $data['pagetitle']="orders";
       return  view('exchange/portfolio/orders', $data);
    }

    public function history()
    {  
       $id = logged('id');
  
       $array = "user='$id' AND ref='open_position'";
 
       $data['user_positions']['val'] =  model('App\Models\ActivityLogModel')->where($array)->findall();  

       $data['pagetitle']="history";
   
       $array= json_decode(json_encode($data), true);
        return  view('exchange/portfolio/history',  $array);
      // return json_encode( $data);
    }
    

    public function test1()
    {  
       // return    ask_market_offers("305","32","236.80");
     
       return    transfer_from_market("1377","15", "11");
    //  return json_encode( $wallets);

    
    
    }

    

    public function list_positions()
    {  
       $id = logged('id');
       $active=1;

       $data['user_positions']['val'] = (new PortfolioModel)->list_positions_actual_price($id,$active);
       $i=0;
       if ($data['user_positions']['val']){  
            foreach ($data['user_positions']['val'] as $row): 
               $data['user_positions']['val'][$i]["amount"] = format_to_currency($row["amount"],false);
               //$data['user_positions']['val'][$i]["units"] = number_format($row["units"], 4, '.', '');
               $data['user_positions']['val'][$i]["units"] = rtrim(rtrim((string)number_format($row['units'], 5, ".", ""),"0"),".");

               $data['user_positions']['val'][$i]["price_open"] = format_to_currency($row["price_open"],false);
               $data['user_positions']['val'][$i]["price"] = format_to_currency($row["price"],false); 
               
               if ($row["active"]==6){
                $data['user_positions']['val'][$i]["button_text"]= lang('App.onsale');
               };
               if ($row["active"]==1){
                $data['user_positions']['val'][$i]["button_text"]= lang('App.manage');
               };
               if ($row["active"]==8){
                $data['user_positions']['val'][$i]["button_text"]= lang('App.cancel');
               };

               $i++;
            endforeach;
        }
      return  json_encode($data,true);
    }





    public function put_position_on_sale()
    { 
       
        $position_ID=post('position_ID');
        $datas= (new PortfolioModel)->get_position($position_ID);


        if  (!$datas){
            $data['error']= "error";
            return json_encode($data,true);

          }else{
            $units=$datas['units'];
            $price_open=$datas['price_open'];
            $amount=$datas['amount'];
            $ticker=$datas['ticker'];
         }
         
        // ONLY  ACTIVE POSITIONS CAN BE PUT ON SALE // 
        if ($datas['active']!="1"){
            $data['error']= "error";
            $data['msg']= "Not enogh units";
            return json_encode($data, true);
        }

        if ($units < post('units')){
            $data['error']= "error";
            $data['msg']= "Not enogh units";
            return json_encode($data, true);
         }
         
         
         if ($units == post('units')){
             
            $info["sale_price"]=post('saleprice');
            $info["market_price"]=post('market_price');
            $info["fragmented"]=post('fragmented');
            $infos=json_encode($info, true);

            $data = [ 
                'active' => "6",
                'data' => $infos,
               // 'timestamp'  => date('Y-m-d H:i:s'),
            ];

            (new PortfolioModel)->update($position_ID, $data);
            $data['done']= "1";
            $data['msg']= "position on sale";
            model('App\Models\ActivityLogModel')->add("Put on Sale ".ucfirst(SKU_gen($datas['ticker'],$position_ID,2))."  User: #".logged('id'),logged('id'),0,"put_on_sale",$position_ID);

            return json_encode($data, true);

         }else{

            $leftunits=doubleval($units)-doubleval(post('units'));
            $leftamount=doubleval($leftunits)*doubleval($price_open);

            $data = [ 
                'active' => "1",
                'units' =>$leftunits,
                'amount' =>$leftamount,
               // 'timestamp'  => date('Y-m-d H:i:s'),
            ];
            (new PortfolioModel)->update($position_ID, $data);
 
            $newpositionID=(new PortfolioModel)->duplicate($position_ID);
            
            $leftunits2=doubleval($units)-doubleval($leftunits);
            $leftamount2=doubleval($leftunits2)*doubleval($price_open);
            $info["splited_from"]=$position_ID;
            $info["sale_price"]=post('saleprice');
            $info["market_price"]=post('market_price');
            $info["fragmented"]=post('fragmented');
            $infos=json_encode($info, true);

            $data = [ 
                'active' => "6",
                'amount'  => $leftamount2,
                'units' => $leftunits2,
                'data' => $infos,
                'take_profit' => "0",
                'timestamp'  => date('Y-m-d H:i:s'),
            ];
            (new PortfolioModel)->update($newpositionID, $data);
            
            $data['done']= "1";
            $data['msg']= $newpositionID;

            model('App\Models\ActivityLogModel')->add("Put on Sale ".ucfirst(SKU_gen($datas['ticker'],$position_ID,2))."  User: #".logged('id'),logged('id'),0,"put_on_sale",$position_ID);
            model('App\Models\ActivityLogModel')->add("Splited position ".ucfirst(SKU_gen($datas['ticker'],$position_ID,2))."  User: #".logged('id'),logged('id'),0,"split_position",$newpositionID);

            return json_encode($data, true);
           
         }

         $data['error']= "error";
         $data['msg']= "nothing to do";
         return json_encode($data, true);
 
    }





    public function cancel_sale()
    {
        $position_ID=post('position_id');
       
        $data = [ 
            'active' => "1",
        ];

        (new PortfolioModel)->update($position_ID, $data);
        $data['done']= "1";
        $data['msg']= lang('sale_cancelled');
         model('App\Models\ActivityLogModel')->add("Sale cacncelled by User: #".logged('id'),logged('id'),0,"cancel_sale",$position_ID);
 
        return json_encode($data, true);

    }





    public function update_order()
    { 
       
        $position_ID=post('position_ID');
        $datas= (new PortfolioModel)->get_position($position_ID);


        if  (!$datas){
            $data['error']= "error";
            return json_encode($data,true);

          }else{
            $units=$datas['units'];
            $price_open=$datas['price_open'];
            $amount=$datas['amount'];
            $ticker=$datas['ticker'];
         }
         
        // ONLY A BUYING ORDERS CAN BE UPDATED // 
        if ($datas['active']!="8"){
            $data['error']= "error";
            $data['msg']= "Not enogh units";
            return json_encode($data, true);
        }
        

     
            $info["sale_price"]=post('saleprice');
            $info["market_price"]=post('market_price');
            $info["fragmented"]=post('fragmented');
            $infos=json_encode($info, true);

            $estimated_amount=doubleval(post('saleprice'))*doubleval(post('units'));

            $data = [ 
                'units'  => post('units'),
                'amount'  => $estimated_amount,
                'active' => "8",
                'data' => $infos,
               // 'timestamp'  => date('Y-m-d H:i:s'),
            ];

            (new PortfolioModel)->update($position_ID, $data);
            $data['done']= "1";
            $data['msg']= "Order updated";
            model('App\Models\ActivityLogModel')->add("Order updated ".ucfirst(SKU_gen($datas['ticker'],$position_ID,2))."  User: #".logged('id'),logged('id'),0,"order_updated",$position_ID);

            return json_encode($data, true);


       

    }

    public function cancel_order()
    {
        $position_ID=post('position_id');
       
        $data = [ 
            'active' => "5",
        ];

        (new PortfolioModel)->update($position_ID, $data);
        $data['done']= "1";
        $data['msg']= lang('order_cancelled');
        model('App\Models\ActivityLogModel')->add("Buying Order Cacncelled by User: #".logged('id'),logged('id'),0,"cancel_buying_order",$position_ID);
 
        return json_encode($data, true);

    }




    public function investor_has_invested()
    {
        $contractID="304";
        $userID="1";
        $data=  (new PortfolioModel)->investor_has_invested_in_position($contractID,$userID);
        return json_encode($data, true);

    }
    

    public function contract_investors()
    {  
         $contractID="304";
         
         $data=  (new PortfolioModel)->list_investors_per_contract($contractID);
         return json_encode($data, true);
    }
 

    public function serverside_datatables_data()
    {
        $db = db_connect();
        $builder = $db->table('positions')->select('id,ticker,units');
        return DataTable::of($builder)->toJson(true);
    }

    

    public function get_positions()
    {
        $request = \Config\Services::request();
        $method = $request->getMethod();
        $something = $request->getVar('title');
           
        $id = logged('id');
        $positions = (new PortfolioModel)->list_positions($id);
		//return $positions;
        return json_encode($positions, true);
        
    }



    public function get_position_partial()
    {
        $position_ID=post('position_id');
        $datas= (new PortfolioModel)->get_position($position_ID);
        if  (!$datas){$data['error']= "error";}else{
            $data['units']=$datas['units'];
            $data['price_open']=$datas['price_open'];
            $data['amount']=$datas['amount'];
            $data['active']=$datas['active'];
         }
        return json_encode($data, true);
    }

    



    public function open_position(){
 
       // postAllowed();
        $id = logged('id');
        $post_amount =  post('amount');
        $set_active_state="1";

        $validation_open_position  = [
            'amount' => 'required|numeric|greater_than[0]',
        ];

        if (! $this->validate($validation_open_position)) {
            $datas = ['errors' => $this->validator->getErrors()];
            $data['error']=$datas;  
            $data['error']="error";
        
            return json_encode($data, true);
        } 

      

        //// LOAD DATA

        $contract_id =  post('contract_id');
        $data= (new ContractModel)->getById($contract_id);
       
        
        //IF JUST WANT TO OPEN A BUYING ORDER
        if (post('put_buying_order')==1){
            $set_active_state="8";
            goto  buyleft;
        }

        // DON´T SALE MORE UNITS THAN COTRACT TARGET -- START

        $invested=(new PortfolioModel)->invested_in_position($contract_id); 

        $will_be_invested=($invested)+(post('amount'));
        $target=($data["target"]);


        if ($will_be_invested > $target ){ 
            $only_can_sale= $target-$invested;

            // CHECK IF THERE ARE OFFERS IN MARKET (SAME PRICE / UNITS)
            
             $findOffer=ask_market_offers($contract_id,post('units'), $post_amount);
            
            
            // BUY LEFT TOKENS ON CONTRACT AND GET THE REST FROM THE MARKET

             if ($only_can_sale>0 AND  $findOffer >0){
               // buy_from_market($position_id,$units,$buyer_id);
                transfer_from_market($findOffer,post('units'),logged('id'));
               // buy_tokens_left_form_contract
                $post_amount=$only_can_sale;
                goto buyleft;

             } 

             if ($only_can_sale==0 AND  $findOffer >0){
               // buy_from_market($position_id,$units,$buyer_id);
                transfer_from_market($findOffer,post('units'),logged('id'));
                $data['error']="";
               return json_encode($data, true);

             } else{
                $data['error']="cant_complete_order";
                $data['msg']= $findOffer ."-->".lang("App.complete_order_txt");
             }
            //

            return json_encode($data, true);
        }

         // DON´T SALE MORE UNITS THAN COTRACT TARGET -- END
         
         buyleft: 

        //// FILL DATA
        $data["amount"]=  $post_amount;
        $data["units"]=  post('units');
        $data["active"]= $set_active_state; 
        $data["type"]=  post('type');  
        if ($data["contract_type"]=="future"){  
            $data["stop_loss"]= post('stop_loss');
            $data["take_profit"]=  $post_amount+($post_amount/100)*($data["roi"]);
            $data["leverage"]="1";//post('laverage');
            $data["short_long"]= "long";
        }else{
            $data["stop_loss"]=  post('stop_loss');
            $data["take_profit"]=   ($post_amount+$post_amount/100)*($data["roi"]);
            $data["laverage"]=  "1";//post('laverage');
            $data["short_long"]=  post('short_long');
        }
         

      
        $positions = (new PortfolioModel)->add_open_position($contract_id,$data);
        $subtract_cash = (new WalletModel)->subtract_cash(logged('id'),$data["amount"],"open_position",$positions);


         // CHECK IF THERE ARE FUNDS

        if ($subtract_cash==false){
            (new PortfolioModel)->delete($positions);
            $data['error']="confirm_funds";
             

        // LETS CHECK IF THERE ARE FUNDS IN OTHER WALLET 
             $cashavailable = (new WalletModel)->get_cash_available($id);

             if ($cashavailable["wallet_balance"]>=$post_amount){
             

                            // TRY TAKEFUNDS FROM ANY PERSONAL WALLET
                                $array = "userID='$id' AND contractID='0' AND network='viholder' AND wallet_balance>='$post_amount' ";

                                $wallets=(new WalletModel)->where($array)->first();
                              
                                $is_personal_wallet=true;
                                $con_name= lang('App.personal_wallet');

                             // NO FUNDS IN PERSONAL WALLETS, TRY IN CONTRACTS WALLETS
                                if(!$wallets){  
                                   
                                   $is_personal_wallet=false;
                                   $array = "userID='$id' AND contractID>'0' AND network='viholder' AND wallet_balance>='$post_amount' ";

                                   $wallets=(new WalletModel)->where($array)->findall();
                                }
 
                                if($wallets){  
                                    
                                    $i=0;
                                    foreach ($wallets as $row ){
                                        if ( $row['wallet_balance'] >=  $post_amount){
                                            $fromwallet= $row['id'];
                                            $contractOwner = $row['userID'];
                                            $WalletContractID= $row['contractID'];
                                                // GET wALLET CONTRACT NAME
                                            if ($is_personal_wallet==false){    
                                               if ($WalletContractID){  
                                                    $walletcontractdata= (new ContractModel)->getById($WalletContractID);
                                                    $con_name=$walletcontractdata['contract_name'];

                                                     // DONT ALLOW TO PAY WITH SAME CONTRACT WALLET
                                                   if (setting("permit_pay_with_contract_funds")=="false"){  
                                                        if ( $contractOwner==logged('id') &&  $WalletContractID==$contract_id){
                                                            $data['error']="cant_pay_with_contract_funds";
                                                            $data['msg']= lang("App.you_cant_pay_with_contract_funds")." ".$con_name. " ".lang("App.dont_worry_you_have")." ".setting("currency_symbol").$row['wallet_balance'].setting("base_currency")." ".lang("App.in_other_investment");
                                                            goto response;
                                                        }  
                                                    }
                                                }
                                            } 
                                              

                                              $data['msg']= lang("App.dont_worry_you_have")." ".setting("currency_symbol").$row['wallet_balance'].setting("base_currency")." ".lang("App.from_the_account").": ".$con_name." WID".$WalletContractID." CID:".$contract_id;
                                              goto response;
                                            }

                                    }
                                }
                                   
                $data['error']="not_enogh_funds";    
                     
            }else{
                 
                $data['error']="not_enogh_funds";
            }
            
            response:

            if ( post('isconfirmed')=="1"){ 
                // CONFIRMED TO TAKE FUND FROM AN OTHER WALLET - cash_subtraction_authorization
                // LOG
                model('App\Models\ActivityLogModel')->add("Confrimed to take other wallet funds".ucfirst(SKU_gen($data['contract_name'],$contract_id,2))."  User: #".logged('id'),$id,0,"cash_subtraction_authorization",$positions);
                // OPEN POSITION
               $positions = (new PortfolioModel)->add_open_position($contract_id,$data);
               $subtract_cash = (new WalletModel)->subtract_cash(logged('id'),$post_amount,"open_position",$positions,$fromwallet);
               
               if ($subtract_cash==false){
                (new PortfolioModel)->delete($positions);
               
                $data['error']="not_enogh_funds";
                 return json_encode($data, true);
               }

                goto is_confirmed;
            
            }  

       
      
        return json_encode($data, true);
        }

        is_confirmed:  

        
       // if (logged('id') == $contractOwner){ }else{   //DONT DEPOSIT IF OWNER WANTS TO PAY FROM it's CONTRACT's WALLET
          $desposit_on_contract=(new WalletModel)->desposit_on_contract($contract_id,$data["amount"],"contract_investment",$positions);
      //  }
         
     // LOG
        model('App\Models\ActivityLogModel')->add("Open Position ".ucfirst(SKU_gen($data['contract_name'],$contract_id,2))."  User: #".logged('id'),$id,0,"open_position",$positions);

        return $positions;
    }



    public function cash_available(){

        $id = logged('id');
        $positions = (new WalletModel)->get_cash_available($id);
        return json_encode($positions, true);
        
    }
     


    public function total_invested()
    {
        
        $id = logged('id');
        $positions = (new PortfolioModel)->list_positions_actual_price($id);
         
        $sumas=0;
        $max = count($positions);
        for($i = 0; $i < $max;$i++)
        {
 
            $sumas += ($positions[$i]['amount']);
         }
         
         $data["total_invested"]=$sumas;
         return json_encode($data, true);
        
    }



    public function portfolio_dashboard()
    {
       
        $id = logged('id');
        $positions = (new PortfolioModel)->list_positions_actual_price($id);
         
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
            $id = logged('id');
            $cash = (new WalletModel)->get_cash_available($id);
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
            $id = logged('id');
            $cash = (new WalletModel)->get_cash_available($id);
            $data["wallet_balance"]=format_to_currency($cash["wallet_balance"],true);
    }
        
        
        return json_encode($data, true);
        
    }

    public function  put_buying_order()
    {

        $id = logged('id');
    }

    


}