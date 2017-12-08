<?php

class Admin_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	function validate($user_name, $password)
	{	
		
		$this->db->where('user_name', $user_name);
		$this->db->where('pass_word', $password);
		$query = $this->db->get('membership');		
		if($query->result_id->num_rows == 1)
		{
			return true;
		}		
	}

    /**
    * Serialize the session data stored in the database, 
    * store it in a new array and return it to the controller 
    * @return array
    */
	function get_db_session_data()
	{
		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); /* array to store the user data we fetch */
		foreach ($query->result() as $row)
		{
		    $udata = unserialize($row->user_data);
		    /* put data in array using username as key */
		
		    $user['user_name'] = $udata['user_name']; 
		    $user['is_logged_in'] = $udata['is_logged_in']; 
		}
		return $user;
	}
	
    /**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */	
	function create_member()
	{

		$this->db->where('user_name', $this->input->post('username'));
		$query = $this->db->get('membership');

        if($query->num_rows > 0){
        	echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			  echo "Username already taken";	
			echo '</strong></div>';
		}else{

			$new_member_insert_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email_addres' => $this->input->post('email_address'),			
				'user_name' => $this->input->post('username'),
				'pass_word' => md5($this->input->post('password'))						
			);
			$insert = $this->db->insert('membership', $new_member_insert_data);
		    return $insert;
		}
	      
	}//create_member
	function get_count() {
		$query = $this->db->query('SELECT count(DISTINCT wp_journals.journal_name) as journal_count, count(DISTINCT wp_journal_main_categories.category_name) as category_count FROM wp_journals INNER JOIN wp_journal_main_categories on wp_journals.main_category_id = wp_journal_main_categories.category_id ORDER BY wp_journals.journal_name');				
		return $query->result_array();
	}
	function get_categories($search_str) {
		if($search_str) {
			$query = $this->db->query('SELECT * FROM `wp_journal_main_categories` WHERE deleted = "1" AND category_name LIKE "%'.$search_str.'%"');							
		} else {
			$query = $this->db->query('SELECT * FROM `wp_journal_main_categories` WHERE deleted = "1" ');
		}		
		return $query->result_array();
	}
	function get_journals($search_str) {
		if($search_str) {			
			$query = $this->db->query('SELECT * FROM wp_journals WHERE journal_name LIKE "%'.$search_str.'%"');				
		} else {

		$query = $this->db->query('SELECT * FROM wp_journals WHERE deleted ="1"');				
		}
		return $query->result_array();
	}
	function get_LatestArticles($search_str) {
		if($search_str) {
			$query = $this->db->query('SELECT wp_latest_articles.id,wp_latest_articles.article_image,wp_latest_articles.article_name,wp_latest_articles.created_date,wp_latest_articles.author_name,wp_latest_articles.pdf_link,wp_journals.journal_name FROM wp_latest_articles INNER JOIN wp_journals ON wp_journals.id = wp_latest_articles.article_category WHERE wp_latest_articles.deleted = "1" AND wp_latest_articles.article_name LIKE "%'.$search_str.'%"');	
		} else {
		$query = $this->db->query('SELECT wp_latest_articles.id,wp_latest_articles.article_image,wp_latest_articles.article_name,wp_latest_articles.created_date,wp_latest_articles.author_name,wp_latest_articles.pdf_link,wp_journals.journal_name FROM wp_latest_articles INNER JOIN wp_journals ON wp_journals.id = wp_latest_articles.article_category WHERE wp_latest_articles.deleted = "1"');							
		}
		return $query->result_array();	
	}
	function get_Testimonials() {
		$query = $this->db->query('SELECT * FROM wp_testimonials');				
		return $query->result_array();	
	}
	function get_SubmitManuscript() {
		$query = $this->db->query('SELECT * FROM wp_manuscript ORDER BY created_date DESC LIMIT 100 ');				
		return $query->result_array();	
	}
	function get_Home_Latest_Updates() {
		$query = $this->db->query('SELECT * FROM wp_home_latest_updates ORDER BY created_date DESC LIMIT 100 ');				
		return $query->result_array();	
	}
	function get_Collaborations() {
		$query = $this->db->query('SELECT * FROM  wp_collaboration ORDER BY created_date DESC LIMIT 100 ');
		return $query->result_array();	
	}
	function get_journal_posts($search_str) {
		if($search_str) {
			$query = $this->db->query('SELECT jp.id, jp.post_name, j.journal_name, jp.post_slug,jp.created_date,jp.post_content, jp.updated_date FROM wp_journal_posts jp INNER JOIN wp_journals j on jp.journal_id = j.id WHERE jp.deleted="1" AND jp.post_name LIKE "%'.$search_str.'%"');
		} else {			
			$query = $this->db->query('SELECT jp.id, jp.post_name, j.journal_name, jp.post_slug,jp.created_date,jp.post_content, jp.updated_date FROM wp_journal_posts jp INNER JOIN wp_journals j on jp.journal_id = j.id WHERE jp.deleted="1"');
		}
			
		//print_r($query);				
		return $query->result_array();
	}
	function get_journals_archives() {
		$query = $this->db->query('SELECT a.id, a.archive_doi,a.archive_year,a.archive_volume, a.archive_fulltext,a.archive_pdf,a.archive_in, a.created_date,a.archive_desc, b.journal_name, c.category_name FROM wp_journal_archives a, wp_journals b, wp_journal_main_categories c WHERE a.journal_id = b.id AND b.main_category_id = c.category_id AND a.deleted = 1');	
		//print_r($query);				
		return $query->result_array();
	}
	function get_archives_by_journal($j, $a) {		
		$query = $this->db->query('SELECT a.id, a.archive_doi,a.archive_year,a.archive_volume, a.archive_fulltext,a.archive_pdf,a.archive_in, a.created_date,a.archive_desc, b.journal_name, c.category_name FROM wp_journal_archives a, wp_journals b, wp_journal_main_categories c WHERE a.journal_id = b.id AND b.main_category_id = c.category_id AND a.archive_in = "'.$a.'" AND a.journal_id = "'.$j.'" AND a.deleted = 1');	
			
		return $query->result_array();
	}
	function get_journal_archive($archive_id) {
		$query = $this->db->query('SELECT * FROM  wp_journal_archives WHERE id = "'.$archive_id.'" AND deleted = 1');	
		//print_r($query);				
		return $query->result_array();
	}
	function get_latest_Article($article_id) {
		
		$query = $this->db->query('SELECT * FROM  wp_latest_articles WHERE id = "'.$article_id.'" AND deleted = 1');	
		//print_r($query);				
		return $query->result_array();
	}
	function get_Testimonial($article_id) {
		
		$query = $this->db->query('SELECT * FROM  wp_testimonials WHERE id = "'.$article_id.'"');	
		//print_r($query);				
		return $query->result_array();
	}

	function get_main_category($cat_id) {		
		//echo "SELECT * FROM wp_journal_main_categories WHERE category_id=".$cat_id."";exit;
		$query = $this->db->query("SELECT * FROM wp_journal_main_categories WHERE category_id=$cat_id");
		return $query->result_array();
	}
	function get_latest_update($l_id) {				
		$query = $this->db->query("SELECT * FROM wp_home_latest_updates WHERE id=$l_id");
		return $query->result_array();
	}
	function insert_main_category($id,$name) {		
		if($id) {
		$query = $this->db->query("UPDATE wp_journal_main_categories SET category_name='".$name."', updated_date ='".date('Y-m-d')."' WHERE category_id=$id");
		} else {
		   $query = $this->db->query("INSERT INTO wp_journal_main_categories (category_name, created_date, updated_date, deleted) VALUES ('".$name."','".date('Y-m-d')."','".date('Y-m-d')."','1')");
		}
		return $query;
		//return $query->result_array();
	}

	function insert_latest_update($id,$descriptin) {		
		if($id) {
		$query = $this->db->query("UPDATE wp_home_latest_updates SET latest_update_description	='".$descriptin."', updated_date ='".date('Y-m-d')."' WHERE id=$id");
		} else {
		   $query = $this->db->query("INSERT INTO wp_home_latest_updates (latest_update_description, created_date, updated_date) VALUES ('".$descriptin."','".date('Y-m-d')."','".date('Y-m-d')."')");
		}
		return $query;
		//return $query->result_array();
	}

	function get_jounal($journal_id) {		
		$query = $this->db->query("SELECT * FROM wp_journals WHERE id=$journal_id");
		return $query->result_array();
	}
	function get_journalPage($page_id) {		
		$query = $this->db->query("SELECT * FROM wp_journal_posts WHERE id=$page_id");
		return $query->result_array();
	}
	function insert_journal($data) {		
   		$journal_url_slug = array_key_exists('journal_url_slug', $data)?$data->journal_url_slug:"";
   		$journal_name = array_key_exists('journal_name', $data)?$data->journal_name:"";
   		$issn_number = array_key_exists('issn_number', $data)?$data->issn_number:"";
   		$journal_meta_keywords = array_key_exists('journal_meta_keywords', $data)?$data->journal_meta_keywords:"";
   		$journal_description = array_key_exists('journal_description', $data)?$data->journal_description:"";
   		$banner_image = array_key_exists('banner_image', $data)?$data->banner_image:"";
   		$sidebar_image = array_key_exists('sidebar_image', $data)?$data->sidebar_image:"";
   		$journal_indexed_desc = array_key_exists('journal_indexed_desc', $data)?$data->journal_indexed_desc:"";
   		$journal_image = array_key_exists('journal_image', $data)?$data->journal_image:"";

		if($data->id) {
		$query = $this->db->query("UPDATE wp_journals SET journal_url_slug='".$journal_url_slug."',journal_name='".$journal_name."', updated_date ='".date('Y-m-d')."',issn_number ='".$issn_number."',journal_meta_keywords ='".$journal_meta_keywords."',journal_description ='".$journal_description."', banner_image ='".$banner_image."',sidebar_image ='".$sidebar_image."',journal_indexed_desc ='".$journal_indexed_desc."',journal_image ='".$journal_image."' WHERE id=$data->id");
		} else {
		   $query = $this->db->query("INSERT INTO wp_journals (journal_image, journal_url_slug,journal_name, created_date, updated_date, issn_number,journal_meta_keywords,journal_description,deleted, banner_image, sidebar_image,journal_indexed_desc) VALUES ('".$journal_image."','".$journal_url_slug."','".$journal_name."','".date('Y-m-d')."','".date('Y-m-d')."','".$issn_number."','".$journal_meta_keywords."','".$journal_description."','1','".$banner_image."','".$sidebar_image."','".$journal_indexed_desc."')");
		}		
		return $query;
		//return $query->result_array();
	}

	function get_journals_and_categories() {
		$query = $this->db->query("SELECT wp_journals.journal_name,wp_journals.id, wp_journal_main_categories.category_id, wp_journal_main_categories.category_name FROM wp_journals INNER JOIN wp_journal_main_categories ON wp_journals.main_category_id=wp_journal_main_categories.category_id GROUP BY wp_journals.journal_name");
		return $query->result_array();
	}
	function update_journal_page($data) {

		$post_name = array_key_exists('post_name', $data)?$data->post_name:"";
		$post_slug = array_key_exists('post_slug', $data)?$data->post_slug:"";
		$post_keywords = array_key_exists('post_keywords', $data)?$data->post_keywords:"";
		$post_title_tag = array_key_exists('post_title_tag', $data)?$data->post_title_tag:"";
		$post_meta_description = array_key_exists('post_meta_description', $data)?$data->post_meta_description:"";
		$post_content = array_key_exists('post_content', $data)?$data->post_content:"";
		$journal_id = array_key_exists('journal_id', $data)?$data->journal_id:"";

		if(isset($data->id) && !empty($data->id)) {
			
		$query = $this->db->query("UPDATE wp_journal_posts SET post_name='".$post_name."', updated_date ='".date('Y-m-d')."',post_slug ='".$post_slug."',post_keywords ='".$post_keywords."',post_title_tag ='".$post_title_tag."',post_meta_description ='".$post_meta_description."',post_content ='".$post_content."',journal_id ='".$journal_id."' WHERE id=$data->id");
		} else {
		   $query = $this->db->query("INSERT INTO wp_journal_posts (post_title_tag,post_meta_description,post_keywords,post_name, created_date, updated_date,post_slug,post_content,journal_id,deleted) VALUES ('".$post_title_tag."','".$post_meta_description."','".$post_keywords."','".$post_name."','".date('Y-m-d')."','".date('Y-m-d')."','".$post_slug."','".$post_content."','$journal_id','1')");
		}
		return $query;
		//return $query->result_array();
	}
	function update_archive($data) {		

		$data->archive_pdf = (isset($data->archive_pdf) && !empty($data->archive_pdf))?$data->archive_pdf:'';
		$data->supli_pdf = (isset($data->supli_pdf) && !empty($data->supli_pdf))?$data->supli_pdf:'';
		$data->archive_fulltext = (isset($data->archive_fulltext) && !empty($data->archive_fulltext))?$data->archive_fulltext:'';
		if(isset($data->id) && !empty($data->id)) {
		$temp = htmlentities($data->archive_desc, ENT_QUOTES, "UTF-8");
		$query = $this->db->query("UPDATE wp_journal_archives SET journal_id='".$data->journal_id."',category_id='".$data->category_id."',archive_desc='".$temp."', archive_doi='".$data->archive_doi."',archive_year='".$data->archive_year."',archive_volume='".$data->archive_volume."',archive_fulltext='".$data->archive_fulltext."',archive_pdf='".$data->archive_pdf."',journal_slug='".$data->journal_slug."',archive_in='".$data->archive_in."',supli_pdf='".$data->supli_pdf."',article_title='".$data->article_title."',article_link='".$data->article_link."',article_authors='".$data->article_authors."',doi_name='".$data->doi_name."',doi_link='".$data->doi_link."' WHERE id=$data->id");
		}/* else {
		   $query = $this->db->query("INSERT INTO wp_journal_archives (journal_id, category_id, archive_desc,archive_doi, archive_year, archive_volume, archive_fulltext, archive_pdf, supli_pdf,archive_in, journal_slug,created_date, updated_date, deleted) VALUES ('".$data->journal_id."','".$data->category_id."','".$data->archive_desc."','".$data->archive_doi."','".$data->archive_year."','".$data->archive_volume."','".$data->archive_fulltext."','".$data->archive_pdf."','".$data->supli_pdf."','".$data->archive_in."','".$data->journal_slug."','".date('Y-m-d')."','".date('Y-m-d')."','1')");
		}*/
		return $query;
		//return $query->result_array();
	}
	function update_latest_article($data) {
	//print_r($data);exit;		
		if(isset($data->id) && !empty($data->id)) {
			
		$query = $this->db->query("UPDATE wp_latest_articles SET article_name='".$data->article_name."', pdf_link='".$data->pdf_link."',article_category='".$data->article_category."', article_image='".$data->article_image."',author_name	='".$data->author_name	."',updated_date='".date('Y-m-d')."' WHERE id=$data->id");
		} else {
		   $query = $this->db->query("INSERT INTO wp_latest_articles (article_name, pdf_link, article_category,article_image, author_name, updated_date, created_date, deleted) VALUES ('".$data->article_name."','".$data->pdf_link."','".$data->article_category."','".$data->article_image."','".$data->author_name."','".date('Y-m-d')."','".date('Y-m-d')."','1')");
		}
		return $query;
		//return $query->result_array();
	}
	function updateTestimonial($data) {				
		if(isset($data->id) && !empty($data->id)) {
		$query = $this->db->query("UPDATE wp_testimonials SET user_name='".$data->user_name."', user_img='".$data->user_img."',testimonial_desc='".$data->testimonial_desc."', user_desig='".$data->user_desig."',user_university='".$data->user_university	."',updated_date='".date('Y-m-d')."' WHERE id=$data->id");
		} else {
		   $query = $this->db->query("INSERT INTO wp_testimonials (user_name, user_img, testimonial_desc,user_desig, updated_date, created_date) VALUES ('".$data->user_name."','".$data->user_img."','".$data->testimonial_desc."','".$data->user_desig."','".date('Y-m-d')."','".date('Y-m-d')."')");
		}
		return $query;	
	}		function get_Suplitypes() {
		$query = $this->db->query('SELECT * FROM wp_supli_types');				
		return $query->result_array();	
	}
