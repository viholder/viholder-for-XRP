<?php
namespace App\Controllers;

use App\Controllers\AdminBaseController;
use App\Models\ContractModel;
use App\Models\WalletModel;
use CodeIgniter\Files\File;
use App\Models\UserModel;
use App\Models\PortfolioModel;
 
 
 
class Contracts extends AdminBaseController
{
    
    public $title = 'Contracts';
    public $menu = 'contracts';
     
    public function index()
     {
        $data['pagetitle']="contracts";
        $id=0; //LIST ALL CONTRACTS
        $status="ALL"  ;
        $data['contracts']['val'] = (new ContractModel)->list_contracts($id, $status);

        if (post('action')!=null && post('action')=="read"){ 
            return json_encode($data,true);
        }else{
            
        return view('exchange/contracts/list', $data);
        }
     }

     public function delete($id)
     {

         $invested= (new PortfolioModel)->invested_in_position($id);

         if ($invested>0){
             return redirect()->back()->with('notifyError', lang('App.cant_delete_contract_already_funded'));
         }

		 (new ContractModel)->delete($id);
         return redirect()->back()->with('notifySuccess', lang('App.contract_deleted'));
     }

     public function ownership()
     {

        $data['pagetitle']="ownership";
        $id = logged('id');
        $status="0"; // LISTA ALL STATUS (PUBLISHED, DRAFT)
        $data['contracts']['val'] = (new ContractModel)->list_contracts($id,$status);
       
// RETURN VIEW OR DATA
        if (post('action')!=null && post('action')=="read"){ 
            return json_encode($data,true);
        }else{
            return view('exchange/contracts/ownership', $data);
        }

      }



     public function myinvestors($contractID=0)
    {    
        
        $data['contract_selected']=$contractID;

        if (post('id')!=null && post('id')>0){ 
            $contractID=post('id');

        }
      
        $data['pagetitle']="myinvestors";
        $id = logged('id');
        $status = "0"; // LISTA ALL STATUS (PUBLISHED, DRAFT)
        $contracts = (new ContractModel)->list_contracts($id, $status, $contractID );
        if (!$contracts) {
            $data['investors']['val']=null;
            return view('exchange/contracts/myinvestors', $data);
        }
 
        $invested = [];
        $investor_positions_totals = [];
        $investor_has_positions = [];
        foreach ($contracts as $contract) {
            $elid =  $contract['id'];
            foreach ($contract["investors"] as $investor_id => $investor_data) {
                $invested[$investor_id] = model('App\Models\PortfolioModel')->investor_has_invested_in_position($elid, $investor_id);
                $investor_positions_totals[$investor_id][$elid] = $invested[$investor_id];
                $investor_has_positions[$investor_id][] = $elid;

               // GET CONTRACT NAME
                $contracts = model('App\Models\ContractModel')->getById($elid);
                $data['contract']['name'][$elid]=$contracts['contract_name'];   

            }
        }

        $investor_totals = [];
        foreach ($investor_positions_totals as $investor_id => $positions) {
          
            $investor_totals[$investor_id] =  floatval(array_sum($positions));
         }

        $data['investors']['val'] = $investor_totals;
        $data['investors']['pos'] = $investor_has_positions;
       
         
// GET INVESTOR NAME
           
             foreach ( $data['investors']['val'] as $key => $value){                    
                $userdata =  model('App\Models\UserModel')->getById($key);
                $data['investors']['name'][$key]=$userdata->name;   
                $data['investors']['image'][$key]= userProfile($key);
             }


// RETURN VIEW OR DATA 
        if (post('id')!=null && post('id')>0){ 

             return json_encode($data,true);
        }else {  
             return view('exchange/contracts/myinvestors', $data);
        }
    }
      


    
     public function open_position_modal()
     {
        return view('exchange/modal_open_position');  
     }




