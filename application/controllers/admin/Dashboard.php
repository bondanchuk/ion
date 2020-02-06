<?php


class Dashboard extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mDashboard');
	}

	function index()
	{
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('tmst_user');
		$output = $crud->render();
		$this->load->view('admin/vDashboard', $output);
	}


}
