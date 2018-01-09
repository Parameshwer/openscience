<?php

class App_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */ 

    function get_home_page_journals($position) {
		$query = $this->db->query("SELECT * FROM `wp_journals` WHERE deleted='1' LIMIT $position, 4");
		
		return $query->result_array();
	}

	function get_journals() {
		$query  = $this->db->query("SELECT * FROM wp_journals INNER JOIN wp_journal_posts ON wp_journals.id = wp_journal_posts.journal_id WHERE post_name = 'Home' AND wp_journals.deleted ='1' ORDER BY wp_journals.created_date ASC");		
		return $query->result_array();		

	}
	function get_sidebar_slugs ($journal_name,$post_name) {		
		$query = $this->db->query('SELECT jp.post_name,j.journal_url_slug,jp.post_slug FROM wp_journal_posts jp INNER JOIN wp_journals j on jp.journal_id = j.id AND j.journal_url_slug = "'.$journal_name.'" ORDER BY jp.created_date ASC');		
		return $query->result_array();
	}
	function get_journal_page($journal_url_slug,$post_name,$post_type) {
		if($post_type == 'eb_post') {			
			$query = $this->db->query('SELECT eb.id,eb.eb_post_slug,eb.eb_journal_slug,j.journal_name,eb.eb_member_name,eb.eb_member_photo,eb.eb_member_country,eb.editor_chief,eb.eb_member_desc,eb.updated_date, j.issn_number, j.banner_image, j.sidebar_image FROM wp_eb_members eb INNER JOIN wp_journals j on eb.journal_id = j.id WHERE j.journal_url_slug="'.$journal_url_slug.'" AND eb.deleted="1" ORDER BY eb.editor_chief DESC');		
		} else {
			$query = $this->db->query('SELECT wp_journal_posts.post_name, wp_journals.issn_number, wp_journal_posts.post_content, wp_journals.journal_name FROM wp_journals INNER JOIN wp_journal_posts ON wp_journals.id = wp_journal_posts.journal_id WHERE post_slug = "'.$post_name.'" AND wp_journals.journal_url_slug ="'.$journal_url_slug.'"');		
			
		}
		return $query->result_array();
	}

	function get_eb_info ($journal_url_slug,$post_name) {	
		$query = $this->db->query('SELECT eb.id,eb.eb_post_slug,eb.eb_journal_slug,j.journal_name,eb.eb_member_name,eb.eb_member_photo,eb.eb_member_country,eb.editor_chief,eb.eb_member_desc,eb.updated_date, j.issn_number, j.banner_image, j.sidebar_image FROM wp_eb_members eb INNER JOIN wp_journals j on eb.journal_id = j.id WHERE j.journal_url_slug="'.$journal_url_slug.'" AND eb.deleted="1" ORDER BY eb.editor_chief DESC');
		return $query->result_array();
	}

	function get_archive_info($journal_name,$post_name) {		
		if((strpos($post_name, 'articles-in-press') !== false)) {
			$archive_type = '1';			
		} else if((strpos($post_name, 'current-issue') !== false)) {
			$archive_type = '2';						
		} else if((strpos($post_name, 'archive') !== false)) {			
			$archive_type = '3';						
		}else if((strpos($post_name, 'special-issues') !== false) ||  (strpos($post_name, 'special-issue') !== false)) {			
			$archive_type = '4';						
		}
		
		$query  = $this->db->query('SELECT j.journal_name,jp.archive_fulltext_views,jp.article_title,jp.article_link, jp.article_authors, jp.archive_pdf_views,jp.supli_pdf_views,jp.archive_volume,jp.id,jp.archive_year,jp.archive_desc,jp.archive_volume,jp.archive_fulltext,jp.archive_pdf,jp.supli_pdf,jp.archive_in,jp.article_type,jp.archive_volume, jv.volume_name, j.journal_url_slug,jp.archive_in,jp.article_type, jv.volume_name FROM 
			wp_journal_archives jp JOIN wp_journals j 			 
			on jp.journal_id = j.id 
			left join wp_journal_volumes jv 
  			on jv.id=jp.archive_volume
			WHERE jp.archive_in = "'.$archive_type.'" AND j.journal_url_slug = "'.$journal_name.'" AND jp.deleted="1" ORDER BY jp.archive_year ASC,jp.archive_volume ASC,jp.archive_pdf ASC'
			);
		
		return $query->result_array();
	}
	function get_latest_articles() {
		$query = $this->db->query("SELECT * FROM wp_latest_articles la INNER JOIN wp_journals j ON la.article_category = j.id WHERE la.deleted ='1' ORDER BY la.created_date");
		return $query->result_array();
	}
	
}
