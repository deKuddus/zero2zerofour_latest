<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_theme extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		// Load Stuff
		// $this->load->model('users_model');
	}

	public function index() {
		$this->dashboard();
	}

	public function dashboard() {

		// Fetch all data
		// $this->data['users'] = $this->users_model->get(2, 3, 'id');
		// dump($this->data['users']);

		// Load view
		$this->data['subview'] = 'admin_theme/components/plain_page';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function login() {
		// Load view
		// $this->data['subview'] = 'admin_theme/components/login';
		$this->load->view('admin_theme/_layout_login');
	}

	public function form() {
		// Load view
		$this->data['form_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/form';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function form_advanced() {
		// Load view
		$this->data['form_advanced_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/form_advanced';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function form_validation() {
		// Load view
		$this->data['form_validation_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/form_validation';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function form_wizards() {
		// Load view
		$this->data['form_wizards_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/form_wizards';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function form_upload() {
		// Load view
		$this->data['form_upload_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/form_upload';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function form_buttons() {
		// Load view
		// $this->data['form_buttons_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/form_buttons';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function tables() {
		// Load view
		$this->data['tables_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/tables';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function tables_dynamic() {
		// Load view
		$this->data['tables_dynamic_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/tables_dynamic';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function chartjs() {
		// Load view
		$this->data['chartjs_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/chartjs';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function chartjs2() {
		// Load view
		$this->data['chartjs2_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/chartjs2';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function morisjs() {
		// Load view
		$this->data['morisjs_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/morisjs';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function echarts() {
		// Load view
		$this->data['echarts_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/echarts';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function other_charts() {
		// Load view
		$this->data['other_charts_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/other_charts';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function e_commerce() {
		// Load view
		$this->data['e_commerce_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/e_commerce';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function projects() {
		// Load view
		$this->data['projects_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/projects';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function project_detail() {
		// Load view
		$this->data['project_detail_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/project_detail';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function contacts() {
		// Load view

		$this->data['subview'] = 'admin_theme/components/contacts';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function profile() {
		// Load view
		$this->data['profile_page'] = TRUE;

		$this->data['subview'] = 'admin_theme/components/profile';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function plain_page() {
		// Load view
		$this->data['subview'] = 'admin_theme/components/plain_page';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function pricing_tables() {
		// Load view
		$this->data['subview'] = 'admin_theme/components/pricing_tables';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}

	public function invoice() {
		// Load view
		$this->data['subview'] = 'admin_theme/components/invoice';
		$this->load->view('admin_theme/_layout_main', $this->data);
	}
}
