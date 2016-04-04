<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Base_Controller {

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
		$this->load->model('Users_model');
	}
	
	public function login()
	{
		if ($this->input->post() != false) {
			$account = $this->input->post('account');
			$password = $this->input->post('password');
			
			$result = $this->Users_model->login($account, $password);
			if ($result) {
				redirect('home');
			} else {
				$this->data['error'] = "Account name or password is correct.";
			}
		}
		
		$this->load->view('user/login', $this->data);
	}
	
	public function logout()
	{
		$this->Users_model->logout();
		redirect('user/login');
	}
	
	public function list_all()
	{
		$this->data['users'] = $this->Users_model->getUsers();
		$this->data['user_roles'] = $this->getUserRoles();
		
		$this->load->view('common/header',  $this->data);
		$this->load->view('user/list_all', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function create(){
		if ($this->input->post() != false) {
			$account = $this->input->post('account');
			$password = $this->input->post('password');
			$name = $this->input->post('name');
			$role = $this->input->post('role');
			
			$result = $this->Users_model->create($account, $password, $name, $role);
			if ($result) {
				redirect('user/list_all');
			} else {
				$this->data['error'] = "Account is already exist.";
			}
		}
		
		$this->data['user_roles'] = $this->getUserRoles();
		
		$this->load->view('common/header',  $this->data);
		$this->load->view('user/create', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function edit($id){
		if ($this->input->post() != false) {
			$account = $this->input->post('account');
			$password = $this->input->post('password');
			$name = $this->input->post('name');
			$role = $this->input->post('role');
			
			$result = $this->Users_model->update($id, $account, $password, $name, $role);
			if ($result) {
				redirect('user/list_all');
			} else {
				$this->data['error'] = "Account is already exist.";
			}
		}
		
		$this->data['user'] = $this->Users_model->getUser($id);
		$this->data['user_roles'] = $this->getUserRoles();
		
		
		$this->load->view('common/header',  $this->data);
		$this->load->view('user/edit', $this->data);
		$this->load->view('common/footer',  $this->data);
	}
	
	public function delete($id){
		if (!empty($id)) {
			$this->Users_model->delete($id);
		}
		redirect('user/list_all');
	}
}
