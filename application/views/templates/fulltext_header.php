<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="en-US" prefix="og: http://ogp.me/ns#">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="en-US" prefix="og: http://ogp.me/ns#">
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!--[if lt IE 9]>
<script src="http://localhost/avens-angular/wp-content/themes/twentythirteen/js/html5.js"></script>
<![endif]-->
<title><?php echo isset($title) ? 'Avens Publishing Group - '.$title : 'Avens Publishing Group | Open Access Journals | Open Access Publications' ; ?></title>
<meta name="description" content="<?php echo isset($title) ? 'Avens Publishing Group - '.$title : 'Avens Publishing Group | Open Access Journals | Open Access Publications' ; ?>"/>
<meta name="keywords" content="<?php echo $meta_keywords;?>"/>
<link href='http://fonts.googleapis.com/css?family=Kreon:300,400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
<link rel='stylesheet' id='genericons-css'  href='<?php echo base_url(); ?>public/css/genericons.css' type='text/css' media='all' />
<link rel='stylesheet' id='twentythirteen-style-css'  href='<?php echo base_url(); ?>public/css/style.css' type='text/css' media='all' />
<!--[if lt IE 9]>
<link rel='stylesheet' id='twentythirteen-ie-css'  href='http://localhost/avens-angular/wp-content/themes/twentythirteen/css/ie.css?ver=2013-07-18' type='text/css' media='all' />
<![endif]-->
<link rel='stylesheet' id='avhec-widget-css'  href='<?php echo base_url(); ?>public/css/avh-ec.widget.css' type='text/css' media='all' />

<link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/responsive.css">
<link rel="stylesheet" href="http://localhost/avens-angular/fulltextarticles/wp-content/themes/twentytwelve/theme.css">

</head>
<body class="blog single-author sidebar">
<div id="page" class="hfeed site">
	<div class="container">
		<div class="row" style="margin:10px 0">
			<div class="col-sm-4" id="logo-box">
				<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url() ?>public//images/logo.png" alt="Avens Publishing Group" class="img-responsive"></a>
			</div>
			<div class="col-sm-8 text-right hidden-xs">
			<?php 				
				if($this->uri->segment(2) =='') {
					$img_name = '1and2.gif';
				} else if($this->uri->segment(2) =='about-us') {
					$img_name = '3and4.gif';
				} else if($this->uri->segment(2) =='journals' || $this->uri->segment(1) =='medical' || $this->uri->segment(1) =='biotechnology' || $this->uri->segment(1) =='biology' || $this->uri->segment(1) =='pharmaceutical') {					
					$img_name = '5and6.gif';
				} else if($this->uri->segment(2) =='submit-manuscript') {
					$img_name = '7and8.gif';
				} else if($this->uri->segment(2) =='processing_fee') {
					$img_name = '9and10.gif';
				} else if($this->uri->segment(2) =='collaborations') {
					$img_name = '1and2.gif';
				} else if($this->uri->segment(2) =='membership') {
					$img_name = '3and4.gif';
				} else if($this->uri->segment(2) =='policies') {
					$img_name = '5and6.gif';
				} else if($this->uri->segment(2) =='contact') {
					$img_name = '7and8.gif';
				} else if($this->uri->segment(2) =='search'){
					$img_name = '7and8.gif';
				} else if($this->uri->segment(2) =='testimonials'){
					$img_name = '7and8.gif';
				}else if($this->uri->segment(1) =='fulltextarticles'){
					$img_name = '7and8.gif';
				}	
				echo '<img src="'.base_url().'public/images/animatedbanners/'.$img_name.'" alt="Avens Publishing Group" />';

			 ?>			
			</div>
		</div>
	</div>
</div>
<div class="site-header">
	<div id="navbar" class="navbar">
		<nav id="site-navigation" class="navigation main-navigation" role="navigation">
			<button class="menu-toggle">Menu</button>
			<a class="screen-reader-text skip-link" href="#content" title="Skip to content">Skip to content</a>
			<div class="menu-main-menu-container">
			<ul id="menu-main-menu" class="nav-menu">			
				<li class="menu-item <?php echo (($this->uri->segment(2) == '')?'current_page_item':''); ?>"><a href="<?php echo base_url(); ?>">Home</a></li>
				<li class="menu-item <?php echo (($this->uri->segment(2) == 'about_us')?'current_page_item':''); ?>"><a href="<?php echo base_url(); ?>about-us/">About Us</a></li>
				<li class="menu-item <?php echo (($this->uri->segment(2) == 'journals')?'current_page_item':''); ?>"><a href="<?php echo base_url(); ?>journals/">Journals</a></li>
				<li class="menu-item <?php echo (($this->uri->segment(2) == 'submit_manuscript')?'current_page_item':''); ?>"><a href="<?php echo base_url(); ?>submit-manuscript/">Submit Manuscript</a></li>
				<li class="menu-item <?php echo (($this->uri->segment(2) == 'processing_fee')?'current_page_item':''); ?>"><a href="<?php echo base_url(); ?>processing-fee/">Processing Fee</a></li>
				<li class="menu-item <?php echo (($this->uri->segment(2) == 'collaborations')?'current_page_item':''); ?>"><a href="<?php echo base_url(); ?>collaborations/">Collaborations</a></li>
				<li class="menu-item <?php echo (($this->uri->segment(2) == 'membership')?'current_page_item':''); ?>"><a href="<?php echo base_url(); ?>membership/">Membership</a></li>
				<li class="menu-item <?php echo (($this->uri->segment(2) == 'policies')?'current_page_item':''); ?>"><a href="<?php echo base_url(); ?>policies/">Policies</a></li>
				<li class="menu-item <?php echo (($this->uri->segment(2) == 'contact')?'current_page_item':''); ?>"><a href="<?php echo base_url(); ?>contact/">Contact</a></li>

			</ul>
			</div>
			<form role="search" method="get" class="search-form" action="<?php echo base_url(); ?>/page/search">
			<label>
				<span class="screen-reader-text">Search for:</span>
				<input type="search" class="search-field" placeholder="Search …" value="" name="s" title="Search for:">
			</label>
			<input type="submit" class="search-submit" value="Search">
		</form>			</nav><!-- #site-navigation -->
	</div><!-- #navbar -->
</div>