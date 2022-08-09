<style>
.article-wrapper .article-image,.article-wrapper-right .article-image{ width:40%;float:left;}
.article-wrapper{box-shadow: 1px 1px 15px #0000001c;padding: 5px;border-radius: 4px;}
.article-wrapper .article-image img,.article-wrapper-right .article-image img{ width:100%;border-radius: 4px;box-shadow: 1px 1px 4px 2px #00000029;}
.article-wrapper .article-image img:hover,.article-wrapper-right .article-image img:hover{opacity:0.5;}
.article-wrapper .article-content-wrapper{width:59%;float:left;padding-left:1%;}
.article-wrapper-right .article-content-wrapper{width:59%;float:left;padding-right:1%;}
.article-wrapper .article-tags,.article-wrapper-right .article-tags{width: 100%;float: left;margin-bottom: 3%;font-size: 18px;font-family: 'Voltaire' !important;font-weight: bold;padding:20px;}
.article-wrapper .article-author-wrapper{float: right;border: none !important; color: #125688 !important;font-weight: normal;}
.article-wrapper .article-tags a{border-bottom: 2px solid #f4981d;}
.article-wrapper h5,.article-wrapper-right h5{font-size: 32px;line-height: 1.3;font-weight: bold;padding-left:20px;}
.article-wrapper-right .article-tags a{border-bottom: 2px solid #f4981d;float:right;}
.article-wrapper-right .article-author-wrapper{float: left !important;/* border: none !important; */color: #125688 !important;font-weight: normal;}
ul.social-network {list-style: none;display: inline;margin-left: 0 !important;padding: 0;margin-top:3%;float:left;}
ul.social-network li {display: inline; margin: 0 5px;}
.social-network a.icoFacebook:hover { background-color: #3B5998;}
.social-network a.icoTwitter:hover {  background-color: #33ccff;}
.social-network a.icoGoogle:hover {  background-color: #BD3518;}
.social-network a.icoFacebook:hover i,.social-network a.icoTwitter:hover i,.social-network a.icoGoogle:hover i{  color: #fff; }
a.socialIcon:hover,.socialHoverClass { color: #44BCDD;}
.social-circle li a { display: inline-block; position: relative; margin: 0 auto 0 auto;  -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%;text-align: center;width: 50px;height: 50px;font-size: 20px;}
.social-circle li i {margin: 0;line-height: 52px;text-align: center;}
.social-circle li a:hover i,.triggeredHover { -moz-transform: rotate(360deg);  -webkit-transform: rotate(360deg);-ms--transform: rotate(360deg);transform: rotate(360deg);-webkit-transition: all 0.2s;-moz-transition: all 0.2s;-o-transition: all 0.2s;-ms-transition: all 0.2s;transition: all 0.2s;}
.social-circle i {color: #fff;-webkit-transition: all 0.8s;-moz-transition: all 0.8s;  -o-transition: all 0.8s;-ms-transition: all 0.8s;transition: all 0.8s;}
.social-network li a {background-color: #bdbbbb;}
@media (max-width:320px)  { .article-wrapper .article-image, .article-wrapper-right .article-image { width: 100%; float: left;}	  
.article-wrapper .article-content-wrapper {width: 100%;float: left; padding-left: 1%;} }
@media only screen 
  and (min-device-width: 320px) 
  and (max-device-width: 480px)
 {
.article-wrapper .article-image, .article-wrapper-right .article-image { width: 100%; float: left;}	  
.article-wrapper .article-content-wrapper {width: 100%;float: left; padding-left: 1%;}
}
@media only screen  and (min-width : 1600px) {	
.article-wrapper .article-tags,.article-wrapper-right .article-tags{width: 100%;float: left;margin-bottom: 3%;font-size: 20px;font-family: 'Voltaire' !important;font-weight: bold;padding:20px;}
.article-wrapper h5,.article-wrapper-right h5{font-size: 36px;line-height: 1.3;font-weight: bold;padding-left:20px;}
}


</style>

<?php 
$CI = &get_instance();
$this->live_db = $this->load->database('live_db', TRUE);
$this->archive_db = $CI->load->database('archive_db', TRUE);
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color 		= $content['widget_bg_color'];
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	= $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 		= "";
$is_home 				= $content['is_home_page'];
$is_summary_required 	= $content['widget_values']['cdata-showSummary'];
$widget_section_url 	= $content['widget_section_url'];
$view_mode            	= $content['mode'];
$max_article            = $content['show_max_article'];
$render_mode            = $content['RenderingMode'];
$page_param	    		= $content['page_param'];
$load_more_url 			= $domain_name.'topic/?sid='.$content['page_param'].'&cid=1';
$widget_auto_count = $this->widget_model->select_setting($view_mode);
$columnist_count   = $widget_auto_count['subsection_otherstories_count_perpage'];
$max_article_count = $widget_auto_count['subsection_otherstories_autoCount'];
$SectionID = $content['sectionID'];
$widget_url=base_url().$this->uri->uri_string();
$TotalRows = 0;
$archive =  '';
if($max_article < 10 ){ $max_article = 10;}
function pager($parameter=[]){
	$config=['base_url'=>$parameter['base_url'],'total_rows'=>$parameter['total_rows'],'per_page'=>$parameter['per_page'],'num_links'=>5,'page_query_string'=>TRUE,'reuse_query_string'=>FALSE,'suffix'=>$parameter['suffix'],'cur_tag_open'=>'<a class="active">','cur_tag_close'=>'</a>','use_page_numbers'=>TRUE,'first_url'=>$parameter['first_url'],'first_link'=>TRUE,'last_link'=>FALSE];
	return $config;
}
if($render_mode == 'manual'):
	$Article = $this->live_db->query("SELECT content_id,CustomTitle,CustomSummary FROM widgetinstancecontent_live WHERE WidgetInstance_id='".$widget_instance_id."' ORDER BY DisplayOrder ASC LIMIT ".$max_article."")->result();
endif;

if($render_mode == 'auto'):

	$check_archive=@$_COOKIE['archivelist_'.$SectionID];
	if($check_archive==''){
		$hasarchive['archive_result']=[];
		$range=range(2009,date('Y')-1);
		foreach($range as $ranger):
			$table='article_'.$ranger;
			if($this->archive_db->table_exists($table)){
				$archive_pattern="SELECT content_id FROM ".$table." WHERE section_id='".$SectionID."'";
				$temp_query=$this->archive_db->query($archive_pattern);
				$data['table']=$table;
				$data['count']=$temp_query->num_rows();
				if($temp_query->num_rows() !=0):
					$hasarchive['archive_result'][]=$data;
				endif;
			}
		endforeach;
		setcookie('archivelist_'.$SectionID,json_encode($hasarchive),time() + (60 * 15));
		$archivelist=$hasarchive;
	}else{
		$archivelist=json_decode($check_archive,true);
	}
	
	if($this->input->get('archive')=='true' && $this->input->get('year')!=''){
		$year = $this->input->get('year');
		$currentyear = date('Y');
		if($year > $currentyear){ $year = 2009;	}
		if($year < 2009){ $year = 2009;	}
		$list = array_reverse($archivelist['archive_result']);
		for($a=0;$a<count($list);$a++):
		if($list[$a]['table']=='article_'.$year){
			$TotalRows = $list[$a]['count'];
			break;
		}
		endfor;
		$firsturl = $widget_url.'?archive=true&year='.$year;
		$suffix = '&archive=true&year='.$year;
		$this->pagination->initialize(pager(['total_rows'=>$TotalRows,'per_page'=>$max_article,'base_url'=>$widget_url,'suffix'=>$suffix,'first_url'=>$firsturl]));
		$Limit=(isset($_GET['per_page']) && $_GET['per_page'])?$_GET['per_page']:0;
		$pagination=$this->pagination->create_links();
		$tblname = "article_".$year;
		$Article = $this->archive_db->query("SELECT content_id,section_name,title,url,summary_html,author_name,author_image_path,article_page_image_path,tags,publish_start_date FROM ".$tblname." WHERE section_id='".$SectionID."' AND status='P' ORDER BY publish_start_date DESC LIMIT ".$Limit.",".$max_article."")->result();
		
		
	}else{
		if(@$_COOKIE['op_auto_count_'.$SectionID]!=''){
		$TotalRows =@$_COOKIE['op_auto_count_'.$SectionID];
		}else{
			$TotalRows = $this->live_db->query("SELECT content_id FROM article WHERE status='P' AND section_id='".$SectionID."'")->num_rows();
			setcookie('op_auto_count_'.$SectionID, $TotalRows,time() + (60 * 15));	
		}
		$this->pagination->initialize(pager(['total_rows'=>$TotalRows,'per_page'=>$max_article,'base_url'=>$widget_url,'suffix'=>'','first_url'=>$widget_url]));
		$Limit=(isset($_GET['per_page']) && $_GET['per_page'])?$_GET['per_page']:0;
		$pagination=$this->pagination->create_links();
		$Article = $this->live_db->query("SELECT content_id,section_name,title,url,summary_html,author_name,author_image_path,article_page_image_path, tags, publish_start_date FROM article WHERE section_id='".$SectionID."' AND status='P' ORDER BY publish_start_date DESC LIMIT ".$Limit.",".$max_article."")->result();
	}
endif;
$dummy_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
$dummy_image1	= image_url.'/images/static_img/no_author.jpg';
$show_simple_tab='';
$countat = 0;
foreach($Article as $FetchedArticle):
	if($render_mode=='manual'){
		$ManArticle = $this->live_db->query("SELECT section_name,title,url,summary_html,author_name,author_image_path,article_page_image_path, tags, publish_start_date FROM article WHERE status='P' AND content_id='".$FetchedArticle->content_id."'")->result();
		$ManArticle=$ManArticle[0];
	}
	$AuthorImage = image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
	$ArticleImage = image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
	$AuthorUrl = '';
	if($render_mode=='auto'){
		if($FetchedArticle->author_image_path!=''){ $AuthorImage = image_url. $FetchedArticle->author_image_path; }
	}else{
		
		if($ManArticle->author_image_path!=''){ $AuthorImage = image_url. $ManArticle->author_image_path; }
	}
	if($render_mode=='auto'){
		if($FetchedArticle->article_page_image_path!=''){
			$ArticleImage = image_url.imagelibrary_image_path. $FetchedArticle->article_page_image_path; 
			$ArticleImage = str_replace("original","w600X390", $ArticleImage);
	}
	}else{
		
		if($ManArticle->article_page_image_path!=''){ 
		$ArticleImage = image_url.imagelibrary_image_path. $ManArticle->article_page_image_path; 
		$ArticleImage = str_replace("original","w600X390", $ArticleImage);
		}
	}
	if($render_mode=='auto'){
		$AuthorName = $FetchedArticle->author_name;
	}else{
		$AuthorName = $ManArticle->author_name;		
	}
	if($render_mode=='auto'){
		$tagName = $FetchedArticle->tags;
		$get_tags =array();
		if($tagName!='')
		$get_tags=  explode(",", $tagName);
		if(count($get_tags)>0){ 
		?>
		<div class="">
		 <!-- <div> <span>TAGS</span> </div>-->
		  <?php $tgcount=1; foreach($get_tags as $tag){
				if($tag!='' && $tgcount ==1){
					$tag_title = join( "_",( explode(" ", trim($tag) ) ) );
					$tag_url_title = preg_replace('/[^A-Za-z0-9\_]/', '', $tag_title); 
					$tag_link = base_url().'topic/'.$tag_url_title; 
					$tag_link = '<a style="color:#010101 !important;" href="'.$tag_link.'">'.$tag.'</a>';
					$tgcount++;
					}
				} ?>
		</div> <?php
		}
	}else{
		echo $tagName = $ManArticle->tags;		
		
		$get_tags =array();
		if($tagName!='')
		$get_tags=  explode(",", $tagName);
		if(count($get_tags)>0){ 
		?>
		<div class="">
		 <!-- <div> <span>TAGS</span> </div>-->
		  <?php $tgcount=1; foreach($get_tags as $tag){
				if($tag!='' && $tgcount ==1){
					$tag_title = join( "_",( explode(" ", trim($tag) ) ) );
					$tag_url_title = preg_replace('/[^A-Za-z0-9\_]/', '', $tag_title); 
					$tag_link = base_url().'topic/'.$tag_url_title; 
					$tag_link = '<a style="color:#010101 !important;" href="'.$tag_link.'">'.$tag.'</a>';
					$tgcount++;
					}
				} ?>
		</div> <?php
		}
	}
	
	
	if($AuthorName!=''){
		if($render_mode=='auto'){
			$section = $FetchedArticle->section_name;
		}else{
			$section = $ManArticle->section_name;
		}
		$author_url  = join("-", explode(" ", $AuthorName)); 
		if($render_mode=='auto'){
			$content_url = $FetchedArticle->url;
		}else{
			$content_url = $ManArticle->url;
		}
		$url_array = explode('/', $content_url);
		$get_seperation_count = count($url_array)-4;
		$section_url = ($get_seperation_count==1)? $author_url : (($get_seperation_count==2)? $url_array[0]."/".$url_array[1] : $url_array[0]."/".$url_array[1]."/".$url_array[2]);
		$author_pos = stripos($AuthorName, $section);
		if ($author_pos === false) {
			$AuthorUrl = base_url().'authors/?q='.$author_url;
		}else{
			$AuthorUrl = base_url().$section_url;
		}
		
	}
	if($render_mode=='auto'){
		$live_article_url = base_url().$FetchedArticle->url;
		$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$FetchedArticle->title);
		$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$FetchedArticle->summary_html);
		$post_time = $this->widget_model->time2string($FetchedArticle->publish_start_date);
	}else{
		$live_article_url = base_url().$ManArticle->url;
		$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$FetchedArticle->CustomTitle);
		if($FetchedArticle->CustomSummary==''){
			$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$ManArticle->summary_html);
		}else{
			$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$FetchedArticle->CustomSummary);
		}
		$post_time = $this->widget_model->time2string($ManArticle->publish_start_date);
		
	}
	$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';
	if($countat % 2 == 0){
		$show_simple_tab .= '<div class="sub_column article-wrapper">';
		$show_simple_tab .='<div class="article-image"><a  href="'.$live_article_url.'"  ><img src="'.$dummy_image.'"  data-src="'.$ArticleImage.'"></a></div>';
		$show_simple_tab .= '<div class="article-content-wrapper"><h4 class="article-tags">'.$tag_link.'<a class="article-author-wrapper" href="'.$AuthorUrl.'"  > '.$AuthorName.'</a></h4>';
		$show_simple_tab .= '<h5>'.$display_title.'</h5>';
		//$show_simple_tab .=	'<p class="post_time">'.$post_time.' </p>'; 
		//$show_simple_tab .=	'<ul class="social-network social-circle"><li><a class="sub_share icoFacebook" title="Facebook" data-title="'.strip_tags($display_title).'" data-url="'.$live_article_url.'"><i class="fa fa-facebook"></i></a></li><li><a class="sub_share icoTwitter" title="Twitter" data-title="'.strip_tags($display_title).'" data-url-twitter="'.$live_article_url.'"><i class="fa fa-twitter"></i></a></li><li><a class="sub_share icoGoogle" title="Google +" data-url="'.$live_article_url.'"><i class="fa fa-google-plus"></i></a></li></ul>'; 
		$show_simple_tab .= '</div> </div>';
	}else{
		$show_simple_tab .= '<div class="sub_column article-wrapper-right">';
		$show_simple_tab .= '<div class="article-content-wrapper"><h4 class="article-tags">'.	$tag_link.'<a class="article-author-wrapper" href="'.$AuthorUrl.'"  > '.$AuthorName.'</a></h4>';
		$show_simple_tab .= '<h5>'.$display_title.'</h5></div> ';
		$show_simple_tab .='<div class="article-image"><a  href="'.$live_article_url.'"  ><img src="'.$dummy_image.'"  data-src="'.$ArticleImage.'"></a></div>';
		$show_simple_tab .= '</div>';
	}
	
	//$countat ++;
endforeach;

echo $show_simple_tab;
if($render_mode == 'auto'){
	
	echo '<div class="pagina" style="margin:3% 0 2%; ">'.$pagination.'</div>';
}


?>

<script>
	$(document).ready(function(){
		$('.sub_share').on('click',function(e){
			$url =$(this).attr('data-url');
			$title =$(this).attr('data-title');
			
			if($url==undefined){
				$.ajax({
					type:'POST',
					url:'<?php echo BASEURL; ?>user/commonwidget/get_shorten_url',
					data:{'article_url':$(this).attr('data-url-twitter')},
					cache:false,
					dataType:'json',
					success:function(result){
						var twiiterUrlPath = 'https://twitter.com/intent/tweet?original_referer=' + encodeURIComponent(result.id) + '&text=' + encodeURIComponent($title) + '&url=' + encodeURIComponent(result.id);

						window.open(twiiterUrlPath, "", "width=670,height=340");
					}
				});
			}else if($title==undefined){
				window.open("https://plus.google.com/share?url="+$url, "", "width=670,height=340");
			}else{
				window.open("https://www.facebook.com/sharer/sharer.php?u="+$url, "", "width=670,height=340");

			}
		});
	})
</script>