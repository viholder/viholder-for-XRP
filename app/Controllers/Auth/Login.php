<?php

namespace App\Controllers\Auth;

use App\Controllers\AdminBaseController;

use App\Models\UserModel;

class Login extends AdminBaseController
{

    public function index()
    {
         
        return view('admin/auth/login');
    }

    public function cover()
    {
         
        return view('admin/auth/cover');
    }

    public function terms($code=0)
    {
        $data["id"]=$code;
        setCookie('current_lang', $code, time()+86400*30);
      // return  redirect()->to('admin/auth/login/terms')->setCookie('current_lang', $code, time()+86400*30);
      
       return view('admin/auth/terms' , $data);
    }

    public function es()
    {
        $code="es";
        setCookie('current_lang', $code, time()+86400*30);
        return  redirect()->to('/auth/login')->setCookie('current_lang', $code, time()+86400*30);
      
    }

    public function en()
    {
        $code="en";
        setCookie('current_lang', $code, time()+86400*30);
        return  redirect()->to('/auth/login')->setCookie('current_lang', $code, time()+86400*30);
      
    }


    public function check()
    {

        // validate
        if (! $this->validate([
            'username' => 'required|usernameValidation[username]',
            'password' => 'required',
            'g-recaptcha-response' => 'validateRecaptcha[g-recaptcha-response]',
        ],[
            'username' => [
                'usernameValidation' => 'User does\'nt exists'
            ],
            'g-recaptcha-response' => [
                'required' => 'Recaptcha is required',
                'validateRecaptcha' => 'Google Recaptcha not valid !'
            ]
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        $user = (new UserModel)->where('username', post('username'))->orWhere('email', post('username'))->first();
        
        // verify password
        if( $user->password != hash( "sha256", post('password') ) ){
            return redirect()->back()->withInput()->with('errors', [
                'password' => 'Invalid Password'
            ]);
        }
        
        // set session
        $time = time();

		// encypting userid and password with current time $time
		$login_token = sha1($user->id.$user->password.$time);

        $remember = post('remember_me');

		if(empty($remember)){
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
		}else{

			$data = [
				'id' => $user->id,
				'time' => time(),
			];
			$expiry = strtotime('+7 days');
/*
            // SMS NOTIFY
            $sms_data = ['phone' => setting('sms_phone_to'), 'text' => 'Logged in: '.$user->name]; 
            sendSMS($sms_data);
*/
$datehoy=date('Y-m-d H:i:s');
(new UserModel)->update($user->id, ['last_login' => $datehoy]);
            // redirect
            return redirect()->to('dashboard')
                    ->setCookie(
                        'login', true, $expiry)
                    ->setCookie(
                        'logged', json_encode($data), $expiry,
                    )->setCookie(
                        'login_token', $login_token, $expiry
                    )->with('notifySuccess', "Welcome ".$user->name);

                    
		}
 /*
         // SMS NOTIFY
         $sms_data = ['phone' => setting('sms_phone_to'), 'text' => 'Logged in: '.$user->name]; 
         sendSMS($sms_data);
*/
$datehoy=date('Y-m-d H:i:s');
(new UserModel)->update($user->id, ['last_login' => $datehoy]);
        // redirect
         
        return redirect()->to('dashboard')->with('notifySuccess', $datehoy."Welcome ".$user->name);
    }
}
