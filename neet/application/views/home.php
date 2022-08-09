<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Edex Neet </title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
			<link href="animate.css" rel="stylesheet">
		<style>
			 body { background-color: #1a5079;}
 			.title {  float: left; width: 100%;}
			.title h2 { color: #00a9a2; font-size: 45px;  margin-bottom: 30px; }
			.title ol { color: #000; }
			.title ol li { font-size: 20px; line-height: 35px; }
			.venue_details { font-size: 26px; text-align: left; color: #fff; width:100% ;float:left;    padding: 22px 0px; }
			.venue_details span { float: left; display: flex;  margin-left: 3%;}
			.venue_details span i { padding-right: 16px; }
			.articles { float:left; height:220px; overflow:hidden;}
			.articles a {  font-size: 24px; text-decoration: none; color: #f2a234; margin: 9px 0px;  float: left; font-weight: bold; }
			.tips img:hover { transform: scale(1.3); -webkit-transform: scale(1.3);  filter: contrast(130%); -webkit-filter: contrast(130%);
    -moz-filter: contrast(130%); -ms-filter: contrast(130%);}
			.tips img {     width: 100%;  overflow: hidden;  -moz-transition: all 0.5s;  -webkit-transition: all 0.5s;  transition: all 0.5s;}
			address {  line-height: 41px;}
			.gap1 {height:1px;clear:both;}
			.animate-left{position:relative;animation:animateleft 2.4s}
			@keyframes animateleft{from{left:-300px;opacity:0} to{left:0;opacity:1}}
			.animate-top{position:relative;animation:animatetop 2.4s}
			@keyframes animatetop{from{top:-300px;opacity:0} to{top:0;opacity:1}}
			.animate-bottom{ position:relative;animation:animatebottom 2.4s }
			@keyframes animatebottom{from{bottom:-300px;opacity:0} to{bottom:0;opacity:1}}
			.animate-right{position:relative;animation:animateright 2.4s}
			@keyframes animateright{from{right:-300px;opacity:0} to{right:0;opacity:1}}


		</style>
	</head>
	<body>
		<div class="container-fluid" >
			<div class="row">
				<div class="col-md-6 col-sm-6 col-lg-6">
					<div class="row">
						<div class="title animate-left">
							<h2 class="text-center ">Venue Details</h2>
							<div class="col-md-offset-3 col-md-8 col-sm-8">
								<div class="venue_details">
									<span>
										<i class="fa fa-map-marker"></i>
										<address>
											Express Publications (Madurai) Limited,<br>
											Express Gardens,2nd Main Road,</br>
											Ambattur Industrial Estate,Chennai - 600 058, </br>
											India.
										</address>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-lg-6">
					<div class="row">
						<div class="title animate-top">
							<h2 class="text-center">Tips</h2>
							<div class="col-md-12 col-sm-12">
								<div class="row tips">
									<div class="col-md-2 col-sm-2">
										<img src="https://images.edexlive.com/uploads/user/imagelibrary/2019/1/7/w600X300/Manish_Bahl.jpeg" class="img-responsive" style="width:100%"/>
									</div>
									<div class="col-md-10 col-sm-10">
										<p style="font-size: 23px;color:#fff;">last minute tips and tricks to crack the exam</p>
									</div>
								</div>
								<br>
								<div class="row tips">
									<div class="col-md-2 col-sm-2">
										<img src="https://images.edexlive.com/uploads/user/imagelibrary/2019/1/7/w600X300/Manish_Bahl.jpeg" class="img-responsive" style="width:100%"/>
									</div>
									<div class="col-md-10 col-sm-10">
										<p style="font-size: 23px;color:#fff;">last minute tips and tricks to crack the exam</p>
									</div>
								</div>
								<br>
								<div class="row tips">
									<div class="col-md-2 col-sm-2">
										<img src="https://images.edexlive.com/uploads/user/imagelibrary/2019/1/7/w600X300/Manish_Bahl.jpeg" class="img-responsive" style="width:100%"/>
									</div>
									<div class="col-md-10 col-sm-10">
										<p style="font-size: 23px;color:#fff">last minute tips and tricks to crack the exam</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="gap1"></div>
				<div class="col-md-6 col-sm-6 col-lg-6">
					
						<div class="title animate-bottom">
							<h2 class="text-center">Videos</h2>
							<div class="row">
								<div class="col-sm-4 col-md-4 col-lg-4">
									<iframe width="100%" height="200" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
								</div>
								<div class="col-sm-4 col-md-4 col-lg-4">
									<iframe width="100%" height="200" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
								</div>
								<div class="col-sm-4 col-md-4 col-lg-4">
									<iframe width="100%" height="200" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
								</div>
							</div>
						</div>
					
				</div>
				<div class="col-md-6 col-sm-6 col-lg-6">
					<div class="row">
						<div class="title animate-right">
							<h2 class="text-center">News</h2>
							<div class="col-md-12 col-sm-12">
								<div class="articles">
									<a href="https://www.edexlive.com/campus/2019/jan/05/how-much-did-jnu-spend-on-sadhguru-sri-sri-ravi-shankar-events-4939.html" class="article_click">How much did JNU spend on Sadhguru, Sri Sri Ravi Shankar events?</a>
									<br>
									<a href="https://www.edexlive.com/news/2019/jan/05/jee-main-2019-here-are-some-last-minute-tips-and-tricks-to-crack-the-exam-4938.html" class="article_click">JEE Main 2019: Here are some last-minute tips and tricks to crack the exam</a>
								<a href="https://www.indulgexpress.com/entertainment/celebs/2019/jan/03/how-ranveer-singhs-witty-comments-on-deepika-padukones-instagram-is-making-fans-go-crazy-11888.html" class="article_click">How Ranveer Singh’s witty comments on Deepika Padukone’s Instagram is making fans go crazy</a>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	

	</body>
</html>