<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends Base_Controller {

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
		$this->load->model('Courses_model');
		$this->load->model('Faculties_model');
		$this->load->model('Users_model');
		
	}
	
	public function list_all()
	{
		$this->data ['courses'] = $this->Courses_model->getCourses ();
		
		$faculties = $this->Faculties_model->getFaculties ();
		$tmp_faculties = [ ];
		foreach ( $faculties as $key => $faculty ) {
			$tmp_faculties [$faculty ['id']] = $faculty;
		}
		$this->data ['faculties'] = $tmp_faculties;
		
		$this->load->view('common/header',  $this->data);
		$this->load->view('course/list_all', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function create(){
		if ($this->input->post() != false) {
			$result = $this->Courses_model->create();
			if ($result) {
				redirect('course/list_all');
			} else {
				$this->data['error'] = "Course is already exist.";
			}
		}
		
		$this->data ['faculties'] = $this->Faculties_model->getFaculties();
		
		$this->load->view('common/header',  $this->data);
		$this->load->view('course/create', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function edit($id){
		if ($this->input->post() != false) {
			$result = $this->Courses_model->update($id);
			if ($result) {
				redirect('course/list_all');
			} else {
				$this->data['error'] = "Course is already exist.";
			}
		}
		
		$this->data['course'] = $this->Courses_model->getCourse($id);
		
		$this->data ['faculties'] = $this->Faculties_model->getFaculties();
		$tmp_faculties = [];
		foreach ($this->data['faculties'] as $faculty){
			$tmp_faculties[$faculty['id']] = $faculty;
		}
		$this->data ['faculties'] = $tmp_faculties;
		
		$this->load->view('common/header',  $this->data);
		$this->load->view('course/edit', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function delete($id){
		if (!empty($id)) {
			$this->Courses_model->delete($id);
		}
		redirect('course/list_all');
	}
}
