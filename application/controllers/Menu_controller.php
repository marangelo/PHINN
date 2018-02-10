<?php
class Menu_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->load->library('session');
		//$this->seguridad->estactivo($this->session->userdata('logged'));	
		$user = $this->session->userdata('logged');

           if (!isset($user)) {
               redirect(base_url().'index.php','refresh');
           }
	}
    public function index()
    {
        $this->load->view('header');
        $this->load->view('dashboardclean');
		$this->load->view('Main');
		$this->load->view('footer');
    }
}