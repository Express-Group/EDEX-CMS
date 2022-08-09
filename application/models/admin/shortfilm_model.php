<?php
class shortfilm_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetRows($PerPage,$Page,$Type){
		if($Type==1){
			return $this->db->query("SELECT sid FROM shortfilm_master WHERE status=1")->num_rows();
		
		}else{
			return $this->db->query("SELECT sid,title,language,summary,approval_status,created_on FROM  shortfilm_master WHERE status=1 ORDER BY created_on DESC LIMIT ".$Page.", ".$PerPage."")->result();
		}
		
	}
	
	public function ShortfilmDetails($SID){
		
		$this->db->select('sid');$this->db->select('title');$this->db->select('duration');$this->db->select('dropbox_link');$this->db->select('youtube_link');$this->db->select('language');$this->db->select('summary');$this->db->select('year_month_competition');$this->db->select('member_location');$this->db->select('teammembers');$this->db->select('equipment_used');$this->db->select('awards');$this->db->select('status');$this->db->select('approval_status');$this->db->select('created_on');
		$this->db->from('shortfilm_master');
		$this->db->where('sid',$SID);
		$Details=$this->db->get();
		$Details=$Details->result();
		$Response=[];
		$Return['result']=[];
		foreach($Details as $Data):
			$Response['sid']=	$Data->sid;
			$Response['title']=	$Data->title;
			$Response['duration']=	$Data->duration;
			$Response['dropbox_link']=	$Data->dropbox_link;
			$Response['youtube_link']=	$Data->youtube_link;
			$Response['language']=	$Data->language;
			$Response['summary']=	$Data->summary;
			$Response['year_month_competition']=	$Data->year_month_competition;
			$Response['member_location']=	$Data->member_location;
			$Response['teammembers']=	$Data->teammembers;
			$Response['equipment_used']=	$Data->equipment_used;
			$Response['awards']=	$Data->awards;
			$Response['status']=	$Data->status;
			$Response['approval_status']=	$Data->approval_status;
			$Return['result'][]=$Response;
		endforeach;
		return json_encode($Return);
	}
	
	public function UpdateRows($Data,$sid){
		$this->db->where('sid',$sid);
		return $this->db->update('shortfilm_master',$Data);
	}
	
	public function GetUrl($Sid){
		$this->db->select('url');
		$this->db->from('shortfilm_master');
		$this->db->where('sid',$Sid);
		$Query=$this->db->get();
		$Query=$Query->result();
		return @$Query[0]->url;
	}

}
?>