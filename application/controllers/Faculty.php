<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faculty extends Base_Controller {

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
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Faculties_model');
		$this->load->model('Users_model');
		
	}
	
	public function list_all()
	{
		$this->data['faculties'] = $this->Faculties_model->getFaculties();
		
		$user_ids_array = [];
		if(!empty($this->data['faculties'])){
			foreach ($this->data['faculties'] as $faculty){
				$user_ids_array[$faculty['vice_chancellor_users_id']] = $faculty['vice_chancellor_users_id'];
				$user_ids_array[$faculty['learning_director_users_id']] = $faculty['learning_director_users_id'];
			}
		}
		
		if(!empty($user_ids_array)){
			$users = $this->Users_model->getUsersByIds($user_ids_array);
			$tmp_users = [];
			foreach ($users as $user){
				$tmp_users[$user['id']] = $user;
			}
			$this->data['users'] = $tmp_users;
		}
		
		$this->load->view('common/header',  $this->data);
		$this->load->view('faculty/list_all', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function create(){
		if ($this->input->post() != false) {
			$result = $this->Faculties_model->create();
			if ($result) {
				redirect('faculty/list_all');
			} else {
				$this->data['error'] = "Faculty is already exist.";
			}
		}
		
		$this->data['vice_chancellors'] = $this->Users_model->getUsersByRole(USER_ROLE_CHANCELLOR);
		$this->data['learning_directors'] = $this->Users_model->getUsersByRole(USER_ROLE_LEARNING_DIRECTOR);
		
		
		$this->load->view('common/header',  $this->data);
		$this->load->view('faculty/create', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function edit($id){
		if ($this->input->post() != false) {
			$result = $this->Faculties_model->update($id);
			if ($result) {
				redirect('faculty/list_all');
			} else {
				$this->data['error'] = "Faculty is already exist.";
			}
		}
		
		$this->data['faculty'] = $this->Faculties_model->getFaculty($id);
		$this->data['vice_chancellors'] = $this->Users_model->getUsersByRole(USER_ROLE_CHANCELLOR);
		$tmp_vice_chancellors = [];
		foreach ($this->data['vice_chancellors'] as $vice_chancellor){
			$tmp_vice_chancellors[$vice_chancellor['id']] = $vice_chancellor;
		}
		$this->data['vice_chancellors'] = $tmp_vice_chancellors;
		
		$this->data['learning_directors'] = $this->Users_model->getUsersByRole(USER_ROLE_LEARNING_DIRECTOR);
		$tmp_learning_directors = [];
		foreach ($this->data['learning_directors'] as $learning_director){
			$tmp_learning_directors[$learning_director['id']] = $learning_director;
		}
		$this->data['learning_directors'] = $tmp_learning_directors;
		
		$this->load->view('common/header',  $this->data);
		$this->load->view('faculty/edit', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function delete($id){
		if (!empty($id)) {
			$this->Faculties_model->delete($id);
		}
		redirect('faculty/list_all');
	}
}
