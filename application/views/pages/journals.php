		<section style="background-color: transparent!important;">
			<div class="InnerbanerBG" style="margin-bottom:0px; background-image: url(<?php echo base_url(); ?>public/images/JOURNALsInner01.jpg);"> 
				<h1 class="uppercase" style="font-weight: 400; text-align:center; color:#fff;"> Journals </h1>  
			</div> 
        </section> 

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap"> 
				 <div class="container clearfix"> 
					<div class="paddingBoth-lg topmargin-sm">
						 <div class="table-responsive">
							<table class="table table-bordered table-striped JournalList">
							  <colgroup>
								<col class="col-xs-7">
								<col class="col-xs-3">
							  </colgroup>
							  <thead>
								<tr>
								  <th> Journal Name </th>
								  <th> ISSN Number </th>
								</tr>
							  </thead>
							  <tbody>
							  	<?php 
							  		foreach ($j_info as $key => $value) {
									echo '<tr>
									  <td>
										<a href="'.base_url().''.$value['journal_url_slug'].'/'.$value['post_slug'].'">'.$value['journal_name'].'</a>
									  </td>
									  <td><b>'.$value['issn_number'].'</b></td>
									</tr>';							  			
							  		}
							  	?>
								
							  </tbody>
							</table>
						  </div>	
					</div>
				 </div> 
			</div> 

		</section><!-- #content end -->
		
