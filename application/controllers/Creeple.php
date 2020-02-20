<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creeple extends CI_Controller {

	public function index()
	{
		$this->load->view('creeple/creeple');
	}
       
}
