<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {    		
        parent::__construct();
        if(!$this->session->userdata('is_logged_in')){
            redirect('login');
        }
    }

	public function index() {					
		$this->load->view('templates/admin/header');	    
	    $this->load->view('templates/admin/content');
	    $this->load->view('templates/admin/footer');
	}
	public function login()
	{		
		$this->load->view('templates/admin/header');	    
	    $this->load->view('templates/admin/content');
	    $this->load->view('templates/admin/footer');
	}
	public function validate_credentials1()
	{			
		echo 'sss';exit;
		$this->load->model('Users_model');

		$user_name = $this->input->post('user_name');
		$password = $this->__encrip_password($this->input->post('password'));

		$is_valid = $this->Users_model->validate($user_name, $password);
		
		if($is_valid)
		{
			echo 'if';
			$data = array(
				'user_name' => $user_name,
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			redirect('admin/dashboardwwww');
		}
		else // incorrect username or password
		{
			echo 'else';
			$data['message_error'] = TRUE;
			$this->login();	
		}
	}
	public function __encrip_password($password) {
        return md5($password);
    }	
	public function dashboard() {
		$this->load->model('Users_model');	        
		$data = $this->Users_model->get_count();
		if(is_array($data)){
			echo json_encode($data);
		}
		//echo $data;

	}
	public function get_categories() {
		$obj=json_decode(file_get_contents('php://input'));
		$search_str = (isset($obj->search_value) && !empty($obj->search_value))?$obj->search_value:"";
		$this->load->model('Users_model');	
		$data = $this->Users_model->get_categories($search_str);
		if(is_array($data)){
			echo json_encode($data);
		}
		//echo $data;

	}
	public function get_journals() {
		$obj=json_decode(file_get_contents('php://input'));
		$search_str = (isset($obj->search_value) && !empty($obj->search_value))?$obj->search_value:"";
		$this->load->model('Users_model');	
		$data = $this->Users_model->get_journals($search_str);
		if(is_array($data)){
			echo json_encode($data);
		}
		//echo $data;

	}
	public function get_journals_posts() {

		$obj=json_decode(file_get_contents('php://input'));
		$search_str = (isset($obj->search_value) && !empty($obj->search_value))?$obj->search_value:"";

		$this->load->model('Users_model');	
		$data = $this->Users_model->get_journals_posts($search_str);
		$journal_data = $this->Users_model->get_journals_and_categories();

		if(is_array($data)){
			echo json_encode($data);
		}
		//echo $data;

	}
	public function get_journals_archives() {
		$this->load->model('Users_model');	
		$data = $this->Users_model->get_journals_archives();
		//$journal_data = $this->Users_model->get_journals_and_categories();

		if(is_array($data)){
			echo json_encode($data);
		}
		//echo $data;

	}
	public function get_archives_by_journal() {
		$obj=json_decode(file_get_contents('php://input'));
		$this->load->model('Users_model');	
		$journal_id = $obj->journal_id;
		$archive_in = $obj->archive_in;		
		
		$data = $this->Users_model->get_archives_by_journal($journal_id,$archive_in);
		if(is_array($data)){
			echo json_encode($data);
		}
	}
	public function get_main_category() {
		$this->load->model('Users_model');
		$cat_id = $this->input->get('id');
		$data = $this->Users_model->get_main_category($cat_id);
		if(is_array($data)) {
			echo json_encode($data);
		}
		//echo $data;

	}
	public function get_latest_update() {
		$this->load->model('Users_model');
		$l_id = $this->input->get('id');
		$data = $this->Users_model->get_latest_update($l_id);
		if(is_array($data)) {
			echo json_encode($data);
		}		

	}
	public function insert_main_category() {
		$obj=json_decode(file_get_contents('php://input'));
		//print_r($obj->category_name);exit;
		//print_r($obj);exit;
		$this->load->model('Users_model');
		$cat_id = $obj->category_id;
		$cat_name = $obj->category_name;
		if($cat_id) {
			$data = $this->Users_model->insert_main_category($cat_id,$cat_name);			
			if($data){
				$status = array('status' => true,"message" => 'Category Edited Successfully','row_id'=> $cat_id);
			}
		} else {
			$data = $this->Users_model->insert_main_category($cat_id,$cat_name);			
			if($data) {
				$status = array('status' => true,"message" => 'Category Added Successfully','row_id'=> $cat_id);			
			}
			
		}
		
		echo json_encode($status);		
	}

	public function insert_latest_update() {
		$obj=json_decode(file_get_contents('php://input'));
		$this->load->model('Users_model');
		$id = $obj->id;
		$latest_update_description = $obj->latest_update_description;
		if($id) {
			$data = $this->Users_model->insert_latest_update($id,$latest_update_description);			
			if($data){
				$status = array('status' => true,"message" => 'Laest Updated Edited Successfully');
			}
		} else {
			$data = $this->Users_model->insert_latest_update($id,$latest_update_description);			
			if($data) {
				$status = array('status' => true,"message" => 'Latest Updated Added Successfully');			
			}
			
		}
		
		echo json_encode($status);		
	}

	
	public function insert_journal() {
		$obj=json_decode(file_get_contents('php://input'));
		//print_r($obj);exit;		
		$this->load->model('Users_model');			
		$journal_id = $obj->id;	
		if($journal_id) {
			$data = $this->Users_model->insert_journal($obj);			
			if($data){
				$status = array('status' => true,"message" => 'Journal Edited Successfully');
			}
		} else {
			$data = $this->Users_model->insert_journal($obj);			
			if($data) {
				$status = array('status' => true,"message" => 'Journal Added Successfully');			
			}
			
		}
		
		echo json_encode($status);		
	}
	public function get_LatestArticles() {
		$obj=json_decode(file_get_contents('php://input'));
		$search_str = (isset($obj->search_value) && !empty($obj->search_value))?$obj->search_value:"";

		$this->load->model('Users_model');	
		$data = $this->Users_model->get_LatestArticles($search_str);
		if(is_array($data)){
			echo json_encode($data);
		}
		//echo $data;

	}
	public function get_Testimonials() {
		$this->load->model('Users_model');	
		$data = $this->Users_model->get_Testimonials();
		if(is_array($data)){
			echo json_encode($data);
		}
		//echo $data;

	}
public function get_supliTypes() {
		$this->load->model('Users_model');	
		$data = $this->Users_model->get_supliTypes();
		if(is_array($data)){
			echo json_encode($data);
		}
		//echo $data;

	}
public function get_Suplitype() {		
		$this->load->model('Users_model');
		$sid = $this->input->get('id');
		//$data = $this->Users_model->get_Suplitype($sid);	
		$data['s_info'] = $this->Users_model->get_supliType($sid);
		$data['j_info'] = $this->Users_model->get_journals("");
		if(is_array($data)) {
			echo json_encode($data);
		}
	}
	public function get_supli_type_by_journal () {
		$obj=json_decode(file_get_contents('php://input'));
		if(isset($obj->id) && !empty($obj->id)) {
			$this->load->model('Users_model');	
			$data = $this->Users_model->get_supli_type_by_journal($obj->id);
			if(is_array($data)){
				echo json_encode($data);
			}	
		}
	}

	public function get_SubmitManuscript() {
		$this->load->model('Users_model');	
		$data = $this->Users_model->get_SubmitManuscript();
		if(is_array($data)){
			echo json_encode($data);
		}
		//echo $data;

	}
	public function get_Home_Latest_Updates() {
		$this->load->model('Users_model');	
		$data = $this->Users_model->get_Home_Latest_Updates();
		if(is_array($data)){
			echo json_encode($data);
		}
		

	}

	public function get_Collaborations() {
		$this->load->model('Users_model');	
		$data = $this->Users_model->get_Collaborations();
		if(is_array($data)){
			echo json_encode($data);
		}
	}

	public function get_journal() {
		$this->load->model('Users_model');
		$journal_id = $this->input->get('id');
		$data = $this->Users_model->get_jounal($journal_id);
		if(is_array($data)) {
			echo json_encode($data);
		}
	}
	public function get_journalPage() {
		$this->load->model('Users_model');
		$page_id = $this->input->get('id');
		$data['post_info'] = $this->Users_model->get_journalPage($page_id);
		$data['journal_info'] = $this->Users_model->get_journals_and_categories();
		if(is_array($data)) {
			echo json_encode($data);
		}	
	}
	public function update_journal_page() {
		$this->load->model('Users_model');
		$obj=json_decode(file_get_contents('php://input'));		
		if(isset($obj->id) && !empty($obj->id)) {
			$data = $this->Users_model->update_journal_page($obj);			
			if($data){
				$status = array('status' => true,"message" => 'Journal Post Edited Successfully');
			}
		} else {
			$data = $this->Users_model->update_journal_page($obj);			
			if($data) {
				$status = array('status' => true,"message" => 'Journal post Added Successfully');			
			}
			
		}		
		echo json_encode($status);
	}
	public function get_journal_archive() {
		$this->load->model('Users_model');
		$archive_id = $this->input->get('id');
		$data['archive_info'] = $this->Users_model->get_journal_archive($archive_id);
		$data['journal_info'] = $this->Users_model->get_journals_and_categories();
		if(is_array($data)) {
			echo json_encode($data);
		}
	}
	public function get_latest_Article() {
		$this->load->model('Users_model');
		$article_id = $this->input->get('id');
		$data['article_info'] = $this->Users_model->get_latest_Article($article_id);		
		$data['journal_info'] = $this->Users_model->get_journals_and_categories();
		if(is_array($data)) {
			echo json_encode($data);
		}
	}
	public function get_only_journals() {
		$this->load->model('Users_model');
		$data = $this->Users_model->get_journals_and_categories();
		if(is_array($data)) {
			echo json_encode($data);
		}
	}
	public function get_Testimonial() {
		$this->load->model('Users_model');
		$article_id = $this->input->get('id');
		$data = $this->Users_model->get_Testimonial($article_id);	
		if(is_array($data)) {
			echo json_encode($data);
		}
	}
	public function update_archive() {
		$this->load->model('Users_model');
		$obj=json_decode(file_get_contents('php://input'));				
		if(isset($obj->id) && !empty($obj->id)) {
			$data = $this->Users_model->update_archive($obj);			
			if($data){
				$status = array('status' => true,"message" => 'Journal Archive Edited Successfully');
			}
		} else {
			$data = $this->Users_model->update_archive($obj);			
			if($data) {
				$status = array('status' => true,"message" => 'Journal Archive Added Successfully');			
			}
			
		}		
		echo json_encode($status);
	}
	public function update_latest_article() {
		$this->load->model('Users_model');
		$obj=json_decode(file_get_contents('php://input'));				
		if(isset($obj->id) && !empty($obj->id)) {
			$data = $this->Users_model->update_latest_article($obj);			
			if($data){
				$status = array('status' => true,"message" => 'Latest Article Edited Successfully');
			}
		} else {
			$data = $this->Users_model->update_latest_article($obj);			
			if($data) {
				$status = array('status' => true,"message" => 'Latest Article Added Successfully');			
			}
			
		}		
		echo json_encode($status);
	}

	public function updateTestimonial() {
		$this->load->model('Users_model');
		$obj=json_decode(file_get_contents('php://input'));				
		
		if(isset($obj->id) && !empty($obj->id)) {
			$data = $this->Users_model->updateTestimonial($obj);			
			if($data){
				$status = array('status' => true,"message" => 'Testimonial Edited Successfully');
			}
		} else {
			$data = $this->Users_model->updateTestimonial($obj);			
			if($data) {
				$status = array('status' => true,"message" => 'Testimonial Added Successfully');			
			}
			
		}		
		echo json_encode($status);
	}
        public function get_new_eb_members() {
		$this->load->model('Users_model');	
		$data = $this->Users_model->get_new_eb_members();
		$journal_data = $this->Users_model->get_journals_and_categories();

		if(is_array($data)){
			echo json_encode($data);
		}
		//echo $data;

	}
	public function get_new_eb_member() {
		$id = $this->input->get('id');
		$this->load->model('Users_model');			
		$data['eb_info'] = $this->Users_model->get_new_eb_member($id);
		$data['journal_info'] = $this->Users_model->get_journals_and_categories();

		if(is_array($data)){
			echo json_encode($data);
		}		

	}
        public function update_eb_member() {
		$this->load->model('Users_model');
		$obj=json_decode(file_get_contents('php://input'));		
		if(isset($obj->id) && !empty($obj->id)) {
			$data = $this->Users_model->update_eb_member($obj);			
			if($data){
				$status = array('status' => true,"message" => 'Journal Post Edited Successfully');
			}
		} else {
			$data = $this->Users_model->update_eb_member($obj);			
			if($data) {
				$status = array('status' => true,"message" => 'Journal post Added Successfully');			
			}
			
		}		
		echo json_encode($status);
	}
        public function updateSuplitype() {
		$this->load->model('Users_model');
		$obj=json_decode(file_get_contents('php://input'));				
		
		if(isset($obj->id) && !empty($obj->id)) {
			$data = $this->Users_model->updateSuplitype($obj);			
			if($data){
				$status = array('status' => true,"message" => 'Supli Type Edited Successfully');
			}
		} else {
			$data = $this->Users_model->updateSuplitype($obj);			
			if($data) {
				$status = array('status' => true,"message" => 'Supli Type Added Successfully');			
			}
			
		}		
		echo json_encode($data);
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin');
	}
	public function save_uploaded_file () {				
		$config['upload_path']          = './public/images/journal-banners';
        $config['allowed_types']        = 'jpg|png|doc|docx';
        $config['max_size']             = 1000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
 	
        $this->load->library('upload', $config); 
		foreach ($image_array as $key => $value) {        
	    	if(isset($_FILES['journal_banner_img'])) {
		       $image_array = $_FILES;
		       $image_type = 'banner_image';
	        } else if(isset($_FILES['journal_sidebar_img'])) {
	        	$image_array = $_FILES;
	        	$image_type = 'sidebar_image';
	        }
    	}

        foreach ($image_array as $key => $value) {        	
        	if($value['name']) {        		
	        	if ( ! $this->upload->do_upload($key))
		        {
	                $error = array('error' => $this->upload->display_errors());
	                print_r($error['error']);

		        }
		        else
		        {		        	
		            $data[] = array('upload_data' => $this->upload->data());		            

		        }
	        }	
        }
        if($image_type == 'banner_image') {
        	$data['file_type'] = 'journal_banner_img';	        
    	} else {
    		$data['file_type'] = 'journal_sidebar_img';	        
    	}
        $data['uploaded_path'] = base_url()."/public/images/journal-banners/".$data[0]['upload_data']['file_name'];
		echo json_encode($data, true);
	}
	public function upload_files() {

//print_r($_FILES['qqfile']['type']);
		if($_FILES['qqfile']['type'] == 'application/pdf') {
			$config['upload_path']          = './wp-content/uploads';
			$config['allowed_types']        = 'pdf';
		} else {
			$config['upload_path']          = './wp-content/uploads';
			$config['allowed_types']        = 'png|jpeg|jpg|gif';
		}
        $config['allowed_types']        = 'png|jpeg|jpg|gif|pdf';
        $config['max_size']             = 25 * 1024 *1024;        
 	
        $this->load->library('upload', $config);     	
        foreach ($_FILES as $key => $value) {        		
        	if($value['name']) {        		
	        	if ( ! $this->upload->do_upload($key))
		        {
	                $data = array('error' => $this->upload->display_errors());	                

		        }
		        else
		        {		        	
		            $data = array('upload_data' => $this->upload->data());		            

		        }
	        }	
        }         
        $data1 = array('success'=>'true');              
        $data1['file_data'] = $data;
        if($_GET['save_to_db']) {
        	$data['upload_data']['full_path'] = 'http://www.avensonline.org/wp-content/uploads/'.$data['upload_data']['file_name'].'';

        	$this->_save_uploaded_to_db($data);
        }
		echo json_encode($data1, true);
	}

	private function _save_uploaded_to_db($data) {
		$this->load->model('Users_model');	
		$result = $this->Users_model->save_uploaded_to_db($data);
		if(is_array($result)){
			echo json_encode($result);
		}
	}
	public function upload_files_to_server() {		
		$dest_folder = './fulltextarticles/wp-content/uploads/';
		$year_folder = "./fulltextarticles/wp-content/uploads/".date('Y')."";
		$month_folder = "".$year_folder."/0".date('n')."";		
		if (!file_exists($year_folder)) {
		    mkdir($year_folder, 0777);
		}
		
	    if(!file_exists($month_folder)) {
	    	mkdir($month_folder, 0777);
	    }

		$final_folder = $month_folder;

		/*if($_FILES['qqfile']['type'] == 'application/pdf') {
			$config['upload_path']          = './fulltextarticles/wp-content/uploads';
			$config['allowed_types']        = 'pdf';
		} else {
			$config['upload_path']          = './fulltextarticles/wp-content/uploads';
			$config['allowed_types']        = 'png|jpeg|jpg|gif';
		}*/
		$config['upload_path']          = $month_folder;
        $config['allowed_types']        = 'png|jpeg|jpg|gif|pdf';
        $config['max_size']             = 25 * 1024 *1024;        
 	
        $this->load->library('upload', $config);     	

        foreach ($_FILES as $key => $value) {        		
        	if($value['name']) {        		
	        	if ( ! $this->upload->do_upload($key))
		        {
	                $data = array('error' => $this->upload->display_errors());	                

		        }
		        else
		        {		        	
		            $data = array('upload_data' => $this->upload->data());		            

		        }
	        }	
        }         
        $data1 = array('success'=>'true');              
        $data1['file_data'] = $data;
        
        $data['upload_data']['full_path'] = 'http://www.avensonline.org/fulltextarticles/wp-content/uploads/'.date('Y').'/0'.date('n').'/'.$data['upload_data']['file_name'].'';

        
        $this->_save_uploaded_to_db($data);
		echo json_encode($data1, true);
	}

public function get_new_eb_members_by_journal() {
		$obj=json_decode(file_get_contents('php://input'));
		$this->load->model('Users_model');	
		$journal_id = $obj->journal_id;
		
		$data = $this->Users_model->get_new_eb_members_by_journal($journal_id);
		if(is_array($data)){
			echo json_encode($data);
		}
	}

public function deleteEBmember() {
		$this->load->model('Users_model');
		$obj=json_decode(file_get_contents('php://input'));		
		if(isset($obj->id) && !empty($obj->id)) {
			$data = $this->Users_model->deleteEBmember($obj->id);			
			if($data){
				$status = array('status' => true,"message" => 'Journal Post Edited Successfully');
			}
		} 

		echo json_encode($data);
}
public function deleteJournalPost() {
		$this->load->model('Users_model');
		$obj=json_decode(file_get_contents('php://input'));		
		if(isset($obj->id) && !empty($obj->id)) {
			$data = $this->Users_model->deleteJournalPost($obj->id);			
			if($data){
				$status = array('status' => true,"message" => 'Journal Post Deleted Successfully');
			}
		} 

		echo json_encode($data);
}
public function deleteJournalArchive() {
	$this->load->model('Users_model');
	$obj=json_decode(file_get_contents('php://input'));		
	if(isset($obj->id) && !empty($obj->id)) {
		$data = $this->Users_model->deleteJournalArchive($obj->id);			
		if($data){
			$status = array('status' => true,"message" => 'Journal Archive Deleted Successfully');
		}
	} 

	echo json_encode($data);
}
public function deleteLatestArticle() {
	$this->load->model('Users_model');
	$obj=json_decode(file_get_contents('php://input'));		
	if(isset($obj->id) && !empty($obj->id)) {
		$data = $this->Users_model->deleteLatestArticle($obj->id);			
		if($data){
			$status = array('status' => true,"message" => 'Latest Article Deleted Successfully');
		}
	} 

	echo json_encode($data);
}
public function deleteTestimonial() {
	$this->load->model('Users_model');
	$obj=json_decode(file_get_contents('php://input'));		
	if(isset($obj->id) && !empty($obj->id)) {
		$data = $this->Users_model->deleteTestimonial($obj->id);			
		if($data){
			$status = array('status' => true,"message" => 'Testimonial Deleted Successfully');
		}
	} 

	echo json_encode($data);
}
public function deleteFulltextarticle() {
	$this->load->model('Users_model');
	$obj=json_decode(file_get_contents('php://input'));		
	if(isset($obj->id) && !empty($obj->id)) {
		$data = $this->Users_model->deleteFulltextarticle($obj->id);			
		if($data){
			$status = array('status' => true,"message" => 'Testimonial Deleted Successfully');
		}
	} 

	echo json_encode($data);
}


public function update_fulltext_article() {
		$this->load->model('Users_model');
		$obj=json_decode(file_get_contents('php://input'),true);			
		if(isset($obj['ID']) && !empty($obj['ID'])) {			
			$data = $this->Users_model->update_fulltext_article($obj);			
			if($data){
				$status = array('status' => true,"message" => 'Fulltext Article Updated Successfully');
			}
		} else {			
			$data = $this->Users_model->update_fulltext_article($obj);			
			if($data) {
				$status = array('status' => true,"message" => 'Fulltext Article Added Successfully');			
			}
			
		}

		echo json_encode($status);
	}

	public function get_fulltext_articles() {
		$obj=json_decode(file_get_contents('php://input'));
		$search_str = (isset($obj->search_value) && !empty($obj->search_value))?$obj->search_value:"";
		$this->load->model('Users_model');	
		$data = $this->Users_model->get_fulltext_articles($search_str);
		if(is_array($data)){
			echo json_encode($data);
		}
	}
public function get_FulltextArticle() {
		$this->load->model('Users_model');
		$id = $this->input->get('id');				
		$data['j_info'] = $this->Users_model->get_journals("");		
		$data['fulltext_info'] = $this->Users_model->get_FulltextArticle($id);		
		if(is_array($data)) {
			echo json_encode($data);
		}	
	}

public function getUploadedFiles() {		
	$this->load->model('Users_model');	
	$data = $this->Users_model->getUploadedFiles();
	if(is_array($data)){
		echo json_encode($data);
	}
	//echo $data;

}	
}