function get_Suplitype($sid) {
		
		$query = $this->db->query('SELECT * FROM  wp_supli_types WHERE id = "'.$sid.'"');	
		//print_r($query);				
		return $query->result_array();
	}
function get_supli_type_by_journal ($data) {
		if(isset($data) && !empty($data)) {			
			$query = $this->db->query("SELECT * FROM `wp_supli_types` WHERE journal_id='".$data."'");
			return $query->result_array();
		}
	}
function get_new_eb_members() {
		$query = $this->db->query('SELECT eb.id,eb.eb_post_slug,eb.eb_journal_slug,j.journal_name,mc.category_name,eb.eb_member_name,eb.eb_member_photo,eb.eb_member_country,eb.editor_chief,eb.eb_member_desc,eb.updated_date FROM wp_eb_members eb INNER JOIN wp_journals j on eb.journal_id = j.id INNER JOIN wp_journal_main_categories mc on mc.category_id = j.main_category_id WHERE eb.deleted="1"');				
		return $query->result_array();
	}
	function get_new_eb_member($id) {
		$query = $this->db->query('SELECT * FROM  wp_eb_members WHERE id = "'.$id.'" AND deleted = 1');		
		return $query->result_array();
	}
function update_eb_member($data) {		
		if(isset($data->id) && !empty($data->id)) {
		$query = $this->db->query("UPDATE wp_eb_members SET category_id='".$data->category_id."',journal_id='".$data->journal_id."',eb_member_name='".$data->eb_member_name."',eb_member_photo='".$data->eb_member_photo."',eb_member_country='".$data->eb_member_country."',editor_chief='".$data->editor_chief."',eb_member_desc='".$data->eb_member_desc."',eb_post_slug='".$data->eb_post_slug."',eb_journal_slug='".$data->eb_journal_slug."',created_date='".date('Y-m-d')."',updated_date='".date('Y-m-d')."',deleted='1' WHERE id = $data->id");		
		} else {		   
		   $query = $this->db->query("INSERT INTO wp_eb_members (category_id, journal_id, eb_member_name,eb_member_photo, eb_member_country, editor_chief,eb_member_desc, eb_post_slug, eb_journal_slug, created_date,updated_date,deleted) VALUES ('".$data->category_id."','".$data->journal_id."','".$data->eb_member_name."','".$data->eb_member_photo."','".$data->eb_member_country."','".$data->editor_chief."','".$data->eb_member_desc."','".$data->eb_post_slug."','".$data->eb_journal_slug."','".date('Y-m-d')."','".date('Y-m-d')."','1')");
		}

		return $query;			
	}

