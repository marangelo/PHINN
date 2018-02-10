<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class reporte_Model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function guardarRep($data) {
		$result = $this->db->insert('orden_produccion', $data);
		$this->Users_model->InsertLog($this->session->userdata['IdUser'], 'INSERTO ORDEN DE PRODUCCION NUMERO '.$data['NoOrden']);
		return $result;
	}

	public function listaReportes() {
	$query=$this->db->get('view_orden_produccion');
	if ($query->num_rows()>0) {
		return $query->result_array();
	} else {
		return false;
	}
}
    public function cambiaStatusRpt1($idRpt, $status){
	    $data = array('Estado' => $status);
	    $this->db->where('IdOrden', $idRpt);
	    $query=$this->db->update('orden_produccion', $data);
	    $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'CAMBIO ESTADO DE LA ORDEN DE PRODUCCION ID'.$idRpt);
	}

	public function validaNumeroRpt($numeroRt) {
		$valor=false;
		$this->db->where('NoOrden', $numeroRt);
		$query=$this->db->get('orden_produccion');
		if ($query->num_rows()>0) {
			$valor=true;
		} else {
			$valor=false;
		}
		echo $valor;
	}

	public function validaStatusOrd() {
		$valor=false;
		$this->db->where('Estado =', 1);
		$query=$this->db->get('orden_produccion');
		if ($query->num_rows()>0) {
			$valor=true;
		} else {
			$valor=false;
		}
		echo $valor;
	}

	public function validaFechaOrd() {
		$this->db->where('Estado =', 1);
		$this->db->select('FechaFin');
		$query=$this->db->get('orden_produccion');
		if ($query->num_rows()>0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function ultimaFch($IDs) {
		$result1="";
		$this->db->where('NoOrden =', $IDs);
		$this->db->select('FechaInicio');
		$query=$this->db->get('orden_produccion');
		foreach ($query->result_array() as $key) {
			$result1 = $key['FechaInicio'];
		}
		echo $result1;
	}

	public function guardaConsecutivo($dias, $noOrden) {
		$array1 = array();$array2 = array();$arrayF = array(); $result=false;
		for ($i=1; $i <= $dias; $i++) { 
			$array1[$i]['Consecutivo'] = $i;
			$array1[$i]['NoOrder'] = $noOrden;
			$array1[$i]['Turno'] = 'Vespertino';

			$array2[$i]['Consecutivo'] = $i;
			$array2[$i]['NoOrder'] = $noOrden;
			$array2[$i]['Turno'] = 'Matutino';
			}
		$arrayF = array_merge($array1, $array2);
		foreach ($arrayF as $key) {
			$data=array(
				'Consecutivo' => $key['Consecutivo'],
				'NoOrder' => $key['NoOrder'],
				'Turno' => $key['Turno']
			);
			$result = $this->db->insert('reporte_diario', $data);			
		}		
		echo $result;
	}

	public function buscarOrdenP($idUnico) {
		$this->db->where('IdOrden', $idUnico);
        $query=$this->db->get('orden_produccion');
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
        	return 0;	
        }        
	}

	public function editarOrden($data, $id) {
        $this->db->where('IdOrden', $id);
        $this->db->update('orden_produccion', $data);
	}

	public function buscarOrdP($codOrd) {
		$valor=false;
		$this->db->where('NoOrder =', $codOrd);
		$query=$this->db->get('reporte_diario');
		if ($query->num_rows()>0) {
			$valor=true;
		} else {
			$valor=false;
		}
		echo $valor;
	}

	public function cambiarOrdenActiva($numOrden){
		$status="";$resp="";
		$this->db->where('IdOrden =', $numOrden);
		$this->db->select('Estado');
		$query=$this->db->get('orden_produccion');
		foreach ($query->result_array() as $key) {
			$status = $key['Estado'];
		}
		if ($status==0) {
			$resp=false;
		}else {
			$data = array('Estado' => 2);
			$this->db->where('Estado =', 1);
			$this->db->update('orden_produccion', $data);

			$data = array('Estado' => 1);
			$this->db->where('IdOrden =', $numOrden);
			$this->db->update('orden_produccion', $data);
			$resp=true;
		}
		echo $resp;
	}
}
?>