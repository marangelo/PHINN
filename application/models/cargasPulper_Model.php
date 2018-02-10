<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class cargaspulper_Model extends CI_Model {	
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function listaConsumos() {
		$query=$this->db->get('view_detallesplanescat1');
		if ($query->num_rows()>0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function guardarCargaPulper($array) {
		$result = $this->db->insert('cargas_pulper', $array);
		if ($result==1) {
			$this->Users_model->InsertLog($this->session->userdata['IdUser'], 'AGREGO UNA NUEVA CARGA AL REPORTE CON ID '.$array['IdReporteDiario']);
		}
		echo $result;
	}

	public function listarCargasP($idReporteDiario) {
		$dataFinal = array();$i=0;
		$this->db->where('idReporteDiario', $idReporteDiario);
		$query=$this->db->get('view_Cargas_Pulper');
		
		if ($query->num_rows()>0) {
			$this->db->select('Descripcion');
			$this->db->where('IdCategoria', 1);
			$query2 = $this->db->get('insumos');
		}
		$this->db->select('COUNT(IdInsumo) as cantMax');
		$this->db->group_by('IdInsumo');
		$this->db->order_by('COUNT(IdInsumo)', 'desc');
		$this->db->where('IdReporteDiario', $idReporteDiario);
		$cant=$this->db->get('cargas_pulper');

		foreach ($query->result_array() as $key) {
			$dataFinal['datos'][$i]['IdCargaPulper']=$key['IdCargaPulper'];
			$dataFinal['datos'][$i]['IdInsumo']=$key['IdInsumo'];
			$dataFinal['datos'][$i]['Cantidad']=$key['Cantidad'];
			$dataFinal['datos'][$i]['IdReporteDiario']=$key['IdReporteDiario'];
			$dataFinal['datos'][$i]['Descripcion']=$key['Descripcion'];
			$dataFinal['datos'][$i]['totalFilas']=$cant->result_array()[0]['cantMax'];
			$dataFinal['datos'][$i]['insumos']=$query2->result_array();
			$i++;
		} 
		return $dataFinal;
	}

	public function calcularTotalCarga($idReporteDiario) {
		$query=$this->db->query('SELECT SUM(Cantidad) as sumTotal from cargas_pulper WHERE IdReporteDiario = "'.$idReporteDiario.'"');
		if ($query->num_rows()>0) {
			return $query->result_array();
		}else {
			return false;
		}
	}

	public function actualizarRegistroCarga($idCargaPulper, $idReporteDiario, $cantidad) {
		if ($cantidad==0) {
			$this->db->delete('cargas_pulper', array('IdCargaPulper' => $idCargaPulper));
			$this->Users_model->InsertLog($this->session->userdata['IdUser'], 'ELIMINO UN REGISTRO DE UNA CARGA DEL REPORTE CON ID '.$idReporteDiario);
			echo "del";
		}else {
			$data = array('Cantidad' => $cantidad);
		    $this->db->where('IdCargaPulper=', $idCargaPulper);
			$this->db->where('IdReporteDiario=', $idReporteDiario);	
		    $result = $this->db->update('cargas_pulper', $data);
		    if ($result==1) {
		    	$this->Users_model->InsertLog($this->session->userdata['IdUser'], 'ACTUALIZO REGISTRO DE UNA CARGA DEL REPORTE CON ID '.$idReporteDiario);
		    }
		    echo $result;
		}
	}

	public function guardarHoraMolienda($array) {
		$result = $this->db->insert('horas_molienda', $array);
		if ($result==1) {
			$this->Users_model->InsertLog($this->session->userdata['IdUser'], 'AGREGO UN NUEVO REGISTRO DE HORA MOLIENDA AL REPORTE CON ID '.$array['IdReporteDiario']);
		}
		echo $result;
	}

	public function listarHorasMolienda($idReporteDiario) {
		$this->db->where('IdReporteDiario', $idReporteDiario);
		$query=$this->db->get('horas_molienda');
		if ($query->num_rows()>0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function buscarHorasMolienda($idHorasMolienda) {
		$this->db->where('IdHora', $idHorasMolienda);
        $query=$this->db->get('horas_molienda');
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
        	return false;	
        }   
	}

	public function actualizarHoraMolienda($idHora, $idReporteDiario ,$horaInicio, $horaFinal) {
		$data = array(
			'horaInicio' => $horaInicio,
			'horaFin' => $horaFinal
			);
	    $this->db->where('IdHora', $idHora);
		$this->db->where('IdReporteDiario', $idReporteDiario);	
	    $result=$this->db->update('horas_molienda', $data);
	    if ($result) {
	    	$this->Users_model->InsertLog($this->session->userdata['IdUser'], 'ACTUALIZO UN REGISTRO DE HORA MOLIENDA DEL RPT CON ID '.$idReporteDiario);
	    }
	    echo $result;
	}

	public function calcularHorasMolienda($idReporteDiario) {
		$query=$this->db->query("CALL sumaHorasMolienda(".$idReporteDiario.")");
		if ($query->num_rows()>0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
}
?>