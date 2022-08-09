<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class shortfilm_controller extends CI_Controller {

	public function __construct() 
	{		
		parent::__construct();
		
		$this->load->helper('form');
		$this->load->helper('url'); 		
		$this->load->helper('file');
	} 
	
	public function index()
	{
		$BrowserUrl=$this->uri->uri_string();
		$SectionName=$this->uri->segment(1);
		if($SectionName!='shortfilm' || $this->uri->segment(5)==''):
			echo $this->load->view("admin/page_not_found_404", '', true);
			exit;
		endif;
		if( $this->uri->segment(5)!=''){
			$GetContentID=explode('.',$this->uri->segment(5));
			$IDPosition=strripos(@$GetContentID[0],'-') + 1;
			$ContentID=(int)substr(@$GetContentID[0],$IDPosition);
			if(gettype($ContentID)!='integer'){
				echo $this->load->view("admin/page_not_found_404", '', true);
				exit;
			}
			$this->load->database();
			$Query=$this->db->query("SELECT url FROM shortfilm_master WHERE sid='".$ContentID."' AND approval_status=1 AND status=1");
			if($Query->num_rows()==0){
				echo $this->load->view("admin/page_not_found_404", '', true);
				exit;
			}else{
				$Result=@$Query->result();
				if($Result[0]->url==''):
					echo $this->load->view("admin/page_not_found_404", '', true);
					exit;
				endif;
				if($BrowserUrl!=$Result[0]->url):
					$newURL=base_url().$Result[0]->url;
					redirect($newURL,'location',301);
				endif;
				$data['sid']=$ContentID;
			}
		}
		$page_type=2;
		$this->load->model('admin/widget_model');
		$this->load->library("template_library");
		$page_details 	= $this->widget_model->getArticleCommonPageDetails(18, 2); 
		if(count($page_details)==0){
			$page_details 	= $this->widget_model->getPageDetails("10000", $page_type); 
		}
		$section_page_id = $page_details['menuid'];
		$xml = simplexml_load_string($page_details['published_templatexml']);
		if(count($xml)>0){
			$is_home_page       = 'n';
			$page_param         = ($this->input->get('pm')!='')? $this->input->get('pm'): $page_details['menuid'];
			$xml                = "";
			$xml				= simplexml_load_string($page_details['published_templatexml']);
			$tmpl_values        = "";
			$tmpl_values        = (string)$xml->attributes()->templatevalues;
			if($tmpl_values!=""){
				$tmpl_values 		= explode("-", $tmpl_values);	
			}else{
				$template_id 	    = $page_details['templateid'];
				$template_details 	= $this->widget_model->getTemplateDetails($template_id); 
				$tmpl_values 		= explode("-", $template_details['template_values']);		
			}
		}
		if(count($xml)< 0 && $page_type==2){
			$parent_section_id	= null;
			if($parent_section_id!=''){				
				$page_details       = $this->widget_model->getArticleCommonPageDetails($parent_section_id, $page_type); 
				$xml				= simplexml_load_string($page_details['published_templatexml']);
				$tmpl_values        = (strlen($xml)!=0)? (string)$xml->attributes()->templatevalues: "";
				if($tmpl_values!=""){
					$tmpl_values 		= explode("-", $tmpl_values);	
				}else{
					$template_id 	    = $page_details['templateid'];
					$template_details 	= $this->widget_model->getTemplateDetails($template_id); 
					$tmpl_values 		= explode("-", $template_details['template_values']);		
				} 		
			}else{
				$page_details       = $this->widget_model->getArticleCommonPageDetails(10000, $page_type);
				$xml				= simplexml_load_string($page_details['published_templatexml']);
				$tmpl_values        = (strlen($xml)!=0)? (string)$xml->attributes()->templatevalues: "";
				if($tmpl_values!=""){
					$tmpl_values 		= explode("-", $tmpl_values);	
				}else{
					$template_id 	    = $page_details['templateid'];
					$template_details 	= $this->widget_model->getTemplateDetails($template_id); 
					$tmpl_values 		= explode("-", $template_details['template_values']);		
				}	
			}
		}
		
		$data['viewmode']   = "live"; 
		$data['content_from']   = "live"; 
		$header_param		= "";
		$footer_param		= "";
		$right_panel_param	= "";
		
		if(count($xml)!= 0){
			$tplheader_values 	= $xml->tplcontainer;
			$page_type          = $page_details['pagetype'];
			if($page_type==2){
				$header_param 		= $tplheader_values[0];
				$body_param	        = $tplheader_values[count($tplheader_values)-3];
				$footer_param 		= $tplheader_values[count($tplheader_values)-1];
				$is_common_header   = $page_details['common_header'];
				$common_header_file = 'article_common_header.php';
				$header_file        = FCPATH.'application/views/view_template'.'/'.$common_header_file;
				$header_file_exist  = file_exists($header_file);
				if(($header_file_exist!= '' && $header_file_exist!=false) && $is_common_header==1){
					$data['header'] 	    = $this->load->view('view_template/article_common_header','', TRUE);
					$data['html_header']    = true;
				}else{
					$data['header'] 	= $this->template_library->article_xml_containers($header_param, "header", $content_id, $is_home_page, $view_mode, $image_number, $page_type, $page_param, $content_from, $content_type_id,'');
				}
				$data['body']	   = '<section class="section-content"><div class="container SectionContainer"><div class="row">';
				$template_values_body_content = explode(",",$tmpl_values[1]);
				$b_section_inc = 0;
				$loop_break_point = ($content_type_id==3 || $content_type_id == 4)? 1 : count($template_values_body_content);
				for($i=1; $i <= $loop_break_point; $i++){
					$body_section 	= $template_values_body_content;
					$section_cl_val	= ($content_type_id==3 || $content_type_id == 4)? 12 : $body_section[$b_section_inc] * (12 / array_sum($body_section));
					$col_sm_val		= "12";
					$col_xs_val		= "12";
					$home_last_column = "";
				if($b_section_inc != (count($body_section)-1) && count($body_section) > 0){
					if(($section_cl_val == 3 || $section_cl_val == 6 ) && array_sum($body_section) == 4){
						$home_last_column = "";
					}else{
						$home_last_column = "ColumnSpaceRight";
					}
				}
				if(count($body_section) == 3){
					if($b_section_inc == 0){
						$col_sm_val		= "3";
					}
					if($b_section_inc == 1){
						$col_sm_val		= "9";
					}
				}
				$c_class_value 	= " col-lg-".$section_cl_val." col-md-".$section_cl_val." col-sm-".$col_sm_val." col-xs-".$col_xs_val." ".$home_last_column." ";
				$data['body'] .= '<div class="'. $c_class_value .'">';
				$pass_body_content = (($i) < count($template_values_body_content)) ? $tplheader_values[$i] : $tplheader_values[$i];			
				if($i==2 && $is_common_header==1){
					$common_right_file = 'article_common_rightpanel.php';
					$right_panel_file   = FCPATH.'application/views/view_template'.'/'.$common_right_file;
					$right_file_exist   = file_exists($right_panel_file);  //get file contents from home.php
					if(($right_file_exist!= '' && $right_file_exist!=false) && $is_common_header==1){
						$data['body'] 	    .= $this->load->view('view_template/article_common_rightpanel','', TRUE);
						$data['html_rightpanel']  = true;
					}else{
						$data['body'] 	  .= $this->template_library->article_xml_containers($pass_body_content, "template_body", $content_id, $is_home_page, $view_mode, $image_number, $page_type, $page_param, $content_from, $content_type_id, $article_landing_details);
					}
				}else{
					$data['body'] 	  .= $this->template_library->article_xml_containers($pass_body_content, "template_body", $content_id, $is_home_page, $view_mode, $image_number, $page_type, $page_param, $content_from, $content_type_id, $article_landing_details);	
				}
				$data['body']	  .= '</div>';
				$b_section_inc ++;
			}
			$data['body']	   .= '</div></div></section>';
			$is_common_header   = $page_details['common_header'];
			$common_footer_file = 'article_common_footer.php';
			$footer_file        = FCPATH.'application/views/view_template'.'/'.$common_footer_file;
			$footer_file_exist  = file_exists($footer_file);  //get file contents from home.php
			if(($footer_file_exist!= '' && $footer_file_exist!=false) && $is_common_header==1){  //check file exist
			$data['footer'] 	= $this->load->view('view_template/article_common_footer','', TRUE);
			}else{
			$data['footer'] 	= $this->template_library->article_xml_containers($footer_param, "footer", $content_id, $is_home_page, $view_mode, $image_number, $page_type, $page_param, $content_from, $content_type_id,'');
			}
			}else
			{
				$header_param 		= $tplheader_values[0];
				$right_panel_param	= $tplheader_values[count($tplheader_values)-2];
				$footer_param 		= $tplheader_values[count($tplheader_values)-1];
				$body_loop_values	= $tplheader_values[0];
				
				if($page_details['common_header']==1 || $page_details['common_footer']==1 || $page_details['common_rightpanel']==1)
				{
					$common_xml         = $this->template_library->get_parent_article_page(10000, $page_type);
					$xml                = simplexml_load_string($common_xml['published_templatexml']);
					if(count($xml)> 1){
						$common_tplheader_values 	= $xml->tplcontainer; 
						if($page_details['common_header']==1){
						$header_param 	= $common_tplheader_values[0];
						}
						if($page_details['common_rightpanel']==1){
						$right_panel_param 	= $common_tplheader_values[count($common_tplheader_values)-2];				
						}
						if($page_details['common_footer']==1){
						$footer_param 	= $common_tplheader_values[count($common_tplheader_values)-1];
						}
					}
				}
				
			$data['header']   = $this->template_library->section_xml_containers($header_param, "header", $is_home_page, $view_mode, $page_type, $page_param);

			$data['body']	  = '<section class="section-content"><div class="container SectionContainer"><div class="row">';
			$template_values_body_content = explode(",",$tmpl_values[1]);
			$b_section_inc = 0;
			for($i=1; $i<=count($template_values_body_content); $i++){
			
				$body_section 	= $template_values_body_content;
				$section_cl_val	= $body_section[$b_section_inc] * (12 / array_sum($body_section));
				
				$col_sm_val		= "12";
				$col_xs_val		= "12";
				$home_last_column = "";
				if($b_section_inc != (count($body_section)-1) && count($body_section) > 0)
				{
					if(($section_cl_val == 3 || $section_cl_val == 6 ) && array_sum($body_section) == 4){
						$home_last_column = "";
					}
					else{
						$home_last_column = "ColumnSpaceRight";
					}
				}
				
				//////  For only three column template  ////
				if(count($body_section) == 3)
				{
						if($b_section_inc == 0)
						{
							$col_sm_val		= "3";
						}
						if($b_section_inc == 1)
						{
							$col_sm_val		= "9";
						}
				}
				$c_class_value 	= " col-lg-".$section_cl_val." col-md-".$section_cl_val." col-sm-".$col_sm_val." col-xs-".$col_xs_val." ".$home_last_column." ";
				$data['body'] .= '<div class="'. $c_class_value .'">';
				$pass_body_content = (($i) < count($template_values_body_content)) ? $tplheader_values[$i] : $right_panel_param;			
				
				$data['body'] 	  .= $this->template_library->section_xml_containers($pass_body_content, "template_body", $is_home_page,  $view_mode, $page_type, $page_param);			
				$data['body']	  .= '</div>';
				$b_section_inc ++;
			}
			$data['body']	  .= '</div></div></section>';

			$data['footer']   = $this->template_library->section_xml_containers($footer_param, "footer", $is_home_page, $view_mode, $page_type, $page_param);
			
			}
			
			$data['content_id']     	= $content_id;
			$data['content_type']	    = $content_type_id;
			$data['header_ad_script']	= $page_details['Header_Adscript'];
			$data['page_type']	        = $page_type;
			$data['article_details']	= $article_landing_details;
			$this->load->view("admin/view_remodal_article", $data);
		}
		
	}
}
?>