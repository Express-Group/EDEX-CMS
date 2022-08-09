<style>
.article_link img{ width: 100%; }
.article_link { float:left;width:100%; }
.subtopic1 { font-size: 23px; line-height: 1.3; margin: 7px 0px; float: left;font-family: anton; }
.back { float:left ;padding: 6% 2%;}
@media only screen and (min-width: 1551px){
	.subtopic1{font-size: 25px;line-height: 1.5;}
}
</style>
<?php 
function getColorPallet($imageURL, $palletSize=[16,8]){
    if(!$imageURL) return false;
    $img = imagecreatefromjpeg($imageURL);
    $imgSizes=getimagesize($imageURL);
    $resizedImg=imagecreatetruecolor($palletSize[0],$palletSize[1]);
    imagecopyresized($resizedImg, $img , 0, 0 , 0, 0, $palletSize[0], $palletSize[1], $imgSizes[0], $imgSizes[1]);
    imagedestroy($img);
    $colors=[];
    for($i=0;$i<$palletSize[1];$i++)
        for($j=0;$j<$palletSize[0];$j++)
            $colors[]=dechex(imagecolorat($resizedImg,$j,$i));
    imagedestroy($resizedImg);
    $colors= array_unique($colors);
    return $colors;
}
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color         = $content['widget_bg_color'];
$widget_custom_title     = $content['widget_title'];
$widget_instance_id      =  $content['widget_values']['data-widgetinstanceid'];
$widget_section_url      = $content['widget_section_url'];
$is_home                 = $content['is_home_page'];
$main_sction_id 	     = "";
$is_summary_required     = $content['widget_values']['cdata-showSummary'];
$domain_name             =  base_url();
$view_mode               = $content['mode'];
$show_simple_tab         = "";
$max_article             = $content['show_max_article'];
$render_mode             = $content['RenderingMode'];
$count 					 = '1';

