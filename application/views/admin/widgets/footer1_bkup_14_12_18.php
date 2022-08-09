<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer1">
  <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="news"> <a href="javascript:void(0)" class="scrollToTop"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
      <h3 class="foot_head">NEWS LETTER</h3>
      <div class="newsbox">
        <form class="navbar-form news_form" id="newsletter_form" name="newsletter_form" role="search" action="<?php echo base_url(); ?>user/common_widget/subscribe_newsletter">
          <div class="input-group">
            <input type="text" class="form-control ntb"  placeholder="Enter email for newsletter" name="email_newsletter" id="email-newsletter">
            <div class="input-group-btn">
              <button class="btn btn-default btn-back" id="submit_newsletter" type="button"><i class="fa fa-chevron-right"></i></button>
            </div>
          </div>
        </form>
        <span id="news_error_throw"></span> </div>
    </div>
  </div>-->
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php 
$view_mode              = $content['mode'];
$social_urls            = $this->widget_model->select_setting($view_mode); 
$widget_bg_color 		= $content['widget_bg_color'];
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	= $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 		= "";
$page_type 				= 'section';
// widget config block ends
?>
    <div class="follow">
      <h3 class="foot_head">FOLLOW US</h3>
      <div class="footer_social"> <a class="fb" href="https://www.facebook.com/edexnie/" rel="nofollow" target="_blank"><i class="fa fa-facebook"></i></a>  <a class="twit" href="https://twitter.com/xpress_edex" rel="nofollow" target="_blank"><i class="fa fa-twitter"></i></a>  <a href="https://www.instagram.com/edexgoeslive/" rel="nofollow" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a><a href="https://www.linkedin.com/in/edex-live-9a0036138?trk=nav_responsive_tab_profile_pic" rel="nofollow" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </div>
    </div>
  </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer2bac">
<!--div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 group-logo">
	<a style=" margin:10px 10px 5px 10px;float:right;" href="http://www.newindianexpress.com/" title="The New IndianExpress" ><img src="images/FrontEnd/images/group-logo.png"></a>
    </div-->
  <div class="footer2">
    <p>Copyright - edexlive.com 2018</p>
    
    <p> <a class="AllTopic" href="http://www.newindianexpress.com/" rel="nofollow" target="_blank">The New Indian Express | </a> <a class="AllTopic" href="http://www.dinamani.com" rel="nofollow" target="_blank">Dinamani | </a> <a class="AllTopic" href="http://www.kannadaprabha.com" rel="nofollow" target="_blank">Kannada Prabha | </a>  <a class="AllTopic" href="http://www.samakalikamalayalam.com" rel="nofollow" target="_blank">Samakalika Malayalam | </a> <a class="AllTopic" href="http://www.indulgexpress.com" rel="nofollow" target="_blank">Indulgexpress | </a>  <a class="AllTopic" href="http://www.cinemaexpress.com" rel="nofollow" target="_blank">Cinema Express  | </a><a class="AllTopic" href="http://www.eventxpress.com/" rel="nofollow" target="_blank">Event Xpress  </a></p>
	<p> <a class="AllTopic" href="<?php echo base_url()."contact-us"; ?>"><?php echo "Contact Us"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."about-us"; ?>"><?php echo "About Us"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."privacy-policy"; ?>"><?php echo "Privacy Policy"; ?> | </a><a class="AllTopic" href="<?php echo base_url()."terms-of-use"; ?>"><?php echo "Terms of Use"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."advertise-with-us"; ?>"><?php echo "Advertise With Us"; ?> </a></p>
	<p> <a class="AllTopic" href="<?php echo base_url(); ?>"><?php echo "Home"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Live-Now"; ?>"><?php echo "Live Now"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Live-Story"; ?>"><?php echo "Live Story"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Campus-Trip"; ?>"><?php echo "Campus Trip"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Coach-Calling"; ?>"><?php echo "Coach Calling"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Live-Take"; ?>"><?php echo "Live Take"; ?></p>
  </div>
</div>
<script>
var $ = $.noConflict();
$(document).ready(function( $ ){
    scrollToTop.init( );
});
var scrollToTop =
{
    init: function(  ){
        //Check to see if the window is top if not then display button
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollToTop').fadeIn();
            } else {
                $('.scrollToTop').fadeOut();
            }
        });
        // Click event to scroll to top
        $('.scrollToTop').click(function(){
            $('html, body').animate({scrollTop : 0},800);
            return false;
        });
    }
};
</script>