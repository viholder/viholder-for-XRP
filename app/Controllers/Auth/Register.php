<?php

namespace App\Controllers\Auth;

use App\Controllers\AdminBaseController;

use App\Models\UserModel;
use App\Models\WalletModel;
 

class Register extends AdminBaseController
{

    public function index()
    {
          return view('admin/auth/register');
    }
    
    public function en()
    {
     
        $code="en";
        setCookie('current_lang', $code, time()+86400*30);
        return  redirect()->to('/auth/register')->setCookie('current_lang', $code, time()+86400*30);

    }

    public function es()
    {
        $code="es";
        setCookie('current_lang', $code, time()+86400*30);
        return  redirect()->to('/auth/register')->setCookie('current_lang', $code, time()+86400*30);

    }

     

    public function save()
	{
     
       // $this->permissionCheck('users_add');
		// postAllowed();
        $exists = count((new UserModel)->getByWhere(['email' => post('email')]));

        if ( $exists ){
            $data['error']= "error" ;
            $data['msg']= "user_already_exists" ;
            return json_encode($data, true);
        }

        $exists = count((new UserModel)->getByWhere(['username' => post('username')]));

        if ( $exists ){
            $data['error']= "error" ;
            $data['msg']= "user_already_exists" ;
            return json_encode($data, true);
        }


		$id = (new UserModel)->create([
			'role' => "4",
			'name' => post('name'),
			'username' => post('username'),
			'email' => post('email'),
			'phone' => "",//post('phone'),
			'address' => "",//post('address'),
			'status' => "1",
			'password' => hash( "sha256", post('password') ),
            'last_login'  => date('Y-m-d H:i:s'),
		]);

        // CREATE VIHOLDER WALLET

        $walletID = (new WalletModel)->create([
            'userID'  => $id, 
            'contractID'  => '0', 
            'network'  => "viholder",
            'wallet_currency'  => setting("base_currency"),
            'wallet_balance'  => 0,
        ]);

 
        // CREATE XRP  USER WALLET
 
        $walletID = (new WalletModel)->create([
            'userID'  => $id, 
            'contractID'  => '319', 
            'network'  => "XRP",
            'wallet_currency'  => "XRP",
            'wallet_balance'  => 0,
        ]);

      
          $rpc_url =  setting('server_xrp'); //"https://s.altnet.rippletest.net:51234"; 
          $contid = "0";  
          $userID=$id; // owner of the wllaet, userID or contractID
          $idWallet=$walletID;
          $command = escapeshellcmd("python3 ./crypto/xrp/create_wallet.py $rpc_url $contid $userID $idWallet");
          shell_exec($command);
        
  
 
          // CREATE ETH  USER WALLET
  
        $walletID = (new WalletModel)->create([
            'userID'  => $id, 
            'contractID'  => '320', 
            'network'  => "ETH",
            'wallet_currency'  => "ETH",
            'wallet_balance'  => 0,
        ]);
   

        /*
       
          $rpc_url =    setting('server_xrp');
          $contid = "0";  
          $userID=$id; // owner of the wllaet, userID or contractID
          $idWallet=$walletID;
          $command = escapeshellcmd("python3 ./crypto/ethereum/eth_wallet.py $rpc_url $contid $userID $idWallet");
         
          shell_exec($command);
        
        */
         

		if (!empty($_FILES['image']['name'])) {
			$img = $this->request->getFile('image');
			$ext = $img->getExtension();
			$upload = $img->move( FCPATH.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'users', $id.'.'.$ext, true );
			$data['img_type'] = $ext;
			if(!$upload){
				copy(FCPATH.'uploads/users/default.png', 'uploads/users/'.$id.'.png');
				$data['img_type'] = "png";
			}
			// CONVERT IMAGE
			$image = \Config\Services::image();

			try {
				$image->withFile( FCPATH.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'users'.DIRECTORY_SEPARATOR. $id.'.'.$ext, true )
					->fit(100, 100, 'center')
					->save( '/opt/bitnami/apache/htdocs/vh/uploads/users/'.$id.'.'.$ext);
			} catch (CodeIgniter\Images\Exceptions\ImageException $e) {
				
				//return redirect()->back()->with('notifyError', 'Server Error Occured while Uploading Image !');
                $data['error']= "error" ;
                return json_encode($data, true);
			}

			// END CONVERTING IMAGE

			(new UserModel)->update($id, ['img_type' => $ext]);
		}else{
		 	copy(FCPATH.'uploads/users/default.png', 'uploads/users/'.$id.'.png');

		}

       

	    model('App\Models\ActivityLogModel')->add('New User $'.$id.' username:'.post('username'), $id); 
	    // redirect()->to('login')->with('notifySuccess', 'New User Created Successfully');
       
         $data['done']= "1" ;
         return json_encode($data, true);
        
	}


    public function check()
    {

        
        helper('cookie');
    

        $user = (new UserModel)->where('username', post('username'))->orWhere('email', post('email'))->first();
        
        
           
       

        // verify password
        if( $user->password != hash( "sha256", post('password') ) ){
            $data['error']= "error" ;
            $data['msg']= "invalid_password" ;
            return json_encode($data, true);
        }

        
        
        // set session
        $time = time();

		// encypting userid and password with current time $time
		$login_token = sha1($user->id.$user->password.$time);

        
       


    //    $remember = true;

	//	if(empty($remember)){
			$array = [
				'login' => true,
				// saving encrypted userid and password as token in session
				'login_token' => $login_token,
				'logged' => [
					'id' => $user->id,
					'time' => $time,
				]
			];
			$this->session->set( $array );
	//	}else{


    /*
			$data = [
				'id' => $user->id,
				'time' => time(),
			];
			$expiry = strtotime('+7 days');

            // redirect
           setCookie('login', true, $expiry);
           setCookie('logged', json_encode($data), $expiry);
           setCookie('login_token', $login_token, $expiry);

            // redirect
    
           $data['done']= "1" ;
           return json_encode($data, true);
		}
    */   

    
        // redirect
        $data['done']= "1" ;
        return json_encode($data, true);
    }
	

}
