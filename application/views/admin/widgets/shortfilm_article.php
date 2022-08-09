<?php
$GetContentID=explode('.',$this->uri->segment(5));
$IDPosition=strripos(@$GetContentID[0],'-') + 1;
$ContentID=(int)substr(@$GetContentID[0],$IDPosition);
$this->load->database();
	$this->db->select('sid')
		->select('title')
		->select('duration')
		->select('youtube_link')
		->select('url')
		->select('language')
		->select('summary')
		->select('year_month_competition')
		->select('member_location')
		->select('teammembers')
		->select('equipment_used')
		->select('awards')
		->select('hits')
		->select('modified_on')
		->from('shortfilm_master')
		->where('sid',$ContentID);
	$Content=$this->db->get();
	$Content=$Content->result();
?>
<article class="WidthFloat_L printthis">
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ArticleDetail ArticleDetailContent ">
		<div id="content" class="content" itemprop="description">
			<figure class="AticleImg open_image margin-top-15">
				<iframe width="" height="400" src="<?php print $Content[0]->youtube_link; ?>" frameborder="0" allowfullscreen style="width:100%;"></iframe>
			</figure>
			<div class="row margin-bottom-15">
				<h1 class="ArticleHead margin-bottom-10" id="content_head" itemprop="name"><?php print $Content[0]->title; ?></h1>  
			</div>
    
    <div class="row margin-bottom-15">
        
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"><div class="strapimg"><img class="img-circle" alt="" src="http://images.edexlive.com/images/static_img/no_author.jpg"></div>
        <div class="author_name"><span>Edex Live</span><br><span><p class="video_Publish">Published: <span>12th July 2017</span></p></span></div></div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><div class="total_views">0142 views</div></div>
        
    </div>  
        
    <div class="video_likes_unlikes">
    
    	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            
            <div class="Social_Font">
            
                <div class="video_PrintSocial" style="visibility: visible; display: block;">  <span class="video_Share_Icons"><a href="javascript:;" class="csbuttons" data-type="twitter" data-txt="A platform where filmmakers meet their needs" data-via="xpress_edex" data-count="true"><i class="fa fa-twitter fa_social"></i><span class="csbuttons-count">0</span></a></span> <span class="video_Share_Icons"><a href="javascript:;" class="csbuttons" data-type="facebook" data-count="true"><i class="fa fa-facebook fa_social"></i><span class="csbuttons-count">4</span></a></span> <span class="video_Share_Icons"><a href="javascript:;" class="csbuttons" data-type="google" data-lang="en" data-count="true"><i class="fa fa-google-plus fa_social"></i><span class="csbuttons-count">0</span></a></span> 
                </div>
            
            </div>
            
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        
        	<div class="likes"><div class="like_counts_dark"><button class=" btn_thumbs_up_dark"><i class="fa fa-thumbs-up thumbs_up" aria-hidden="true"></i></button>108</div> <div class="like_counts_dark"><button class=" btn_thumbs_down_dark"><i class="fa fa-thumbs-down thumbs_down" aria-hidden="true"></i></button>12</div></div>
            
        </div>
    
    </div>
    
    <div class="description_video"><p>Shortfundly is a platform that connects short-film filmmakers to each other and to film festivals around the world</p></div>
    
  </div>
  
  <div id="keywordline"></div>
  
</div>
</div>

                                
</article>
<style>
.description_video p { margin:0; padding:3px 20px 2px 0px; font-size:18px; color:#000; line-height:23px; float:left; width:100%; }
.video_likes_unlikes{ margin:0 0 25px 0; padding:6px 0 3px 0; width:100%; float:left; color:#000; font-size:20px; border-top:1px solid #dfdfdf; border-bottom:1px solid #dfdfdf; }
.total_views{ margin:0; padding:10px 0 0 0; float:right; border-bottom:2px solid #f9881f; font-size:23px; color:#5b5b5b; }
.likes{ margin:0; padding:0; float:right; }
.like_counts_dark{ margin:0; padding:7px 12px 0 0; color:#000; font-size:20px; float:left; }
.video_PrintSocial{ margin:0; padding:0; float:left; }
.video_Share_Icons{ position:relative; float:left; margin:0 14px 0 0; color:#5b5b5b; }
.video_PrintSocial .fa-twitter{ margin:0 3px 0 0; padding:5px; color:#fff; background-color:#54bcf2; }
.video_PrintSocial .fa-facebook{ margin:0 3px 0 0; padding:5px; color:#fff; background-color:#4672db; }
.video_PrintSocial .fa-google-plus{ margin:0 3px 0 0; padding:5px; color:#fff; background-color:#e41919; }
.video_Publish{ color:#f99c20; padding:5px 70px 2px 0px; font-size:14px !important; text-align:left; margin:0px; float:left; width:100%; line-height:20px !important; }
.btn_thumbs_up_dark{ background:none !important; border:0 !important; }
.btn_thumbs_down_dark{ background:none !important; border:0 !important; }
</style>