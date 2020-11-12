<?php
	
	/**
	* Frontend_Controller
	*/
	class Frontend_Controller extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			// Load stuff
			

			// $data['meta_title'] = config_item('site_name');
			// $this->data['meta_shop'] = 'SSOFTBD | Shop - UI';
			
			// Login Check
				// $exception_uris = array(
				// 		'account',
				// 		'profile'
				// 	);
				
				// if(in_array(uri_string(), $exception_uris) == TRUE) {
				// 	if($this->client_model->loggedin() == FALSE) {
				// 		redirect('login');
				// 	}
			// }

			// dump($this->data, TRUE);
		}
	}

?>