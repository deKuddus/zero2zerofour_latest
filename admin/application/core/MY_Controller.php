<?php
	
	/**
	* MY Controller
	*/
	class MY_Controller extends MX_Controller
	{
		
		public $data = array();

		function __construct()
		{
			parent::__construct();

			// Load Stuff
			$this->data['site_name'] = config_item('site_name');
			$this->data['meta_title'] = config_item('meta_title');

			$this->data['errors'] = array();

			$this->load->helper('form');
			$this->load->library('form_validation');
		}

		
	}


?>