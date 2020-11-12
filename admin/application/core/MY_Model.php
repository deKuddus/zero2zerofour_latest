<?php
	
	/**
	* MY Model
	*/
	class MY_Model extends CI_Model
	{
		protected $_table_name = '';
		protected $_primary_key = 'id';
		protected $_primary_filter = 'intval';
		protected $_order_by = '';
		public $rules = array();
		protected $_timestamps = FALSE;

		function __construct()
		{
			parent::__construct();
		}

		// load data from post array to data 
		public function array_from_post($fields) {
			$data = array();

			foreach ($fields as $field) {
				$data[$field] = $this->input->post($field);
			}

			return $data;
		}

		// Fetch data from db 
		public function get($id = NULL, $single = FALSE) {

			if($id != NULL) {
				$filter = $this->_primary_filter;
				$id = $filter($id);
				// $this->db->where($this->_primary_key, $id);
				$this->db->where(array($this->_table_name.'.is_active'=>1, $this->_primary_key=>$id));
				$method = 'row';
			}
			else if($single == TRUE) {
				$this->db->where($this->_table_name.'.is_active',1);
				$method = 'row';
			}
			else {
				$this->db->where($this->_table_name.'.is_active',1);
				$method = 'result';
			}


			if(!$this->db->order_by($this->_order_by)) {
				$this->db->order_by($this->_order_by);
			}

			return $this->db->get($this->_table_name)->$method();
		}

		// Fetch data from db by WHERE clause
		public function get_by($where, $single = FALSE) {
			
			$this->db->where($where);

			return $this->get(NULL, $single);
		}
		
		// INSERT / UPDATE into DB
		public function save($data, $id = NULL) {
			// Set timestamps
			if($this->_timestamps == TRUE) {
				$now = date('Y-m-d H:i:s');
				$id || $data['created'] = $now;
				$data['modified'] = $now;
			}

			// Insert
			if($id === NULL) {
				!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
				$this->db->set($data);
				$this->db->insert($this->_table_name);
				$id = $this->db->insert_id();
			}
			// Update
			else {
				$filter = $this->_primary_filter;
				$id = $filter($id);
				$this->db->set($data);
				$this->db->where($this->_primary_key, $id);
				$this->db->update($this->_table_name);
			}

			return $id;
		}
		
		// DELETE form DB
		public function delete($id) {
			$filter = $this->_primary_filter;
			$id = $filter($id);

			if(!$id) {
				return FALSE;
			}

			$this->db->where($this->_primary_key, $id);
			$this->db->limit(1);
			$this->db->delete($this->_table_name);
		}

		// DeActive in
		public function de_active($id) {
			$filter = $this->_primary_filter;
			$id = $filter($id);

			if(!$id) {
				return FALSE;
			}

			$data = array(
					'is_active' => 0
				);

			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->limit(1);
			$this->db->update($this->_table_name);
		}

		// Set table name 
		public function get_table() {
	    	$table = $this->_table_name;
	    	return $table;
	    }

	    // Get data with Order
	    public function get_with_order($order_by) {
	    	$table = $this->get_table();
	    	$this->db->order_by($order_by);
	    	$query = $this->db->get($table);
	    	return $query->result();
	    }

	    // get data with limit
	    public function get_with_limit($limit, $offset, $order_by) {
	    	$table = $this->get_table();
	    	$this->db->limit($limit, $offset);
	    	$this->db->order_by($order_by);
	    	$query = $this->db->get($table);
	    	return $query->result();
	    }

	    // Get data with ID 
	    public function get_where($id) {
	    	$table = $this->get_table();
	    	$this->db->where($this->_primary_key, $id);
	    	$query = $this->db->get($table);
	    	return $query->result();
	    }

	    // Get data row with ID
	    public function get_row_where($id) {
	    	$table = $this->get_table();
	    	$this->db->where($this->_primary_key, $id);
	    	$query = $this->db->get($table);
	    	return $query->row();
	    }

	    // Get data for specific value
	    public function get_where_custom($col, $value) {
	    	$table = $this->get_table();
	    	$this->db->where($col, $value);
	    	$query = $this->db->get($table);
	    	return $query->result();
	    }

	    // Inset data
	    public function _insert($data) {
	    	$table = $this->get_table();
	    	$this->db->insert($table, $data);
	    	return $this->db->insert_id();
	    }

	    // Update data
	    public function _update($id, $data) {
	    	$table = $this->get_table();
	    	$this->db->where($this->_primary_key, $id);
	    	$this->db->update($table, $data);
	    }

	    // Delete row
	    public function _delete($id) {
	    	$table = $this->get_table();
	    	$this->db->where($this->_primary_key, $id);
	    	$this->db->delete($table);
	    }

	    // Get total num for specific value
	    public function count_where($col, $value) {
	    	$table = $this->get_table();
	    	$this->db->where($col, $value);
	    	$query = $this->db->get($table);
	    	$num_rows = $query->num_rows();
	    	return $num_rows;
	    }

	    // Get total row
	    public function count_all() {
	    	$table = $this->get_table();
	    	$query = $this->db->get($table);
	    	$num_rows = $query->num_rows();
	    	return $num_rows;
	    }

	    // Get last ID
	    public function get_max() {
	    	$table = $this->get_table();
	    	$this->db->select_max($this->_primary_key);
	    	$query = $this->db->get($table);
	    	$row = $query->row();
	    	$id = $row->id;
	    	return $id;
	    }

	    // Custom query
	    public function _custom_query($mysql_query) {
	    	$query = $this->db->query($mysql_query);
	    	return $query->result();
	    }

	    // Custom query _custom_result
	    public function _custom_result($mysql_query) {
	    	$query = $this->db->query($mysql_query);
	    	return $query->result();
	    }

	    // Custom query _custom_result_array
	    public function _custom_result_array($mysql_query) {
	    	$query = $this->db->query($mysql_query);
	    	return $query->result_array();
	    }

	    // return $query->result_array();


	    // Custom query return
		public function _custom_return_query($mysql_query) {
			$query = $this->db->query($mysql_query);
			return $query;
		}

		// unique validation check
	    public function unique_validation_check($column_name,$str) {
	        
	        $mysql_query = "SELECT * FROM $this->_table_name WHERE $column_name ='$str'";
	        $update_id = $this->uri->segment(3);
	        
	        if (is_numeric($update_id)) {
	            $mysql_query .= " AND id!='$update_id'";
	        }

	        $query = $this->_custom_return_query($mysql_query);

	        return $query->num_rows();
	    }

	    //data_dropdown
	    public function get_data_dropdown($arr) {
        
	        $this->load->module($arr['module']);
	

	        $id = $arr['id'];
	        $name = $arr['name'];
	        $this->db->select("$id, $name");


	        //$this->_table_name='product';
	        $data = $this->$arr['model']->get();
	        // dump($product,TRUE);
	        
	        // Return key => value pair array
	        $array = array(0 => '-- Select --');
	        if(count($data)) {
	            foreach ($data as $dta) {
	                $array[$dta->id] = $dta->$name;
	            }
	        }

	        return $array;
	    }

	    public function date_format($data){
	        $date = DateTime::createFromFormat('m/d/Y', $data);
	        $date=$date->format('Y-m-d');
	        return $date;
	    }

	}


?>