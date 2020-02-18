<?php

class Fitbit_model extends CI_Model {

    function submitActivities($data){
        $outArray = array('response' => 'Success','errors' => array(),'entries' => 0);
        
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
            $ID = $this->db->insert_id();
            if($ID > 0){
                $outArray['entries']++;
            }else{
                array_push($outArray['errors'],$this->db->error());
            }
        }
        return $outArray;
    }
    
    function getActivities($dateStart,$dateEnd,$activity,$user){
        $this->db->select("value");
        $this->db->select("DATE_FORMAT(dateTime,'%Y-%m-%d') as dateTime");
        $this->db->where('activity',$activity);
        $this->db->where('fitbit_user',$user);
        $this->db->where('dateTime BETWEEN "' . $dateStart . '" AND "' . $dateEnd . '"');
        $this->db->order_by('dateTime', 'ASC');
        $query = $this->db->get('fitbit_activities');
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
