<?php
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  = $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid     = $content['sectionID'];
$widget_section_url  = $content['widget_section_url'];
$view_mode           = $content['mode'];
$max_article         = $content['show_max_article'];
$render_mode         = $content['RenderingMode'];
$Limit=($max_article=='')?10:$max_article;
$Access=($widgetsectionid!=18)?false:true;
$LocalUrl='http://cms.edexlive.com';
if($Access==true):
	$TotalRows=$this->db->query("SELECT sid FROM shortfilm_master WHERE status=1 AND approval_status=1 AND youtube_link!='' ")->num_rows();
	$config['base_url']=($view_mode=='live') ? $LocalUrl.'/shortfilm' : $LocalUrl .'/shortfilm';
	$config['total_rows']=$TotalRows;
	$config['per_page'] = 5;
	$config['page_query_string'] = TRUE;
	$config['use_page_numbers'] = TRUE;
	$this->pagination->initialize($config);
	if(isset($_GET['per_page']) && $_GET['per_page']!=''){ $Limit=$_GET['per_page'] ; }else{ $Limit = 0;}
	$Data=$this->db->query("SELECT sid,url,title,duration,hits,modified_on,youtube_link FROM shortfilm_master WHERE status=1 AND approval_status=1 AND youtube_link!='' LIMIT ".$Limit." , ".$config['per_page']." ")->result();
	$template='';
	$template .='<div class="row">';
	$template .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
	$template .='<div class="SundaySecond">';
	$template .='<fieldset class="FieldTopic"><legend class="topic"><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></legend></fieldset>';
	foreach($Data as $ShortFilmDetails):
		$YoutubeKey=strripos($ShortFilmDetails->youtube_link,'/');
		$TempYoutubeUrl=substr($ShortFilmDetails->youtube_link,$YoutubeKey + 1);
		$UpdatedDate=date('dS  F Y' , strtotime($ShortFilmDetails->modified_on)); 
		$Absurl=BASEURL.$ShortFilmDetails->url;
		$template .='<!--block starts here--><div class="WidthFloat_L">';
		$template .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 SundaySecondSplit">';
		$template .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
		$template .='<div class="video_space">';
		$template .='<a href="'.$Absurl.'" class="article_click">';
		$template .='<img src="https://img.youtube.com/vi/'.$TempYoutubeUrl.'/mqdefault.jpg" data-src="https://img.youtube.com/vi/'.$TempYoutubeUrl.'/mqdefault.jpg" title="'.$ShortFilmDetails->title.'" alt="'.$ShortFilmDetails->title.'" class="lazy-loaded">';
		$template .='<i class="fa fa-play video_icon" aria-hidden="true"></i><div class="duration">'.$ShortFilmDetails->duration.'</div>';
		$template .='</a></div></div>';
		$template .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
		$template .='<h4 class="subtopic subtopic_video_lead-section">';
		$template .='<a href="'.$Absurl.'" class="article_click">'.$ShortFilmDetails->title.'</a>';
		$template .='</h4>';
		$template .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="video_view">'.$ShortFilmDetails->hits.' views</div></div>';
		$template .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
		$template .='<div class="video_uploadon">Uploaded on: <span style="color:#004a8f">'.$UpdatedDate.'</span> </div>';
		$template .='</div></div></div></div><!--Block end here-->';
	endforeach;
	$template .='</div></div></div>';
	echo $template.'<div class="pagina">'.$this->pagination->create_links().'</div>';
endif;
?>
<style>
html{  --width--100--:100%;  --float--left--:left;  --background--:#3c8dbc; }
.subtopic_video_lead-section{ margin:2px 0 7px 20px!important; font-size:18px; line-height:1.4;}
.subtopic_video_lead-section a:hover { color:#000; }
.video_view{ margin:0 0 16px 0; color:#ff9405; float:var(--float--left--); font-family:"Helvetica Neue",Helvetica,Arial,sans-serif; font-size:10px; font-weight:normal; border:1px dotted #ff9405; }
.video_uploadon{ color:#000; float:var(--float--left--);  font-size:14px;    font-family: anton; }
.video_space{ width:95%; overflow:hidden; }
.video_icon{ font-size:25px; color:#fff; background:#f4981d; border-radius:50%; margin:0; padding:7px 7px 7px 12px; position:absolute; z-index:99; bottom:34%; right:48%; opacity:0.9;  text-shadow:none; }
.video_space img{ -webkit-transition:all 2s ease; -o-transition:all 2s ease; -ms-transition:all 2s ease; transition:all 2s ease; width:var(--width--100--); }
.video_space img:hover{ -webkit-backface-visibility:hidden; backface-visibility:hidden; -webkit-transform: scale(2, 3); -moz-transform: scale(2, 3); -ms-transform: scale(2, 3); -0-transform: scale(2, 3); transform: scale(2, 2); -webkit-filter:brightness(80%); -moz-filter:brightness(80%); -ms-filter:brightness(80%); -0-filter:brightness(80%); filter:brightness(80%); }
.duration{ margin:0 20px 2px 0; padding:4px 5px; color:#fff; background:rgba(0, 0, 0, 0.5); width:auto; right:0; bottom:0; position:absolute;    font-family: anton; }
.pagina strong{background-color: #666;color: #fff;font-weight: 500;margin-right: 5px;padding: 6px 12px;text-align: center;}
</style>


