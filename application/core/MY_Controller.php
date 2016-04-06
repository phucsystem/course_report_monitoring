<?php

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

}

/* application/libraries/Admin_Controller.php */

class Base_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set("Asia/Bangkok");
        
        $this->load->library('session');
        $this->data['title'] = "Course Monitoring Reports";
        $this->data['error'] = '';
        
        $this->data['session'] = $this->session->get_userdata ();
        $this->data['roles'] = $this->getFullUserRoles();
        
        if( $this->router->fetch_method()!= 'login'  && empty($this->data['session']['user_id'])){
        	redirect('user/login');
        }
    }
    
    public function getUserRoles(){
    	$user_roles = [
// 				USER_ROLE_ADMIN => 'Admin',
				USER_ROLE_CHANCELLOR => 'Pro-Vice Chancellor',
				USER_ROLE_LEARNING_DIRECTOR => 'Director of Learning and Quality',
				USER_ROLE_LEARNING_COURSE_LEADER => 'Course Leader',
				USER_ROLE_LEARNING_COURSE_MODERATOR => 'Course Moderator',
				USER_ROLE_LEARNING_COURSE_GUEST => 'Guest',
		];
    	
    	return $user_roles;
    }
    
    public function getFullUserRoles(){
    	$user_roles = [
    			USER_ROLE_ADMIN => 'Admin',
    			USER_ROLE_CHANCELLOR => 'Pro-Vice Chancellor',
    			USER_ROLE_LEARNING_DIRECTOR => 'Director of Learning and Quality',
    			USER_ROLE_LEARNING_COURSE_LEADER => 'Course Leader',
    			USER_ROLE_LEARNING_COURSE_MODERATOR => 'Course Moderator',
    			USER_ROLE_LEARNING_COURSE_GUEST => 'Guest',
    	];
    	 
    	return $user_roles;
    }
    
    public function getStatuses(){
    	$report_statuses = [
    			REPORT_STATUS_NEW => 'New',
    			REPORT_STATUS_WAIT_FOR_APPROVE => 'Wait For Approve',
    			REPORT_STATUS_APPROVED => 'Approved',
    			REPORT_STATUS_FEEDBACK => 'Feedback',
    	];
    	return $report_statuses;
    }


}
