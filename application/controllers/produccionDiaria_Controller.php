<?php
defined('BASEPATH') or exit('No direct script access allowed');

class produccionDiaria_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
        $user = $this->session->userdata('logged');
        if (!isset($user)) {
            redirect(base_url().'index.php','refresh');
        }
	}

	public function index() {
		$data['metas'] = $this->produccionDiaria_Model->listarMetas();
		$this->load->view('header');
		$this->load->view('dashboardclean');
		$this->load->view('superAdmin/produccionDiaria', $data);
		$this->load->view('footer');
	}

	public function listarProduccionDiaria($meta) {
		$this->produccionDiaria_Model->listandoProdDxM($meta);
	}

	public function generandoDataRpt() {
		$this->produccionDiaria_Model->generarData();
	}

	public function guardarProduccionDiaria() {
		$this->produccionDiaria_Model->guardarProduccionDiaria(
			$this->input->post('meta'),
			$this->input->post('fecha'),
			$this->input->post('val1'),
			$this->input->post('val2'),
			$this->input->post('val3'),
			$this->input->post('val4'),
			$this->input->post('val5'),
			$this->input->post('val6'),
			$this->input->post('val7'),
			$this->input->post('val8'),
			$this->input->post('val9'),
			$this->input->post('val10'),
			$this->input->post('tipo')
		);
	}

	public function gestionandoProduccionDiaria($fecha, $tipo) {
		$this->produccionDiaria_Model->gestionandoProduccionDiaria($fecha, $tipo);
	}

	public function diasGrafica() {
		$this->produccionDiaria_Model->listarDiasGrafica();
	}

	public function dataGraficaProd() {
		$this->produccionDiaria_Model->generandoDataGrafica();	
	}
}
?>