     public function view($id)
     {
        $data['pagetitle']="view";
        $data['contract']= (new ContractModel)->getById($id);

        if ( $data['contract'] ){ 
           
            $totalinvestors=model('App\Models\PortfolioModel')->list_investors_per_contract($id);
            $data['contract']['investors']= count($totalinvestors);

            
            $data['contract']['price'] = $data['contract']['unit_value'];
            $data['contract']['dedlines']=deadlines_percent($id);

            $data['contract']['followers']=has_followers($id);

            $invested= (new PortfolioModel)->invested_in_position($id);

            $data['contract']['invested']= $invested;

            $data['contract']['contract_name']=htmlspecialchars_decode(stripslashes($data['contract']['contract_name']));
            $data['contract']['contract_excerpt']=htmlspecialchars_decode(stripslashes($data['contract']['contract_excerpt']));
            $data['contract']['contract_description']=htmlspecialchars_decode(stripslashes($data['contract']['contract_description']));

           if (getUserlang()=="en"){
                
                    if ($data['contract']['contract_name_en']!=null){
                        $data['contract']['contract_name']=htmlspecialchars_decode(stripslashes($data['contract']['contract_name_en']));
                    }
                    if ($data['contract']['contract_excerpt']!=null){
                        $data['contract']['contract_excerpt']=htmlspecialchars_decode(stripslashes($data['contract']['contract_excerpt_en']));
                    }
                    if ($data['contract']['contract_description']!=null){
                        $data['contract']['contract_description']=htmlspecialchars_decode(stripslashes($data['contract']['contract_description_en']));
                    }
             }
        }else{
            // THE CONTRACT DOES NOT EXIST OR DELETED
            
        }


        return view('exchange/contracts/view',$data);
     }
 
     public function edit($id)
     {
        $data['pagetitle']="edit";
        $data['contract']= (new ContractModel)->getById($id);
        $data['contract']["edit"]=true;

        $data['contract']['contract_name']=  htmlspecialchars($data['contract']['contract_name']);
        $data['contract']['contract_excerpt']=  htmlspecialchars($data['contract']['contract_excerpt']);
        
         $data['contract']['contract_description2']= htmlspecialchars($data['contract']['contract_description']);
            //  $data['contract']['contract_description']= "";// htmlspecialchars($data['contract']['contract_description']);

        // $data['contract']['contract_description2'] = trim(preg_replace('/\s+/', ' ',  $data['contract']['contract_description2'] ));
        $data['contract']['contract_description2'] = str_replace(array("\n", "\r"), '',$data['contract']['contract_description2'] );

        return view('exchange/contracts/edit',$data);
     }


    public function contract_data()
    {
        $id=intval(post('id'));
        $datas['contract']= (new ContractModel)->getById($id);
        
        if  (!$datas['contract']){$data['error']= "error";}else{

            $data['unit_value']=$datas['contract']['unit_value'];
            $data['contract_type']=strtoupper(lang("App.".$datas['contract']['contract_type']));
            $data['contract_name']=$datas['contract']['contract_name'];
            $data['contract_sku']=SKU_gen($datas['contract']['contract_name'],$id,2);
             
        }

        return json_encode($data, true); //view('exchange/contracts/view',$data);     
    }

      


