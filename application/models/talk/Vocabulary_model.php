<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Vocabulary_model extends CI_Model {
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getVocabularyItems(){
        $sql = 'SELECT * FROM talk_vocabulary';
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function getVocabularyItemsAndGroups(){
        $sql = 'SELECT * FROM talk_vocabulary, talk_group WHERE'
                . ' talk_vocabulary.primary_group = talk_group.group_ID';
        $query = $this->db->query($sql);
        return $query->result();
    }
}

?>