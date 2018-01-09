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
                        //print_r($articles_info);
                        if(!empty($articles_info) && isset($articles_info)) {
                            $name_flag = true;
                            $article_array = array(); 
                            $year_arr = array();
                            $article_data = [];                       
                            foreach ($articles_info as $key => $value) {
                                $article_array[$value['volume_name']][] = $value;
                                array_push($year_arr, $value['archive_year']);
                                $article_data[$value['archive_year']][$value['archive_volume']][] = $value;                          
                            }
                            
                            foreach ($article_array as $key => $value) {
                                foreach ($value as $k => $v) {                                    
                                    if($v['archive_in'] === '1' || $v['archive_in'] === '2') {
                                        if($name_flag) {
                                        echo '<div style="text-transform:capitalize;font-size:15px;font-weight:bold;margin-bottom:10px"><b>'.$key.'</b></div>';
                                        }
                                        echo '<div class="promo promo-light bottommargin-sm">';
                                        if($v['article_type']) {
                                            if($v['article_type'] == 1) {
                                                $v['article_type'] = 'Review Article';
                                            } else if($v['article_type'] == 2) {
                                                $v['article_type'] = 'Research Article';
                                            } else if($v['article_type'] == 3) {
                                                $v['article_type'] = 'Supplementary Information';
                                            }
                                            echo '<h4 class="Article"> <i class="icon-double-angle-right"></i>'.$v['article_type'].'</h4>';
                                        }
                                        echo '<div class="ArticleHead">';
                                        if($v['archive_desc']) {
                                            
                                            echo html_entity_decode($v['archive_desc'], ENT_QUOTES, "UTF-8");
                                        }
                                        echo '<ul class="iconlist"><li><a href="'.$v['article_link'].'"> <i class="icon-caret-right"></i>'.$v['article_title'].'</a></li></ul>'; 
                                        if($v['article_authors']) {
                                            echo '<p class="ArticleCont"> <b> Corresponding Author :</b>'.$v['article_authors'].'</p>'; 
                                        }

                                        echo '<div class="btn-wrapper"><p class="full_text_para"><a target="_blank" href="'.$v['article_link'].'" target="_blank" class="icon-fulltext">Full Text</a></p>';
                                        echo '<p class="pdf_para"><a target="_blank" href="'.base_url().'wp-content/uploads/'.$v['archive_pdf'].'" target="_blank" class="icon-pdf"> PDF</a> </p>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                    }                                     
                                    $name_flag = false;
                                }
                            }
                            if(strpos($this->uri->segment(2), 'archive') !== false) {
                                $loop_flag = true;
                                echo '<div class="tabs tabs-bordered clearfix ui-tabs ui-widget ui-widget-content ui-corner-all" id="tab-2">';
                                    echo '<ul class="tab-nav clearfix ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">';
                                        foreach ($article_data as $key => $value) {
                                            if($loop_flag) {
                                                echo '<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"     role="tab" tabindex="0" aria-controls="'.$key.'" aria-labelledby="'.$key.'-tab" aria-selected="true" aria-expanded="true"><a href="#'.$key.'" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="'.$key.'-tab">'.$key.'</a></li>';
                                            } else {
                                                echo '<li class="ui-state-default ui-corner-top"     role="tab" tabindex="0" aria-controls="'.$key.'" aria-labelledby="'.$key.'-tab" aria-selected="true" aria-expanded="true"><a href="#'.$key.'" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="'.$key.'-tab">'.$key.'</a></li>';
                                            }
                                            $loop_flag = false;
                                        }
                                    echo '</ul>';
                                    echo '<div class="tab-container">';
                                    $volume_name_flag = true;
                                    foreach ($article_data as $key => $value) {

                                        echo '<div class="tab-content clearfix ui-tabs-panel ui-widget-content ui-corner-bottom" id="'.$key.'" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="false" style="display: block;">';
                                            $i = 0;
                                            foreach ($value as $k => $v) {
                                                echo '<div class="toggle toggle-bg">';
                                                //if($volume_name_flag) {
                                                    echo '<div class="togglet"><i class="toggle-closed icon-ok-circle"></i><i class="toggle-open icon-remove-circle"></i>'.$v[$i]['volume_name'].'</div>';
                                                //}
                                                echo '<div class="togglec">';
                                                foreach ($v as $a => $b) {                                                                                                         
                                                        echo '<div class="promo promo-light bottommargin-sm">';
                                                            if($b['article_type'] == '1') {
                                                                $b['article_type'] = 'Review Article';
                                                            } else if ($b['article_type'] == '2') {
                                                                $b['article_type'] = 'Research Article';
                                                            } else if ($b['article_type'] == '3') {
                                                                $b['article_type'] = 'Supplementary Information';
                                                            } 
                                                            echo '<h4 class="Article"> <i class="icon-double-angle-right"></i> '.$b['article_type'].' </h4>';
                                                             
                                                             echo '<div class="ArticleHead">';
                                                             if($b['article_link'] && $b['article_title']) {
                                                                echo '<ul class="iconlist"> 
                                                                        <li><a target="_blank" href="'.$b['article_link'].'"> <i class="icon-caret-right"></i>'.$b['article_title'].'</a> </li>
                                                                    </ul>';
                                                             }
                                                             if($b['article_authors']) {
                                                                echo '<p class="ArticleCont"> <b> Corresponding Author: </b>'.$b['article_authors'].'</p>';
                                                             }
                                                             if($b['archive_fulltext'] && $b['article_link']) {
                                                                 echo '<div class="btn-wrapper">
                                                                        <p class="full_text_para"><a href="http://www.opensciencepublications.com/fulltextarticles/'.$b['archive_fulltext'].'" target="_blank" class="icon-fulltext">Full Text</a></p>
                                                                        
                                                                        <p class="pdf_para"><a href="'.$b['article_link'].'" target="_blank" class="icon-pdf"> PDF</a> </p>
                                                                    </div>';                                                                
                                                             }
                                                        echo '</div>'; 
                                                        echo '</div>'; 
                                                }
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                        echo '</div>';
                                        $volume_name_flag = false;
                                    }
                                    echo '</div>';
                                echo '</div>';
                            }
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