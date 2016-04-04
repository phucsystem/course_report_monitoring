<?php

class Users_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
    }

    public function login($account, $password) {
        $this->db->select("*");
        $this->db->where("account_name", $account);
        $password = md5($password);
        $this->db->where("password", $password);
        $query = $this->db->get("tbl_users");
		if ($query->num_rows () > 0) {
			foreach ($query->result() as $rows) {
				$data = array(
						'user_id' => $rows->id,
						'user_name' => $rows->name,
						'role_id' => $rows->role_id,
						'logged_in' => TRUE,
				);
					
				$this->session->set_userdata ( $data );
			}
			return true;
		} else {
			return false;
		}
    }

    public function logout() {
        $data = array(
            'user_id' => '',
            'user_name' => '',
            'role_id' => '',
            'logged_in' => FALSE,
        );
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
    }
    
    function getUsers() {
    	// Get the user details
    	$this->db->select("*");
    	$this->db->where("role_id !=", 1);
    	$query = $this->db->get('tbl_users');
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	}
    	return array();
    }
    
    function getUsersByIds($user_ids_array) {
    	// Get the user details
    	$this->db->select("*");
    	$this->db->where_in("id", $user_ids_array);
    	$query = $this->db->get('tbl_users');
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	}
    	return array();
    }
    
    function getUsersByRole($role) {
    	// Get the user details
    	$this->db->select("*");
    	$this->db->where_in("role_id", $role);
    	$query = $this->db->get('tbl_users');
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	}
    	return array();
    }

    function getUser($id) {
        // Get the user details
        $this->db->select("*");
        $this->db->where("id", $id);
        $query = $this->db->get('tbl_users');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }


    function create($account, $password, $name, $role) {
    	
    	$this->db->select("*");
    	$this->db->where("account_name", $account);
    	$query = $this->db->get('tbl_users');
    	if ($query->num_rows() > 0) {
    		return false;
    	}
    	
        // Create the user account
       
        $data = array(
            'account_name' => $account,
            'name' => $name,
            'role_id' => $role,
        	'email' => $this->input->post('email'),
        );
        if(!empty($password)){
        	$password = md5($password);
        	$data['password'] = $password;
        }
        
        $this->db->insert('tbl_users', $data);
        
        return true;
    }
    
    function delete($id) {
    	// Delete a user account
    	$this->db->delete('tbl_users', array('id' => $id));
    }
    

    function update($id, $account, $password, $name, $role) {
    	$this->db->select("*");
    	$this->db->where("id !=", $id);
    	$this->db->where("account_name", $account);
    	$query = $this->db->get('tbl_users');
    	if ($query->num_rows() > 0) {
    		return false;
    	}
    	
    	$data = array(
            'account_name' => $account,
            'name' => $name,
            'role_id' => $role,
    	    'email' => $this->input->post('email'),
        );
        if(!empty($password)){
        	$password = md5($password);
        	$data['password'] = $password;
        }
        
        $this->db->where('id', $id);
        $this->db->update('tbl_users', $data);
        
        return true;

    }



}
