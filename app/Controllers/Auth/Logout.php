<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

use App\Models\User;

class Logout extends BaseController
{
    public function index()
    {

  
		helper('cookie');

		 
        // Deleting Sessions
		$this->session->remove('login');
		$this->session->remove('logged');
		// Deleting Cookie
		delete_cookie('login');
		delete_cookie('logged');
		delete_cookie('login_token');
		$this->session->stop();
		$this->session->destroy();
		 
       // return redirect()->to('auth/login')->with('notify_success', 'Logged out ');
	     
		//return "<a href='http://34.94.38.158/vh/market'> ok </a>";
		return view('admin/auth/login');
    }

	public function logout()
    {
 echo "logedout";
	}

}
