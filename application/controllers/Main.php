<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    const BASE_URL = 'http://www.chrismadeen.com/';
    
    public function index()
	{
            //require_once 'Requests/library/Requests.php';
            $this->load->helper('url');
            $this->load->helper('cookie');
            $this->load->model('video_model');
            $data['videos'] = $this->video_model->getVideos();
            $data['base'] = 'http://www.chrismadeen.com/';
            if(!get_cookie('cgm_main')){
                $cookie= array(
                    'name'   => 'cgm_main',
                    'value'  => $this->gen_random(),
                    'expire' => '3600',
                );
                $this->input->set_cookie($cookie);
                $this->data['main_cook'] = $cookie;
                $this->load->view('main',$this->data);
            }else{
                $cookie= array(
                    'value'  => get_cookie('cgm_main'),
                );
                $this->data['main_cook'] = $cookie;
                $this->load->view('main',$this->data);
            }
	}
        
        public function beta(){
            //require_once 'Requests/library/Requests.php';
            $this->load->helper('url');
            $this->load->helper('cookie');
            $this->load->model('video_model');
            $data['videos'] = $this->video_model->getVideos();
            $data['base'] = 'http://www.chrismadeen.com/';
            if(!get_cookie('cgm_main')){
                $cookie= array(
                    'name'   => 'cgm_main',
                    'value'  => $this->gen_random(),
                    'expire' => '3600',
                );
                $this->input->set_cookie($cookie);
                $this->data['main_cook'] = $cookie;
                $this->load->view('main_beta',$this->data);
            }else{
                $cookie= array(
                    'value'  => get_cookie('cgm_main'),
                );
                $this->data['main_cook'] = $cookie;
                $this->load->view('main_beta',$this->data);
            }        
        }
        
        function ar(){
            $this->load->model('arrested_development/character_model');
            $this->load->model('arrested_development/topic_model');
            $this->load->model('arrested_development/facts_model');
            $this->load->model('arrested_development/theory_model');
            $this->load->helper('cookie');

            $cookie= array(
                'name'   => 'Cook',
                'value'  => $this->gen_random(),
                'expire' => '3600',
            );

            $this->input->set_cookie($cookie);
            
            if(!isset($cookie['Cook'])){
                echo 'fuck?!';
                die;
            }
            
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
            $this->data['baseURL'] = 'http://www.chrismadeen.com/';
            
            $this->data['entry_types'] = array('character' => $char,'topic' => $topic,'facts'=> $fact,'theories'=> $theor);
            
            $this->load->view('ar/ar',$this->data);
        }
        
        public function fitbit(){
            $this->load->helper('url');
            $this->load->helper('cookie');
            
            $this->data['fitbit_id'] = '22BJWV';
            if(!get_cookie('cgm_fitbit')){
                $cookie= array(
                    'name'   => 'cgm_fitbit',
                    'value'  => $this->gen_random(),
                    'expire' => '3600',
                );
                $this->input->set_cookie($cookie);
                $this->data['fitcook'] = $cookie;
                $this->load->view('fitbit',$this->data);
            }else{
                $cookie= array(
                    'value'  => get_cookie('cgm_fitbit'),
                );
                $this->data['fitcook'] = $cookie;
                $this->load->view('fitbit',$this->data);
            }
            //$fitbit_auth = 'https://www.fitbit.com/oauth2/authorize?response_type=code&client_id=22BJWV&redirect_uri=https%3A%2F%2Fwww.chrismadeen.com%2FMain%2Ffitbit&scope=heartrate&expires_in=604800';
            //$fitbit_auth = 'https://www.fitbit.com/oauth2/authorize?response_type=token&client_id=22BJWV&redirect_uri=https%3A%2F%2Fwww.chrismadeen.com%2FMain%2Ffitbit&scope=activity%20nutrition%20heartrate';
            //$this->data['auth'] = $code = $this->input->get('code');
            //$this->data['token'] = $token = $this->input->get('access_token');
            //$uri = fetch_current_uri();
            //if($code == "" && strpos($uri,'#') < 0){
             //   redirect($fitbit_auth,'refresh');
            //}else{
            //}
        }
        
        public function fitbit_login(){
            $this->load->view('fitbit_auth');
        }
        
        public function phaser(){
            $this->load->view('root');
        }
        
        public function talk(){
            $this->data['base'] = 'http://www.chrismadeen.com/';
            $this->load->model('talk/Vocabulary_model');
            $this->data['vocabulary'] = $this->Vocabulary_model->getVocabularyItemsAndGroups();
            //print_r($this->data['vocabulary']);
            $this->load->view('talk',$this->data);
        }
        
        public function talk_intake(){
            $this->load->helper(array('form', 'url'));
            $this->data['base'] = 'http://chrismadeen.com/';
            $this->load->helper('cookie');

            $cookie= array(
                'name'   => 'Cook',
                'value'  => "Cookiedactyle",
                'expire' => '3600',
            );

            print_r($this->input->set_cookie($cookie));
            $this->load->view('talk_intake',$this->data);
        }
        
        public function talk_submit(){
            /*
            $data = $this->input->post('data');
            $data = json_decode(stripslashes($data));
            $serverFile = time(). $data['fileName'];
            die;
            $fp = fopen('./CGM/img/talking/misc/'.$serverFile,'w'); //Prepends timestamp to prevent overwriting
            fwrite($fp, $data);
            fclose($fp);
            $returnData = array( "serverFile" => $serverFile );
            echo json_encode($returnData);
            //print_r($data);
             * 
             */
            print_r($this->input->post());
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
        
    public function test(){
        $this->load->view('test.php');
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
}
