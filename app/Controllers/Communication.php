<?php

namespace App\Controllers;

use App\Controllers\AdminBaseController;

use Config\Services;
use App\Models\NotificationsModel;
use App\Models\UserModel;
use App\Models\PortfolioModel;


class Communication extends AdminBaseController
{

    public $title = 'Communication';
    public $menu = 'communication';
 
    protected $helpers = ['form', 'viholder_helper'];

    public function index()
    {
        
        $rules = [
            'sendto' => 'required',
            'msg_subject' => 'required|min_length[5]',
        ];

        if (strtolower($this->request->getMethod()) !== 'post') {
            return view('admin/communication/communication', [
                'validation' => Services::validation(),
            ]);
        }

        if (! $this->validate($rules)) {
            return view('admin/communication/communication', [
                'validation' => $this->validator,
            ]);
        }
 
           // $l=0;
        foreach (post('sendto') as $selectedOption){
          

            if ($selectedOption=="all_users" ){
                $selectedOption="-1";
            }
            if ($selectedOption=="users" ){
                $selectedOption="-2";
            }
            if ($selectedOption=="investors" ){
                $selectedOption="-4";
            }
            if ($selectedOption=="contract_owners" ){
                $selectedOption="-5";
            }
            if ($selectedOption=="staff" ){
                $selectedOption="-6";
            }

            
 
        $message = (new NotificationsModel)->create([
            'msg_txt' => htmlspecialchars(post('msg_to_send')),
            'msg_to' =>  $selectedOption,
            'msg_subject' => htmlspecialchars(post('msg_subject')),
            'msg_from' => logged('id'),
            'active' => '1',
            'timestamp'  => date('Y-m-d H:i:s'),

        ]);

        

        }
 
        return view('admin/communication/communication', [
            'validation' => Services::validation(),
            
        ]);

    }

     
    public function send_msg()
    {
       if (strlen(post('msg_subject'))<5){
        $result['error']=1;
        $result['msg']=lang('App.message_to_short');
        return json_encode($result);
       }
        $message = (new NotificationsModel)->create([
            'msg_txt' => htmlspecialchars(post('msg_to_send')),
            'msg_to' =>  post('touserID'),
            'msg_from' => logged('id'),
            'msg_subject' => htmlspecialchars(post('msg_subject')),
            'active' => '1',
            'timestamp'  => date('Y-m-d H:i:s'),
        ]);
        $result['done']=1;
        return json_encode($result);
    }

    public function get_users()
    {

    $users = (new UserModel)->findAll();
    $i=0;
    foreach ( $users as $row){
        $userdata[$i]['userID'] =  $row->id;
        $userdata[$i]['username'] =  $row->username;
        $userdata[$i]['name'] =  $row->name;
        $i++;
    }

    return json_encode($userdata);

    }




    public function activity()
    {

    $activity = (new NotificationsModel)->findAll();
    $i=0;
    foreach ( $activity as $row){

        $userdata = model('App\Models\UserModel')->getById($row['msg_from']);
           
        if ($userdata ){  
            $activitydata[$i]['img_type'] = $userdata->img_type;
            $activitydata[$i]['name'] = $userdata->name;
              
          }
           
          if (strlen($row['msg_txt']>=180)){ $addots="..."; }else{ $addots=""; };

          $activitydata[$i]['msg_txt']= substr($row['msg_txt'],0,180).$addots;
             
          $activitydata[$i]['since'] = get_time_ago(strtotime($row['timestamp']));



        $activitydata[$i]['id'] =  $row['id'];
        $activitydata[$i]['msg_from'] =  $row['msg_from'];
        $activitydata[$i]['msg_to'] =  $row['msg_to'];
        $activitydata[$i]['msg_subject'] =  $row['msg_subject'];

        $i++;
    }

    return json_encode($activitydata);

    }



     


    

}