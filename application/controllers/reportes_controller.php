<?php
defined('BASEPATH') or exit('No direct script access allowed');

class reportes_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$user = $this->session->userdata('logged');			
		if (!isset($user)) { 
		    redirect(base_url().'index.php','refresh');
		} 
	}

    public function index() {
    	$data['ordProduccion'] = $this->reporteDiario_Model->llenaComboOrdenProd();
	    $this->load->view('header');
		$this->load->view('dashboardclean');
		$this->load->view('Supervisor/reportes', $data);
		$this->load->view('footer');		
    }

    public function filtrandoOrdTrabajoByIdOrdProd($noOrden) {
    	$this->reporteDiario_Model->filtrandoOrdenesTrabajo($noOrden);
    }

    public function menuReporte() {
    	$data['metas'] = $this->produccionDiaria_Model->listarMetas();
	    $this->load->view('header');
		$this->load->view('dashboardclean');
		$this->load->view('superAdmin/menuReporte', $data);
		$this->load->view('footer');	
    }
}