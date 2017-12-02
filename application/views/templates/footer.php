
		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark">

			<div class="container">

				<!-- Footer Widgets
				============================================= -->
				<div class="footer-widgets-wrap clearfix">

					<div class="col_two_third">

						<div class="widget clearfix">

						 

							<div class="clearfix" style="padding: 10px 0; background: url('images/world-map.png') no-repeat center center;">
								<div class="col_two_fifth">
									<address class="nobottommargin">
										<abbr title="Address" style="display: inline-block;margin-bottom: 7px;"><strong> Contact :</strong></abbr><br>
										Open Science Publications <br>
										502 Padmaja Towers <br>
										Srinagar Colony <br>
										Hyderabad <br>
										INDIA-500073
									</address>
								</div>
								<div class="col_three_fifth col_last">
									<abbr title="Phone Number"><strong>Phone:</strong></abbr>  +91-9177734525 <br> 
									<abbr title="Email Address"><strong>Email:</strong></abbr> info@opensciencepublications.com
								</div>
							</div>

							<a href="#" class="social-icon si-small si-rounded topmargin-sm si-facebook">
								<i class="icon-facebook"></i>
								<i class="icon-facebook"></i>
							</a>

							<a href="#" class="social-icon si-small si-rounded topmargin-sm si-twitter">
								<i class="icon-twitter"></i>
								<i class="icon-twitter"></i>
							</a>
							
							<a href="#" class="social-icon si-small si-rounded topmargin-sm si-linkedin">
								<i class="icon-linkedin"></i>
								<i class="icon-linkedin"></i>
							</a>

							<a href="#" class="social-icon si-small si-rounded topmargin-sm si-rss">
								<i class="icon-rss"></i>
								<i class="icon-rss"></i>
							</a>

							<a href="#" class="social-icon si-small si-rounded topmargin-sm si-blogger">
								<i class="icon-blogger"></i>
								<i class="icon-blogger"></i>
							</a>

							  
						</div>

					</div>

					<div class="col_one_third col_last">

						<div class="widget widget_links clearfix">

								<h4> Company </h4>

								<ul>
									<li><a href="#"> About Us </a></li>
									<li><a href="#"> Policies </a></li>
									<li><a href="#"> Membership </a></li>
									 
								</ul>

							</div>

					</div> 

				</div><!-- .footer-widgets-wrap end -->

			</div>

			<!-- Copyrights
			============================================= -->
			<div id="copyrights">

				<div class="container clearfix">

					<div class="col_full">
						Copyrights &copy; 2013 All Rights Reserved by Open Science Publications.<br> 
					</div> 
					
					<div class="col_full">
						<p style="margin-top:-30px;">Open Science Publications is an Open Access Publisher &amp; 
					all published content, except where otherwise noted, is licensed under a Creative Commons</p>
					<p style="margin-top:-25px;">
						This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/3.0/deed.en_US">Creative Commons Attribution 3.0 Unported License</a>. <br>	<a rel="license" href="http://creativecommons.org/licenses/by/3.0/deed.en_US"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by/3.0/88x31.png"></a>				
											
						</p>
					</div> 

				</div>

			</div><!-- #copyrights end -->

		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>


	<!-- External JavaScripts
	============================================= -->
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/plugins.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/functions.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.bootpag.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#latest-journals").load("<?php echo base_url(); ?>home/get_home_page_journals/"); 
			$(".pagination").bootpag({
				total: 16,
				page: 1,
				maxVisible: 4,
				leaps: false 
			}).on("page", function(e, num){
				e.preventDefault();
				$("#latest-journals").prepend('<div class="loading-indication"></div>');		
				$("#latest-journals").load("<?php echo base_url(); ?>home/get_home_page_journals/", {'page':num});
			});
		});
	</script>
</body>
</html>