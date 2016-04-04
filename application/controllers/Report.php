<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends Base_Controller {

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
		$this->load->model('Reports_model');
		$this->load->model('Years_model');
		$this->load->model('Courses_model');
		$this->load->model('Faculties_model');
		$this->load->model('Users_model');
		
	}
	
	public function list_all()
	{
		$this->data ['reports'] = $this->Reports_model->getReports ();
		
		$courses = $this->Courses_model->getCourses ();
		$tmp_courses = [ ];
		foreach ( $courses as $key => $course ) {
			$tmp_courses [$course ['id']] = $course;
		}
		$this->data ['courses'] = $tmp_courses;
		$this->data ['statuses'] = $this->getStatuses();
		$this->data ['users'] = $this->Users_model->getUsers();
		$tmp_users = [];
		foreach ($this->data ['users'] as $user){
			$tmp_users[$user['id']] = $user;
		}
		$this->data['users'] = $tmp_users;
		
		$this->load->view('common/header',  $this->data);
		$this->load->view('report/list_all', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function create(){
		if ($this->input->post() != false) {
			
			$config['upload_path'] = './assets/files/';
			$config['allowed_types'] = '*';
			$config['max_size']	= '10000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			
			$this->load->library('upload', $config);
			
			$this->data['data'] = '';
			if ( ! $this->upload->do_upload('file'))
			{
				$this->data['error'] = array('error' => $this->upload->display_errors());
			}
			else
			{
				$this->data['data'] = array('upload_data' => $this->upload->data());
			}
			$curr_user = $this->session->userdata();
			$result = $this->Reports_model->create($this->data['data'], $curr_user);
			if ($result) {
				redirect('report/list_all');
			} else {
				$this->data['error'] = "Report name is already exist.";
			}
			
			send_email('phucsystem@gmail.com', 'Your account in RELG game', 'Your new account is: <b>'
					. '</b> and your password is <b>' . '</b>. <br> Please access following link to login: ' . site_url('report/edit'));
		}
		
		
		$years = $this->Years_model->getYearsByCourseLeaderId($this->data['session']['user_id']);
		
		$course_ids_array = [];
		$years_group = [];
		foreach ($years as $year){
			$course_ids_array[$year['courses_id']] = $year['courses_id'];
			$years_group[$year['courses_id']][] = $year;
		}
		
		$courses = $this->Courses_model->getCourses();
		foreach ($courses as $key => $course){
			if(!in_array($course['id'], $course_ids_array)){
				unset($courses[$key]);
			}
		}
		
		$this->data['courses'] = $courses;
		$this->data['years_of_course'] = $years_group;
		
		$this->load->view('common/header',  $this->data);
		$this->load->view('report/create', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function download($id){
		$this->data['report'] = $this->Reports_model->getReport($id);
		$this->load->helper('download');
		force_download($this->data['report']['file_url'], NULL);
	}
	
	public function edit($id){
		if ($this->input->post() != false) {
			$config['upload_path'] = './assets/files/';
			$config['allowed_types'] = '*';
			$config['max_size']	= '10000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			
			$this->load->library('upload', $config);
			$this->data['data'] = '';
			if ( ! $this->upload->do_upload('file'))
			{
				$this->data['error'] = array('error' => $this->upload->display_errors());
			}
			else
			{
				$this->data['data'] = array('upload_data' => $this->upload->data());
			}
			
			$result = $this->Reports_model->update($id, $this->data['data']);
			if ($result) {
				redirect('report/list_all');
			} else {
				$this->data['error'] = "Report name is already exist.";
			}
		}
		
		$years = $this->Years_model->getYearsByCourseLeaderId($this->data['session']['user_id']);
		
		$course_ids_array = [];
		$years_group = [];
		foreach ($years as $year){
			$course_ids_array[$year['courses_id']] = $year['courses_id'];
			$years_group[$year['courses_id']][] = $year;
		}
		
		$courses = $this->Courses_model->getCourses();
		foreach ($courses as $key => $course){
			if(!in_array($course['id'], $course_ids_array)){
				unset($courses[$key]);
			}
		}
		
		$this->data['courses'] = $courses;
		$this->data['years_of_course'] = $years_group;
		
		$this->data['report'] = $this->Reports_model->getReport($id);
		
		$this->load->view('common/header',  $this->data);
		$this->load->view('report/edit', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function delete($id){
		if (!empty($id)) {
			$this->Reports_model->delete($id);
		}
		redirect('report/list_all');
	}
}
