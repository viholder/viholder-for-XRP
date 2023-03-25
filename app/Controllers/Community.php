<?php
namespace App\Controllers;

use App\Controllers\AdminBaseController;
//use App\Models\CommunityModel;
use App\Models\UserModel;

class Community extends AdminBaseController
{
    
    public $title = 'Community';
    public $menu = 'community';

    public function index()
    {
     // $this->permissionCheck('users_list');

      $array = array('status' => '1');

      $users = (new UserModel)->where($array)->findall();
     // $users = (new UserModel)->findAll();
 
      return view('exchange/community', compact('users'));

    }

}