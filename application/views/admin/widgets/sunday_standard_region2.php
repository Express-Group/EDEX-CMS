<style>
		.upcomming-box{background: #3366cc;float: left;width: 100%;color: #fff;padding: 10px;margin-bottom: 20px;border-radius: 8px;box-shadow: 3px 4px 1px #00000040;}
		.upcomming-box .wrapper1{float: left;font-size: 3.4rem;text-transform: uppercase;font-weight: 700;margin-left: 5%;padding-top: 3%;}
		.upcomming-box .wrapper2{width: 9%;float: left;margin-left: 1%;margin-right: 1%;}
		.upcomming-box .wrapper2 img{width: 100%;}
		.upcomming-box .wrapper3{float: left;font-size: 3.4rem;text-transform: uppercase;font-weight: 700;    padding-top: 3%;}
		.upcomming-box .wrapper4{float: left;padding-top:2%;width: 22%;margin-left: 3%;}
		</style>
		<style>
		@media only screen and (min-width: 1551px){
			.upcomming-box .wrapper1{font-size: 3.8rem;margin-left: 9%;}
			.upcomming-box .wrapper3{font-size: 3.8rem;}
		}
		@media only screen and (max-width: 768px){
			.upcomming-box{width: 87%;color: #fff;padding: 10px;margin-bottom: 20px;border-radius: 8px;box-shadow: 3px 4px 1px #00000040;margin-left: 6%;}
			.upcomming-box .wrapper1{width: 27%;font-size: 1rem;margin-left: 6%;padding-top: 3%;}
			.upcomming-box .wrapper2{width: 7%;margin-left: 2%;margin-right: 2%;}
			.upcomming-box .wrapper3{width: 27%;font-size: 1rem;padding-top: 3%;}
			.upcomming-box .wrapper4{float: left;padding-top: 1%;width: 20%;}
			.upcomming-box .wrapper4 img{width: 100%;}
		}
		</style>
<?php
/*
Finame 		: 	sunday_standard_region3
Created On 	: 	15-10-2015
Purpose for	:	Display the Sunday Standard Region 3 
*/
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color 		=	$content['widget_bg_color'];
$widget_custom_title 	=	$content['widget_title'];
$widget_instance_id 	=	$content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= 	$content['sectionID'];
$main_sction_id 		= 	"";
$is_home                = $content['is_home_page'];
$is_summary_required    = $content['widget_values']['cdata-showSummary'];
$widget_section_url     = $content['widget_section_url'];
$view_mode              = $content['mode'];
$max_article         = $content['show_max_article'];
$render_mode         = $content['RenderingMode'];
// widget config block ends
// Here the Design Start 
$domain_name 		    =	base_url();
$show_simple_tab 	    = 	"";
$show_simple_tab 	   .=	' <div class="row">'; // Row Started 
$show_simple_tab 	   .=	'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
//$show_simple_tab 	   .=	'<div class="SundaySecond" '.$widget_bg_color.'>';
$content_type = $content['content_type_id'];
$widget_contents = array();
//getting content block - getting content list based on rendering mode
	//getting content block starts here . Do not change anything
if($render_mode == "manual")
{
$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'], $max_article); 	

$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
	$get_content_ids = implode("," ,$get_content_ids); 

	if($get_content_ids!='')
	{
		$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
		foreach ($widget_instance_contents as $key => $value) {
			foreach ($widget_instance_contents1 as $key1 => $value1) {
				if($value['content_id']==$value1['content_id']){
					$widget_contents[] = array_merge($value, $value1);
				}
			}
		}
	}	
	
					
}
else
{
	$widget_contents = $this->widget_model->get_all_available_articles_auto($max_article, $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
//$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($max_article, $content['sectionID'] , $content_type ,  $content['mode']);
}
//getting content block ends here
//Widget code block - code required for simple tab structure creation. Do not delete
//Widget code block Starts here
// content list iteration block - Looping through content list and adding it the list
// content list iteration block starts here
/*
if (function_exists('array_column')) 
				{
			$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
				}else
				{
			$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
				}
		$get_content_ids = implode("," ,$get_content_ids);

if($get_content_ids!='')
	{
		$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
		
			foreach ($widget_instance_contents as $key => $value) 
			{
				foreach ($widget_instance_contents1 as $key1 => $value1) 
				{
					if($value['content_id']==$value1['content_id'])
					{
					   $widget_contents[] = array_merge($value, $value1);
					}
				}
			} */
	
$i =1;
$count = 1;
if(count($widget_contents)>0)
{
	foreach($widget_contents as $get_content) // For Get Content Start Here 
	{
		                              
		$original_image_path = "";
		$imagealt            = "";
		$imagetitle          = "";
		$custom_title        = "";
		$custom_summary      = "";
		if($render_mode == "manual")
		{
			if($get_content['custom_image_path'] != '')
			{
			$original_image_path = $get_content['custom_image_path'];
			$imagealt            = $get_content['custom_image_title'];	
			$imagetitle          = $get_content['custom_image_alt'];												
			}
			$custom_title   = $get_content['CustomTitle'];
			$custom_summary = $get_content['CustomSummary'];
		}
		if($original_image_path =="")                                                // from cms || live table    
		{
		$original_image_path  = $get_content['ImagePhysicalPath'];
		$imagealt             = $get_content['ImageCaption'];	
		$imagetitle           = $get_content['ImageAlt'];	
		}
		$logo_prefix = ($is_home=='y') ? 'nie' : 'nie';
	    $show_image="";
		if($original_image_path !='' && get_image_source($original_image_path, 1))
		{
			$imagedetails = get_image_source($original_image_path, 2);
			$imagewidth = $imagedetails[0];
			$imageheight = $imagedetails[1];	
		
			if ($imageheight > $imagewidth)
			{
				$Image600X300 	= $original_image_path;
			}
			else
			{
				$Image600X300  = str_replace("original","w600X300", $original_image_path);
			}
			if (get_image_source($Image600X300, 1) && $Image600X300 != '')
			{
			$show_image = image_url. imagelibrary_image_path . $Image600X300;
			}
			else 
			{
			$show_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_600X300.jpg';
			}
			$dummy_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_600X300.jpg';
		}
		else
		{
		$show_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_600X300.jpg';
		$dummy_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_600X300.jpg';
		}
		$content_url = $get_content['url'];
		$param = $content['close_param'];
		$live_article_url = $domain_name.$content_url.$param;
		if( $custom_title == '')
		{
		$custom_title = $get_content['title'];
		}	
		$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
		$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';
		//  Assign article links block ends hers
		// Assign summary block - creating links for  article summary
		// Assign summary block starts here
		if( $custom_summary == '' && $render_mode=="auto")
		{
		$custom_summary =  $get_content['summary_html'];
		}
		$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag
		// Assign summary block starts here
		
		////////  For first Article  /////////
		if($i==1){$show_simple_tab 	   .=	'<div class="SundaySecond" '.$widget_bg_color.'>';}
		/* if($i==1){
			$show_simple_tab.= '<div class="col-lg-10 col-md-10 col-sm-12 col-lg-offset-1 col-md-offset-1 col-xs-12 SundaySecondSplit">';
			$show_simple_tab.=  '<a target="_BLANK" href="https://www.edexlive.com/happening/2021/mar/26/thinkedu-indias-longest-running-largest-education-conclave-is-back-full-schedule-here-19327.html" title="think edu 2021"><div class="upcomming-box">
			<span class="wrapper1">Streaming Now</span>
			<span class="wrapper2"><img title="Think Edu 2021" src="thinkedu-2017-logo.png" alt="Thinkedu-2021"></span>
			<span class="wrapper3">ThinkEdu 2021</span>
			<span class="wrapper4"><img title="Think Edu 2021" src="title-partner.jpg" alt="Thinkedu-2021q" style="border: 1px solid #f5d90f;"></span>
		</div></a>';
			$show_simple_tab.=  '</div>';
		} */
		if($count <= 3)
		{
			if($count==1)
			{
			
			$show_simple_tab.= '<div class="WidthFloat_L">'; 
			} 
			
		$show_simple_tab.= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 SundaySecondSplit">';
		$show_simple_tab.= '<a  href="'.$live_article_url.'" class="article_click"  >
		<img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'" width="600" height="300"></a>';
		$show_simple_tab .='<h4 class="subtopic">'.$display_title.'</h4>';
		if($is_summary_required== 1)
		{
		$show_simple_tab.='<p class="summary">'.$summary.'</p>';
		}
		$show_simple_tab.= '</div>';
		if($widget_instance_id==1592 && $i==2){
			$show_simple_tab.= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 SundaySecondSplit">';
			$show_simple_tab.= '<a  href="https://www.edexlive.com/campus/2021/may/04/st-georges-univ-ramaiah-work-togetherfor-aspiring-med-students-to-obtain-degrees-20336.html" class="article_click"  ><img src="https://images.edexlive.com/uploads/user/imagelibrary/2021/5/4/w600X300/Logo_2_1.png" data-src="https://images.edexlive.com/uploads/user/imagelibrary/2021/5/4/w600X300/Logo_2_1.png" title = "Logo_(2)_(1)" alt = "Logo_(2)_(1)">';
			$show_simple_tab .='<h4 class="subtopic"><a href="https://www.edexlive.com/campus/2021/may/04/st-georges-univ-ramaiah-work-togetherfor-aspiring-med-students-to-obtain-degrees-20336.html" title="St. George’s University & Ramaiah Group of Institutions are working together to enable aspiring medical students to obtain an internationally recognized degree">St. George’s University & Ramaiah Group of Institutions are working together to enable aspiring medical students to obtain an internationally recognized degree</a></h4></a>';
			$show_simple_tab.='<p class="summary">Both Ramaiah Group and SGU have medical schools with over 40 years of successful teaching and an excellent track record of top-rung medical candidates</p>';
			$show_simple_tab.= '</div>';
			$count=3;
		}
		if($count==3 )
		{
			 
		$show_simple_tab.=  '</div>';
		//$show_simple_tab .='</div>';
		
		$count=0;
		
		} 
		
			if($i == count($widget_contents))
			{
				if($i%3!=0)
				{
				//$show_simple_tab.=  '</div>';
				$show_simple_tab .='</div>';
				} 
			$show_simple_tab .='</div>';
			}
		$count ++;	
		}
		
		//if($i==)
		// display title and summary block ends here					
		//Widget design code block 1 starts here																
		//Widget design code block 1 starts here			
		$i =$i+1;							  
		} // For Get Content Start Here 	
	// content list iteration block ends here
      //}
  }
 elseif($view_mode=="adminview")
{
$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
}

// Adding content Block ends here
//$show_simple_tab.=  '</div>'; //  WidthFloat_L for Last Dic close 
//$show_simple_tab .='</div>';// SundaySecond
$show_simple_tab .='</div>';// col-lg-12
$show_simple_tab .='</div>';
// Row End 

echo $show_simple_tab;
?>
