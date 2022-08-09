<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admincontroller extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		$this->load->model('Adminmodel');
		$this->load->library('upload');
		$this->load->library('pagination');
	}

	public function dashboard()
	{
	
		$data['template'] = "dashboard";
		$this->parser->parse('cpanel/common', $data);
	}
	
	public function tips()
	{
		$data['template'] 	=	'tips';
		$data['type']	= '';
		$config['page_query_string'] = TRUE;
		$config['base_url'] = base_url().'neet-cpanel/tips';
		$data['limit'] = ($this->input->get('per_page')!='') ? $this->input->get('per_page') : 0 ;
		$data['content']	=	$this->Adminmodel->fetch_tips_data($data);
		$config['total_rows'] = $data['content']['rows'];
		$config['per_page'] = 10;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->parser->parse('cpanel/common',$data);
	}
	
	public function video()
	{
		$data['template'] 	=	'videos';
		$data['type']	= '';
		$config['page_query_string'] = TRUE;
		$config['base_url'] = base_url().'neet-cpanel/video';
		$data['limit'] = ($this->input->get('per_page')!='') ? $this->input->get('per_page') : 0 ;
		
		$data['content']	=	$this->Adminmodel->fetch_videos_data($data);
		$config['total_rows'] = $data['content']['rows'];
		$config['per_page'] = 10;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$this->parser->parse('cpanel/common',$data);	
	}
	
	public function news()
	{
		$data['template'] 	=	'news';
		$data['type']	= '';
		$config['page_query_string'] = TRUE;
		$config['base_url'] = base_url().'neet-cpanel/news';
		$data['limit'] = ($this->input->get('per_page')!='') ? $this->input->get('per_page') : 0 ;
		
		$data['content']	=	$this->Adminmodel->fetch_news_data($data);
		$config['total_rows'] = $data['content']['rows'];
		$config['per_page'] = 10;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->parser->parse('cpanel/common',$data);	
	}
	
	public function venue()
	{
		$data['template'] 	=	'venue';
		$data['type']	= '';
		$config['page_query_string'] = TRUE;
		$config['base_url'] = base_url().'neet-cpanel/venue';
		$data['limit'] = ($this->input->get('per_page')!='') ? $this->input->get('per_page') : 0 ;
		
		$data['content']	=	$this->Adminmodel->fetch_venue_data($data);
		$config['total_rows'] = $data['content']['rows'];
		$config['per_page'] = 10;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->parser->parse('cpanel/common',$data);	
	}
	
	public function createtips()
	{
		$tips 		= trim($this->input->post('tips',TRUE));
        $tips_image = $_FILES['tips_image']['name'];
		if($tips !='' && $tips_image!='')
		{
			$config_image['upload_path']   = FCPATH.'uploads/';
            $config_image['allowed_types'] = '*';
			$this->upload->initialize($config_image);    
            if(!$this->upload->do_upload('tips_image')){
                $upload_file =null;
            }else{
                $filename = $this->upload->data();
                $upload_file = $filename['file_name'];
            }
			$now 	= date('Y-m-d H:i:s');
			$data 	= array('tips_txt'=>$tips,'tips_image'=>$upload_file,'created_on'=>$now, 'status'=>'1');
			$result	= $this->Adminmodel->inserttips($data);
			if($result == 1)
			{
				$this->session->set_flashdata('success','Tips Created Successfully');
				redirect('/neet-cpanel/tips');
			}else{
				$this->session->set_flashdata('error','Tips Not Created please try again');
				redirect('neet-cpanel/tips');
			}
		}else{
			$this->session->set_flashdata('error','Something Went Wrong');
			redirect('neet-cpanel/tips');
		}
	} 
	
	public function get_tipdetails()
	{
		$data['tips_id']	= trim($this->input->post('tips_id',TRUE)) ;
		if($data['tips_id'] !='')
		{
			$data['type']		= 1;
			$result	= $this->Adminmodel->fetch_tips_data($data);
			$stats_val 	= ($result['value'][0]['status'] == 1) ? 'checked' : '';
			$status = '<div class="form-group status">
							<label class="col-md-3">Status</label>
								<div class="col-md-9">
		<input name="status" class="ace ace-switch ace-switch-6 active_status" '.$stats_val.' type="checkbox" value="1"/>
								<span class="lbl"></span>
							</div>
						</div>';
			echo json_encode( ['id' => $this->encrypt->encode($result['value'][0]['tips_id']), 'tips' =>$result['value'][0]['tips_txt'], 
			'image'=>$this->encrypt->encode( $result['value'][0]['tips_image'] ), 'show_image'=> $result['value'][0]['tips_image'],'status' =>$status] );
		}else{
			echo json_encode(['id'=>0]);
		}
	}
	
	public function updatetips()
	{
		$tips 				= trim($this->input->post('tips',TRUE));
		$data['tips_id'] 	= $this->encrypt->decode( trim($this->input->post('tips_edit',TRUE)) );
		$status 			= trim($this->input->post('status',TRUE));
		$tips_image 		= $_FILES['tips_image']['name'];
		if($tips !='' && $data['tips_id'] !=''){
			if($tips_image != '') { 
				$config_image['upload_path']   = FCPATH.'uploads/';
				$config_image['allowed_types'] = '*';
				$this->upload->initialize($config_image);    
				if(!$this->upload->do_upload('tips_image')){
					$tips_image =null;
				}else{
					$filename 	= $this->upload->data();
					$tips_image = $filename['file_name'];
				}
			}else{
				$tips_image = $this->encrypt->decode( trim($this->input->post('tips_edit_image',TRUE)) ); 
			}
			$data['content']	= array('tips_txt'=>$tips,'tips_image'=>$tips_image,'status'=>$status);
			$result				= $this->Adminmodel->updatettips($data);
			if($result == 1)
			{
				$this->session->set_flashdata('success','Tips Updated Successfully');
				redirect('neet-cpanel/tips');
			}else{
				$this->session->set_flashdata('error','Tips Not Updated please try again');
				redirect('neet-cpanel/tips');
			}
		}else{
			$this->session->set_flashdata('error','Something Went Wrong');
			redirect('neet-cpanel/tips');
		}
	}
	
	public function delete_tips()
	{
		$tips_id	= trim($this->input->post('tips_id',TRUE));
		if($tips_id!='')
		{
			$result = $this->Adminmodel->delete_tips_details($tips_id);
			if($result == 1){
				$this->session->set_flashdata('success','Tips Deleted Successfully');
				echo json_encode(['val'=>$result]);
			}else{
				echo json_encode(['val'=>0]);
			}
		}else{
			echo json_encode(['val'=>0]);
		}
	}

	public function createvenue()
	{
		$venue	=	trim($this->input->post('venue_txt',TRUE));
		if($venue !='')
		{
			$now 	= date('Y-m-d H:i:s');
			$data	= array('venue_details'=>$venue,'created_on'=>$now,'status'=>'1');
			$result = $this->Adminmodel->insertvenue($data);
			if($result > 0)
			{
				$this->session->set_flashdata('success','Venue Created Successfully');
				redirect('/neet-cpanel/venue');
			}else{
				$this->session->set_flashdata('error','Venut Not Created please try again');
				redirect('neet-cpanel/venue');
			}
		}else{
			$this->session->set_flashdata('error','Something Went Wrong');
			redirect('neet-cpanel/venue');
		}
	}
	
	public function get_venuedetails()
	{
		$data['venue_id']	= trim($this->input->post('venue_id',TRUE));
		if($data['venue_id'] !='')
		{
			$data['type']	= 1;
			$result	= $this->Adminmodel->fetch_venue_data($data);
			$stats_val 	= ($result['value'][0]['status'] == 1) ? 'checked' : '';
			$status = '<div class="form-group status">
							<label class="col-md-3">Status</label>
								<div class="col-md-9">
		<input name="status" class="ace ace-switch ace-switch-6 active_status" '.$stats_val.' type="checkbox" value="1"/>
								<span class="lbl"></span>
							</div>
						</div>';
			echo json_encode(['id' =>$this->encrypt->encode($result['value'][0]['venue_id']), 'venue' =>$result['value'][0]['venue_details'], 'status' =>$status]);
		}else{
			echo json_encode(['id'=>0]);
		}
	}
	
	public function updatevenue()
	{
		$data['venue_id']	=  $this->encrypt->decode( trim($this->input->post('venue_edit', TRUE)) );
		$venue				= trim($this->input->post('venue_txt',TRUE));
		$status				= trim($this->input->post('status',TRUE));
		if($status == '') { $status = 0 ;}
		if($data['venue_id'] !='' && $venue!='')
		{
			$data['content']	= array('venue_details'=> $venue, 'status'=> $status);
			$result				= $this->Adminmodel->update_venue_data($data);
			if($result == 1)
			{
				$this->session->set_flashdata('success','Venue Updated Successfully');
				redirect('neet-cpanel/venue');
			}else{
				$this->session->set_flashdata('error','Venue Not Updated please try again');
				redirect('neet-cpanel/venue');
			}
		}else{
			$this->session->set_flashdata('error','Something Went Wrong');
			redirect('neet-cpanel/venue');
		}
	}
	
	public function delete_venue()
	{
		$venue_id	= trim($this->input->post('venue_id',TRUE));
		if($venue_id!='')
		{
			$result = $this->Adminmodel->delete_venue_details($venue_id);
			if($result == 1){
				$this->session->set_flashdata('success','Venue Deleted Successfully');
				echo json_encode(['val'=>$result]);
			}else{
				echo json_encode(['val'=>0]);
			}
		}else{
			echo json_encode(['val'=>0]);
		}
	}
	
	
	public function createvideo()
	{
		$video_title	=	trim($this->input->post('video_title',TRUE));
		$video_embed	=	trim($this->input->post('video_embed',TRUE));
		if($video_title !='' && $video_embed!='' )
		{
			$now 	= date('Y-m-d H:i:s');
			$data	= array('video_title'=>$video_title,'video_embed' =>$video_embed, 'created_on'=>$now, 'status'=>'1');
			$result = $this->Adminmodel->insertvideo($data);
			if($result > 0)
			{
				$this->session->set_flashdata('success','Video Details Created Successfully');
				redirect('/neet-cpanel/video');
			}else{
				$this->session->set_flashdata('error','Video Details Not Created please try again');
				redirect('neet-cpanel/video');
			}
		}else{
			$this->session->set_flashdata('error','Something Went Wrong');
			redirect('neet-cpanel/video');
		}
	}
	
	public function get_videodetails()
	{
		$data['video_id']	= trim($this->input->post('video_id',TRUE));
		if($data['video_id'] !='')
		{
			$data['type']	= 1;
			$result	= $this->Adminmodel->fetch_videos_data($data);
			$stats_val 	= ($result['value'][0]['status'] == 1) ? 'checked' : '';
			$status = '<div class="form-group status">
							<label class="col-md-3">Status</label>
								<div class="col-md-9">
		<input name="status" class="ace ace-switch ace-switch-6 active_status" '.$stats_val.' type="checkbox" value="1"/>
								<span class="lbl"></span>
							</div>
						</div>';
			echo json_encode(['id' =>$this->encrypt->encode($result['value'][0]['video_id']), 'title' =>$result['value'][0]['video_title'], 'embed' =>$result['value'][0]['video_embed'], 'status' =>$status]);
		}else{
			echo json_encode(['id'=>0]);
		}
	}
	
	public function updatevideo()
	{
		$data['video_id']	= 	$this->encrypt->decode( trim($this->input->post('video_edit', TRUE)) );
		$video_title		= 	trim($this->input->post('video_title',TRUE));
		$video_embed		=	trim($this->input->post('video_embed',TRUE));
		$status				=	trim($this->input->post('status',TRUE));
		if($status == '') { $status = 0 ;}
		if( $data['video_id'] !='' && $video_title!='' && $video_embed!='' )
		{
			$data['content']	= array('video_title'=> $video_title, 'video_embed'=>$video_embed, 'status'=> $status);
			$result				= $this->Adminmodel->update_video_data($data);
			if($result == 1)
			{
				$this->session->set_flashdata('success','Video Details Updated Successfully');
				redirect('neet-cpanel/video');
			}else{
				$this->session->set_flashdata('error','Video Details Not Updated please try again');
				redirect('neet-cpanel/video');
			}
		}else{
			$this->session->set_flashdata('error','Something Went Wrong');
			redirect('neet-cpanel/video');
		}
	}
	
	public function delete_video()
	{
		$video_id	= trim($this->input->post('video_id',TRUE));
		if($video_id!='')
		{
			$result = $this->Adminmodel->delete_video_details($video_id);
			if($result == 1){
				$this->session->set_flashdata('success','Venue Deleted Successfully');
				echo json_encode(['val'=>$result]);
			}else{
				echo json_encode(['val'=>0]);
			}
		}else{
			echo json_encode(['val'=>0]);
		}
	}
	
	public function createnews()
	{
		$news_title	=	trim($this->input->post('news_title',TRUE));
		$news_link	=	trim($this->input->post('news_link',TRUE));
		if($news_title !='' && $news_link!='' )
		{
			$now 	= date('Y-m-d H:i:s');
			$data	= array('news_title'=>$news_title,'news_url' =>$news_link, 'created_on'=>$now, 'status'=>'1');
			$result = $this->Adminmodel->insertnews($data);
			if($result > 0)
			{
				$this->session->set_flashdata('success','News Details Created Successfully');
				redirect('/neet-cpanel/news');
			}else{
				$this->session->set_flashdata('error','News Details Not Created please try again');
				redirect('neet-cpanel/news');
			}
		}else{
			$this->session->set_flashdata('error','Something Went Wrong');
			redirect('neet-cpanel/news');
		}
	}
	
	public function get_newsdetails()
	{
		$data['news_id']	= trim($this->input->post('news_id',TRUE));
		if($data['news_id'] !='')
		{
			$data['type']	= 1;
			$result	= $this->Adminmodel->fetch_news_data($data);
			$stats_val 	= ($result['value'][0]['status'] == 1) ? 'checked' : '';
			$status = '<div class="form-group status">
							<label class="col-md-3">Status</label>
								<div class="col-md-9">
		<input name="status" class="ace ace-switch ace-switch-6 active_status" '.$stats_val.' type="checkbox" value="1"/>
								<span class="lbl"></span>
							</div>
						</div>';
			echo json_encode(['id' =>$this->encrypt->encode($result['value'][0]['news_id']), 'title' =>$result['value'][0]['news_title'], 'news_link' =>$result['value'][0]['news_url'], 'status' =>$status]);
		}else{
			echo json_encode(['id'=>0]);
		}
	}

	public function updatenews()
	{
		$data['news_id']	= 	$this->encrypt->decode( trim($this->input->post('news_edit', TRUE)) );
		$news_title		= 	trim($this->input->post('news_title',TRUE));
		$news_link		=	trim($this->input->post('news_link',TRUE));
		$status				=	trim($this->input->post('status',TRUE));
		if($status == '') { $status = 0 ;}
		if( $data['news_id'] !='' && $news_title!='' && $news_link!='' )
		{
			$data['content']	= array('news_title'=> $news_title, 'news_url'=>$news_link, 'status'=> $status);
			$result				= $this->Adminmodel->update_news_data($data);
			if($result == 1)
			{
				$this->session->set_flashdata('success','News Details Updated Successfully');
				redirect('neet-cpanel/news');
			}else{
				$this->session->set_flashdata('error','News Details Not Updated please try again');
				redirect('neet-cpanel/news');
			}
		}else{
			$this->session->set_flashdata('error','Something Went Wrong');
			redirect('neet-cpanel/news');
		}
	}
	
	public function delete_news()
	{
		$news_id	= trim($this->input->post('news_id',TRUE));
		if($news_id!='')
		{
			$result = $this->Adminmodel->delete_news_details($news_id);
			if($result == 1){
				$this->session->set_flashdata('success','News Deleted Successfully');
				echo json_encode(['val'=>$result]);
			}else{
				echo json_encode(['val'=>0]);
			}
		}else{
			echo json_encode(['val'=>0]);
		}
	}
	
}