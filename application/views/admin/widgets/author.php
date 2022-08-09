<?php
//WIDGET CONFIGURATION
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  =  $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	 = "";
$widget_section_url  = $content['widget_section_url'];
$is_home             = $content['is_home_page'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$view_mode           = $content['mode'];
$render_mode         = $content['RenderingMode'];
$max_article         = $content['show_max_article'];

//END;

//WIDGET DYNAMIC ATTRIBUTES
$AuthorId=str_replace('-',' ',$_GET['q']);
$Type=(isset($_GET['t']) && $_GET['t']!='')?$_GET['t']:0;
$AuthorDetails=$this->widget_model->GetAuthorDetailsById($AuthorId,$Type);
$FaceBook='https://www.facebook.com/edexnie/';
$Twitter='https://twitter.com/xpress_edex';
$Instagram='https://www.instagram.com/edexgoeslive/';
//ATTRIBUTES ENDS..
?>
<div class="row author-panel">
	<div class="col-md-6 col-ls-6 col-xs-12 col-sm-12 author-img-rotate img-circle">
	<?php
	$ImagePath=image_url.$AuthorDetails[0]->image_path;
	if(empty($AuthorDetails[0]->image_path)):
		$ImagePath=base_url('images/static_img/author_noimage.png');
	endif;
	?>
		<img src="<?php print $ImagePath?>" class="img-circle img-responsive">
	</div>
	<div class="col-md-6 col-ls-6 col-xs-12 col-sm-12">
		<h2 class="author-panel-heading"><span><?php print $AuthorDetails[0]->AuthorName?></span></h2>
			<div class="col-md-12 p13">
			<?php if($AuthorDetails[0]->Email!=''): ?>
				<p >Email ID : <?php print $AuthorDetails[0]->Email?></p>
			<?php endif; if(strlen($AuthorDetails[0]->mobile) > 3):  ?>
				<p>Phone Number : <?php print $AuthorDetails[0]->mobile?></p>
			<?php endif;?>
			</div>
			<div class="author-social">
				<a href="<?php ($AuthorDetails[0]->facebook=='')? print $FaceBook : print $AuthorDetails[0]->facebook;?>" class="link facebook" target="_blank"><span class="fa fa-facebook-square"></span></a>
				<a href="<?php ($AuthorDetails[0]->twitter=='')? print $Twitter : print $AuthorDetails[0]->twitter; ?>" class="link twitter" target="_blank"><span class="fa fa-twitter"></span></a>
				<a href="<?php ($AuthorDetails[0]->instagram=='')? print $Instagram : print $AuthorDetails[0]->instagram;?>" class="link google-plus" target="_blank"><span class="fa fa-instagram"></span></a>
			</div>
			
	</div>

	<div class="col-md-12">
		<?php if($AuthorDetails[0]->ShortBiography !=''): ?>
		<p class="bio-hr"></p>
		<p class="bio-title">Biography:</p>
		<p class="bio-content"><?php print stripslashes($AuthorDetails[0]->ShortBiography); ?></p>
		<?php endif; ?>
	</div>
</div>

