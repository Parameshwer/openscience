<?php

class App_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */    
	function get_journals() {
		$query  = $this->db->query('SELECT * FROM wp_journals WHERE deleted = "1"');		
		return $query->result_array();		

	}
	function get_journal_post ($cat_name,$journal_name,$post_name) {
		
		$query = $this->db->query('SELECT jp.post_title_tag,jp.post_keywords,jp.post_meta_description,jp.post_name,jp.post_slug,jp.post_content,mc.category_name,j.journal_url_slug, j.journal_name,j.banner_image,j.sidebar_image,j.issn_number FROM wp_journal_posts jp INNER JOIN wp_journals j on jp.journal_id = j.id INNER JOIN wp_journal_main_categories mc on mc.category_id = j.main_category_id WHERE jp.post_slug = "'.$post_name.'" AND mc.category_name = "'.$cat_name.'" AND j.journal_url_slug = "'.$journal_name.'"');
		return $query->result_array();
	}
	function get_archive_info($cat_name,$journal_name,$post_name) {		
		if((strpos($post_name, 'articles-in-press') !== false)) {
			$archive_type = '1';			
		} else if((strpos($post_name, 'current-issue') !== false)) {
			$archive_type = '2';						
		} else if((strpos($post_name, 'archive') !== false)) {			
			$archive_type = '3';						
		}else if((strpos($post_name, 'special-issues') !== false) ||  (strpos($post_name, 'special-issue') !== false)) {			
			$archive_type = '4';						
		}
		
		$query  = $this->db->query('SELECT j.journal_name,jp.archive_fulltext_views,jp.archive_pdf_views,jp.supli_pdf_views,jp.archive_volume,jp.id,jp.archive_year,jp.archive_desc,jp.archive_volume,jp.archive_fulltext,jp.archive_pdf,jp.supli_pdf,j.journal_url_slug,jp.archive_in, mc.category_name, jv.volume_name FROM 
			wp_journal_archives jp JOIN wp_journals j 			 
			on jp.journal_id = j.id INNER JOIN wp_journal_main_categories mc
			on mc.category_id = j.main_category_id 
			left join wp_journal_volumes jv 
  			on jv.id=jp.archive_volume
			WHERE jp.archive_in = "'.$archive_type.'" AND mc.category_name = "'.$cat_name.'" AND j.journal_url_slug = "'.$journal_name.'" AND jp.deleted="1" ORDER BY jp.archive_year ASC,jp.archive_volume ASC,jp.archive_pdf ASC'
			);
		return $query->result_array();
	}
	function archive_page_info($journal_name) {
		$query  = $this->db->query('SELECT * FROM wp_journals WHERE journal_url_slug = "'.$journal_name.'" AND deleted = "1"');
		return $query->result_array();		
	}
	function get_sidebar_links($cat_name,$journal_name,$post_name) {
		if((strpos($post_name, 'articles-in-press') !== false)) {
			$archive_type = '1';			
		} else if((strpos($post_name, 'current-issue') !== false)) {
			$archive_type = '2';						
		} else if((strpos($post_name, 'archive') !== false)) {			
			$archive_type = '3';						
		}else if((strpos($post_name, 'special-issues') !== false) || (strpos($post_name, 'special-issue') !== false)) {			
			$archive_type = '4';						
		}
		if($archive_type == '3') {
			$query = $this->db->query('SELECT * FROM wp_journal_archives jp INNER JOIN wp_journals j on jp.journal_id = j.id INNER JOIN wp_journal_main_categories mc on mc.category_id = j.main_category_id WHERE mc.category_name = "'.$cat_name.'" AND j.journal_url_slug = "'.$journal_name.'"');
		} else {
			$query  = $this->db->query('SELECT * FROM wp_journal_archives jp INNER JOIN wp_journals j on jp.journal_id = j.id INNER JOIN wp_journal_main_categories mc on mc.category_id = j.main_category_id WHERE mc.category_name = "'.$cat_name.'" AND j.journal_url_slug = "'.$journal_name.'"');
		}
		
		return $query->result_array();
	}
	function get_home_page_journals($position) {
		$query = $this->db->query("SELECT * FROM `wp_journals` WHERE deleted='1' LIMIT $position, 4");
		
		return $query->result_array();
	}

	function get_sidebar_slugs ($cat_name,$journal_name,$post_name) {
		/*$query = $this->db->query('SELECT * FROM wp_journal_posts INNER JOIN wp_journal_main_categories 
			ON wp_journal_posts.category_id = wp_journal_main_categories.category_id 
			WHERE journal_slug = "'.$journal_name.'" AND category_name="'.$cat_name.'"');*/			
		$query = $this->db->query('SELECT jp.post_name,mc.category_name,j.journal_url_slug,jp.post_slug FROM wp_journal_posts jp INNER JOIN wp_journals j on jp.journal_id = j.id INNER JOIN wp_journal_main_categories mc on mc.category_id = j.main_category_id WHERE mc.category_name = "'.$cat_name.'" AND j.journal_url_slug = "'.$journal_name.'" ORDER BY jp.created_date ASC');			
		return $query->result_array();
	}
	function get_testimonials() {
		$query = $this->db->query("SELECT * FROM wp_testimonials WHERE deleted = '1'");			
		return $query->result_array();	
	}
	function get_search_results($string) {
		if(isset($string) && !empty($string)) {
			$query  = $this->db->query('SELECT * FROM wp_journal_archives jp JOIN wp_journals j on jp.journal_id = j.id INNER JOIN wp_journal_main_categories mc on mc.category_id = j.main_category_id WHERE jp.archive_desc LIKE "%'.$string.'%"');

			return $query->result_array();					
		}
	}

