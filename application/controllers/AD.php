<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AD extends CI_Controller {
    
    function insertRecord(){
        $data = $this->input->post('data');
        $data = json_decode(stripslashes($data));
        $modelName = $data->type . '_model';
        $this->load->model('arrested_development/' . $modelName);
        $result = $this->$modelName->insertRecord($data->obj);
        echo json_encode($result);
    }
    
    function insertRelations(){
        $this->load->model('arrested_development/relations_model');
        $data = $this->input->post('data');
        $data = json_decode(stripslashes($data));
        $result = $this->relations_model->insertRelations($data->relations);
        echo json_encode($result);
    }
    
    function getTopics(){
        $this->load->model('arrested_development/topic_model');
        $data = $this->topic_model->getTopics();
        echo json_encode($data);
    }
    
    function getCharacters(){
        $this->load->model('arrested_development/character_model');
        $data = $this->character_model->getCharacters();
        echo json_encode($data);
    }
    
    function getFilteredItems(){
        $this->load->model('arrested_development/relations_model');
        $data = json_decode(stripslashes($this->input->post('data')));
        $result = $this->relations_model->getFilteredItems($data);
        echo json_encode($result);   
    }
    
    function getAllTheThings(){
        $this->load->model('arrested_development/topic_model');
        $this->load->model('arrested_development/character_model');
        $this->load->model('arrested_development/facts_model');
        $this->load->model('arrested_development/theory_model');
        $out = array();
        $out['facts'] = $facts = $this->facts_model->getFacts();
        $out['theories'] = $theories = $this->theory_model->getTheories();
        $out['characters'] = $characters = $this->character_model->getCharacters();
        $out['topics'] = $topics = $this->topic_model->getTopics();
        echo json_encode($out);
    }
    
}