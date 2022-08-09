<?php
class Adminmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function fetch_tips_data($data)
	{
		if($data['type'] == 1){
			$filter = "AND tips_id='".$data['tips_id']."'";
			$limit	= '';
		}else{
			$filter = '';
			$limit 	= "LIMIT ".$data['limit']." , 10";
		}
		
		$result['value'] = $this->db->query("SELECT tips_id, tips_txt, tips_image, DATE_FORMAT(created_on, '%M %d %Y') as created_on, status FROM neet_tips WHERE tips_id!='' ".$filter." ORDER BY tips_id DESC ".$limit." ")->result_array();

		$result['rows'] = $this->db->query("SELECT tips_id, tips_txt, tips_image, DATE_FORMAT(created_on, '%M %d %Y') as created_on, status FROM neet_tips WHERE tips_id!='' ORDER BY tips_id DESC")->num_rows(); 
		
		return $result;
	}
	
	public function fetch_videos_data($data)
	{
		if($data['type'] == 1){
			$filter = "AND video_id='".$data['video_id']."'";
			$limit	= '';
		}else{
			$filter = '';
			$limit 	= "LIMIT ".$data['limit']." , 10";
		}
		$result['value'] = $this->db->query("SELECT video_id, video_title, video_embed, DATE_FORMAT(created_on, '%M %d %Y') as created_on, status FROM neet_videos WHERE video_id!='' ".$filter." ORDER BY video_id DESC ".$limit." ")->result_array(); 
		
		$result['rows'] = $this->db->query("SELECT video_id, video_title, video_embed, DATE_FORMAT(created_on, '%M %d %Y') as created_on, status FROM neet_videos WHERE video_id!='' ORDER BY video_id DESC")->num_rows(); 
		
		return $result;
	}
	
	public function fetch_news_data($data)
	{
		if($data['type'] == 1){
			$filter = "AND news_id='".$data['news_id']."'";
			$limit	= '';
		}else{
			$filter = '';
			$limit 	= "LIMIT ".$data['limit']." , 10";
		}
		$result['value'] = $this->db->query("SELECT news_id,news_title, news_url, DATE_FORMAT(created_on, '%M %d %Y') as created_on, status FROM neet_news WHERE news_id!='' ".$filter." ORDER BY news_id DESC ".$limit." ")->result_array(); 
		
		$result['rows'] = $this->db->query("SELECT news_id,news_title, news_url, DATE_FORMAT(created_on, '%M %d %Y') as created_on, status FROM neet_news WHERE news_id!='' ORDER BY news_id DESC")->num_rows(); 
		
		return $result;
	}
	
	public function fetch_venue_data($data)
	{
		if($data['type'] == 1){
			$filter = "AND venue_id='".$data['venue_id']."'";
			$limit	= '';
		}else{
			$filter = '';
			$limit 	= "LIMIT ".$data['limit']." , 10";
		}
		$result['value'] = $this->db->query("SELECT venue_id, venue_details, DATE_FORMAT(created_on, '%M %d %Y') as created_on, status FROM neet_venue WHERE venue_id!='' ".$filter." ORDER BY venue_id DESC ".$limit." ")->result_array();

		$result['rows'] = $this->db->query("SELECT venue_id, venue_details, DATE_FORMAT(created_on, '%M %d %Y') as created_on, status FROM neet_venue WHERE venue_id!=''  ORDER BY venue_id DESC")->num_rows();	

		return $result;		
	}
	
	public function inserttips($data)
	{
		return $this->db->insert('neet_tips', $data);
	}
	
	public function updatettips($data)
	{
		$this->db->where('tips_id',$data['tips_id']);
        return $this->db->update('neet_tips', $data['content']);
	}
	
	public function delete_tips_details($tips_id)
	{
		$this->db->where('tips_id',$tips_id);
		return $this->db->delete('neet_tips');
	}
	
	public function insertvenue($data)
	{
		$this->db->insert('neet_venue', $data);
        return $this->db->insert_id();
	}
	
	public function update_venue_data($data)
	{
        $this->db->where('venue_id',$data['venue_id']);
        return $this->db->update('neet_venue', $data['content']);
	}
	
	public function delete_venue_details($venue_id)
	{
		$this->db->where('venue_id',$venue_id);
		return $this->db->delete('neet_venue');
	}
	
	public function insertvideo($data)
	{
		return $this->db->insert('neet_videos', $data);
	}
	
	public function update_video_data($data)
	{
		$this->db->where('video_id',$data['video_id']);
        return $this->db->update('neet_videos', $data['content']);
	}
	
	public function delete_video_details($video_id)
	{
		$this->db->where('video_id',$video_id);
		return $this->db->delete('neet_videos');
	}
	
	public function insertnews($data)
	{
		return $this->db->insert('neet_news', $data);
	}
	
	public function update_news_data($data)
	{
        $this->db->where('news_id',$data['news_id']);
        return $this->db->update('neet_news', $data['content']);
	}
	
	public function delete_news_details($news_id)
	{
		$this->db->where('news_id',$news_id);
		return $this->db->delete('neet_news');
	}
	
}
?>