function get_new_eb_members_by_journal($jid) {
$query = $this->db->query('SELECT eb.id,eb.eb_post_slug,eb.eb_journal_slug,j.journal_name,mc.category_name,eb.eb_member_name,eb.eb_member_photo,eb.eb_member_country,eb.editor_chief,eb.eb_member_desc,eb.updated_date FROM wp_eb_members eb INNER JOIN wp_journals j on eb.journal_id = j.id INNER JOIN wp_journal_main_categories mc on mc.category_id = j.main_category_id WHERE eb.deleted="1" AND eb.journal_id = "'.$jid.'"');				
		return $query->result_array();
}
function deleteEBmember($e_id) {
	$query = $this->db->query("UPDATE wp_eb_members SET deleted = '2' WHERE id = $e_id");
}
function deleteJournalPost($p_id) {
	$query = $this->db->query("UPDATE wp_journal_posts SET deleted = '2' WHERE id = $p_id");	
	return $query;
}
function deleteJournalArchive($p_id) {
	$query = $this->db->query("UPDATE wp_journal_archives SET deleted = '2' WHERE id = $p_id");	
	return $query;
}
function deleteLatestArticle($p_id) {
	$query = $this->db->query("UPDATE wp_latest_articles SET deleted = '2' WHERE id = $p_id");	
	return $query;
}

