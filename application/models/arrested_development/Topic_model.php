<?php

class Topic_model extends CI_Model {

    function insertRecord($data){
        $this->db->insert('ar_topics',$data);
        $outArray = array();
        $ID = $this->db->insert_id();
        if(is_int($ID)){
            $this->db->where('topics_ID', $ID);
            $query = $this->db->get('ar_topics');
            $outArray['record'] = $query->row();
            $outArray['response'] = 'Topic Successfully Added: ' . $data->text;
            $outArray['error'] = 0;
        }else{
            $outArray['response'] = 'Unable to add topic: ' . $data->text;
            $outArray['error'] = 1;            
        }
        return $outArray;
    }
    
    function getTopics(){
        $sql = 'SELECT * FROM ar_topics ORDER BY text ASC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function getTopicColumns(){
        $strSQL =   "SELECT `COLUMN_NAME` 
                    FROM 
                    `INFORMATION_SCHEMA`.`COLUMNS` 
                    WHERE `TABLE_SCHEMA`='happyrobot' 
                    AND `TABLE_NAME`='ar_topics';";
         $query = $this->db->query($strSQL);
         return $query->result();
    }
}
