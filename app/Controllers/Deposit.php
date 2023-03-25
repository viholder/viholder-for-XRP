<?php
namespace App\Controllers;

use App\Controllers\AdminBaseController;

class Deposit extends AdminBaseController
{
    
    public $title = 'Deposit';
    public $menu = 'deposit';

    public function index()
    {
        
        // die(var_dump($_COOKIE));

        return view('exchange/deposit');
    }

}