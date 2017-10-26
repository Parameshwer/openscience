<section style="background-color: transparent!important;">
			<div class="InnerbanerBG" style="margin-bottom:0px; background-image: url(<?php echo base_url(); ?>public/images/SubjectmanuscriptInner01.jpg);"> 
				<h1 class="uppercase" style="font-weight: 400; text-align:center; color:#fff;"> Submit Manuscript </h1>  
			</div> 
        </section> 

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap"> 
				 <div class="container clearfix"> 
					<div class="paddingBoth-lg topmargin-sm">
						 <div class="contact-widget bottommargin-lg">

							<div class="contact-form-result"></div>
							<div class="col-md-12">
								<p class="text-muted"><strong>*</strong> These fields are required.  </p>
							</div>

							<form class="nobottommargin" id="submit-manuscript" name="template-contactform" action="#" method="post" enctype="multipart/form-data">

								<div class="form-process"></div>

								<div class="col_half">
									<label for="sm-first-name"> First Name <small>*</small></label>
									<input type="text" id="sm-first-name" name="sm-first-name" value="" class="sm-form-control required" />
								</div>
								
								<div class="col_half col_last">
									<label for="sm-last-name"> Last Name <small>*</small></label>
									<input type="text" id="sm-last-name" name="sm-last-name" value="" class="sm-form-control required" />
								</div>

								<div class="col_half">
									<label for="sm-email"> Email <small>*</small></label>
									<input type="email" id="sm-email" name="sm-email" value="" class="required email sm-form-control" />
								</div>

								<div class="col_half col_last">
									<label for="sm-phone">Phone <small>*</small> </label>
									<input type="text" id="sm-phone" name="sm-phone"  pattern= "[0-9]" value="" class="required sm-form-control" />
								</div>
								
								<div class="col_half">
									<label for="sm-country"> Country <small>*</small> </label>
									<input type="text" id="sm-country" name="sm-country" value="" class="required sm-form-control" />
								</div>
								
								<div class="col_half col_last">
									<label for="sm-state"> State <small>*</small> </label>
									<input type="text" id="sm-state" name="sm-state" value="" class="required sm-form-control" />
								</div>

								<div class="clear"></div>

								<div class="col_half">
									<label for="sm-journal"> Select Journal <small>*</small> </label>
									<select id="sm-journal" name="sm-journal" class="required sm-form-control">
										<option value="">-- Select One --</option>
										 <option value="Indian Journal of Applied Radiology">Indian Journal of Applied Radiology</option>
										 <option value="Indian Journal of Nutrition">Indian Journal of Nutrition</option>
										 <option value="Indian Journal of Ocular Biology">Indian Journal of Ocular Biology</option>
										 <option value="Indian Journal of Cardio Biology &amp; Clinical Sciences">Indian Journal of Cardio Biology &amp; Clinical Sciences</option>
										 <option value="Journal of Cancer Research and Molecular Medicine">Journal of Cancer Research and Molecular Medicine</option>
										 <option value="Journal of Immunology and Vaccine Technology">Journal of Immunology and Vaccine Technology</option>
										 <option value="Journal of Enzymology and Metabolism">Journal of Enzymology and Metabolism</option>
										 <option value="Journal of chemistry &amp; Applied Biochemistry">Journal of chemistry &amp; Applied Biochemistry</option>
										 <option value="Journal of Plant Science and Research">Journal of Plant Science and Research</option>
										 <option value="Journal of Cell Science &amp; Molecular Biology">Journal of Cell Science &amp; Molecular Biology</option>
										 <option value="Environmental and Social Sciences">Environmental and Social Sciences</option> 
									</select>
								</div>

								<div class="col_half col_last">
									<label for="sm-article"> Article <small>*</small> </label>
									<input type="text" id="sm-article" name="sm-article" value="" class="required sm-form-control" />
								</div>

								<div class="clear"></div>
								
								<div class="col_half">
									<label for="sm-author"> Corresponding Author  </label>
									<input type="text" id="sm-author" name="sm-author" value="" class="sm-form-control" />
								</div>

								<div class="col_half  col_last">
									<label for="sm-file">Upload File <small>*</small></label>
									<input type="file" id="sm-file" name="sm-file"  accept="application/msword, application/pdf, application/x-zip, application/zip, application/x-zip-compressed, application/force-download, application/octet-stream, application/x-rar, application/rar, application/x-rar-compressed, application/force-download, application/octet-stream" value="" class="required sm-form-control" />
								</div>
 
								<div class="col_full hidden">
									<input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
								</div>

								<div class="col_full">
									<button class="button button-3d nomargin" type="submit" id="sm-submit" name="sm-submit" value="submit"> Submit </button>
								</div>

							</form>

						</div>	
					</div>
				 </div> 
			</div> 

		</section><!-- #content end -->
		