<?php
namespace App\Controllers;

 
use App\Controllers\AdminBaseController;
//use App\Models\BankModel;
 
 

class Banking extends AdminBaseController
{

    public $title = 'Banking';
    public $menu = 'banking';

    public function index()
    {
        /*
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }
   */
       return view('exchange/banking' );

    }


}