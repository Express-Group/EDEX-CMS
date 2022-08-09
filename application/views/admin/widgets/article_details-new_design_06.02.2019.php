<style>
.remodal .SectionContainer{padding:0;}
.article-wrapper{width: 80%;margin: 2% 10% 0;float: left;}
.article-wrapper #stroydetails{width:25%;float:left;}
.article-wrapper #storyContent{width:50%;float:left;margin:0;}
#stroydetails .articles_social_icons{float:left;margin:0;}
#stroydetails .articles_social_icons a{float:left;width:100%;margin-top:15px;}
#stroydetails .articles_social_icons a img{width:35px;}
#stroydetails .articles_social_icons a .share-txt{margin: 3.3% 0 0 2%;float: left;font-weight: normal;}
#stroydetails p{font-size: 15px;font-weight: normal;margin: 3px 0 3px;}
#stroydetails p a{color: #000;text-decoration: underline;font-weight:bold;}
.AticleImgBottom{text-align: center !important;}
.ArticleHead{width: 70%;float: left;margin: 0 15% 0;text-align: center;line-height: 53px;}
.article_summary{width: 70%;float: left;margin: 1% 15% 1%;}
.straptxt p{padding:0;text-align: center;}
</style>
<article class="WidthFloat_L printthis">
<?php
					$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
				    $content_id= $content['content_id'];
					$content_type_id = $content['content_type'];
					$view_mode          = $content['mode'];
					if($content_id!=''){
										 
					if($content['content_from'] =="live"){
					//$content_details = $this->widget_model->widget_article_content_by_id($content_id, $content_type_id, ""); from live
					$content_details = $content['detail_content'];   // from Template Controller
					}else if($content['content_from']=="archive"){
		            $content_details = $content['detail_content'];
					}
					$content_det= $content_details[0];
					
					$section_id = $content_det['section_id'];
					
					//print_r($content_det);exit;
					$domain_name =  base_url();
					$article_url = $domain_name.$content_det['url'];
					$metatitle = $content_det['meta_Title'];
					$section_details = $this->widget_model->get_sectionDetails($section_id, $view_mode);
					$home_section_name = 'Home';
					$child_section_name = $section_details['Sectionname'];
					$child_section_name1 = $section_details['URLSectionStructure'];
					$url_structure       = $section_details['URLSectionStructure'];
					$sub_section_name = 'Home';
					if($section_details['IsSubSection'] =='1'&& $section_details['ParentSectionID']!=''&& $section_details['ParentSectionID']!=0 ){
					$sub_section = $this->widget_model->get_sectionDetails($section_details['ParentSectionID'], $view_mode);
					$sub_section_name = ($sub_section['Sectionname']!='')? $sub_section['Sectionname'] : '' ;
					$sub_section_name1= $sub_section['URLSectionStructure'];
					 if($sub_section['IsSubSection'] =='1'&& $sub_section['ParentSectionID']!=''&& $sub_section['ParentSectionID']!=0 ){
					$grand_sub_section = $this->widget_model->get_sectionDetails($sub_section['ParentSectionID'], $view_mode);
					$grand_parent_section_name = $grand_sub_section['Sectionname'];
					$grand_parent_section_name1 = $grand_sub_section['URLSectionStructure'];
					$section_link = '<a href="'.$domain_name.'">'.$home_section_name.'</a> <i class="fa fa-angle-right"></i> <a href="'.$domain_name.$grand_parent_section_name1.'">'.$grand_parent_section_name.'</a> <i class="fa fa-angle-right"></i> <a href="'.$domain_name.$sub_section_name1.'">'.$sub_section_name.'</a> <i class="fa fa-angle-right"></i> <a href="'.$domain_name.$child_section_name1.'">'.$child_section_name.'</a>';
					}else{
					$section_link = '<a href='.$domain_name.' >'.$home_section_name.'</a> <i class="fa fa-angle-right"></i> <a href='.$domain_name.$sub_section_name1.' >'.$sub_section_name.'</a> <i class="fa fa-angle-right"></i> <a href='.$domain_name.$child_section_name1.' >'.$child_section_name.'</a>';
					}
					}elseif(strtolower($child_section_name) != "home"){
					$section_link = '<a href= '.$domain_name.' >'.$home_section_name.'</a> <i class="fa fa-angle-right"></i> <a href='.$domain_name.$child_section_name1.' >'.$child_section_name.'</a>';
					}elseif(strtolower($child_section_name) == "home" || strtolower($child_section_name) == "home"){
					$section_link = '<a href= '.$domain_name.' >'.$home_section_name.'</a>';
					}
				  /*  edited to hide breadcrumb
				  echo '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
				  echo '<div class="bcrums"> 
				   '.$section_link.'  </div>
				  </div>
				  </div>'; */
				  ?>
<!--<script src="DWConfiguration/ActiveContent/IncludeFiles/AC_RunActiveContent.js" type="text/javascript"></script>-->


<div class="row">
	<div class="article_tag">
		<?php 
		$article_tags= $content_det['tags'];
        $get_tags =array();
		if($article_tags!='')
		$get_tags=  explode(",", $article_tags);
		if(count($get_tags)>0){
		?>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ArticleDetail">
		<div class="tags">
		 <!-- <div> <span>TAGS</span> </div>-->
		  <?php $tgcount=1; foreach($get_tags as $tag){
				if($tag!='' && $tgcount ==1){
					$tag_title = join( "_",( explode(" ", trim($tag) ) ) );
					$tag_url_title = preg_replace('/[^A-Za-z0-9\_]/', '', $tag_title); 
					$tag_link = base_url().'topic/'.$tag_url_title; 
					echo '<a href="'.$tag_link.'">'.$tag.'</a>';
					$tgcount++;
					}
				} ?>
		</div>
	</div>
  <?php $pub_col='6'; }else{ $pub_col='12';  }  ?>
	  <div class="col-lg-<?php print $pub_col; ?> col-md-<?php print $pub_col; ?> col-sm-12 col-xs-12 ArticleDetail">
		<?php
		 $published_date = date('dS  F Y ' , strtotime($content_det['publish_start_date']));
		?>
		 <div class="article_published_date"><p class="ArticlePublish"> Published: <span><?php echo $published_date;?></span>&nbsp;&nbsp;&nbsp;&nbsp; </p></div>
	  </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ArticleDetail">
    <?php 		
					//////  For Article title  ////		
					$content_title = $content_det['title'];
					if( $content_title != '')
					{
						//$content_title = stripslashes(preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $content_title));
						$content_title = stripslashes(strip_tags($content_title, '</p>'));
					}
					else
					{
						$content_title = '';
					}
                    $content_url = '';
					$page_index_number = '';
					if($content_type_id ==1){	
					$linked_to_columnist = $content_det['author_name'];
					$author_name    = $content_det['author_name'];
					$summary_html   = $content_det['summary_html'];
					$author_image   = $content_det['author_image_path'];
					$agency_name    = $content_det['agency_name'];
					$is_author      = ($content_det['author_name']!='')? 1 : 0;
					$is_agency      = ($content_det['agency_name']!='')? 1 : 0;
					$author_pos     = stripos($author_name, $child_section_name);
				   // $author_url     = ($author_pos === false)? "author/".join("-", explode(" ", $author_name)) : "columns/".join("-", explode(" ", $author_name));
					$author_url     = ($author_pos === false)? "author/".join("-", explode(" ", $author_name)) : $child_section_name1;
					$author_url_new     = 'authors/?q='.str_replace(' ','-',$author_name);
					}else{
					$is_author      = 0;
					$is_agency      = ($content_det['agency_name']!='')? 1 : 0;
					$author_name    = '';
					$agency_name    = $content_det['agency_name'];
					}
					
				   $published_date = date('dS  F Y ' , strtotime($content_det['publish_start_date']));
				   $last_updated_date  = date('dS  F Y ' , strtotime($content_det['last_updated_on']));
				   $allow_social_btn= 1; //$content_det['allow_social_button'];
				   $allow_comments= $content_det['allow_comments'];
				
				   $email_shared = 0; //$content_det['emailed'];
				   if ($email_shared > 999 && $email_shared <= 999999) {
					$email_shared = round($email_shared / 1000, 1).'K';
				   } else if ($email_shared > 999999) {
				   $email_shared = round($email_shared / 1000000, 1).'M';
				   } else {
					$email_shared = $email_shared;
				   }
				   $publish_start_date = $content_det['publish_start_date'];
					?>
    <h1 class="ArticleHead" e-metatitle="<?php echo $metatitle; ?>" id="content_head" itemprop="name"><?php echo $content_title;?></h1>
     <div class="straptxt article_summary"><?php echo $summary_html;?></div>
	  <?php  if($author_image!=''){?> 
   <div class="strapimg"><img class="img-circle" alt="" src="<?php echo image_url.$author_image;?>"></div>
   <?php if($is_author==1 && $is_agency==1){ ?>
   <div class="author_name"><span><a href="<?php echo base_url().$author_url_new;?>" target="_blank"><?php echo $author_name;?></a></span></span> <br>
        <div class="author_pro"><span>Edex Live</span></div></div>

      <?php }else if($author_name!=''){ ?>
      <div class="author_name"><span><a href="<?php echo base_url().$author_url_new;?>" target="_blank"><?php echo $author_name;?></a></span></span> <br>
        <div class="author_pro"><span>Edex Live</span></div></div>
      <?php }else if($agency_name!=''){ ?>
      <div class="author_name"><span><?php echo $agency_name;?></span> <br>
        <div class="author_pro"><span>Edex Live</span></div></div>
      <?php } ?>
   <?php }
   else
   { ?>
   <div class="strapimg"><img class="img-circle" alt="" src="<?php echo image_url ?>images/static_img/no_author.jpg"></div>
  <?php if($is_author==1 && $is_agency==1){ ?>
      <div class="author_name"><span><a href="<?php echo base_url().$author_url_new;?>" target="_blank"><?php echo $author_name;?></a></span></span> <br>
        <div class="author_pro"><span>Edex Live</span></div></div>
      <?php }else if($author_name!=''){ ?>
     <div class="author_name"><span><a href="<?php echo base_url().$author_url_new;?>" target="_blank"><?php echo $author_name;?></a></span></span> <br>
        <div class="author_pro"><span>Edex Live</span></div></div>
      <?php }else if($agency_name!=''){ ?>
      <div class="author_name"><span><?php echo $agency_name;?></span> <br>
        <div class="author_pro"><span>Edex Live</span></div></div>

      <?php } ?>
   <?php
   } ?>
 
     <?php if($allow_social_btn==1) { ?>
	 <div class="Social_Font"> <div class="PrintSocial articles_social_icons"> 
		<div class="social_icon_count"><span class="article_fb_count"><span id="article_fb_count">0</span><span class="fb_ext"></span></span><br><span class="article_fb_shares">shares</span></div><a href="javascript:;" class="csbuttons" data-type="facebook" data-count="true"><img src="<?php echo image_url ?>images/static_img/fb.png?" class="img-responsive"></a>
		<a class="csbuttons" data-type="twitter" data-txt="<?php echo strip_tags($content_title);?>" data-via="xpress_edex" data-count="true"><img src="<?php echo image_url ?>images/static_img/twitter.png" class="img-responsive"></a>
		<a href="https://www.linkedin.com/shareArticle?url=<?php echo $article_url;?>&mini=true" target="_blank"><img src="<?php echo image_url ?>images/static_img/linkedin.png" class="img-responsive"></a>
		<!--<a><img src="<?php echo image_url ?>images/static_img/instagram.png" class="img-responsive"></a>-->
		<a class="whatsapp" href="" data-txt="<?php echo strip_tags($content_title);?>" data-link="<?php echo $article_url;?>"><img src="<?php echo image_url ?>images/static_img/whatsapp.png" class="img-responsive"></a>
		<a class="Share_Icons PositionRelative"><img  id="popoverId" src="<?php echo image_url ?>images/static_img/email.png" class="img-responsive"></a>
		 <div id="popover-content" class="popover_mail_form fade right in ">
          <div class="arrow"></div>
          <h3 class="popover-title">Share Via Email</h3>
          <div class="popover-content">
            <form class="form-inline Mail_Tooltip" action="<?php echo base_url(); ?>user/commonwidget/share_article_via_email" name="mail_share" method="post" id="mail_share" role="form">
              <div class="form-group">
                <input type="text" placeholder="Name" name="sender_name" id="name" class="form-control">
                <input type="text" placeholder="Your Mail" name="share_email" id="share_email" class="form-control">
                <input type="text" placeholder="Friends's Mail" name="refer_email" id="refer_email" class="form-control">
                <textarea placeholder="Type your Message" class="form-control" name="message" id="message"></textarea>
                <input type="hidden"  class="content_id" name="content_id" value="<?php echo $content_id;?>" />
                <input type="hidden"  class="section_id" name="section_id" value="<?php echo $section_id;?>" />
                <input type="hidden"  class="content_type_id" name="content_type_id" value="<?php echo $content_type_id;?>" />
                <input type="hidden"  class="article_created_on" name="article_created_on" value="<?php echo $publish_start_date;?>" />
                <input type="reset" value="Reset" class="submit_to_email submit_post">
                <!--<input type="submit" value="share" class="submit_to_email submit_post" name="submit">-->
               <input type="button" value="Share" id="share_submit" class="submit_to_email submit_post" onclick="mail_form_validate();" name="submit">
              </div>
            </form>
          </div>
        </div>
	 </div>
	 </div>
	
    <?php  } ?>
    <!--  <?php  //if($content_type_id!= 1){ ?>
      Last Updated: <span><?php //echo $last_updated_date;?></span>&nbsp;&nbsp;
    <p></p>
    <?php //} ?>
    </p>
    <?php  //if($content_type_id=='1'){ ?>
    <p class="ArticlePublish margin-bottom-10"> Last Updated: <span><?php echo $last_updated_date;?></span>&nbsp;&nbsp;|&nbsp;&nbsp; <span class="FontSize" id="incfont" data-toggle="tooltip" title="Zoom In">A+</span><span class="FontSize" id="resetMe" data-toggle="tooltip" title="Reset">A&nbsp;</span><span class="FontSize" id="decfont" data-toggle="tooltip" title="Zoom Out">A-</span> <span id="print_article">&nbsp;&nbsp;|&nbsp;&nbsp;<i class="fa fa-print"></i></span></p>
    <?php //} ?>
    <div class="vuukle-powerbar"></div>-->
   
  </div>
</div>
<?php
	  
	/* ------------------------------------- Article content Type --------------------------------------------*/	
				  
	if($content_type_id=='1'){
	
	$article_body_text =  stripslashes($content_det['article_page_content_html']);	
	$article_body_text  = str_replace('http://images.edexlive.com/' , image_url , $article_body_text);
	
	$Image600X390      = str_replace(' ', "%20", $content_det['article_page_image_path']);
	
	if (getimagesize(image_url_no . imagelibrary_image_path . $Image600X390) && $Image600X390 != '')
	{
	$imagedetails = getimagesize(image_url_no . imagelibrary_image_path.$Image600X390);
	$imagewidth = $imagedetails[0];
	$imageheight = $imagedetails[1];
	
	if ($imageheight > $imagewidth)
	{
		$Image600X390 	= $content_det['article_page_image_path'];
	}
	else
	{				
		//$Image600X390 	= str_replace("original","w600X390", $content_det['article_page_image_path']);
		$Image600X390 	= $content_det['article_page_image_path'];
	}
	$image_path='';
	
		$image_path = image_url. imagelibrary_image_path . $Image600X390;
		
	}
	else{
	$image_path='';
	$image_caption='';	
	}
	$show_image = ($image_path != '') ? $image_path : "no_image";
	$image_caption= $content_det['article_page_image_title'];
	$image_alt =  $content_det['article_page_image_alt'];
	$content_url       = base_url().$content_det['url'];
	$page_index_number = ($content_det['allow_pagination']==1)? $content['image_number'] : "no_pagination";
	$special_class     = (strtolower($section_details['Sectionname'])=="specials")? 'special_class': '';
	?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ArticleDetail ArticleDetailContent <?php echo $special_class;?>">
  <div id="content" class="content" itemprop="description">
    <?php if($show_image!='no_image'){ ?>
    <figure class="AticleImg open_image">
      <div class="image-Zoomin"><i class="fa fa-search-plus"></i><i class="fa fa-search-minus"></i></div>
      <img src="<?php echo $show_image;?>" title="<?php echo $image_caption;?>" alt="<?php echo $image_alt;?>" itemprop="image">
      <?php if($image_caption!=''){ ?>
      <p class="AticleImgBottom"><?php echo strip_tags($image_caption);?></p>
      <?php } ?>
    </figure>
    <?php } ?>
	<div class="article-wrapper">
		<div id="stroydetails">
			<p><?php echo $published_date;?></p>
			<?php if($is_author==1 && $is_agency==1){ ?>
				<p><a href="<?php echo base_url().$author_url_new;?>" target="_blank"><?php echo $author_name;?></a></p>
			<?php }else if($author_name!=''){ ?>
				<p><a href="<?php echo base_url().$author_url_new;?>" target="_blank"><?php echo $author_name;?></a></p>
			<?php }else if($agency_name!=''){ ?>
				<p><?php echo $agency_name;?></p>
			<?php } ?>
			<?php if($allow_social_btn==1) { ?>
			 <div class="Social_Font"> 
				<div class="PrintSocial articles_social_icons"> 
					<a href="javascript:;" class="csbuttons" data-type="facebook" data-count="true"><img src="<?php echo image_url ?>images/static_img/fb.png?" class="img-responsive"><span class="share-txt" style="color: #136ca8;">Share</span></a>
					
					<a class="csbuttons" data-type="twitter" data-txt="<?php echo strip_tags($content_title);?>" data-via="xpress_edex" data-count="true"><img src="<?php echo image_url ?>images/static_img/twitter.png" class="img-responsive"><span class="share-txt" style="color: #1db4c8;">Tweet</span></a>
					
					<a href="https://www.linkedin.com/shareArticle?url=<?php echo $article_url;?>&mini=true" target="_blank"><img src="<?php echo image_url ?>images/static_img/linkedin.png" class="img-responsive"><span class="share-txt" style="color: #2D85EC;">Share</span></a>
					
					<a class="whatsapp" href="" data-txt="<?php echo strip_tags($content_title);?>" data-link="<?php echo $article_url;?>"><img src="<?php echo image_url ?>images/static_img/whatsapp.png" class="img-responsive"></a>
					
					<a class="Share_Icons PositionRelative"><img  id="popoverId" src="<?php echo image_url ?>images/static_img/email.png" class="img-responsive"><span class="share-txt" style="color: #389157;">Email</span></a>
					
					 <div id="popover-content" class="popover_mail_form fade right in ">
					  <div class="arrow"></div>
					  <h3 class="popover-title">Share Via Email</h3>
					  <div class="popover-content">
						<form class="form-inline Mail_Tooltip" action="<?php echo base_url(); ?>user/commonwidget/share_article_via_email" name="mail_share" method="post" id="mail_share" role="form">
						  <div class="form-group">
							<input type="text" placeholder="Name" name="sender_name" id="name" class="form-control">
							<input type="text" placeholder="Your Mail" name="share_email" id="share_email" class="form-control">
							<input type="text" placeholder="Friends's Mail" name="refer_email" id="refer_email" class="form-control">
							<textarea placeholder="Type your Message" class="form-control" name="message" id="message"></textarea>
							<input type="hidden"  class="content_id" name="content_id" value="<?php echo $content_id;?>" />
							<input type="hidden"  class="section_id" name="section_id" value="<?php echo $section_id;?>" />
							<input type="hidden"  class="content_type_id" name="content_type_id" value="<?php echo $content_type_id;?>" />
							<input type="hidden"  class="article_created_on" name="article_created_on" value="<?php echo $publish_start_date;?>" />
							<input type="reset" value="Reset" class="submit_to_email submit_post">
							<!--<input type="submit" value="share" class="submit_to_email submit_post" name="submit">-->
						   <input type="button" value="Share" id="share_submit" class="submit_to_email submit_post" onclick="mail_form_validate();" name="submit">
						  </div>
						</form>
					  </div>
					 </div>
				</div>
			 </div>
			<?php  } ?>
		</div>
		<div id="storyContent">
			<?php echo $article_body_text; ?> 
		</div>
	</div>
     
	<style>
	.tags-bottom span{color: #000000;font-size: 20px;padding-top: 13px;	}
	.tags-bottom a{padding: 10px 15px;border-bottom:none;border: 2px solid #eee;border-radius: 26px;background: #f4981d;color:#fff;}
	</style>
	<?php if(count($get_tags) > 0): ?>
	<div class="tags tags-bottom">
		<div> <span>TAGS</span> </div>
		 <?php 
		 foreach($get_tags as $tag){
			if($tag!=''){
				$tag_title = join( "_",( explode(" ", trim($tag) ) ) );
				$tag_url_title = preg_replace('/[^A-Za-z0-9\_]/', '', $tag_title); 
				$tag_link = base_url().'topic/'.$tag_url_title; 
				echo '<a href="'.$tag_link.'">'.$tag.'</a>';
				$tgcount++;
			}
		} ?>
	</div>
	<?php endif; ?>
    </div>
  <?php 
	  if($content['content_from']=="live"){
	 $Related_article_content = $this->widget_model->get_related_article_by_contentid($content_id, $content['content_from']);
	 if(count($Related_article_content)>0){
	 ?>
  <ul class="RelatedArticle" style="display:none;">
    <div class="RelatedArt">Related Article</div>
    <?php foreach ($Related_article_content as $get_article){
		$relatedarticle_title = strip_tags($get_article['related_articletitle']);
		$related_url          = $get_article['related_articleurl'];
		$param                = $content['close_param'];
		$domain_name          =  base_url();
		$related_article_url  = $domain_name.$related_url.$param;
		?>
    <li><a href="<?php echo $related_article_url;?>"  class="article_click" target="_blank"><i class="fa fa-angle-right"></i><?php echo $relatedarticle_title;?></a></li>
    <?php  } }?>
  </ul>
  <?php }elseif($content['content_from']=="archive"){
	 $live_query_string 	    = explode("/",$this->uri->uri_string());
	 $year                      = $live_query_string[count($live_query_string)-4];
	 $table                     = "relatedcontent_".$year;
	 $Related_article_content = $this->widget_model->get_related_article_from_archieve($content_id, $table);
	 if(count($Related_article_content)>0){
	 ?>
  <ul class="RelatedArticle" style="display:none;">
    <div class="RelatedArt">Related Article</div>
    <?php foreach ($Related_article_content as $get_article){
		$relatedarticle_title = strip_tags($get_article['related_articletitle']);
		$related_url          = $get_article['related_articleurl'];
		$param                = $content['close_param'];
		$domain_name          =  base_url();
		$related_article_url  = $domain_name.$related_url.$param;
		?>
    <li><a href="<?php echo $related_article_url;?>"  class="article_click" target="_blank"><i class="fa fa-angle-right"></i><?php echo $relatedarticle_title;?></a></li>
    <?php  } }?>
  </ul>
  <?php }
	  ?>
  <!--<div class="pagination pagina">
    <ul>
      <li><a href="javascript:;" id="prev" class="prevnext element-disabled">« Previous</a></li>
      <li><a href="javascript:;" id="next" class="prevnext">Next »</a></li>
    </ul>
    <br />
  </div>-->
  <div class="text-center">
  <ul class="article_pagination" id="article_pagination">
    </ul></div>
  <div id="keywordline"></div>
</div>
<?php }
	/* ------------------------------------- Gallery content Type --------------------------------------------*/	
else if($content_type_id=='3'){ 
$get_gallery_images	 = $content_details;
$image_number        = $content['image_number'];
$content_url         = base_url().$content_details[0]['url'];
$page_index_number   = $content['image_number'];
?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 features">
  <?php if(count($get_gallery_images)> 1){ ?>
  <div class="text-center play-pause-icon"> <span id="auto-play" class="cursor-pointer"><i class="fa fa-play" title="Play"></i> </span> </div>
  <?php } ?>
  <div class="slide GalleryDetail GalleryDetailSlide" style="width:100% !important">
    <?php foreach($get_gallery_images as $gallery_image){ 
				  
                  $gallery_caption = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $gallery_image['gallery_image_title']);
				  $gallery_alt =  $gallery_image['gallery_image_alt'];
				  $Image600X390= str_replace(' ', "%20",$gallery_image['gallery_image_path']);
				  if (getimagesize(image_url . imagelibrary_image_path . $Image600X390) && $Image600X390 != '')
					{
				  $imagedetails = getimagesize(image_url . imagelibrary_image_path.$Image600X390);
					$imagewidth = $imagedetails[0];
                    $imageheight = $imagedetails[1];
					if ($imageheight > $imagewidth)
					{
						$Image600X390 	= $gallery_image['gallery_image_path'];
						$is_verticle    = 'style="width:100%"';
					}else if($imagewidth > 600 && $imagewidth < 700) // minimum width image
					{				
						$Image600X390 	= $gallery_image['gallery_image_path'];
						$is_verticle    = 'style="width:100%"'; 
					}
					else if($imagewidth < 600) // minimum width image
					{				
						$Image600X390 	= $gallery_image['gallery_image_path'];
						$is_verticle    = 'style="width:100%"'; //'class="gallery_minimum_pixel"';
					}else  // normal image
					{				
						$Image600X390 	= $gallery_image['gallery_image_path'];
						$is_verticle    = '';
					}
						$show_gallery_image = image_url. imagelibrary_image_path . $Image600X390;
					}else{
						$show_gallery_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
						$is_verticle        = '';
					}
                  ?>
    <div class="item">
      <figure class="PositionRelative"> <img src="<?php echo $show_gallery_image;?>" title="<?php echo $gallery_caption;?>" alt="<?php echo $gallery_alt;?>" <?php echo $is_verticle;?>>
       <?php if($gallery_caption!=''){ ?>
        <div class="TransLarge Font14"><?php echo $gallery_caption;?></div>
         <?php } ?>
      </figure>
    </div>
    <?php 
					 } ?>
  </div>
  <?php if(count($get_gallery_images)> 1){ ?>
  <div class="text-center">
    <ul class="gallery_pagination" id="gallery_pagination">
    </ul>
  </div>
  <?php } ?>
    <script>
var currentimageIndex = "<?php echo (($image_number)> count($get_gallery_images))? 1: $image_number;  ?>";
var TotalIndex = "<?php echo (count($get_gallery_images));  ?>";
$( document ).ready(function() {
$('html').addClass('gallery_video_remodal');
<?php if(($image_number) > 1 ){ ?>
 $('.GalleryDetailSlide').slick('slickGoTo', <?php echo $image_number-1;?>);
<?php } ?>
});
</script>
  <div id="keywordline"></div>
</div>
<?php 
							}
						/* ------------------------------------- Video content Type --------------------------------------------*/	
							else if($content_type_id=='4')
							{    
							 $video_scipt       = htmlspecialchars_decode($content_det['video_script']);
							 $video_description = $content_det['summary_html'];
							 $content_url       = base_url().$content_det['url'];
						?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="videodetail" style="text-align: center;">
    <?php if($content_det['video_site']=='ventunovideo'){ 
	//$video_scipt = trim(stripslashes($video_scipt),'"');
	?>
    <script type="text/javascript">
AC_FL_RunContent( 'width','630','height','441','id','ventuno_player_0','src','http://cfplayer.ventunotech.com/player/vtn_player_2?vID==<?php echo $video_scipt;?>','wmode','transparent','allownetworking','all','allowscriptaccess','always','allowfullscreen','true','movie','http://cfplayer.ventunotech.com/player/vtn_player_2?vID==<?php echo $video_scipt;?>' ); //end AC code
</script><noscript><object width="630" height="441" id="ventuno_player_0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
      <param name="movie" value="http://cfplayer.ventunotech.com/player/vtn_player_2.swf?vID==<?php echo $video_scipt;?>"/>
      <param name="allowscriptaccess" value="always"/>
      <param name="allowFullScreen" value="true"/>
      <param name="wmode" value="transparent"/>
      <embed src="http://cfplayer.ventunotech.com/player/vtn_player_2.swf?vID==<?php echo $video_scipt;?>" width="630" height="441" 
wmode="transparent" allownetworking="all" allowscriptaccess="always" allowfullscreen="true"></embed>
    </object></noscript>
    <?php }else{
		echo $video_scipt;
	}
		 ?>
  </div>
  <p> <?php echo $video_description;?></p>
  <div id="keywordline"></div>
</div>
<script>
						 $( document ).ready(function() {
						 $('html').addClass('gallery_video_remodal');
						});
						</script>
<?php 
							}
					/* ------------------------------------- Audio content Type --------------------------------------------*/	
							else 
							{ 
							 $audio_path       = image_url. audio_source_path.$content_det['audio_path'];
							 $audio_description = $content_det['summary_html'];
							 $content_url       = base_url().$content_det['url'];
							?>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="">
      <audio class="margin-left-10 margin-top-5" controls="" src="<?php echo $audio_path;?>"> </audio>
      <p> <?php echo $audio_description;?></p>
    </div>
    <div id="keywordline"></div>
  </div>
  <?php	}
}?>
  <input type="hidden" value="<?php print $article_url; ?>" class="random_url">
</div>

                                
</article>
<div class="NextArticle FixedOptions" style="display:none;">
  <?php
					//$time1 = microtime(true);
					$prev_article = $this->widget_model->get_section_previous_article($content['content_id'], $content_det['section_id'],$content_type_id);
					$next_article = $this->widget_model->get_section_next_article($content['content_id'], $content_det['section_id'],$content_type_id);
										
//$time2 = microtime(true);
//echo "script execution time: ".($time2-$time1); //value in seconds				

					//print_r($select_section_prev_article);exit;
					?>
  <?php if(count($prev_article)> 0){
					$prev_content_id = $prev_article['content_id'];
					$prev_section_id = $prev_article['section_id'];
					$param = $content['close_param'];
					$prev_string_value = $domain_name.$prev_article['url'].$param;
	                 ?>
  <a class="prev_article_click LeftArrow" style="display:none !important;" href="<?php echo $prev_string_value;?>" title="<?php echo strip_tags($prev_article['title']);?>"><i class="fa fa-chevron-left"></i></a>
  <?php } ?>
  <?php if(count($next_article)> 0){
					$next_content_id = $next_article['content_id'];
					$next_section_id = $next_article['section_id'];
					$param = $content['close_param'];
					$next_string_value = $domain_name.$next_article['url'].$param;
					?>
  <a class="next_article_click RightArrow" style="display:none !important;" href="<?php echo $next_string_value;?>" title="<?php echo strip_tags($next_article['title']);?>"><i class="fa fa-chevron-right"></i></a>
  <?php } ?>
 <?php //$bitly = getSmallLink($content_url); 
       $bitly_url = "";//$bitly['id'];
	   $bitly_message = "";//$bitly['msg'];
 ?>
</div>
<!--style overwriting editor body content-->
<style>
.ArticleDetailContent li{float: none; list-style: inherit;}
.ArticleDetailContent blockquote {
    padding-left: 20px !important;
    padding-right: 8px !important;
    border-left-width: 5px;
    border-color: #ccc;
    font-style: italic;
	margin:10px 0 !important;
	padding: 12px 16px !important;
	font-size:13px !important;
}
.ArticleDetailContent blockquote p{font-size:13px !important;text-align:center;}
@media screen and ( max-width: 768px){
 audio { width:100%;}
}
</style>
<script type="text/javascript">
            $(document).ready(function() {
                $(document).on("click",".whatsapp", function(e) {
					e.preventDefault();
                    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

                        var article = $(this).attr("data-txt");
                        var weburl = $(this).attr("data-link");
                        var whats_app_message = article +" - "+weburl;
                        var whatsapp_url = "whatsapp://send?text="+whats_app_message;
                        window.location.href= whatsapp_url;
						//alert(whatsapp_url);
                    }/* else{
                        alert('you are not using mobile device.');
                    } */
                });
            });
