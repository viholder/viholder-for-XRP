<?php
namespace App\Controllers;

use App\Controllers\AdminBaseController;

use App\Models\NotificationsModel;

class Notifications extends AdminBaseController
{
    
     

    public function index()
    {
        //$userData = $_SESSION;
        return view('exchange/notifications');
       // return   json_encode($notifications,true);
    }

    public function check_for_new_msg()
    {
        $id=logged('id');
        $status="1"; 
        $notifications = (new NotificationsModel)->list_notifications($id,$status);

        return   json_encode($notifications,true);
    }

    public function list()
    {
        //$userData = $_SESSION;
        $id=logged('id');
        $data['notify']= (new NotificationsModel)->list_notifications($id);

         return view('exchange/notifications/list', $data);
       // return   json_encode($notifications,true);
    }

   
    public function view($id)
    {
        

       $data['message']= (new NotificationsModel)->getById($id);

         
       if ($data['message']){
           $userdata = model('App\Models\UserModel')->getById($data['message']['msg_from']);
        if ($userdata ){  
          $data['message']['img_type'] = $userdata->img_type;
          $data['message']['name'] = $userdata->name;
          
        }

      
        $data['message']['since'] = get_time_ago(strtotime($data['message']['timestamp']));

        

            if ( $data['message']['msg_to'] <0) { 
            
              }else{  

                $datas =  array('active' => 0); 
                (new NotificationsModel)->update($id, $datas);
            }
       }
      // return   json_encode($data,true);
      return view('exchange/notifications/view',$data);
       
    }



   


    public function delete()
    {
        
        postAllowed();
        $id=  post('id');

        
    /// MARK AS SEEN - GROUP MSG
            $array = array('id'=> $id);
            $datas['notify']=  model('App\Models\NotificationsModel')->where($array)->first();
            
           if ($datas['notify']['msg_to']<0){  
        
                $userid[0]=logged('id');

            if  (!$datas['notify']['seen']){ 

                    $datass =  array('seen' =>  json_encode($userid)); 

                    model('App\Models\NotificationsModel')->update($id, $datass  );

                    }else{  

                    $tempArray =  json_decode($datas['notify']['seen'],true);         
                
                    array_push($tempArray, $userid[0] );

                    $uniquevale= array_unique($tempArray);

                    $data = [ 
                        'seen' =>  json_encode($uniquevale),
                    ];

                    $seenby = model('App\Models\NotificationsModel')->update($id, $data );
                    return json_encode($data, true);
            }
            
            
        } else {

        /// DELETE - DIRECT MSG
            (new NotificationsModel)->delete($id);
            $data['done']=1;
            return   json_encode($data,true);

        }
    
    }   
}
