<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class ordenProduccionG_Controller extends CI_Controller {
	public function __construct() {
		parent:: __construct();
		$this->load->library('session');
		$this->load->helper('url');
		$user = $this->session->userdata('logged');
			if (!isset($user)) { 
			redirect(base_url().'index.php','refresh');
		} 
	}

	public function index() {
		$data['listaReport'] = $this->reporte_Model->listaReportes();
        $this->load->view('header');
        $this->load->view('dashboardclean');
        $this->load->view('Supervisor/ordenProduccion', $data);
		$this->load->view('footer');		
	}

	public function guardarReporte() {
		$fechaInicio = date('Y-m-d', strtotime($this->input->post('fechaInicio', TRUE)));
		$fechaFinal = date('Y-m-d', strtotime($this->input->post('fechaFinal', TRUE)));
		$array = array(
			'NoOrden' => $this->input->post('numOrden', TRUE),
			'Usuario' => $this->session->userdata('IdUser'),
			'FechaInicio' => $fechaInicio,
			'FechaFin' => $fechaFinal,
			'Estado' => 3,
			'comentarios' => $this->input->post('comentario', TRUE)
		);
			$this->reporte_Model->guardarRep($array);
			redirect('ordProduccion');
	}

	public function guardarOrdenSupervisor() {
		$fechaInicio = date('Y-m-d', strtotime($this->input->post('fechaInicio', TRUE)));
		$fechaFinal = date('Y-m-d', strtotime($this->input->post('fechaFinal', TRUE)));
		$array = array(
			'NoOrden' => $this->input->post('numOrden', TRUE),
			'Usuario' => $this->session->userdata('IdUser'),
			'FechaInicio' => $fechaInicio,
			'FechaFin' => $fechaFinal,
			'Estado' => 3,
			'comentarios' => $this->input->post('comentario', TRUE)
		);
			$this->reporte_Model->guardarRep($array);
			redirect('OrdenProduccion');
	}

	public function cambiaStatusRpt($idRpt, $status){
	$this->reporte_Model->cambiaStatusRpt1($idRpt, $status);
	}

	public function validaNumRpt($id) {
		$this->reporte_Model->validaNumeroRpt($id);
	}

	public function validaStatusOrdenP() {
	$bool = $this->reporte_Model->validaStatusOrd();
	}

	public function validaFechaOrdenP() {
		$fecha1 = null;
		$fechaFin = $this->reporte_Model->validaFechaOrd();
		foreach ($fechaFin as $key) {
			$fecha1 = $key['FechaFin'];
		}
		echo $fecha1;
	}

	public function obtieneUltFec($id) {
		$result = $this->reporte_Model->ultimaFch($id);
	}

	public function guardaConsecutivoOrdP($dias, $noOrden) {		
		$this->reporte_Model->guardaConsecutivo($dias, $noOrden);
	}

	public function buscarOrdenProd($identificador) {
		$iden = $identificador;
		$json= array();
		$regOrdenP = $this->reporte_Model->buscarOrdenP($iden);
		foreach ($regOrdenP as $key) {
			$dta = array(
				'IdOrden' => $key['IdOrden'],
				'NoOrden' => $key['NoOrden'],
				'Usuario' => $key['Usuario'],
				'FechaInicio' => $key['FechaInicio'],
				'FechaFin' => $key['FechaFin'],
				'Estado' => $key['Estado'],
				'comentarios' => $key['comentarios']				
			);
			$json[] =$dta;
		}
		echo json_encode($json);
	}

	public function editarOrdProd() {
		$idUnico=$this->input->post('identificador', TRUE);
		$fechaInicio = date('Y-m-d', strtotime($this->input->post('fechaInicio1', TRUE)));
		$fechaFinal = date('Y-m-d', strtotime($this->input->post('fechaFinal1', TRUE)));
		$array = array(
		'FechaInicio' => $fechaInicio,
		'FechaFin' => $fechaFinal,
		'comentarios' => $this->input->post('comentario1', TRUE)
		);
		$this->reporte_Model->editarOrden($array, $idUnico);

		redirect('ordProduccion');
	}

	public function editarOrdProdSupervisor() {
		$idUnico=$this->input->post('identificador', TRUE);
		$fechaInicio = date('Y-m-d', strtotime($this->input->post('fechaInicio1', TRUE)));
		$fechaFinal = date('Y-m-d', strtotime($this->input->post('fechaFinal1', TRUE)));
		$array = array(
		'FechaInicio' => $fechaInicio,
		'FechaFin' => $fechaFinal,
		'comentarios' => $this->input->post('comentario1', TRUE)
		);
		$this->reporte_Model->editarOrden($array, $idUnico);

		redirect('OrdenProduccion');
	}

	public function buscarOrdenProdEnOrdTr($codOrd) {
		$this->reporte_Model->buscarOrdP($codOrd);
	}

	public function cambiarOrdenAct($numOrden) {
		$this->reporte_Model->cambiarOrdenActiva($numOrden);
	}
}

?>