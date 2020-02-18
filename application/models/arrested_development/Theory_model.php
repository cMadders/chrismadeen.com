<?php

class Theory_model extends CI_Model {

    function insertRecord($data){
        $this->db->insert('ar_theories',$data);
        $outArray = array();
        if($this->db->insert_id()){
            $outArray['response'] = 'Theory Successfully Added: ' . $data->topic_name;
            $outArray['error'] = 0;
        }else{
            $outArray['response'] = 'Theory to add Character: ' . $data->topic_name;
            $outArray['error'] = 1;            
        }
        return $outArray;
    }
    
    function getTheories(){
        $sql = 'SELECT * FROM ar_theories ORDER BY text ASC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function getTheoryColumns(){
        $strSQL =   "SELECT `COLUMN_NAME` 
                    FROM 
                    `INFORMATION_SCHEMA`.`COLUMNS` 
                    WHERE `TABLE_SCHEMA`='happyrobot' 
                    AND `TABLE_NAME`='ar_theories';";
         $query = $this->db->query($strSQL);
         return $query->result();
    }
}
