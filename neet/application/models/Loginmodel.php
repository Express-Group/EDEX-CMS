<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginmodel extends CI_Model{
	private $cmsdb;
	public function __construct(){
		parent::__construct();
		$this->cmsdb = $this->load->database('cms_db', TRUE);
	}
	
	public function checkuser($username,$password){
		$query = $this->cmsdb->query("SELECT User_id ,status FROM usermaster WHERE Username='".$username."' AND Password='".hash('sha512', $password)."'");
		return ['count'=>$query->num_rows() , 'result'=>$query->row_array()];
	}
}
?> 