$content_type = $content['content_type_id'];  
if($render_mode == "manual"){
	$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'], $max_article); 				
}else{
   $widget_instance_contents = $this->widget_model->get_all_available_articles_auto($max_article, $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
}
if(count($widget_instance_contents)>0) {
	$show_simple_tab .= '<div class="SundaySecond">';
	$show_image1	= image_url_no. imagelibrary_image_path.'logo/nie_logo_600X300.jpg';
	foreach($widget_instance_contents as $get_content)
		{
			if($render_mode == "manual"){
				$content_type = $get_content['content_type_id']; 
				$content_details = $this->widget_model->get_contentdetails_from_database($get_content['content_id'], $content_type, $is_home, $view_mode);
			}else{
				 $content_type = $content['content_type_id'];  
			}
			$custom_title        = "";
			$custom_summary      = "";
			$original_image_path = "";
			$imagealt            = "";
			$imagetitle          = "";
			$Image600X390        = "";
			if($render_mode == "manual")            
			{
				if($get_content['custom_image_path'] != '')
				{
					$original_image_path = $get_content['custom_image_path'];
					$imagealt            = $get_content['custom_image_title'];	
					$imagetitle          = $get_content['custom_image_alt'];												
				}
					$custom_title        = stripslashes($get_content['CustomTitle']);
					$custom_summary      = $get_content['CustomSummary'];
					$content_url         = $content_details[0]['url'];
			}
			else
				{
				    $content_url    = $get_content['url'];
					$custom_title   = $get_content['title'];
					$custom_summary = $get_content['summary_html'];
				}
			if($original_image_path =="" && $render_mode =="manual")       
				{
					   $original_image_path  = $content_details[0]['ImagePhysicalPath'];
					   $imagealt             = $content_details[0]['ImageCaption'];	
					   $imagetitle           = $content_details[0]['ImageAlt'];	
				}	
			else if($original_image_path =="" && $render_mode =="auto")                  
			{
				   $original_image_path  = $get_content['ImagePhysicalPath'];
				   $imagealt             = $get_content['ImageCaption'];	
				   $imagetitle           = $get_content['ImageAlt'];	
			}
			if ($original_image_path!='' && get_image_source($original_image_path, 1))
			{
				$imagedetails = get_image_source($original_image_path, 2);
				$imagewidth = $imagedetails[0];
				$imageheight = $imagedetails[1];	
				if ($imageheight > $imagewidth){
					$Image600X390 	= $original_image_path;
				}else{
					$Image600X390  = str_replace("original","w600X300", $original_image_path);
				}
				if ($Image600X390 != '' && get_image_source($Image600X390, 1))
				{
					$show_image = image_url. imagelibrary_image_path . $Image600X390;
					$show_image1 = image_url_no. imagelibrary_image_path . $Image600X390;
				}
				else 
				{
					$show_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X300.jpg';
				}
			}	
			else 
			{
				$show_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X300.jpg';
			}
			$dummy_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X300.jpg';		
				
			$param = $content['close_param']; 
			$live_article_url = $domain_name. $content_url.$param;
		
			if( $custom_title == '' && $render_mode=="manual" )
			{
				$custom_title = $content_details[0]['title'];
			}	
			$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title); 
			$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';			

			$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary); 
			if($count == 1 ){			
				$show_simple_tab .= '<div class="WidthFloat_L">';
				$show_simple_tab .= '<div class="col-md-8 col-sm-8 SundaySecondSplit"><a href="'.$live_article_url.'" class="article_link">';
				$show_simple_tab .= '<img src="'.$show_image.'" data-src="'.$show_image.'" title="'.$imagetitle.'" alt="'.$imagealt.'" class="img-responsive"></a>';
				$show_simple_tab .= '<h4 class="subtopic">'.$display_title.'</h4>';
				//$show_simple_tab .= '<p class="summary">'.$summary.'</p>';
				$show_simple_tab .= '</div>';
			}
			if($count == 2){
				$show_simple_tab .= '<div class="col-md-4 col-sm-4 SundaySecondSplit">';
				$show_simple_tab .= '<a href="'.$live_article_url.'" class="article_link">';
				$show_simple_tab .= '<img src="'.$show_image.'" data-src="'.$show_image.'" title="'.$imagetitle.'" alt="'.$imagealt.'" class="img-responsive"></a>';
				$show_simple_tab .= '<h4 class="subtopic1">'.$display_title.'</h4>';
				$show_simple_tab .= '<p class="summary">'.$summary.'</p></div>';
				$show_simple_tab .= '</div>';
			}
			
			if($count >= 3 && $count <=5 ){
					if($count==3){
						$show_simple_tab .= '<div class="WidthFloat_L">';
					}
					$show_simple_tab .= '<div class="col-md-4 col-sm-4 SundaySecondSplit">';
					$show_simple_tab .= '<a href="'.$live_article_url.'">';
					$show_simple_tab .=	'<img src="'.$show_image.'" data-src="'.$show_image.'" title="'.$imagetitle.'" alt="'.$imagealt.'" class="img-responsive"> </a>';
					$show_simple_tab .=	'<h4 class="subtopic">'.$display_title.'</h4>';
					$show_simple_tab .=	'<p class="summary">'.$summary.'</p>';
					$show_simple_tab .=	'</div>';
					if($count==5){
						$show_simple_tab .= '</div>';
					}
			}
			if($count == 6){
				$show_simple_tab .= '<div class="WidthFloat_L margin-bottom-15" style="position:relative;padding:0;">';
				$show_simple_tab .= '<div style="background: url('.$show_image.');float: left;width: 100%;  height: 100%; background-repeat: no-repeat; -ms-background-size: cover; -moz-background-size: cover; -webkit-background-size: cover;position:absolute; opacity:0.4;border-radius: 13px;"></div>';
				$show_simple_tab .= '<div style="background: #'.array_rand(getColorPallet($show_image1) ,1).';float: left;width: 100%;  height: 100%; background-repeat: no-repeat; -ms-background-size: cover; -moz-background-size: cover; -webkit-background-size: cover;position:absolute; opacity:0.4;border-radius: 13px;"></div>';
				$show_simple_tab .= '<div class="col-md-12 col-sm-12">';
				$show_simple_tab .= '<div class="back">';
				$show_simple_tab .= '<div class="col-md-6 col-sm-6">';
				$show_simple_tab .= '<h4 class="subtopic" style="font-size:27px;">'.$display_title.'</h4>';
				$show_simple_tab .= '<p class="summary" style="font-size:19px !important;">'.$summary.'</p>';
				$show_simple_tab .= '</div>';
				$show_simple_tab .= '<div class="col-md-6 col-sm-6">';
				$show_simple_tab .= '<a href="" class="article_link">';
				$show_simple_tab .= '<img src="'.$show_image.'" data-src="'.$show_image.'" title="'.$custom_title.'" alt="'.$imagealt.'" class="img-responsive"></a>';
				$show_simple_tab .= '</div></div></div></div>';
			}

			if($count == 6){
				$count = 1;
			}else{
				$count++;
			}
		}
		if($count==2 || $count==4){
			$show_simple_tab .= '</div>';
		}
		$show_simple_tab .= '</div>';
		echo $show_simple_tab;
}

?>