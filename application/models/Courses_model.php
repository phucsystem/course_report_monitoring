<?php

class Courses_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
    }

    
    function getCourses() {
    	// Get the user details
    	$this->db->select("*");
    	$query = $this->db->get('tbl_courses');
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	}
    	return array();
    }

    function getCourse($id) {
        // Get the user details
        $this->db->select("*");
        $this->db->where("id", $id);
        $query = $this->db->get('tbl_courses');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }


    function create() {
    	
    	$this->db->select("*");
    	$this->db->where("name", $this->input->post('name'));
    	$this->db->or_where("code", $this->input->post('code'));
    	$query = $this->db->get('tbl_courses');
    	if ($query->num_rows() > 0) {
    		return false;
    	}
    	
        // Create the user account
        $data = array(
            'name' => $this->input->post('name'),
            'code' => $this->input->post('code'),
            'faculties_id' => $this->input->post('faculty_id'),
        );
        
        $this->db->insert('tbl_courses', $data);
        
        return true;
    }
    

    function update($id) {
    	$this->db->select("*");
    	$this->db->where("id !=", $id);
    	$this->db->where("name", $this->input->post('name'));
    	$this->db->where("code", $this->input->post('code'));
    	$query = $this->db->get('tbl_courses');
    	if ($query->num_rows() > 0) {
    		return false;
    	}
    	
    	$data = array(
            'name' => $this->input->post('name'),
            'code' => $this->input->post('code'),
            'faculties_id' => $this->input->post('learning_director'),
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_courses', $data);
        
        return true;

    }
    
    function delete($id) {
    	// Delete a user account
    	$this->db->delete('tbl_courses', array('id' => $id));
    }



}
