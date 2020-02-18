<?php

class Character_model extends CI_Model {
    
    function insertRecord($data){
        $this->db->insert('ar_characters',$data);
        $outArray = array();
        if($this->db->insert_id()){
            $outArray['response'] = 'Character Successfully Added: ' . $data->character_name;
            $outArray['error'] = 0;
        }else{
            $outArray['response'] = 'Unable to add Character: ' . $data->character_name;
            $outArray['error'] = 1;            
        }
        return $outArray;
    }
    
    function getCharacters(){
        $this->db->order_by('ar_characters.text','asc');
        $query = $this->db->get('ar_characters');
        $this->db->join('ar_character_attribtues','ar_characters.character_ID = ar_character_attributes.character_id');
        return $query->result();
    }
    
    function getCharacterColumns(){
        $strSQL =   "SELECT `COLUMN_NAME` 
                    FROM 
                    `INFORMATION_SCHEMA`.`COLUMNS` 
                    WHERE `TABLE_SCHEMA`='happyrobot' 
                    AND `TABLE_NAME`='ar_characters';";
         $query = $this->db->query($strSQL);
         return $query->result();
    }
}
