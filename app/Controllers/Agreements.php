<?php
namespace App\Controllers;

 
use App\Controllers\AdminBaseController;
use App\Models\AgreementModel;
 
 

class Agreements extends AdminBaseController
{

    public $title = 'Agreements';
    public $menu = 'agreements';

    public function index()
    {

       // $array = array('active' => 1);  

       // $agreement['agremment'] = model('App\Models\AgreementModel')->where($array)->findAll();
       $data['agreements'] = model('App\Models\AgreementModel')->findAll();
       if (!$data['agreements']){
        $agreements=false;
     }
    
       
      return view('exchange/agreements', $data );

      
    }




    public function view($id=0)
    {

        
        $contract_id=post('agreementID');
       
        if (!$contract_id){
            $contract_id=$id;
            if($id==0){
                return "";//view('exchange/agreements');
            } 
        }
         
        
       
        $array = array('contractID' => $contract_id);  
    
        $agreement['agremment'] = model('App\Models\AgreementModel')->where($array)->first();
       
       // IF AGREEMENT DOES NOT  EXIST 
       if ($agreement['agremment']==null )
       {
         $data['agremment']['id']=$contract_id;
         $data['agremment']['content']="";
         return json_encode($data,true);
       }
      // END

        
       if (getUserlang()=="es"){ 
            $data['agremment']['content']= htmlspecialchars_decode($agreement['agremment']->content);
       }else{  
            $data['agremment']['content']= htmlspecialchars_decode($agreement['agremment']->content_en);
        }

        if (post('action')!=null && post('action')=="read"){ 
            return json_encode($data,true);
        }else{
             return view('exchange/agreements' , $agreement);
        }

        

     
    }


    public function delete($id)
    {

       
        (new AgreementModel)->delete($id);
        return redirect()->back()->with('notifySuccess', lang('App.agreement_deleted'));

    }


    public function save($id=0)
    {
        $contract_id=post('agreementID');
       
        if (!$contract_id){
            $contract_id=$id;
            if($id==0){
                return "";//view('exchange/agreements');
            } 
        }


        $array = array('contractID'=> $contract_id);
        $AgreementID =  model('App\Models\AgreementModel')->where($array)->first();

        

        if (!$AgreementID){  

                // CREATE NEW AGREEMENT 

                $AgreementID = (new AgreementModel)->create([
                    'contractID'  => $contract_id, 
                    'content'  =>post('text'), 
                    'content_en'  => "", 

                ]);
                 $data["done"]=1;

        }else{  // UPDATE AGREEMENT
         
            if (getUserlang()=="es"){ 
           
                $data = [ 
                'contractID' => $contract_id,
                'content' => htmlspecialchars(post('text')),
                'date' => date('Y-m-d H:i:s'),
             ];
            }else{
                $data = [ 
                    'contractID' => $contract_id,
                    'content_en' => htmlspecialchars(post('text')),
                    'date' => date('Y-m-d H:i:s'),
                 ];
            }

                (new AgreementModel)->update( $AgreementID->id, $data);
 
        }
 

        return json_encode($data,true);

    }

}