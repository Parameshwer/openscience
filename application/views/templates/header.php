<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<!-- Stylesheets ============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700|Roboto:300,400,500,700" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/swiper.css" type="text/css" />

	<!-- Construction Demo Specific Stylesheet -->	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/construction.css" type="text/css" />
	<!-- / -->

	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dark.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/magnific-popup.css" type="text/css" />

	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/fonts.css" type="text/css" /> -->

	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/responsive.css" type="text/css" />

	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/colors.css" type="text/css" />

	<!-- Document Title ============================================= -->
	<title> Open Science Journals India | Indian Open Access Journal </title>

</head>
<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Top Bar
		============================================= -->
		<div id="top-bar">

			<div class="container clearfix">

				<div class="col_half nobottommargin clearfix">

					<p clas7s="nobottommargin"><strong>Call:</strong> +91-9177734525 | <strong> Email:</strong> info@opensciencepublications.com </p>

				</div>

				<div class="col_half fright col_last clearfix nobottommargin">
				
					<!-- Top Social
					============================================= -->
					<div id="top-social">
						<ul>
							<li><a href="#" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a></li>
							<li><a href="#" class="si-twitter"><span class="ts-icon"><i class="icon-twitter"></i></span><span class="ts-text">Twitter</span></a></li>
							<li><a href="#" class="si-linkedin"><span class="ts-icon"><i class="icon-linkedin"></i></span><span class="ts-text"> Linkedin</span></a></li>
							<li><a href="#" class="si-rss"><span class="ts-icon"><i class="icon-rss"></i></span><span class="ts-text"> RSS </span></a></li>
							<li><a href="#" class="si-blogger"><span class="ts-icon"><i class="icon-blogger"></i></span><span class="ts-text"> Blogger</span></a></li> 
						</ul>
					</div><!-- #top-social end --> 

				</div>

			</div>

		</div><!-- #top-bar end -->

		<!-- Header
		============================================= -->
		<header id="header" class="sticky-style-2">

			<div class="container clearfix">

				<!-- Logo
				============================================= -->
				<div id="logo">
					<a href="index.html" class="standard-logo"><img src="<?php echo base_url(); ?>public/images/opensciencepublications-Logo-New.png" alt="Open Science Publications Logo"></a>
					<a href="index.html" class="retina-logo"><img src="<?php echo base_url(); ?>public/images/opensciencepublications-Logo-New.png" alt="Open Science Publications Logo"></a>
				</div><!-- #logo end --> 
			</div>

			<div id="header-wrap">

				
				<!-- Primary Navigation
				============================================= -->
				<nav id="primary-menu" class="style-2">

					<div class="container clearfix">

						<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
						<?php //echo $this->uri->segment(1); ?>
							<ul>
								<li class="<?php echo (($this->uri->segment(1) == '')?'current':''); ?>"><a href="<?php echo base_url(); ?>"><div> HOME </div> </a> </li> 
								<li class="<?php echo (($this->uri->segment(1) == 'about_us')?'current':''); ?>"><a href="<?php echo base_url(); ?>about_us"><div> ABOUT US </div></a></li>
								<li class="<?php echo (($this->uri->segment(1) == 'journals')?'current':''); ?>"><a href="<?php echo base_url(); ?>journals"><div> JOURNALS </div></a></li>
								<li class="<?php echo (($this->uri->segment(1) == 'submit-manuscript')?'current':''); ?>"><a href="<?php echo base_url(); ?>submit-manuscript"><div> SUBMIT MANUSCRIPT </div></a></li>
								<li class="<?php echo (($this->uri->segment(1) == 'membership')?'current':''); ?>"><a href="<?php echo base_url(); ?>membership"><div> MEMBERSHIP </div></a></li>
								<li class="<?php echo (($this->uri->segment(1) == 'latest-articles')?'current':''); ?>"><a href="<?php echo base_url(); ?>latest-articles"><div> LATEST ARTICLES </div></a></li>
								<li class="<?php echo (($this->uri->segment(1) == 'register')?'current':''); ?>"><a href="<?php echo base_url(); ?>register"><div> REGISTER </div></a></li>
								<li class="<?php echo (($this->uri->segment(1) == 'policies')?'current':''); ?>"><a href="<?php echo base_url(); ?>policies"><div> POLICIES </div></a></li>
								<li class="<?php echo (($this->uri->segment(1) == 'contact-us')?'current':''); ?>"><a href="<?php echo base_url(); ?>contact-us"><div> CONTACT US </div></a></li>
								 
							</ul> 
						 
						<div id="top-search">
							<a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
							<form action="search.html" method="get">
								<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter..">
							</form>
						</div><!-- #top-search end -->

					</div>

				</nav><!-- #primary-menu end -->

			</div>

		</header><!-- #header end -->