</script>
<script type="text/javascript">
	var base_url        = "<?php echo base_url(); ?>";
	var content_id      = "<?php echo $content_id; ?>";
	var content_type_id = "<?php echo $content_type_id; ?>";
	var page_Indexid    = "<?php echo $page_index_number; ?>";
	var section_id      = "<?php echo $section_id; ?>";
	//location.reload(true);
	var content_url     = "<?php echo $content_url; ?>";
	var page_param      = "<?php echo $content['page_param']; ?>";
	var content_from    = "<?php echo $content['content_from']; ?>";
	var bitly_url       = "<?php echo $bitly_url;?>";
	var bitly_message   = "<?php echo $bitly_message;?>";
</script>
<div class="recent_news">
<div id="topover" class="slide-open" style="visibility: hidden;">
  <p>O<br>
    P<br>
    E<br>
    N</p>
</div>
</div>
<script src="<?php echo image_url; ?>js/FrontEnd/js/remodal-article.js"></script>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<script id="dsq-count-scr" src="//www-edexlive-com.disqus.com/count.js" async></script>
<?php //echo "open me";exit;?>
<input type="hidden" id="scrollContentID" value="<?php echo @$content_id ?>">
<input type="hidden" id="ArticleCountCheck" value="1">
<input type="hidden" id="CurrentArticleID" value="<?php echo @$content_id ?>">
<script>
var ajaxTriggered = true;
var atitle = $('title').html();
$(window).scroll(function() {
	var documentHeight = $(document).height();
	var onScroll = $(window).scrollTop() +  $(window).height();
	var getPercentage = (documentHeight * 40)/100;
	var percentageHeight = documentHeight - getPercentage;
	var contentType = "<?php echo @$content_type_id ?>";
	var articleId = $("#scrollContentID").val();
	var sectionId = "<?php echo @$section_id ?>";
	var contentBlock = ($('article').length - 1);
	var changeUrl = $('article').eq([contentBlock]).find('.random_url').val();
	var changeTitle = $('article').eq([contentBlock]).find('.ArticleHead').text();
	var dynamicClass = 'article-rendered-onscroll-'+(contentBlock);
	var articleCountCheck = parseInt($('#ArticleCountCheck').val());
	var currentArticleId = $('#CurrentArticleID').val();
	$('article').each(function(index){
		var sOffset = $(this).offset().top;
		//var shareheight = $(this).height();
		 var scrollYpos = $(document).scrollTop();
		 if (scrollYpos > sOffset) {
			changeUrl = $(this).find('.random_url').val();
			changeTitle = $(this).find('.ArticleHead').attr('e-metatitle');
		 }
		 if(scrollYpos < 300){
			changeUrl = $('article').eq([0]).find('.random_url').val();
			changeTitle = atitle;
		 }
	});
	$('title').eq(0).html(changeTitle +' - Edexlive');
	window.history.pushState('load', 'page', changeUrl);
	if(onScroll >= percentageHeight  && articleCountCheck < 6){
		if(ajaxTriggered){
			ajaxTriggered=false;
			 var ajaxRequest =$.ajax({
				beforeSend : function(){
					$('article').eq([contentBlock]).after("<article class='WidthFloat_L printthis "+dynamicClass+"' style='margin-top:15px;'><span style='width:100%;float:left;text-align:center;font-size:26px;color:#f4981d;'><i class='fa fa-circle-o-notch fa-spin' aria-hidden='true'></i></span></article>");
				},
				url :'<?php print BASEURL ?>user/commonwidget/nextArticle',
				method : 'post',
				data : {'contentType' : contentType ,'articleId' : articleId ,'sectionId' : sectionId, 'articlecount' : articleCountCheck ,'currentarticleid' : currentArticleId},
				cache : false,
				dataType: 'json',
			});
			ajaxRequest.done(function(result){
				
				if(result.status ==1){
					$("#scrollContentID").val(result.contentid);
					$("#ArticleCountCheck").val(parseInt(articleCountCheck) + 1);
					var articleTemplate = '';
					var hasImage = tagsBottom = '';
					var hasTags = '<div class="article_tag">';
					var socialIcons ='';
					var authorDetails ='';
					var publishedDate ='';
					
					
					if(result.articleimage!=''){
						var hasImageCaption ='';
						if(result.articleimagetitle!=''){hasImageCaption +='<p class="AticleImgBottom">'+result.articleimagetitlestripped+'</p>'; }
						hasImage += '<figure class="AticleImg open_image"><img src="<?php echo image_url.imagelibrary_image_path ?>'+result.articleimage+'" title="'+result.articleimagetitle+'" alt="'+result.articleimagealt+'">'+hasImageCaption+'</figure>';
					}
					
					if(result.tags!=''){
						var separateTags = result.tags.split(',');
						var i,m;
						m=1;
						hasTags += '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ArticleDetail"><div class="tags"><!--<div> <span>TAGS</span> </div>-->';
						tagsBottom +='<div class="tags tags-bottom"><div> <span>TAGS</span> </div>';
						for(i=0;i<separateTags.length;i++){
							if(separateTags[i]!=''){
								tagUrl = separateTags[i].trim().split(' ').join('_');
								tagUrl ="<?php print base_url() ?>topic/"+tagUrl;
								if(m==1){
									hasTags +='<a href="'+tagUrl+'">'+separateTags[i]+'</a>';
									tagsBottom +='<a href="'+tagUrl+'">'+separateTags[i]+'</a>';
								}else{
									tagsBottom +='<a href="'+tagUrl+'">'+separateTags[i]+'</a>';
								}
								
								m++;
							}
						}
						hasTags += '</div></div>';
						tagsBottom +='</div>';
						$size = '6';
					}else{
						$size = '12';
					}
					
					publishedDate +='<div class="col-lg-'+$size+' col-md-'+$size+' col-sm-12 col-xs-12 ArticleDetail"><div class="article_published_date"><p class="ArticlePublish"> Published: <span>'+result.publisheddate+'</span>&nbsp;&nbsp;&nbsp;&nbsp; </p></div></div>';
					publishedDate +='</div>';
					
					socialIcons +='<div class="Social_Font"><div class="PrintSocial articles_social_icons">';
					socialIcons +='<div class="social_icon_count"><span class="article_fb_count"><span id="article_fb_count_'+contentBlock+'">0</span><span class="fb_ext_'+contentBlock+'"></span></span><br><span class="article_fb_shares">shares</span></div>';
					socialIcons +='<a href="javascript:;" class="csbuttons facebook_'+contentBlock+'" data-type="facebook" data-url="'+result.url+'" data-count="true"><img src="<?php echo image_url ?>images/static_img/fb.png?" class="img-responsive"></a>';
					socialIcons +='<a href="javascript:;" class="csbuttons twitter_'+contentBlock+'" data-type="twitter" data-txt="'+result.strippedtitle+'" data-url="'+result.bittyurl.id+'" data-via="xpress_edex" data-count="true"><img src="<?php echo image_url ?>images/static_img/twitter.png" class="img-responsive"></a>';
					socialIcons +='<a target="_BLANK" href="href="https://www.linkedin.com/shareArticle?url="'+result.url+'"&mini=true"><img src="<?php echo image_url ?>images/static_img/linkedin.png" class="img-responsive"></a><a class="whatsapp" href="" data-txt="'+result.strippedtitle+'" data-link="'+result.url+'"><img src="<?php echo image_url ?>images/static_img/whatsapp.png" class="img-responsive"></a><a><img src="<?php echo image_url ?>images/static_img/email.png" class="img-responsive"></a>';
					socialIcons +='</div></div>';
					
					if(result.authorimage==''){
						authorDetails +='<div class="strapimg"><img class="img-circle" alt="" src="<?php echo image_url ?>images/static_img/no_author.jpg"></div>';
					}else{
						authorDetails +=' <div class="strapimg"><img class="img-circle" alt="" src="<?php echo image_url?>'+result.authorimage+'"></div>';
					}
					
					if(result.authorname!=''){
						authorDetails +='<div class="author_name"><span><a href="<?php echo base_url()?>authors/?q='+result.authorname.split(' ').join('-')+'" target="_blank">'+result.authorname+'</a></span></span> <br><div class="author_pro"><span>Edex Live</span></div></div>';
					 
					}else{
					
					}
					
					articleTemplate += '<div class="row"></div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ArticleDetail">'+hasTags+publishedDate+'<h1 class="ArticleHead" e-metatitle="'+result.metatitle+'" id="content_head_'+contentBlock+'">'+result.title+'</h1><div class="straptxt article_summary">'+result.summary+'</div>'+authorDetails+socialIcons+'</div>';
					
					articleTemplate += '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ArticleDetail ArticleDetailContent></div><div id="content_'+contentBlock+'" class="content">'+hasImage+'<div id="storyContent">'+result.content+'</div>';
					articleTemplate += tagsBottom;
					
					articleTemplate += '</div><input type="hidden" value="'+result.url+'" class="random_url"></div>';
					 var y = $('.'+dynamicClass).offset();
					$('.'+dynamicClass).html(articleTemplate);
					console.log(onScroll);
					$(document).on('click','.twitter_'+contentBlock,function(){
						var twiiterUrlPath = 'https://twitter.com/intent/tweet?original_referer=' + encodeURIComponent($(this).attr('data-url')) + '&text=' + encodeURIComponent($(this).attr('data-txt')) + '&url=' + encodeURIComponent($(this).attr('data-url'));
						window.open(twiiterUrlPath, "", "width=550,height=420");
					});
					$(document).on('click','.twitter_'+contentBlock,function(){
						var twiiterUrlPath = 'https://twitter.com/intent/tweet?original_referer=' + encodeURIComponent($(this).attr('data-url')) + '&text=' + encodeURIComponent($(this).attr('data-txt')) + '&url=' + encodeURIComponent($(this).attr('data-url'));
						window.open(twiiterUrlPath, "", "width=550,height=420");
					});
					
					$(document).on('click','.facebook_'+contentBlock,function(){
						facebookUrlPath	= 'https://www.facebook.com/sharer/sharer.php?u=' + $(this).attr('data-url');
						window.open(facebookUrlPath, "", "width=670,height=340");
					});
					dynamic_fb_count('article_fb_count_'+contentBlock,'fb_ext_'+contentBlock,result.url);
					ajaxTriggered=true;
				}else{
					$('.'+dynamicClass).html('<p style="margin-top: 10px;text-align: center;color: #f4981d;font-size: 19px;">No More Articles</p>');
					ajaxTriggered=false;
				}
			});
			ajaxRequest.fail(function(errorStatus,errorMessage){
				console.log(errorStatus);
				console.log(errorMessage);
			}); 
		}
		
	}
});
function dynamic_fb_count($dynamic_id,$dynamic_class,$dynamic_url){
	$.getJSON('https://graph.facebook.com/?id=' + $dynamic_url, function( fbdata ) {
		$Counttype = '';
		if (fbdata.share.share_count > 999 && fbdata.share.share_count <= 999999) {
			fb_count = parseFloat(fbdata.share.share_count / 1000).toFixed(1);
			$Counttype = 'K';
		} else if (fbdata.share.share_count > 999999) {
		   fb_count = parseFloat(fbdata.share.share_count / 1000000).toFixed(1);
		   $Counttype = 'M';
		} else {
			fb_count = fbdata.share.share_count;
			 $Counttype = '';
		}
		var options = {useEasing: true, seGrouping: true, separator: '.', decimal: '.', };
		var counts = new CountUp($dynamic_id, 0, fb_count, 0, 2.5, options);
		if (!counts.error) { counts.start();} else { console.error(counts.error);}
		$('.'+$dynamic_class).html($Counttype);

	});
}
</script>
