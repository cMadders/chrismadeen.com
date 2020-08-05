<?php

class Fitbit_model extends CI_Model {
    private $DUPLICATE_ENTRY = 1062;
    
    function submitActivities($data){
        $outArray = array('response' => 'Success','errors' => array(),'entries' => 0,'updates' => 0, 'duplicates' => 0);
        
        if(count($data) <= 0){
            $outArray['response'] = 'No entries submitted';
            $outArray['error'] = 1;
        }
        
        $user = $this->getLocalUser($data->user);

        $outArray['user'] = $user;
        foreach($data->activities->combined as $item){
            $arr = array('dateTime' => $item->dateTime,
                'fitbit_user' => $user->local_id,
                'activity' => $data->type,
                'value' => $item->value);
            
            $this->db->insert('fitbit_activities',$arr);
            
            $result = $this->checkActivityEntry($arr);
            $outArray[$result]++;

            //array_push($outArray['errors'],$result);
        }
        return $outArray;
    }
    
    function checkActivityEntry($arr){
        $ID = $this->db->insert_id();
        $result = '';
        
        if($ID > 0){
            $result = 'entries';
        }else{
            $error = $this->db->error();
            if($error['code'] == $this->DUPLICATE_ENTRY){
                $updates = $this->updateActivityEntry($arr);
            }
            if($updates < 0){
                $result = 'duplicates';
            }else{
                $result = 'updates';
            }
        }
        return $result;
    }
    
    function updateActivityEntry($arr){
        $this->db->where('fitbit_user',$arr['fitbit_user']);
        $this->db->where('activity',$arr['activity']);
        $this->db->where('dateTime',$arr['dateTime']);
        $this->db->update('fitbit_activities',$arr);
        return $this->db->affected_rows();
    }
    
    function getActivities($dateStart,$dateEnd,$activity,$user){
        $this->db->select("value");
        $this->db->select("DATE_FORMAT(dateTime,'%Y-%m-%d') as dateTime");
        $this->db->where('activity',$activity);
        $this->db->where('fitbit_user',$user);
        $this->db->where('dateTime BETWEEN "' . $dateStart . '" AND "' . $dateEnd . '"');
        $this->db->order_by('dateTime', 'ASC');
        $query = $this->db->get('fitbit_activities');
        $result = $query->result();
        if(count($result) == 0){
            $result = getMostRecentActivities($activity, $user);
        }
        return $result;
    }
    
    function getMostRecentActivities($activity,$user){
        $this->db->select("value");
        $this->db->select("DATE_FORMAT(dateTime,'%Y-%m-%d') as dateTime");
        $this->db->where('activity',$activity);
        $this->db->where('fitbit_user',$user);
        $this->db->order_by('dateTime', 'ASC');
        $query = $this->db->get('fitbit_activities',7);
        return $query->result();
    }

    function getLocalUser($userID){
        $this->db->where('user_id',$userID);
        $query = $this->db->get('fitbit_users');
        $user = $query->row();
        
        if(!isset($user->local_id)){
            $localUserID = $this->insertLocalUser($userID);
            $user = $this->getLocalUserByLocalID($localUserID);
        }else{
            $localUserID = $user->local_id;
        }
        return $user;
    }
    
    function getLocalUserByLocalID($userID){
        $this->db->where('local_id',$userID);
        $query = $this->db->get('fitbit_users');
        return $query->row();        
    }
    
    function insertLocalUser($userID){
        $arr = array('user_id' => $userID);
        $this->db->insert('fitbit_users',$arr);
        return $this->db->insert_id();
    }
    
}
