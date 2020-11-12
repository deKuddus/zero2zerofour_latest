<?php
	
	/**
	* Frontend_Controller
	*/
	class Admin_Controller extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			// Load stuff
			// $this->data['shop_name'] = 'RMART | ADMIN ';

			// $this->load->module('users');

			// $this->load->model('users_model');
			

			// // // Login Check
			// 	$exception_uris = array(
			// 			'login',
			// 			'logout'
			// 		);
				
			// 	if(in_array(uri_string(), $exception_uris) == FALSE) {
			// 		if($this->users_model->loggedin() == FALSE) {
			// 			redirect('login');
			// 		}
			// 	}
			// /Login Check
		}
	}

?>