    public function update()
	{ 
        $data['pagetitle']="update";
        $id=post('contract_id');
        if (post('create-smartcontract')=="0"){ $contractnetwork="";}else{$contractnetwork=post('contract-network');}
 
  
    $data = [ 
        'contract_name' => htmlspecialchars(post('contract-title')),
        'contract_description' => htmlspecialchars(post('compose-textarea')),
        'contract_type'  => post('contract_type'), 
        'contract_excerpt'  =>htmlspecialchars(post('contract-excerpt')), 
        'valoration'  => post('contract-valoration'), 
        'unit_value'  => post('contract-und-value'), 
        'total_tokens'  => post('contract-units'),
        'target'  => (post('contract-und-value')*post('contract-units')),
        'starting_date'  => post('contract_start_date_input'),
        'expires'  => post('contract-expires'),
        'ownerID'  => logged('id'), 
        'active'  => '-1',//post('contract-active'),
        'expiration_date'  => post('contract_exp_date_input'),
        'autorenew'  => post('contract-autorenew'),
        'lifetime_days'  => post('contract_duration_input'),
        'is_smart_contract' => post('create-smartcontract'),
        'is_fixed' => post('contract-fixed-funding'),
        'roi'  => post('contract_roi'),
        'network'  => $contractnetwork,
        'timestamp'  => date('Y-m-d H:i:s'),
    ];

    (new ContractModel)->update($id, $data);
    
    return redirect()->to('contracts')->with('notifySuccess', lang('App.update_success'));

    }

 
    public function create()
    {
        $data['pagetitle']="create";
        return view('exchange/contracts/create',$data );
    }


 
    public function save()
	{  
        $data['pagetitle']="save";
                $this->permissionCheck('create_contract ');
                $id = logged('id');


                postAllowed();
               
                // EXPIRATION DATA MUST BE GREATER THAT 
        
                if (post('contract_exp_date_input') < post('contract_duration_input')) {  
                    $datas = ['errors' => array("contract_exp_date_box"=>  lang('App.error_exp_date'))];
                    $data['error']=$datas;
                    return view('exchange/contracts/create', $data );
                }
                if (post('contract_start_date_input') > post('contract_duration_input') OR post('contract_start_date_input') > post('contract_exp_date_input')) {  
                    $datas = ['errors' => array("contract_start_date_box"=>  lang('App.error_contract_start_date'))];
                    $data['error']=$datas;
                    return view('exchange/contracts/create', $data );
                }


                // FORM VALIDATION
                if (post('create-smartcontract')=="0"){ $contractnetwork="";}else{$contractnetwork=post('contract-network');}

  
                $validation_Rules_Contract  = [
                    'contract-units' => 'required|numeric|greater_than[0]',
                    'contract-und-value' => 'required|numeric|greater_than[0]', 
                    'contract_start_date_input' => 'required|numeric', 
                    'contract_roi' => 'required|numeric',
                    'contract-excerpt' => 'required',
                ];

                
                // FORM VALIDATION LOGO IMAGE
                $validation_Rules_Image_logo  = [
                    
                    'contract-logo-image' => [
                        'label' => '',
                        'rules' => 'uploaded[contract-logo-image]'
                            . '|is_image[contract-logo-image]'
                            . '|mime_in[contract-logo-image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                            . '|max_size[contract-logo-image,1550]'
                           // . '|max_dims[contract-logo-image,1024,1024]',
                    ],      
                ];
                // FORM VALIDATION HEADER IMAGE
                $validation_Rules_Image_Header = [
                    'contract-header-image' => [
                        'label' => '',
                        'rules' => 'uploaded[contract-header-image]'
                            . '|is_image[contract-header-image]'
                            . '|mime_in[contract-header-image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                            . '|max_size[contract-header-image,1550]'
                           // . '|max_dims[contract-header-image,1024,1024]',
                    ],
                ];

               // http://phpgurukul.com/form-validation-in-codeigniter/
                   
                
                if (! $this->validate($validation_Rules_Contract)) {

                    $datas = ['errors' => $this->validator->getErrors()];
                    $data['error']=$datas;  
                    
                   // return redirect()->back()->with('notifyError', 'Server Error');
                    
                    return view('exchange/contracts/create', $data );
                   
                 } 
 

            // LOGO 
                
                if (! $this->validate($validation_Rules_Image_logo)) {
                    $datas = ['errors' => $this->validator->getErrors()];
                      $data['error']=$datas;  
                     return view('exchange/contracts/create', $data );

                }else{  
                 $logo_image_validated="1";
                // $img = $this->request->getFile('contract-logo-image');
                 }
                 
                 
                
            // HEADER
        

            if (! $this->validate($validation_Rules_Image_Header)) {
                $datas = ['errors' => $this->validator->getErrors()];
                $data['error']=$datas; 
                return view('exchange/contracts/create', $data );
            }else{  
                $header_image_validated="1";
               // $img = $this->request->getFile('contract-header-image');
            }

            
        // SAVE DATA IF FORM IS VALID AND IMAGES UPLOADED
     
        if ($header_image_validated=="1" AND $logo_image_validated=="1"){
       $visibility= json_encode(post('visibility_by'));
              $contractID = (new ContractModel)->create([
                'contract_name' => htmlspecialchars(post('contract-title')),
                'contract_description' => htmlspecialchars(post('compose-textarea')),
                'contract_type'  => post('contract_type'), 
                'contract_excerpt'  =>htmlspecialchars(post('contract-excerpt')), 
                'valoration'  => post('contract-valoration'), 
                'unit_value'  => post('contract-und-value'), 
                'total_tokens'  => post('contract-units'),
                'target'  => (post('contract-und-value')*post('contract-units')),
                'starting_date'  => post('contract_start_date_input'),
                'expires'  => post('contract-expires'),
                'ownerID'  => logged('id'), 
                'active'  => post('contract-active'),
                'expiration_date'  => post('contract_exp_date_input'),
                'autorenew'  => post('contract-autorenew'),
                'lifetime_days'  => post('contract_duration_input'),
                'is_smart_contract' => post('create-smartcontract'),
                'is_fixed' => post('contract-fixed-funding'),
                'roi'  => post('contract_roi'),
                'network'  => $contractnetwork,
                'visibility' => "1". $visibility,
                'timestamp'  => date('Y-m-d H:i:s'),
            ]);
         
            $img = $this->request->getFile('contract-logo-image');
            if (!empty($_FILES['contract-logo-image']['name'])) {
                $ext = $img->getExtension();
                $upload = $img->move( FCPATH.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'logos', $contractID.'.'.$ext, true );
                if(!$upload){
                    (new ContractModel)->delete($contractID);
                     return redirect()->back()->with('notifyError', 'Server Error Occured while Uploading Image !');
               
                }
                // CONVERT IMAGE
                $image = \Config\Services::image();

                try {
                    $image->withFile( FCPATH.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'logos'.DIRECTORY_SEPARATOR.$contractID.".".$ext)
                        ->fit(100, 100, 'center')
                        ->convert(IMAGETYPE_PNG)
                        ->save( '/opt/bitnami/apache/htdocs/vh/uploads/logos/'.$contractID.'.png');
                } catch (CodeIgniter\Images\Exceptions\ImageException $e) {
                   
                     (new ContractModel)->delete($contractID);
                    return redirect()->back()->with('notifyError', 'Server Error Occured while Uploading Image !'.$e->getMessage());

                }
              ////

             } 

             $img = $this->request->getFile('contract-header-image');
             if (!empty($_FILES['contract-header-image']['name'])) {

                $ext = $img->getExtension();
                $upload = $img->move( FCPATH.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'headers', $contractID.'.'.$ext, true );
                if(!$upload){
                    (new ContractModel)->delete($contractID);
                     return redirect()->back()->with('notifyError', 'Server Error Occured while Uploading Image !');
                }
                   // CONVERT IMAGE
                     $image = \Config\Services::image();

                    try {
                        $image->withFile( FCPATH.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'headers'.DIRECTORY_SEPARATOR.$contractID.".".$ext)
                            ->fit(365, 160, 'center')
                            ->convert(IMAGETYPE_PNG)
                            ->save( '/opt/bitnami/apache/htdocs/vh/uploads/headers/'.$contractID.'.png');
                    } catch (CodeIgniter\Images\Exceptions\ImageException $e) {
                       
                         (new ContractModel)->delete($contractID);
                        return redirect()->back()->with('notifyError', 'Server Error Occured while Uploading Image !'.$e->getMessage());

                    }
                ////
                
            } 
    
        // CREATE VIHOLDER WALLET

        $walletID = (new WalletModel)->create([
            'userID'  => logged('id'), 
            'contractID'  => $contractID, 
            'network'  => "viholder",
            'wallet_currency'  => setting("base_currency"),
            'wallet_balance'  => 0,
        ]);


        // IF IS SMART-CONTRACT: CREATE AND UPDATE WALLETS
        

            if (post('create-smartcontract')==1){  

                $walletID = (new WalletModel)->create([
                    'userID'  => logged('id'), 
                    'contractID'  => $contractID, 
                    'network'  => "ripple",
                ]);

                
                if (post('contract-network')=="ripple"){  
                    $rpc_url =  setting('server_xrp'); //"https://s.altnet.rippletest.net:51234"; 
                    $id = $contractID;  
                    $userID=logged('id'); // owner of the wllaet, userID or contractID
                    $idWallet=$walletID;
                    $command = escapeshellcmd("python3 ./xrp/create_wallet.py $rpc_url $id $userID $idWallet");
                    shell_exec($command);
                }

             }
             
 
             
  
                 model('App\Models\ActivityLogModel')->add("New ".ucfirst(post('contract_type'))." Contract #".$contractID." User: #".logged('id'));
                 return redirect()->to('contracts')->with('notifySuccess', lang('App.created_success'));

	    }
 
    }

 }