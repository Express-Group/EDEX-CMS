<?php
class Validateuser{
	private $CI;
	public function __construct(){
		$this->CI = &get_instance();
	}
	public function checkuser(){
		$userID = $this->CI->session->userdata('nuid');
		$userName = $this->CI->session->userdata('nusername');
		$pageName = $this->CI->uri->segment(1);
		if($userID!='' && $userName!=''){
			if($this->CI->uri->uri_string()=='neet-cpanel'){
				redirect('/neet-cpanel/dashboard' , 301);
			}
		}else{
			if($pageName!='' && $this->CI->uri->uri_string()!='neet-cpanel'){
				redirect('/neet-cpanel' , 301);
			}
		}
	}
}
?>  