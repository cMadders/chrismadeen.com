<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fitbit extends CI_Controller {
    const BASE_URL = 'http://www.chrismadeen.com/';
    
    public function index()
    {
        $this->load->view('test');
    }
    
    public function submitActivities(){
        $this->load->model('fitbit/fitbit_model');
        $data = $this->input->post('data');
        $data = json_decode(stripslashes($data));
        $result = $this->fitbit_model->submitActivities($data);
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function getActivities(){
        $this->load->model('fitbit/fitbit_model');
        $data = $this->input->post('data');
        $data = json_decode(stripslashes($data));
        $result = $this->fitbit_model->getActivities($data->dateStart,$data->dateEnd,$data->activity,$data->user);
        $result = array('activities-' . $data->activity => $result);
        header('Content-Type: application/json');
        echo json_encode($result);        
    }
    
}
