<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('cpanel/common/header');
$this->load->view('cpanel/'.$template);
$this->load->view('cpanel/common/footer');
?>