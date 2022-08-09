<?php
class Questioncontroller extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function index(){
		$data['template'] 	=	'questions';
		$search='';
		$query = "SELECT qid , subject , answer  , DATE_FORMAT(created_on , '%D  %M %Y %h:%i:%s %p') as created_on , question, status FROM neet_questions WHERE qid!='' ".$search." ORDER BY created_on DESC";
		$totalrows = $this->db->query($query)->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = base_url('neet-cpanel/questions');
		$config['total_rows'] = $totalrows;
		$config['per_page'] = 10;
		$config['use_page_numbers'] = FALSE;
		$config['page_query_string'] = TRUE;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$rows = ($this->input->get('per_page')!='' ) ? $this->input->get('per_page') : 0;
		$data['data'] = $this->db->query($query." LIMIT ".$rows." , ".$config['per_page']."")->result();
		$this->load->view('cpanel/common',$data);
	}
	
	public function add(){
		$data['error'] = '';
		$filepath ='';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('question', 'Question', 'required');
		$this->form_validation->set_rules('answer', 'Answer', 'required');
		if(isset($_FILES["file_upload"]) && $_FILES["file_upload"]["name"]!=''){
			$this->load->library('upload');
			 $config['upload_path']          = FCPATH.'assets/images/Questions/';
             $config['allowed_types']        = 'doc|docx|pdf';
			 $this->upload->initialize($config);
			  if(!$this->upload->do_upload('file_upload')){
				  $data['error'] = $this->upload->display_errors();
			  }else{
				  $image = $this->upload->data();
				  $filepath  = $image['file_name'];
			  }
		}
		$data['template'] 	=	'add_questions';
		 if ($this->form_validation->run() == FALSE ||  $data['error']!=''):
			$this->load->view('cpanel/common',$data);
		 else : 
			$subject = trim($this->input->post('subject'));
			$question = trim($this->input->post('question'));
			$answer = trim($this->input->post('answer'));
			$data = array('question'=>$question , 'answer' => $answer , 'subject' => $subject , 'file_path' => $filepath ,'created_by'=>$this->session->userdata('nuid'));
			$result = $this->db->insert('neet_questions' , $data);
			if($result==1){
				$this->session->set_flashdata('question' , 'success');
			}else{
				$this->session->set_flashdata('question' , 'error');
			}
			redirect('/neet-cpanel/questions' , 301);
		 endif;
	}
	
	public function edit(){
		$data['template'] 	=	'add_questions';
		$data['error'] = '';
		$filepath =$this->input->post('file_temp');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('question', 'Question', 'required');
		$this->form_validation->set_rules('answer', 'Answer', 'required');
		if(isset($_FILES["file_upload"]) && $_FILES["file_upload"]["name"]!=''){
			$this->load->library('upload');
			 $config['upload_path']          = FCPATH.'assets/images/Questions/';
             $config['allowed_types']        = 'doc|docx|pdf';
			 $this->upload->initialize($config);
			  if(!$this->upload->do_upload('file_upload')){
				  $data['error'] = $this->upload->display_errors();
			  }else{
				  $image = $this->upload->data();
				  unlink($config['upload_path'].$filepath);
				  $filepath  = $image['file_name'];
			  }
		}
		 if ($this->form_validation->run() == FALSE ||  $data['error']!=''):
			$qid = $this->input->get('id');
			if($qid=='' || !is_numeric($qid)){
				redirect('/neet-cpanel/questions' , 301);
			}
			$data['questiondetails'] = $this->db->query("SELECT qid , question ,  answer , subject , file_path , status FROM  neet_questions WHERE qid ='".trim($qid)."'")->row_array();
			if(count($data['questiondetails']) < 0){
				redirect('/neet-cpanel/questions' , 301);
			}
			$this->load->view('cpanel/common',$data);
		 else : 
			$subject = trim($this->input->post('subject'));
			$question = trim($this->input->post('question'));
			$answer = trim($this->input->post('answer'));
			$data = array('question'=>$question , 'answer' => $answer , 'subject' => $subject , 'file_path' => $filepath ,'created_by'=>$this->session->userdata('nuid'));
			$this->db->where('qid' , $this->input->post('qid'));
			$result = $this->db->update('neet_questions' , $data);
			if($result==1){
				$this->session->set_flashdata('question' , 'success');
			}else{
				$this->session->set_flashdata('question' , 'error');
			}
			redirect('/neet-cpanel/questions' , 301);
		 endif;
	}
}
?> 