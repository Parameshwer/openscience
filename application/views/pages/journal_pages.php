<section style="background-color: #ccc!important;">
    <div class="InnerbanerBG" style="margin-bottom:0px; background-image: url(images/indian-journal-of-nutritionInner01.jpg);"> 
        <h1 class="uppercase" style="font-weight: 400; text-align:center; color:#fff;">  <?php echo $p_info[0]['journal_name']; ?> </h1>  
    </div> 
</section>
<section id="content" style="margin-bottom: 0px;">

			<div class="content-wrap"> 
				<div class="container clearfix topmargin-sm">

                    <!-- Post Content
                    ============================================= -->
                    <div class="postcontent nobottommargin col_last clearfix">  
					<h3> <?php echo $p_info[0]['post_name']; ?></h3> 
                    <?php 
                        if(!empty($p_info[0]['post_type']) && isset($p_info[0]['post_type'])) {
                            foreach ($p_info as $key => $value) {
                                echo '<div class="media"> <div class="media-left pull-left"><img alt="'.$value['eb_member_name'].'" class="media-object" src="'.base_url().'wp-content/uploads/default-user.png" width="100" height="100"></div> <div class="media-body"> <h4 class="media-heading">'.$value['eb_member_name'].'</h4>'.$value['eb_member_desc'].'</div> </div>';
                            }
                        } else {
                            echo $p_info[0]['post_content'];
                        }
                    ?>
					
                    </div><!-- .postcontent end -->

                    <!-- Sidebar
                    ============================================= -->
                    <div class="sidebar nobottommargin clearfix">
                        <div class="sidebar-widgets-wrap">  

                            <div class="widget widget_links clearfix"> 
                                <?php 
                                    if(!empty($p_info[0]['issn_number']) && isset($p_info[0]['issn_number'])) {
                                    echo '<div class="fancy-title title-center">
    									<h3 class="issno"> [ISSN: - '.$p_info[0]['issn_number'].']  </h3> 	
    								</div>';
                                        
                                    };
                                ?>
                                <ul class="JournalListMenu">
                                    <?php 
                                        foreach ($links_info as $key => $value) {
                                            echo '<li><a href="'.base_url().''.$value['journal_url_slug'].'/'.$value['post_slug'].'"><div>'.$value['post_name'].'</div></a></li>';
                                        }
                                    ?>
                                    
									 
                                </ul> 
                            </div> 
                            <div class="widget clearfix">
								<div class="ConfRespons">
									 <img src="http://opensciencepublications.com/wp-content/uploads/2013/08/Indian-Journal-of-Nutrition.png" alt="Image" style="width:90%; padding-top:5px;">  
								</div>
                            </div>                             
                        </div>
                    </div><!-- .sidebar end -->

                </div>
			</div> 

		</section>