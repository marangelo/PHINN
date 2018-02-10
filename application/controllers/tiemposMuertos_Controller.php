<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class tiemposMuertos_Controller extends CI_Controller {
	public function __construct() {
		parent:: __construct();
		$this->load->helper('url');
		$this->load->library('session');
        $user = $this->session->userdata('logged');
        if (!isset($user)) {
            redirect(base_url().'index.php','refresh');
        }
	}

public function index() {
	$this->load->view('header');
	$this->load->view('dashboardclean');
	$this->load->view('TiemposMuertos/tiemposMuertos');
	$this->load->view('footer');
}

public function guardarTiempoM() {
	//$var1 = $this->input->post('consecutivo', TRUE);
	$horaInicio = date("H:i:s", strtotime($this->input->post('timepickerII', TRUE)));
	$horaFinal = date("H:i:s", strtotime($this->input->post('timepickerFF', TRUE)));
	$idRptD = $this->input->post('idRptD', TRUE);
	$consecutivo = $this->input->post('consecutivo', TRUE);
	$ordP1 = $this->input->post('ordP1', TRUE);
	$turno1 = $this->input->post('turno1', TRUE);
	$maquina = $this->input->post('maquina', TRUE);
	$descripcion = $this->input->post('descipcion11', TRUE);
	$array = array(
		'IdReporteDiario'=> $idRptD,
		'Consecutivo' => $consecutivo,
		'NoOrden' => $ordP1,
		'HoraInicio' => $horaInicio,
		'HoraFin' => $horaFinal,
		'Turno' => $turno1,
		'Maquina' => $maquina,
		'Descripcion' => $descripcion
		);
		 $duplicado = $this->db->get_where('reporte_diario',array("IdReporteDiario" => $idRptD,'Estado'=>0));
         if ($duplicado->num_rows()>0) {
             echo "Consecutivo ya se ha cerrado";
         } else {
	        $this->tiemposMuertos_Model->guardarTiempoMuerto($array);
     	    echo "permite guardar";
		 }
	}

	public function buscarDetalleTM($iden) {
		$identificador = $iden;$maquina="";
		$json= array();
		$list = $this->tiemposMuertos_Model->buscarDetalleTMt($identificador);
		foreach ($list as $key) {
			$horaInicio = date('g:i A', strtotime($key['HoraInicio']));
			$horaFinal = date('g:i A', strtotime($key['HoraFin']));
			$horaMD = new DateTime('00:00:00');
			$datetime1 = new DateTime($key['HoraInicio']);
			$datetime2 = new DateTime($key['HoraFin']);

			if ($datetime2<$datetime1) {
				$time1 = $horaMD->diff($datetime2);
				$time2 = $horaMD->diff($datetime2);
				$tf=$this->sumaRestaHoras($horaFinal,$horaInicio);
				
			}else {
				$interval = $datetime1->diff($datetime2);
				$tf = $interval->format("%H:%I");
			}		
			if ($key['Maquina'] == 1) {
				$maquina="Maquina 1";
			} 
			else if($key['Maquina'] == 2)
			{
				$maquina="Maquina 2";
			}
			else if($key['Maquina'] == 3){
				$maquina="Maquina 3";
			}
			$dta = array(			
			'IdTiempoMuerto' => $key['IdTiempoMuerto'],
			'IdReporteDiario' => $key['IdReporteDiario'],
			'NoOrden' => $key['NoOrden'],
			'HoraInicio' => $horaInicio,
			'Turno' => $key['Turno'],
			'HoraFin' => $horaFinal,
			'Intervalos' => $tf,
			'Maquina' => $maquina,
			'Descripcion' => $key['Descripcion']
			);
			$json[] =$dta;
		}
		echo json_encode($json);
	}

	public function eliminarTiempoM($idTiempoMuerto,$IdReporteDiario) {
		 $duplicado = $this->db->get_where('reporte_diario',array("IdReporteDiario" => $IdReporteDiario,'Estado'=>0));
         if ($duplicado->num_rows()>0) {
             echo "Consecutivo ya se ha cerrado";
         } else {
		$this->tiemposMuertos_Model->elimarTiempoMuerto($idTiempoMuerto,$IdReporteDiario);
		//echo "Se puede eliminar";
		 }
	}

	public function actualizarTablaTM() {
		$json= array();
		$query=$this->tiemposMuertos_Model->actualiza();
		foreach ($query as $key) {
			$dta = array(
			'IdTiempoMuerto' => $key['IdTiempoMuerto'],
			'IdReporteDiario' => $key['IdReporteDiario'],
			'NoOrden' => $key['NoOrden'],
			'HoraInicio' => $key['NoOrden'],
			'Turno' => $key['Turno'],
			'HoraFin' => $key['NoOrden'],
			'Intervalos' => $key['NoOrden'],
			'Maquina' => $key['NoOrden'],
			'Descripcion' => $key['Descripcion']
		);
			$json[] =$dta;
		}
		echo json_encode($json);
	}

	public function sumaRestaHoras($horainicio, $horafin){
		$dif=date("H.i:s", strtotime("00:00:00") + strtotime($horainicio) - strtotime($horafin) );
		return $dif;
	}
}
?>