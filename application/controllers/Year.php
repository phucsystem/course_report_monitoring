<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Year extends Base_Controller {

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
		$this->load->model('Years_model');
		$this->load->model('Courses_model');
		$this->load->model('Faculties_model');
		$this->load->model('Users_model');
		
	}
	
	public function list_all()
	{
		$this->data ['years'] = $this->Years_model->getYears ();
		
		$courses = $this->Courses_model->getCourses ();
		$tmp_courses = [ ];
		foreach ( $courses as $key => $course ) {
			$tmp_courses [$course ['id']] = $course;
		}
		$this->data ['courses'] = $tmp_courses;
		
		$this->data ['users'] = $this->Users_model->getUsers();
		$tmp_users = [];
		foreach ($this->data ['users'] as $user){
			$tmp_users[$user['id']] = $user;
		}
		$this->data['users'] = $tmp_users;
		
		$this->load->view('common/header',  $this->data);
		$this->load->view('year/list_all', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function create(){
		if ($this->input->post() != false) {
			$result = $this->Years_model->create();
			if ($result) {
				redirect('year/list_all');
			} else {
				$this->data['error'] = "Year academic is already exist.";
			}
		}
		
		$this->data ['users'] = $this->Users_model->getUsers();
		$this->data ['courses'] = $this->Courses_model->getCourses ();
		
		$this->data['course_leaders'] = $this->Users_model->getUsersByRole(USER_ROLE_LEARNING_COURSE_LEADER);
		$this->data['course_moderators'] = $this->Users_model->getUsersByRole(USER_ROLE_LEARNING_COURSE_MODERATOR);
		
		$this->load->view('common/header',  $this->data);
		$this->load->view('year/create', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function edit($id){
		if ($this->input->post() != false) {
			$result = $this->Years_model->update($id);
			if ($result) {
				redirect('year/list_all');
			} else {
				$this->data['error'] = "Academic year is already exist.";
			}
		}
		
		$this->data['year'] = $this->Years_model->getYear($id);
		
		$this->data ['courses'] = $this->Courses_model->getCourses ();
		$tmp_courses = [];
		foreach ($this->data['courses'] as $courses){
			$tmp_courses[$courses['id']] = $courses;
		}
		$this->data ['courses'] = $tmp_courses;
		
		$this->data['course_leaders'] = $this->Users_model->getUsersByRole(USER_ROLE_LEARNING_COURSE_LEADER);
		$tmp_leaders = [];
		foreach ($this->data ['course_leaders'] as $user){
			$tmp_leaders[$user['id']] = $user;
		}
		$this->data['course_leaders'] = $tmp_leaders;
		
		$this->data['course_moderators'] = $this->Users_model->getUsersByRole(USER_ROLE_LEARNING_COURSE_MODERATOR);
		$tmp_moderators = [];
		foreach ($this->data ['course_moderators'] as $user){
			$tmp_moderators[$user['id']] = $user;
		}
		$this->data['course_moderators'] = $tmp_moderators;
		
		$this->load->view('common/header',  $this->data);
		$this->load->view('year/edit', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function delete($id){
		if (!empty($id)) {
			$this->Years_model->delete($id);
		}
		redirect('year/list_all');
	}
}
