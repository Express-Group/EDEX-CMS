<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logincontroller extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Loginmodel');
	}
	
	public function index(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
		 if ($this->form_validation->run() == FALSE){
            $this->load->view('cpanel/login');
         }else{
			$username = trim($this->input->post('username'));
			$password = trim($this->input->post('password'));
			$userDetails = $this->Loginmodel->checkuser($username ,$password);
			if($userDetails['count']==0){
				$this->session->set_flashdata('error','<p style="margin: 0 0 4px;color: red;">Enter Valid Username/password</p>');
				$this->load->view('cpanel/login');
			}else{
				if($userDetails['result']['status']!='1'){
					$this->session->set_flashdata('error','<p style="margin: 0 0 4px;color: red;">Your account is not activated</p>');
					$this->load->view('cpanel/login');
				}else{
					$this->session->set_userdata('nuid' , $userDetails['result']['User_id']);
					$this->session->set_userdata('nusername' ,$username);
					redirect('neet-cpanel/dashboard');
				}
			}
			
		 }
		
	}
	
	public function logout(){
		$this->session->sess_destroy();
		$this->session->set_flashdata('error','<p style="margin: 0 0 4px;color: red;">you are sign out from the session</p>');
		redirect('/neet-cpanel');
	}
}
?> 