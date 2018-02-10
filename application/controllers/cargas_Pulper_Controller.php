<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class cargas_Pulper_Controller extends CI_Controller {
	public $cantTotal;
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
        $user = $this->session->userdata('logged');
        if (!isset($user)) {
            redirect(base_url().'index.php','refresh');
        }
	}

	public function index($idReporteD) {
		$data['consecutivo'] = $this->Ordenproduccion_model->buscarRtpDiario($idReporteD);
		$data['tipoFibra']= $this->cargasPulper_Model->listaConsumos();

		$data['tiempoTotal'] = date('H:i:s', strtotime($this->calcularCantHoras($idReporteD)));
		$query = $this->cargasPulper_Model->calcularTotalCarga($idReporteD);
		foreach ($query as $key) {
			$cargaTotal = $key['sumTotal'];
		}
		$data['cargaTotal'] = $cargaTotal;
		$this->load->view('header');
		$this->load->view('dashboardclean');
		$this->load->view('Coordinador/cargasPulper',$data);
		$this->load->view('footer');
	}

	public function listarCargasPulper() {
		$json= array();
		$query=$this->cargasPulper_Model->listaConsumos();
		foreach ($query as $key) {
			$dta = array(
				'descripcion' => $key['descripcion']		
			);
			$json[] =$dta;
		}
		echo json_encode($json);
	}

	public function guardarCPulper() {
		$IdReporteDiario = $this->input->post('idReporteDiario', TRUE);
		$IdInsumo = $this->input->post('tipoFibra', TRUE);
		$Cantidad = $this->input->post('cantidad', TRUE);
		$array = array(
			'IdReporteDiario'=> $IdReporteDiario,
			'IdInsumo' => $IdInsumo,
			'Cantidad' => $Cantidad
			);
		 $duplicado = $this->db->get_where('reporte_diario',array("IdReporteDiario" => $IdReporteDiario,'Estado'=>0));
         if ($duplicado->num_rows()>0) {
             echo "Consecutivo ya se ha cerrado";
         } else {
			$this->cargasPulper_Model->guardarCargaPulper($array);
		 }
	}

	public function listarCantidadCargas($idReporteDiario) {
		$json=array();
		$query=$this->cargasPulper_Model->listarCargasP($idReporteDiario);
		if ($query!=FALSE) {
		echo json_encode($query);
		}else {
			echo 'FALSE';
		}
	}

	public function actualizarCargaP($idCargaPulper, $IdReporteDiario, $cantidad) {
		$duplicado = $this->db->get_where('reporte_diario',array("IdReporteDiario" => $IdReporteDiario,'Estado'=>0));
         if ($duplicado->num_rows()>0) {
             echo "Consecutivo ya se ha cerrado";
         }else{
		   $this->cargasPulper_Model->actualizarRegistroCarga($idCargaPulper, $IdReporteDiario ,$cantidad);		   
		 }
	}

	public function agregarHorasM() {
		$IdReporteDiario = $this->input->post('idRptD', TRUE);
		$horaInicio = date("H:i:s", strtotime($this->input->post('timepickerII', TRUE)));
		$horaFinal = date("H:i:s", strtotime($this->input->post('timepickerFF', TRUE)));
		$carga = 'BATIDO';
		$array = array(
			'IdReporteDiario'=> $IdReporteDiario,
			'horaInicio' => $horaInicio,
			'horaFin' => $horaFinal,
			'carga' => $carga
			);
		$duplicado = $this->db->get_where('reporte_diario',array("IdReporteDiario" => $IdReporteDiario,'Estado'=>0));
         if ($duplicado->num_rows()>0) {
             echo "Consecutivo ya se ha cerrado";
         } else {
		$this->cargasPulper_Model->guardarHoraMolienda($array);
		 }
	}

	public function listarHorasM($idReporteDiario) {
		$json=array(); $tiempoTotal;
		$query=$this->cargasPulper_Model->listarHorasMolienda($idReporteDiario);
		if ($query!=FALSE) {
		foreach ($query as $key) {
			$horaInicio = date('g:i A', strtotime($key['horaInicio']));
			$horaFinal = date('g:i A', strtotime($key['horaFin']));
			$tf=$this->sumaRestaHoras($horaFinal,$horaInicio);
			$dta = array(
				'IdHora' => $key['IdHora'],
				'carga' => $key['carga'],
				'horaInicio' => $horaInicio,
				'horaFin' => $horaFinal,
				'tiempo' => $tf,
				'IdReporteDiario' => $key['IdReporteDiario']	
			);
			$json[] =$dta;
		}
		echo json_encode($json);
		}else {
			echo 'FALSE';
		}
	}

	public function calcularCantHoras($idReporteDiario) {
		$tiempoTotal=array();$contTotal=0;
		$query=$this->cargasPulper_Model->listarHorasMolienda($idReporteDiario);
		if ($query!=FALSE) {
			foreach ($query as $key) {	
				$horaInicio = date('g:i A', strtotime($key['horaInicio']));
				$horaFinal = date('g:i A', strtotime($key['horaFin']));
				$tf=$this->sumaRestaHoras($horaFinal,$horaInicio);		
				$array = array(
						'horas' => $tf
					);
				$tiempoTotal[] = $array;	
			}
		for ($i=0;$i<count($tiempoTotal);$i++) { 
			list($h, $m, $s) = explode(':', $tiempoTotal[$i]['horas']); 
			$miMunutos =   ($h * 3600) + ($m * 60) + $s;     
			$this->cantTotal += $miMunutos;
		}
			return $this->conversorSegundosHoras($this->cantTotal);	
		}
	}

	public function conversorSegundosHoras($tiempo_en_segundos) {
       $horas = floor($tiempo_en_segundos / 3600);
       $minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
       $segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);

       return $horas . ':' . $minutos . ":" . $segundos;
	}

	public function buscarHorasM($idHoraMolienda) {
		$json=array();
		$query=$this->cargasPulper_Model->buscarHorasMolienda($idHoraMolienda);
		if ($query!=FALSE) {
		foreach ($query as $key) {
			$horaInicio = date('g:i A', strtotime($key['horaInicio']));
			$horaFinal = date('g:i A', strtotime($key['horaFin']));
			$dta = array(
				'IdHora' => $key['IdHora'],
				'carga' => $key['carga'],
				'horaInicio' => $horaInicio,
				'horaFin' => $horaFinal,
				'IdReporteDiario' => $key['IdReporteDiario']	
			);
			$json[] =$dta;
		}
		echo json_encode($json);
		}else {
			echo 'FALSE';
		}
	}

	public function actualizaHMolienda() {
		$idHora = $this->input->post('idHora', TRUE);
		$IdReporteDiario = $this->input->post('idRptD', TRUE);
		$horaInicio = date("H:i:s", strtotime($this->input->post('timepickerII', TRUE)));
		$horaFinal = date("H:i:s", strtotime($this->input->post('timepickerFF', TRUE)));
		$duplicado = $this->db->get_where('reporte_diario',array("IdReporteDiario" => $IdReporteDiario,'Estado'=>0));
         if ($duplicado->num_rows()>0) {
             echo "Consecutivo ya se ha cerrado";
         }else{
		$this->cargasPulper_Model->actualizarHoraMolienda($idHora, $IdReporteDiario, $horaInicio, $horaFinal);
	   }
	}

	public function sumaRestaHoras($horainicio, $horafin){
		$dif=date("H:i:s", strtotime("00:00:00") + strtotime($horainicio) - strtotime($horafin) );
		//$min = 
		return $dif;
	}
	
}

?>