function deleteTestimonial($p_id) {
	$query = $this->db->query("UPDATE wp_testimonials SET deleted = '2' WHERE id = $p_id");	
	return $query;
}
function deleteFulltextarticle($p_id) {
	$query = $this->db->query("UPDATE wp_fulltextarticles SET deleted = '2' WHERE ID = $p_id");	
	return $query;
}


function update_fulltext_article($data) {
 
		if(isset($data['ID']) && !empty($data['ID'])) {
		$query = $this->db->query("UPDATE wp_fulltextarticles SET post_content='".$this->db->escape_str($data['post_content'])."',journal_id='".$data['journal_id']."',category_id='".$data['category_id']."',post_title='".$this->db->escape_str($data['post_title'])."',post_browser_title='".$this->db->escape_str($data['post_browser_title'])."',post_meta_keywords='".$this->db->escape_str($data['post_meta_keywords'])."',post_date='".date('Y-m-d H:i:s')."' WHERE ID = '".$data['ID']."'");		
		} else {		   
		   $query = $this->db->query("INSERT INTO wp_fulltextarticles (category_id, journal_id, post_content,post_title,post_browser_title,post_meta_keywords,post_date) VALUES ('".$data['category_id']."','".$data['journal_id']."','".$this->db->escape_str($data['post_content'])."','".$this->db->escape_str($data['post_title'])."','".$this->db->escape_str($data['post_browser_title'])."','".$this->db->escape_str($data['post_meta_keywords'])."','".date('Y-m-d H:i:s')."')");
		}	
		return $query;	
	}
