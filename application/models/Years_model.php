<?php

class Years_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
    }

    
    function getYears() {
    	// Get the user details
    	$this->db->select("*");
    	$query = $this->db->get('tbl_academic_years');
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	}
    	return array();
    }

    function getYear($id) {
        // Get the user details
        $this->db->select("*");
        $this->db->where("id", $id);
        $query = $this->db->get('tbl_academic_years');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }
    
    function getYearsByCourseLeaderId($id) {
    	// Get the user details
    	$this->db->select("*");
    	$this->db->where("course_leader_users_id", $id);
    	$query = $this->db->get('tbl_academic_years');
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	}
    	return array();
    }


    function create() {
    	
    	$this->db->select("*");
    	$this->db->where("year", $this->input->post('year'));
    	$this->db->where("courses_id", $this->input->post('courses_id'));
    	$query = $this->db->get('tbl_academic_years');
    	if ($query->num_rows() > 0) {
    		return false;
    	}
    	
        // Create the user account
        $data = array(
            'year' => $this->input->post('year'),
            'courses_id' => $this->input->post('courses_id'),
            'course_leader_users_id' => $this->input->post('course_leader_users_id'),
            'course_moderator_users_id' => $this->input->post('course_moderator_users_id'),
        );
        
        $this->db->insert('tbl_academic_years', $data);
        
        return true;
    }
    

    function update($id) {
    	$this->db->select("*");
    	$this->db->where("id !=", $id);
    	$this->db->where("year", $this->input->post('year'));
    	$this->db->where("courses_id", $this->input->post('courses_id'));
    	$query = $this->db->get('tbl_academic_years');
    	if ($query->num_rows() > 0) {
    		return false;
    	}
    	
    	$data = array(
            'year' => $this->input->post('year'),
            'courses_id' => $this->input->post('courses_id'),
            'course_leader_users_id' => $this->input->post('course_leader_users_id'),
            'course_moderator_users_id' => $this->input->post('course_moderator_users_id'),
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_academic_years', $data);
        
        return true;

    }
    
    function delete($id) {
    	// Delete a user account
    	$this->db->delete('tbl_academic_years', array('id' => $id));
    }



}
