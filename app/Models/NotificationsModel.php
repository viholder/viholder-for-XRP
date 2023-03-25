<?php

namespace App\Models;

use App\Models\BaseModel;

 
class NotificationsModel extends BaseModel
{
    protected $table      = 'notifications';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $allowedFields = ['msg_from', 'msg_to', 'msg_subject',  'msg_txt', 'msg_view_link', 'active', 'timestamp' , 'seen'];
 

/////////////////////////////////////////////////////////

    function list_notifications($id,$status="all"){  
      
      if ($status=="all"){       
          $status="(active='1' OR active='0')";
          $orderby="DESC";
      }else{ 
          $status="(active='1')";
          $orderby="ASC";
      }

      $sendto="msg_to='-1' AND  $status "; // TO ALL USERS

      if (is_user_category("investor")){  $sendto.="OR msg_to='-4' AND $status"; } 
      if (is_user_category("contract_owner")){  $sendto.="OR msg_to='-5' AND  $status"; }
      if (is_user_category("no_active")){  $sendto.="OR msg_to='-2' AND $status"; }
      if (is_user_category("staff")){  $sendto.="OR msg_to='-6'AND  $status"; }

    
    $array = "msg_to='$id' AND $status OR $sendto ";
    $notifications['notify'] = $this->where($array)->orderby('id',$orderby)->findAll();

      if ($notifications){
          $i=0;
          $noti=array();
              foreach ( $notifications['notify'] as $row ){

                    $userlog=logged('id');  
                    $tempArray =  json_decode($row['seen'],true);
        

                   
    
                    
                  if (is_array($tempArray) &&  in_array($userlog , $tempArray)){  $r="si"; }else{ $r="no";}

                  if ($r=="no" ){ 

                        $noti['notify'][$i]['id'] = $row['id'];
                        $noti['notify'][$i]['msg_from'] = $row['msg_from'];
                        $noti['notify'][$i]['msg_txt']  =  $row['msg_txt'];
                        $noti['notify'][$i]['msg_subject']  =  $row['msg_subject'];
                        $noti['notify'][$i]['timestamp']  = $row['timestamp'];
                        $noti['notify'][$i]['active']  = $row['active'];
                        $noti['notify'][$i]['msg_to']  = $row['msg_to'];


                        $userdata = model('App\Models\UserModel')->getById($notifications['notify'][$i]['msg_from']);

                        if ($userdata ){  
                          
                          $noti['notify'][$i]['img_type'] =  $userdata->img_type;
                          $noti['notify'][$i]['name'] =   $userdata->name;
                          
                        }

                        $noti['notify'][$i]['since'] = get_time_ago(strtotime($noti['notify'][$i]['timestamp']));
                        $i++;
                  }  ;
            
              } 

              if ( $i >0){  
                  $noti['notify'][0]['see-all-messages']= lang('App.see-all-messages');
              } 
              
              
      }
      
      return  $noti;

}


///////////////////

}