<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    const BASE_URL = 'http://www.chrismadeen.com/';
    private $BASE = 'https://www.chrismadeen.com/';
    private $FITBIT_ID = '22BJWV';
    
    public function index()
    {
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->model('video_model');
        $data['videos'] = $this->video_model->getVideos();
        $data['base'] = 'http://www.chrismadeen.com/';
        $this->checkCookies('cgm_main');
        $this->load->view('main',$this->data);
    }

    public function beta(){
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->model('video_model');
        $data['videos'] = $this->video_model->getVideos();
        $data['base'] = 'http://www.chrismadeen.com/';
        $this->checkCookies('cgm_main');        
        $this->load->view('main_beta',$this->data);
    }

    // TO DO - Unfinished relational database example.  Needs more data entry and front end work.
    function ar(){
        $this->load->model('arrested_development/character_model');
        $this->load->model('arrested_development/topic_model');
        $this->load->model('arrested_development/facts_model');
        $this->load->model('arrested_development/theory_model');
        $this->load->helper('cookie');

        $this->checkCookies('cgm_ar');

        //TO-DO Move data-types to enumerated array 
        $this->data['characters'] = $characters = $this->character_model->getCharacters();
        $this->data['characterColumns'] = $characterColumns = $this->character_model->getCharacterColumns();
        $char = array('data-type' => 4,'columns'=> $characterColumns, 'entries' => $characters);

        $this->data['facts'] = $facts = $this->facts_model->getFacts();
        $this->data['factsColumns'] = $factsColumns = $this->facts_model->getFactsColumns();
        $fact = array('data-type' => 2,'columns'=> $factsColumns, 'entries'=> $facts);

        $this->data['topics'] = $topics = $this->topic_model->getTopics();
        $this->data['topicColumns'] = $topicColumns = $this->topic_model->getTopicColumns();
        $topic = array('data-type' => 3,'columns'=> $topicColumns, 'entries' => $topics);

        $this->data['theories'] = $theories = $this->theory_model->getTheories();
        $this->data['theoriesColumns'] = $theoriesColumns = $this->theory_model->getTheoryColumns();
        $theor = array('data-type' => 1,'columns'=> $theoriesColumns, 'entries' => $theories);

        $this->data['baseURL'] = $this->BASE;

        $this->data['entry_types'] = array('character' => $char,'topic' => $topic,'facts'=> $fact,'theories'=> $theor);

        $this->load->view('ar/ar',$this->data);
    }

    public function fitbit(){
        $this->load->helper('url');
        $this->load->helper('cookie');

        // My fitbit ID, for initialized
        $this->data['fitbit_id'] = $this->FITBIT_ID;

        $this->checkCookies('cgm_fitbit');

        $this->load->view('fitbit',$this->data);
    }

    public function fitbit_login(){
        $this->load->view('fitbit_auth');
    }

    public function phaser(){
        $this->load->view('root');
    }

    public function talk(){
        $this->load->model('talk/Vocabulary_model');

        $this->data['base'] = $this->BASE;
        $this->data['vocabulary'] = $this->Vocabulary_model->getVocabularyItemsAndGroups();

        $this->load->view('talk',$this->data);
    }

    public function talk_intake(){
        $this->load->helper(array('form', 'url'));
        $this->data['base'] = $this->BASE;

        $this->load->helper('cookie');

        $this->checkCookies('cgm_talk');

        $this->load->view('talk_intake',$this->data);
    }

    // In Progress ****
    public function talk_submit(){
        $this->output->enable_profiler(TRUE);
        $config['upload_path']= "./img/talking/";
        $config['allowed_types']='gif|jpg|png';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload',$config);
        if($this->upload->do_upload("imageToUpload")){
            echo 'hi';
            $data = array('upload_data' => $this->upload->data());

            $title= $this->input->post('description');
            $image= $data['upload_data']['imageToUpload']; 

            //$result= $this->upload_model->save_upload($title,$image);
            echo json_decode($result);
        }else{
            echo $this->upload->display_errors();
        }
    }
     
    
    function do_upload(){
        $config['upload_path']="./img";
        $config['allowed_types']='gif|jpg|png';
        $config['encrypt_name'] = TRUE;
         
        $this->load->library('upload',$config);
        if($this->upload->do_upload("imageToUpload")){
            $data = array('upload_data' => $this->upload->data());
            echo json_decode($data);
        }
 
     }
     
     // TO DO - add random numbers
     function gen_random(){
         $random = "";
        for($i = 0;$i < 10;$i++){
            $upperOrLower = rand(0,1);
            if($upperOrLower){
                $rand = chr(rand(65,90));
            }else{
                $rand = chr(rand(97,122));
            }
            $random .= $rand;
        }
        return $random;
     }
     
     function checkCookies($name){
        if(!get_cookie($name)){
            $cookie= array(
                'name'   => $name,
                'value'  => $this->gen_random(),
                'expire' => '3600',
            );
            $this->input->set_cookie($cookie);
            $this->data['main_cook'] = $cookie;
        }else{
            $cookie= array(
                'value'  => get_cookie($name),
            );
            $this->data['main_cook'] = $cookie;
        }
     }
}
