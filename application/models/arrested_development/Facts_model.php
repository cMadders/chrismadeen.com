<?php

class Facts_model extends CI_Model {
    
    function insertRecord($data){
        $this->db->insert('ar_facts',$data);
        $outArray = array();
        $ID = $this->db->insert_id();
        if(is_int($ID)){
            $this->db->where('facts_ID', $ID);
            $query = $this->db->get('ar_facts');
            $outArray['record'] = $query->row();
            $outArray['response'] = 'Fact Successfully Added: ' . $data->text;
            $outArray['error'] = 0;
        }else{
            $outArray['response'] = 'Unable to add Fact: ' . $data->text;
            $outArray['error'] = 1;            
        }
        return $outArray;
    
    }
    function getFacts(){
        $sql = 'SELECT * FROM ar_facts';
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function getFactsColumns(){
        $strSQL =   "SELECT `COLUMN_NAME` 
                    FROM 
                    `INFORMATION_SCHEMA`.`COLUMNS` 
                    WHERE `TABLE_SCHEMA`='happyrobot' 
                    AND `TABLE_NAME`='ar_facts';";
         $query = $this->db->query($strSQL);
         return $query->result();
    }
}
