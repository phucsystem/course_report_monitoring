<?php

class Faculties_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
    }

    
    function getFaculties() {
    	// Get the user details
    	$this->db->select("*");
    	$query = $this->db->get('tbl_faculties');
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	}
    	return array();
    }

    function getFaculty($id) {
        // Get the user details
        $this->db->select("*");
        $this->db->where("id", $id);
        $query = $this->db->get('tbl_faculties');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }
    
    function getFacultiesByChancellorId($id) {
    	// Get the user details
    	$this->db->select("*");
    	$this->db->where("vice_chancellor_users_id", $id);
    	$query = $this->db->get('tbl_faculties');
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	}
    	return array();
    }
    
    function getFacultiesByLearningDirectorId($id) {
    	// Get the user details
    	$this->db->select("*");
    	$this->db->where("learning_director_users_id", $id);
    	$query = $this->db->get('tbl_faculties');
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	}
    	return array();
    }


    function create() {
    	
    	$this->db->select("*");
    	$this->db->where("name", $this->input->post('name'));
    	$query = $this->db->get('tbl_faculties');
    	if ($query->num_rows() > 0) {
    		return false;
    	}
    	
        // Create the user account
        $data = array(
            'name' => $this->input->post('name'),
            'vice_chancellor_users_id' => $this->input->post('vice_chancellor'),
            'learning_director_users_id' => $this->input->post('learning_director'),
        );
        
        $this->db->insert('tbl_faculties', $data);
        
        return true;
    }
    

    function update($id) {
    	$this->db->select("*");
    	$this->db->where("id !=", $id);
    	$this->db->where("name", $this->input->post('name'));
    	$query = $this->db->get('tbl_faculties');
    	if ($query->num_rows() > 0) {
    		return false;
    	}
    	
    	$data = array(
            'name' => $this->input->post('name'),
            'vice_chancellor_users_id' => $this->input->post('vice_chancellor'),
            'learning_director_users_id' => $this->input->post('learning_director'),
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_faculties', $data);
        
        return true;

    }
    
    function delete($id) {
    	// Delete a user account
    	$this->db->delete('tbl_faculties', array('id' => $id));
    }



}
