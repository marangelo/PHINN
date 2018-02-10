<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class reporteDiario_Controller extends CI_Controller {
	public function __construct() {
		parent:: __construct();
		$this->load->library('session');
        $user = $this->session->userdata('logged');
        if (!isset($user)) {
            redirect(base_url().'index.php','refresh');
        }
	}
	public function index($idReporteDiario) {
		$data['consecutivo'] = $this->Ordenproduccion_model->buscarRtpDiario($idReporteDiario);
		$data['cabeceraRpt'] = $this->reporteDiario_Model->caberaReporte($idReporteDiario);
		$data['idReporteDiario'] = $idReporteDiario;		
		$this->load->view('Reportes/reporteOrdTrabDiario', $data);
	}

	public function cambiaEstadoRptD($idRptDiario, $estado) {
        $this->reporteDiario_Model->cambiarEstadoReporteD($idRptDiario, $estado);
    }

	public function eliminarRegRptDiario()
	{
		$this->reporteDiario_Model->eliminarRptDiario($this->input->post('deleteInfoRptDiario'));
	}

}
?>