function get_journals_and_categories() {
		$query = $this->db->query("SELECT wp_journals.journal_name,wp_journals.id, wp_journal_main_categories.category_id, wp_journal_main_categories.category_name FROM wp_journals INNER JOIN wp_journal_main_categories ON wp_journals.main_category_id=wp_journal_main_categories.category_id GROUP BY wp_journals.journal_name");
		return $query->result_array();
	}
	function get_countries() {
		$query = $this->db->query("SELECT * FROM wp_countries");
		return $query->result_array();	
	}
function updateSuplitype($data) {				
		if(isset($data->id) && !empty($data->id)) {
		$query = $this->db->query("UPDATE wp_supli_types SET supli_name='".$data->supli_name."',journal_id='".$data->journal_id."',updated_date='".date('Y-m-d')."' WHERE id=$data->id");
		} else {
		   $query = $this->db->query("INSERT INTO wp_supli_types (supli_name, journal_id, updated_date, created_date) VALUES ('".$data->supli_name."','".$data->journal_id."','".date('Y-m-d')."','".date('Y-m-d')."')");
		}
		return $query;	
	}
	function get_supli_type_by_journal ($data) {
		if(isset($data) && !empty($data)) {			
			$query = $this->db->query("SELECT * FROM `wp_supli_types` WHERE journal_id='".$data."'");
			return $query->result_array();
		}
	}
function get_Suplitypes() {
	$query = $this->db->query('SELECT * FROM wp_supli_types');				
	return $query->result_array();	
}
function get_Suplitype($sid) {
	
	$query = $this->db->query('SELECT * FROM  wp_supli_types WHERE id = "'.$sid.'"');	
	//print_r($query);				
	return $query->result_array();
}
function save_submit_manuscript_info($data) {	
	if(isset($data) && !empty($data)) {	
	   $query = $this->db->query(
	   	"INSERT INTO wp_manuscript (firstname, lastname, tell_no, phoneno, email, alter_email, country, journal, article, cauthor, uploadfile, created_date) VALUES 
	   		('".$data['firstname']."','".$data['lastname']."','".$data['tellno']."','".$data['phoneno']."','".$data['email']."','".$data['alt_email']."','".$data['country']."','".$data['journal']."','".$data['article']."','".$data['cauthor']."','".$data['temp_file_upload']."','".date('Y-m-d')."')"
	   	);	   
		return $query;	
	}
}
function save_collab_info($data) {	
	if(isset($data) && !empty($data)) {	
	   $query = $this->db->query(
	   	"INSERT INTO wp_collaboration (contact_person, email, univer_name, mail_address, country, pincode, telephone, fax, wesite_url, mem_univer_dept, created_date) VALUES 
	   	    ('".$data['contact_person']."','".$data['email']."','".$data['institute_name']."','".$data['mailing_address']."','".$data['country']."','".$data['pincode']."','".$data['telephone']."','".$data['faxs']."','".$data['website_rrl']."','".$data['noof_members']."','".date('Y-m-d')."')"
	   	);	   
		return $query;	
	}
}
function save_statistics_info($id, $type) {
	if($type == 'full_text') {
		$string = 'archive_fulltext_views';
	}else if($type == 'pdf') {
		$string = 'archive_pdf_views';
	}else if($type == 'supli_pdf') {
		$string = 'supli_pdf_views';
	}

	$this->db->query("UPDATE wp_journal_archives SET ".$string." = ".$string." + 1 WHERE id = $id");
	$query = $this->db->query("SELECT $string FROM  wp_journal_archives WHERE id = $id");			
	return $query->result();	
}
function get_eb_info ($cat_name,$journal_name,$post_name) {
		
		$query = $this->db->query('SELECT eb.id,eb.eb_post_slug,eb.eb_journal_slug,j.journal_name,mc.category_name,eb.eb_member_name,eb.eb_member_photo,eb.eb_member_country,eb.editor_chief,eb.eb_member_desc,eb.updated_date, j.issn_number, j.banner_image, j.sidebar_image FROM wp_eb_members eb INNER JOIN wp_journals j on eb.journal_id = j.id INNER JOIN wp_journal_main_categories mc on mc.category_id = j.main_category_id WHERE eb.eb_journal_slug ="'.$journal_name.'" AND eb.eb_post_slug = "'.$post_name.'" AND eb.deleted="1" ORDER BY eb.editor_chief DESC');
		return $query->result_array();
	}
function get_fulltext_info($title) {
	$temp = explode(".", $title);	
	if(isset($title) && !empty($title)) {
		$query  = $this->db->query('SELECT ft.post_content,ft.post_browser_title,ft.post_meta_keywords,j.issn_number,j.journal_name,j.banner_image,j.sidebar_image FROM wp_fulltextarticles ft JOIN wp_journals j ON ft.journal_id = j.id WHERE ft.post_title ="'.$temp[0].'"');

		return $query->result_array();					
	}
}

function generate_sitemap_fulltext(){
$query = $this->db->query('SELECT post_title, post_browser_title, post_meta_keywords FROM  wp_fulltextarticles');	
	//print_r($query);				
	return $query->result_array();
}
function generate_sitemap_pdf(){
$query = $this->db->query('SELECT archive_pdf FROM  wp_journal_archives');	
	//print_r($query);				
	return $query->result_array();
}
}
