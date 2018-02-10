<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class tiemposMuertos_Model extends CI_Model{
	function __construct() {
		parent:: __construct();
		$this->load->database();
	}

	public function guardarTiempoMuerto($data) {
	$result = $this->db->insert('tiempos_muertos', $data);
	if($result==1) {
		$this->Users_model->InsertLog($this->session->userdata['IdUser'], 'AGREGO NUEVO TIEMPO MUERTO AL CONSECUTIVO '.$data['Consecutivo'].' DEL TURNO '.$data['Turno']);
	}
	echo $result;
	}

	public function listarTM($IdReporteDiario) {
		$this->db->where('IdReporteDiario =', $IdReporteDiario);
		$query=$this->db->get('tiempos_muertos');
		if ($query->num_rows()>0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function buscarDetalleTMt($idUnico) {
		$this->db->where('IdTiempoMuerto', $idUnico);
        $query=$this->db->get('tiempos_muertos');
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
        	return 0;	
        }        
	}

	public function elimarTiempoMuerto($idTiempoMuerto,$IdReporteDiario) {
		$this->db->where('IdTiempoMuerto', $idTiempoMuerto);
		$this->db->where('IdReporteDiario', $IdReporteDiario);
		$query=$this->db->delete('tiempos_muertos');
		if ($query==1) {
			$this->Users_model->InsertLog($this->session->userdata['IdUser'], 'ELIMINO UN TIEMPO MUERTO DEL REPORTE CON ID NO. '.$IdReporteDiario);
			echo true;
		}else {echo false;}
	}

	public function actualiza() {
		$query=$this->db->get('tiempos_muertos');
		if ($query->num_rows()>0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
}
?>