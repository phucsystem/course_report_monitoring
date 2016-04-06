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
		
		$curr_user = $this->session->userdata();
		if($curr_user['role_id'] == USER_ROLE_CHANCELLOR){
// 			$this->data ['reports'] = $this->Reports_model->getReportsByStatus (REPORT_STATUS_APPROVED);
// 			$this->data ['reports'] = array_merge($this->data ['reports'], $this->Reports_model->getReportsByStatus (REPORT_STATUS_FEEDBACK));
			
			$faculties = $this->Faculties_model->getFacultiesByChancellorId($curr_user['user_id']);
			
			$faculties_ids_array = [];
			foreach ($faculties as $faculty){
				$faculties_ids_array[] = $faculty['id'];
			}
			
			if(!empty($faculties_ids_array)){
				$courses = $this->Courses_model->getCoursesByFacultiesIds($faculties_ids_array);
			}
			$courses_ids_array = [];
			foreach ($courses as $course){
				$courses_ids_array[] = $course['id'];
			}
			
			$years = $this->Years_model->getYearsByCoursesIds($courses_ids_array);
			
			foreach ($years as $year){
				$years_ids_array[] = $year['id'];
			}
			$this->data ['reports'] = $this->Reports_model->getReportsByYearIds ($years_ids_array);
		} else if($curr_user['role_id'] == USER_ROLE_LEARNING_DIRECTOR){
			$faculties = $this->Faculties_model->getFacultiesByLearningDirectorId($curr_user['user_id']);
			
			$faculties_ids_array = [];
			foreach ($faculties as $faculty){
				$faculties_ids_array[] = $faculty['id'];
			}
			
			if(!empty($faculties_ids_array)){
				$courses = $this->Courses_model->getCoursesByFacultiesIds($faculties_ids_array);
			}
			$courses_ids_array = [];
			foreach ($courses as $course){
				$courses_ids_array[] = $course['id'];
			}
				
			$years = $this->Years_model->getYearsByCoursesIds($courses_ids_array);
				
			foreach ($years as $year){
				$years_ids_array[] = $year['id'];
			}
			$this->data ['reports'] = $this->Reports_model->getReportsByYearIds ($years_ids_array);
			
		}else if($curr_user['role_id'] == USER_ROLE_LEARNING_COURSE_MODERATOR){
			$years = $this->Years_model->getYearsByCourseModeratorId($curr_user['user_id']);
			$years_ids_array = [];
			
			foreach ($years as $year){
				$years_ids_array[] = $year['id'];
			}
			$this->data ['reports'] = $this->Reports_model->getReportsByYearIds ($years_ids_array);
			
		}else if($curr_user['role_id'] == USER_ROLE_LEARNING_COURSE_LEADER){
			$years = $this->Years_model->getYearsByCourseLeaderId($curr_user['user_id']);
			
			$years_ids_array = [];
				
			foreach ($years as $year){
				$years_ids_array[] = $year['id'];
			}
			$this->data ['reports'] = $this->Reports_model->getReportsByYearIds ($years_ids_array);
			
		}else if($curr_user['role_id'] == USER_ROLE_LEARNING_COURSE_GUEST){
			$this->data ['reports'] = $this->Reports_model->getReportsByStatus (REPORT_STATUS_APPROVED);
			$this->data ['reports'] = array_merge($this->Reports_model->getReportsByStatus (REPORT_STATUS_FEEDBACK));
		}
		
		foreach ($this->data ['reports'] as $key => $report){
			$late = false;
			if(!empty($report['approve_datetime']) && $report['approve_datetime']!='0000-00-00 00:00:00'){
				$datetime1 = new DateTime();
				$datetime2 = new DateTime($report['approve_datetime']);
				$interval = $datetime1->diff($datetime2);
				$diff_day = abs($interval->format('%R%a days')) ;
				if($diff_day>14){
					$late =  true;
				}
			}
			$this->data ['reports'][$key]['late'] = $late;
		}
		
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
				$year_id = $this->input->post('year');
				$year_info = $this->Years_model->getYear($year_id);
				$course_moderator_users_id = $year_info['course_moderator_users_id'];
				$course_moderator_user = $this->Users_model->getUser($course_moderator_users_id);
				// Send email
				send_email($course_moderator_user['email'], 
						'New report is waiting for approval', 
						'A report is submitted by Course Leader. Please click following url and aprrove it.
						<br/> Link: '.site_url('report/view').'/'.$result) ;
				
				
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
	
	public function view($id){
		$years = $this->Years_model->getYears();
		
		$course_ids_array = [];
		$years_group = [];
		foreach ($years as $year){
			$course_ids_array[$year['courses_id']] = $year['courses_id'];
			$years_group[$year['courses_id']][] = $year;
		}
		
		$courses = $this->Courses_model->getCourses();
// 		foreach ($courses as $key => $course){
// 			if(!in_array($course['id'], $course_ids_array)){
// 				unset($courses[$key]);
// 			}
// 		}
		
		$this->data['courses'] = $courses;
		$this->data['years_of_course'] = $years_group;
		
		$this->data['report'] = $this->Reports_model->getReport($id);
		
		$this->load->view('common/header',  $this->data);
		$this->load->view('report/view', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function approve($id){
		$curr_user = $this->session->userdata();
		$this->Reports_model->updateStatus($id, REPORT_STATUS_APPROVED, $curr_user);
		$course_id = $this->input->post('course');
		$course = $this->Courses_model->getCourse($course_id);
		$faculty = $this->Faculties_model->getFaculty($course['faculties_id']);
		
		$vice_chancellor_users_id = $faculty['vice_chancellor_users_id'];
		$vice_chancellor_user = $this->Users_model->getUser($vice_chancellor_users_id);
		
		// Send email
		send_email($vice_chancellor_user['email'],
				'Approved report is waiting for reponse',
				'A report is approved by Course Moderator. Please click following url and write feedback.
						<br/> Link: '.site_url('report/comment').'/'.$id) ;
		
		$learning_director_users_id = $faculty['learning_director_users_id'];
		$learning_director_user = $this->Users_model->getUser($learning_director_users_id);
		
		send_email($learning_director_user['email'],
				'Approved report is waiting for reponse',
				'A report is approved by Course Moderator. Please click following url and write feedback.
						<br/> Link: '.site_url('report/comment').'/'.$id) ;
		
		redirect('report/list_all');
	}
	
	public function comment($id){
		if ($this->input->post() != false) {
			$curr_user = $this->session->userdata();
			$result = $this->Reports_model->comment($id, $curr_user);
			if ($result) {
				
				$report = $this->Reports_model->getReport($id);
				$course_leader_user_id = $report['create_by'];
				$course_leader_user = $this->Users_model->getUser($course_leader_user_id);
				
				@send_email($course_leader_user['email'],
						'A report is approved and reponsed.',
						'Please click following url to view detail.
						<br/> Link: '.site_url('view/view').'/'.$id) ;
				
				sleep(2);
				
				$year = $this->Years_model->getYear($report['academic_years_id']);
				$course = $this->Courses_model->getCourse($year['courses_id']);
				
				$course_moderator_user_id = $year['course_moderator_users_id'];
				$course_moderator_user = $this->Users_model->getUser($course_moderator_user_id);
				
				@send_email($course_moderator_user['email'],
						'A report is approved and reponsed.',
						'Please click following url to view detail.
						<br/> Link: '.site_url('view/view').'/'.$id) ;
				
				sleep(2);
				
				$faculties_id = $course['faculties_id'];
				$faculty = $this->Faculties_model->getFaculty($faculties_id);
				
				$vice_chancellor_users_id = $faculty['vice_chancellor_users_id'];
				$vice_chancellor_user = $this->Users_model->getUser($vice_chancellor_users_id);
				
				@send_email($vice_chancellor_user['email'],
						'A report is approved and reponsed.',
						'Please click following url to view detail.
						<br/> Link: '.site_url('view/view').'/'.$id) ;
				
				sleep(2);
				
				$learning_director_users_id = $faculty['learning_director_users_id'];
				$learning_director_user = $this->Users_model->getUser($learning_director_users_id);
				
				@send_email($learning_director_user['email'],
						'A report is approved and reponsed.',
						'Please click following url to view detail.
						<br/> Link: '.site_url('view/view').'/'.$id) ;
				
				sleep(2);
				
				
				redirect('report/list_all');
			} 
		}
	
	    $years = $this->Years_model->getYears();
		
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
		$this->load->view('report/comment', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function delete($id){
		if (!empty($id)) {
			$this->Reports_model->delete($id);
		}
		redirect('report/list_all');
	}
}
