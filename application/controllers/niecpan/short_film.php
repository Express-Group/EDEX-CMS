<?php
class short_film extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/shortfilm_model');
	}
	
	public function index(){
		$URL='http://cms.edexlive.com/';
		$data['title']='Shortfilm Manager';
		$data['url']=$URL;
		$this->load->view('admin/shortfilm_manager',$data);
	}
	
	public function getRows(){
		$PerPage= $this->input->post('per_page');
		$Page=$this->input->post('page');
		$Page=($Page=='' || $Page==0 )?0:$Page;
		$TotalRows=$this->shortfilm_model->GetRows($PerPage,$Page,1);
		$GetDetails=$this->shortfilm_model->GetRows($PerPage,$Page,2);
		$DetailsIntoJson=[];
		$Details['records']=[];
		foreach($GetDetails as $JsonDetails){
			$DetailsIntoJson['sid']=$JsonDetails->sid;
			$DetailsIntoJson['title']=$JsonDetails->title;
			$DetailsIntoJson['language']=$JsonDetails->language;
			$DetailsIntoJson['summary']=$JsonDetails->summary;
			$DetailsIntoJson['approval_status']=$JsonDetails->approval_status;
			$DetailsIntoJson['created_on']=$JsonDetails->created_on;
			$Details['records'][]=$DetailsIntoJson;
		}
		$_GET['per_page']=$Page;
		$config['base_url']="";
		$config['total_rows']=$TotalRows;
		$config['per_page']=$PerPage;
		$config['num_links']=5;
		$config['page_query_string']=TRUE;
		$config['reuse_query_string']=TRUE;
		$config['use_page_numbers']=TRUE;
		$config['anchor_class'] = 'class="pager_num"';
		$this->pagination->initialize($config);
		$Details['pagination']=str_replace('<a','<a pagination ',$this->pagination->create_links());
		
		
		echo json_encode($Details);
	}
	
	public function GetDetails(){
		$Sid=$this->input->post('sid');
		echo $this->shortfilm_model->ShortfilmDetails($Sid);
	}
	
	public function updateRows(){
		$memberCount=$this->input->post('member_count');
		if($this->input->post('approval_status')=='true'){
			$ApStatus=1;
		}
		if($this->input->post('approval_status')=='false'){
			$ApStatus=0;
		}
		$Details=[];
		$JsonDetails['details']=[];
		$JsonResult='';
		if($memberCount !=0){
			$Name=array_filter(explode('|~|',$this->input->post('member_name')),'strlen');
			$Role=array_filter(explode('|~|',$this->input->post('member_role')),'strlen');
			$College=array_filter(explode('|~|',$this->input->post('member_college')),'strlen');
			$DOB=array_filter(explode('|~|',$this->input->post('member_dob')),'strlen');
			$Contact=array_filter(explode('|~|',$this->input->post('member_contact')),'strlen');
			for($j=0;$j< count($Name);$j++):
				$Details['name']=$Name[$j];	
				$Details['role']=$Role[$j];	
				$Details['college']=$College[$j];	
				$Details['dob']=$DOB[$j];
				$Details['contact']=$Contact[$j];
				$JsonDetails['details'][]=$Details;
			endfor;
			$JsonResult=json_encode($JsonDetails);
		}
		//$Date=date('y-m-d h:i:s');
		$Url=$this->shortfilm_model->GetUrl($this->input->post('sid'));
		if($Url!=''){
			$NewUrl=$Url;
		}else{
			$Date=date('d');
			$Year=date('Y');
			$Month=date('M');
			$NewUrl= RemoveSpecialCharacters($this->input->post('title'));
			$NewUrl= mb_strtolower(join( "-",( explode(" ",$NewUrl))));
			$NewUrl= join( "-",( explode("&nbsp;",htmlentities($NewUrl))));
			$NewUrl .='-'.$this->input->post('sid').'.htm';
			$NewUrl=strtolower('shortfilm/'.$Year.'/'.$Month.'/'.$Date.'/'.$NewUrl);
		}
		$Data=['title'=>$this->input->post('title'),'url'=>$NewUrl,'duration'=>$this->input->post('duration'),'dropbox_link'=>$this->input->post('dropbox_link'),'youtube_link'=>$this->input->post('youtube_link'),'language'=>$this->input->post('language'),'summary'=>$this->input->post('summary'),'year_month_competition'=>$this->input->post('year'),'member_location'=>$this->input->post('location'),'equipment_used'=>$this->input->post('equipment'),'awards'=>$this->input->post('awards'),'approval_status'=>$ApStatus,'modified_on'=>date('y-m-d h:i:s'),'teammembers'=>$JsonResult];
		echo $this->shortfilm_model->UpdateRows($Data,$this->input->post('sid'));
	
	}

}
?>