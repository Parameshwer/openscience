<section style="background-color: transparent!important;">
	<div class="InnerbanerBG" style="margin-bottom:0px; background-image: url(<?php echo base_url(); ?>public/images/SubjectmanuscriptInner01.jpg);"> 
		<h1 class="uppercase" style="font-weight: 400; text-align:center; color:#fff;"> Latest Articles </h1>  
	</div> 
</section> 

<!-- Content
============================================= -->
<section id="content">

	<div class="content-wrap"> 
		 <div class="container clearfix"> 
			<section id="content" style="margin-bottom: 0px;">

			<div class="content-wrap"> 
				 <div class="container clearfix"> 
					<div> 	 	
						<div class="row clearfix bottommargin-lg topmargin common-height LatestArticles"> 
							<?php 
								foreach ($la_info as $key => $value) {
									echo '<div class="col-lg-6 bottommargin" style="height: 88px;">   
										<div class="feature-box fbox-large fbox-rounded fbox-effect">
											<div class="fbox-icon">
												<img src="http://www.opensciencepublications.com/wp-content/uploads/IJN-4-154fig1.png">
											</div>
											<p> <a href="#"><a href="'.$value['pdf_link'].'">'.$value['article_name'].'</a> </p>
											<div class="row">
													<div class="col-md-6">'.$value['author_name'].'</div>
													<div class="col-md-6" style="text-align:right; font-size:12px"><a href="">'.$value['journal_name'].'</a> </div>
											</div>		
										</div> 
									</div>';		
								}
							?>
							 																					
							<div class="divider divider-center"><a href="#" data-scrollto="#header"><i class="icon-chevron-up"></i></a></div>
							
							<ul class="pager topmargin">
								<li class="previous"><a href="#">← Older</a></li>
								<li class="next"><a href="#">Newer →</a></li>
							</ul>
							 
					

						</div> <!-- /.row-->
			
					</div>
				 </div> 
			</div> 

		</section>			
		 </div> 
	</div> 

</section><!-- #content end -->
