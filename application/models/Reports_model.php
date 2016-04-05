<?php

class Reports_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
    }

    
    function getReports() {
    	// Get the user details
    	$this->db->select("*");
    	$query = $this->db->get('tbl_reports');
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	}
    	return array();
    }
    
    function getReportsByStatus($status) {
    	// Get the user details
    	$this->db->select("*");
    	$this->db->where("status", $status);
    	$query = $this->db->get('tbl_reports');
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	}
    	return array();
    }

    function getReport($id) {
        // Get the user details
        $this->db->select("*");
        $this->db->where("id", $id);
        $query = $this->db->get('tbl_reports');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }
    
    function getReportsByYearIds($years_ids_array) {
    	// Get the user details
    	$this->db->select("*");
    	$this->db->where_in("academic_years_id", $years_ids_array);
    	$query = $this->db->get('tbl_reports');
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	}
    	return array();
    }


    function create($file_data, $create_user) {
    	$this->db->select("*");
    	$this->db->where("name", $this->input->post('name'));
    	$query = $this->db->get('tbl_reports');
    	if ($query->num_rows() > 0) {
    		return false;
    	}
    	
        // Create the user account
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'file_url' => $file_data['upload_data']['full_path'],
        	'status' => REPORT_STATUS_WAIT_FOR_APPROVE,
            'create_by' => $create_user['user_id'],
            'create_datetime' => date('Y-m-d H:i:s'),
            'academic_years_id' => $this->input->post('year')
        );
        
        $this->db->insert('tbl_reports', $data);
        
        return $this->db->insert_id();;
    }
    

    function update($id, $file_data) {
    	$this->db->select("*");
    	$this->db->where("id !=", $id);
    	$this->db->where("name", $this->input->post('name'));
    	$query = $this->db->get('tbl_reports');
    	if ($query->num_rows() > 0) {
    		return false;
    	}
    	
    	$data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
    	    'academic_years_id' => $this->input->post('year')
        );
    	
    	if(!empty($file_data['upload_data']['full_path'])){
    		$data['file_url'] = $file_data['upload_data']['full_path'];
    	}
    	
        $this->db->where('id', $id);
        $this->db->update('tbl_reports', $data);
        
        return true;
    }
    
    function updateStatus($id, $status, $user) {
    	$data = array(
    			'status' => $status,
    	);
    	
    	if($status == REPORT_STATUS_APPROVED){
    		$data['approve_by'] = $user['user_id'];
    		$data['approve_datetime'] = date('Y-m-d H:i:s');
    	}
    	
    	$this->db->where('id', $id);
    	$this->db->update('tbl_reports', $data);
    	return true;
    }
    
    function comment($id, $user) {
    	$data = array(
    			'comment' => $this->input->post('comment'),
    			'status' => REPORT_STATUS_FEEDBACK,
    			'approve_by' => $user['user_id'],
    			'approve_datetime' => date('Y-m-d H:i:s')
    	);
    	
    	$this->db->where('id', $id);
    	$this->db->update('tbl_reports', $data);
    	return true;
    }
    
    function delete($id) {
    	// Delete a user account
    	$this->db->delete('tbl_reports', array('id' => $id));
    }



}
