<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title><?php echo ucfirst($template); ?></title>
	<style>
		#loader{ transition:all .3s ease-in-out;opacity:1; visibility:visible; position:fixed; height:100vh; width:100%; background:#fff; z-index:90000; }
		#loader.fadeOut{ opacity:0;visibility:hidden }
		.spinner{ width:40px; height:40px; position:absolute; top:calc(50% - 20px); left:calc(50% - 20px);
		background-color:#333; border-radius:100%; -webkit-animation:sk-scaleout 1s infinite ease-in-out; animation:sk-scaleout 1s infinite ease-in-out}
		@-webkit-keyframes sk-scaleout{
			0%{-webkit-transform:scale(0)}
			100%{-webkit-transform:scale(1);opacity:0}
		}
		@keyframes sk-scaleout{
			0%{	-webkit-transform:scale(0);transform:scale(0)}
			100%{-webkit-transform:scale(1);transform:scale(1);opacity:0}
		}
		.page-header { border:none !important;}
		.page-header h1 { float:left;}
		.page-header button { float:right; /* border-radius: 10%; */}
		td { text-align:center; !important}
		.error {  color: #f00e0e;   font-size: 15px; font-weight: bold;}
		label { font-weight: bold !important; font-size: 18px !important;}
	</style>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom_style.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.custom.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/chosen.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.com.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/toastr.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker3.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-timepicker.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/daterangepicker.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-colorpicker.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.com.css" />
	<script src="<?php echo base_url();?>assets/js/ace-extra.min.js"></script>
		
		
</head>

<body class="no-skin">
	<div id="loader">
		<div class="spinner"></div>
	</div>
	<script type="text/javascript">window.addEventListener('load', () => {
		const loader = document.getElementById('loader');
		setTimeout(() => {
		  loader.classList.add('fadeOut');
		}, 300);
	  });
	</script>
	<div id="navbar" class="navbar navbar-default          ace-save-state">
		<div class="navbar-container ace-save-state" id="navbar-container">
			<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
				<span class="sr-only">Toggle sidebar</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<div class="navbar-header pull-left">
				<a href="<?php echo base_url();?>neet-cpanel/dashboard" class="navbar-brand">
					<small>	ENPL - Cpanel </small>
				</a>
			</div>

			<div class="navbar-buttons navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">
					<li class="light-blue dropdown-modal">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<span class="user-info">
								<small>Welcome,</small>
									<?php echo $this->session->userdata('nusername'); ?>
							</span>
							<i class="ace-icon fa fa-caret-down"></i>
						</a>
						<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<!--<li>
								<a href="#">
									<i class="ace-icon fa fa-cog"></i>
									Settings
								</a>
							</li>
							<li>
								<a href="profile.html">
									<i class="ace-icon fa fa-user"></i>
									Profile
								</a>
							</li>
							<li class="divider"></li>-->
							<li>
								<a href="<?php echo base_url();?>neet-cpanel/logout">
									<i class="ace-icon fa fa-power-off"></i>
									Logout
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="main-container ace-save-state" id="main-container">
		<script type="text/javascript">
			try{ace.settings.loadState('main-container')}catch(e){}
		</script>
		<div id="sidebar" class="sidebar responsive ace-save-state">
			<script type="text/javascript">
				try{ace.settings.loadState('sidebar')}catch(e){}
			</script>
			<ul class="nav nav-list">
				<li class="">
					<a href="<?php echo base_url('neet-cpanel/dashboard');?>">
						<i class="menu-icon fa fa-tachometer"></i>
						<span class="menu-text"> Dashboard </span>
					</a>
					<b class="arrow"></b>
				</li>
				
				<li class="">
					<a href="<?php echo base_url('neet-cpanel/venue');?>">
						<i class="menu-icon fa fa-map-marker"></i>
						<span class="menu-text"> Venue </span>
					</a>
					<b class="arrow"></b>
				</li>
				
				<li class="">
					<a href="<?php echo base_url('neet-cpanel/tips');?>">
						<i class="menu-icon fa fa-search"></i>
						<span class="menu-text"> Tips </span>
					</a>
					<b class="arrow"></b>
				</li>
				
				<li class="">
					<a href="<?php echo base_url('neet-cpanel/video');?>">
						<i class="menu-icon fa fa-youtube"></i>
						<span class="menu-text"> Video </span>
					</a>
					<b class="arrow"></b>
				</li>
				
				<li class="">
					<a href="<?php echo base_url('neet-cpanel/news');?>">
						<i class="menu-icon fa fa-newspaper-o"></i>
						<span class="menu-text"> News </span>
					</a>
					<b class="arrow"></b>
				</li>
				<li class="">
					<a href="<?php echo base_url('neet-cpanel/questions');?>">
						<i class="menu-icon fa fa-question-circle"></i>
						<span class="menu-text"> Questions </span>
					</a>
					<b class="arrow"></b>
				</li>				
			</ul>

			<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
				<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
			</div>
		</div>