function get_FulltextArticle($sid) {		
		$query = $this->db->query("SELECT ID,post_title, 	post_browser_title,post_meta_keywords,post_content,post_date,journal_id,category_id FROM  wp_fulltextarticles WHERE id ='".$sid."' ");	
		//print_r($query);				
		return $query->result_array();
	}
function get_fulltext_articles($search_str) {
	if($search_str) {
		$query = $this->db->query('SELECT ID,post_title,post_date,post_meta_keywords,post_browser_title,post_modified FROM `wp_fulltextarticles` WHERE post_type = "post" AND deleted= "1" AND post_title LIKE "%'.$search_str.'%" ORDER BY post_date DESC');				
	} else {
		$query = $this->db->query("SELECT ID,post_title,post_date,post_meta_keywords,post_browser_title,post_modified FROM `wp_fulltextarticles` WHERE post_type = 'post' AND deleted= '1' ORDER BY post_date DESC");
	}
	return $query->result_array();
}

function save_uploaded_to_db($data) {	
	if($data) {
		$query = $this->db->query("INSERT INTO wp_uploaded_files (client_name, file_ext, file_name, file_path, file_size, file_type, full_path, height, image_type, width, orig_name, raw_name, created_date, updated_date, deleted) VALUES ('
			".$data['upload_data']['client_name']."',
			'".$data['upload_data']['file_ext']."',
			'".$data['upload_data']['file_name']."',
			'".$data['upload_data']['file_path']."',
			'".$data['upload_data']['file_size']."',
			'".$data['upload_data']['file_type']."',
			'".$data['upload_data']['full_path']."',
			'".$data['upload_data']['image_height']."',
			'".$data['upload_data']['image_type']."',
			'".$data['upload_data']['image_width']."',
			'".$data['upload_data']['orig_name']."',
			'".$data['upload_data']['raw_name']."',
			'".date('Y-m-d')."',
			'".date('Y-m-d')."',
			1)");
	}
}
function getUploadedFiles() {
	$query = $this->db->query("
			SELECT id,file_name,full_path,file_type,image_type,file_ext,created_date FROM wp_uploaded_files ORDER BY id DESC"
		);		
	return $query->result_array();
}
}

