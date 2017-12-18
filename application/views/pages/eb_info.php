<div id="main" class="site-main">	<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">


		<style type="text/css">
			.journal-name h1{
				text-align: center;
				text-shadow: 0px 0px 9px rgba(0, 0, 0, 1);
				font-size: 2em;
				color: #ffffff;
			}
			.issn-num{background-color: #fe6d01;padding: 8px;color: #ffffff;border-top:1px solid #ffffff;font-size: 1.1em;text-align: right;}	
			.issn-num p{margin: 0;}
			.site-header{background: none;height: auto;}
			.site-header .home-link{display: none;}
			.journal-info-box{position: relative;color: #ffffff;}
			.journal-info-box h1.entry-title{  position: absolute;top: 0;font-size: 2em;padding: 20px;text-shadow: 0 0 6px #222;}
			.journal-info-box .issn-number{font-size: 0.5em;overflow: hidden;top: 10px;position: relative;}
			.affix{position: fixed;top: 0;}
			#journal-sidebar-wrapper {
			    margin: -40px 0 0;
			}
		</style>

		<style type="text/css">
			.journal-name{background: url("<?php echo base_url(); ?>public/images/journal-banners/<?php echo $eb_info[0]['banner_image'] ?>") no-repeat scroll center top / 1600px auto;text-align: center;padding: 90px;position:relative;
			background-repeat:no-repeat;
			-webkit-background-size:cover;
			-moz-background-size:cover;
			-o-background-size:cover;
			background-size:cover;
			background-position:center;
		}
	}
</style>

<div class="journal-name">		
	<div class="container">
		<h1 class="entry-title"><?php echo $eb_info[0]['journal_name']; ?></h1>									
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<!-- <div class=" affix-top" data-spy="affix" data-offset-top="300" > -->
			<div class="mobile-category-nav visible-xs">
				<a href="#" id="mobile-post-navbtn">Menu</a>
				<ul class="mobile-post-nav">
					<?php
						foreach ($static_page as $key => $value) {
							echo '<li><a class="" href="">'.$key.'</a></li>';
						}
					?>
				</ul>
			</div>
			<div>
			
				<div id="journal-sidebar-wrapper">
				<?php 
					if($eb_info[0]['issn_number']) {
						echo "<div class='issn-num'><p>".$eb_info[0]['issn_number']."</p></div>";
					}
				?>
					<div id="journal-sidebar">
						<div id="nav-post">
							<ul class="post-nav">
							<?php
							/*
								foreach ($static_page as $key => $value) {
									echo '<li><a class="" href="'.base_url().''.$eb_info[0]['journal_url_slug'].'/'.$value.'/">'.$key.'</a></li>';
								}
							*/
								foreach ($links_info as $key => $value) {																		
									echo '<li><a class="" href="'.base_url().''.$value['journal_url_slug'].'/'.$value['post_slug'].'/">'.$value['post_name'].'</a></li>';	
								}
							 ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="journal-info-box">


					<img src="<?php echo base_url(); ?>public/images/journal-sidebar-images/<?php echo $eb_info[0]['sidebar_image'] ?>" class="img-responsive">
					<!-- <h1 class="entry-title"><?php //echo $eb_info[0]['journal_name']; ?></h1> -->
				</div>
			</div>
		</div>		
		<div class="col-sm-8">		
			<div class="post-text-box <?php echo $eb_info[0]['eb_post_slug']?>">				
				<div id="post-content">
					<h1>Editorial Board</h1>
					<?php //print_r($eb_info); ?>
                                        
					<?php 
                                             $e_flag = true; 
                                             foreach ($eb_info as $key => $value) {
                                               if($value['editor_chief'] == '1') {
                                                 if($e_flag) {
                                                    echo '<span style="color: #cc5200; font-size: medium;"><strong>Editor-in-Chief</strong></span>';
                                                 }
                                               }
						echo '<div class="new-eb-box '.(($value['editor_chief'] == '1')?'editor-chief-box':'').'"><div class="eb-image-box"><img class="" title="'.$value['eb_member_name'].'" src="'.base_url().'wp-content/uploads/'.$value['eb_member_photo'].'" alt="'.$value['eb_member_name'].'" height="100" width="100"></div><div class="eb-info-box"><strong>'.$value['eb_member_name'].'</strong>'.$value['eb_member_desc'].'</div></div>';
					} ?>
					<?php //echo $eb_info[0]['post_content']; ?>
				</div>  	
			</div>
		</div>
	</div>
<!--
</div>
</div>
</div>
</div>


</div><!-- #content -->
</div><!-- #primary -->


</div><!-- #main -->