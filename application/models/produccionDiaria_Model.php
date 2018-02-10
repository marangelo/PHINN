<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class produccionDiaria_Model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function listandoProdDxM($meta) {
		$i=0;
		$json = array();
		$query=$this->db->query("CALL sp_produccionDiaria('".$meta."')");
		
		$this->db->order_by("fecha", "asc");
		$query1=$this->db->get('tmp_produccion');
		if ($query1->num_rows()>0) {
            foreach ($query1->result_array() as $key) {
	            $json['data'][$i]['fecha'] = $key['fecha'];
	            $json['data'][$i]['1'] = $key['1'];
	            $json['data'][$i]['2'] = $key['2'];
	            $json['data'][$i]['3'] = $key['3'];
	            $json['data'][$i]['4'] = $key['4'];
	            $json['data'][$i]['5'] = $key['5'];
	            $json['data'][$i]['6'] = $key['6'];
	            $json['data'][$i]['7'] = $key['7'];
	            $json['data'][$i]['8'] = $key['8'];
	            $json['data'][$i]['9'] = $key['9'];
	            $json['data'][$i]['10'] = $key['10'];
	            $json['data'][$i]['TBD'] = $key['TBD'];
	            $json['data'][$i]['TNS'] = $key['TNS'];
	            $json['data'][$i]['OPC'] = "	
                <div class='nav'>
                    <a class='dropdown-button btn-floating' href='#' data-activates='dropdown-".$i."'><i class='small material-icons'>list</i></a>
                    <ul id='dropdown-".$i."' class='dropdown-content ul-dr'>
						<li><a href='#!' onclick='editandoProduccion(".'"'.$key['fecha'].'"'.", 1)'>Editar</a></li>
						<li class='divider'></li>
						<li><a onclick='deleteProduccion(".'"'.$key['fecha'].'"'.", 2)' href='#' style='color:red'>Eliminar</a></li>
                    </ul>
                </div>";
	            $i++; 
            }
		}
		echo json_encode($json);
	}

	public function listarMetas() {
		setlocale(LC_TIME, 'spanish');
        
        $this->db->select('Consecutivo');
        $this->db->select('FechaMeta');
        $this->db->order_by("Estado", "desc");
        $query_meta = $this->db->get('metas');
        
        if ($query_meta->num_rows()>0) {
	        foreach ($query_meta->result_array() as $key) {
	        	$inicio = strftime("%B - %Y", strtotime($key['FechaMeta']));
	            $temp[] = array(
	                'value' => $key['Consecutivo'],
	                'desc' =>  $inicio
	            );                
	        }
	        return $temp;
        }else {
        	return false;
        }        
	}

	public function soloMetas($meta) {
		$this->db->where('Consecutivo', $meta);
		$this->db->select('Eco24/1');
		$this->db->select('Eco6/4');
		$this->db->select('Cholin_8/6');
		$this->db->select('Cholin_900');
		$this->db->select('Generico_Eco_1000');
		$this->db->select('Generico_Eco_900');
		$this->db->select('Cholin_HD_32/1');
		$this->db->select('BolsonServilleta');
		$this->db->select('Cholin_HD_Gen32/1');
		$query = $this->db->get('metas');

		if ($query->num_rows()>0) {
			return $query->result_array();
		}else {
			return false;
		}
	}

	public function soloPesos() {
		$this->db->select('Peso');
		$query = $this->db->get('Articulos');
		if ($query->num_rows()>0) {
			return $query->result_array();
		}else {
			return false;
		}
	}

	public function guardarProduccionDiaria($meta,$fecha,$val1,$val2,$val3,$val4,$val5,$val6,$val7,$val8,$val9,$val10,$tipo) {

		$this->db->where('fecha', $fecha);
		$query = $this->db->get('produccion_diaria');

		if ($query->num_rows()>0 && $tipo=='u') {
			$this->db->where('fecha', $fecha);
			$this->db->update('produccion_diaria', array(
				'fecha' => $fecha,
				'val1' => $val1,
				'val2' => $val2,
				'val3' => $val3,
				'val4' => $val4,
				'val5' => $val5,
				'val6' => $val6,
				'val7' => $val7,
				'val8' => $val8,
				'val9' => $val9,
				'val10' => $val10,
				'IdMeta' => $meta
			));
		}elseif ($query->num_rows()>0 && $tipo=='i') {
			echo 2;
		}else {
			$this->db->insert('produccion_diaria', array(
				'fecha' => $fecha,
				'val1' => $val1,
				'val2' => $val2,
				'val3' => $val3,
				'val4' => $val4,
				'val5' => $val5,
				'val6' => $val6,
				'val7' => $val7,
				'val8' => $val8,
				'val9' => $val9,
				'val10' => $val10,
				'IdMeta' => $meta
			));
			echo ($this->db->affected_rows() > 0) ? 1 : 0;
		}        
	}

	public function porcentajeCumplimiento($meta) {
		$query_sp_porc=$this->db->query("CALL porcentaje('".$meta."')");
		if ($query_sp_porc->num_rows()>0) {
			return $query_sp_porc->result_array();
		}else {
			return false;
		}
	}

	public function gestionandoProduccionDiaria($fecha, $tipo) {
		if ($tipo == 1) {
			$this->db->where('fecha', $fecha);
			$result = $this->db->get('tmp_produccion');
			if ($result->num_rows()>0) {
				echo json_encode($result->result_array());
			}else {
				echo false;
			}
		}elseif ($tipo == 2) {
			$this->db->where('fecha', $fecha);
			$query=$this->db->delete('produccion_diaria');
			if ($query==1) {
				echo true;
			}else {echo false;}
		}
	}

	public function generarData() {
		$json=array(); $i=0;
		$query_data_prod=$this->db->query("SELECT fecha AS fecha, ((`1`+`2`)/TBD)*100 AS ep,((`3`+`4`)/TBD)*100 AS ch,((`5`+`6`)/TBD)*100 AS gen FROM tmp_produccion ORDER BY fecha ASC;");
		if ($query_data_prod->num_rows()>0) {
			foreach ($query_data_prod->result_array() as $key) {
				$json['data'][$i]['fecha'] = $key['fecha'];
				$json['data'][$i]['ep'] = floatval(number_format($key['ep'],0))."%";
				$json['data'][$i]['ch'] = floatval(number_format($key['ch'],0))."%";
				$json['data'][$i]['gen'] =floatval(number_format($key['gen'],0))."%";
				$i++;			
			}					
		}else {
			$json['data'][$i]['fecha'] = '01/01/2000';
			$json['data'][$i]['ep'] = '-';
			$json['data'][$i]['ch'] = '-';
			$json['data'][$i]['gen'] = '-';
		}
		echo json_encode($json);
	}

	public function soloFecha($meta) {
		setlocale(LC_TIME, 'spanish');
		$this->db->where('Consecutivo', $meta);
		$this->db->select('FechaMeta');
		$query = $this->db->get('metas');
		if ($query->num_rows()>0) {
			return strftime("%B %Y", strtotime($query->result_array()[0]['FechaMeta']));
		}else {
			return false;
		}
	}

	public function listarDiasGrafica() {
		$json=array();$i=0;
		$query_dias_prod=$this->db->query("SELECT fecha AS fecha FROM tmp_produccion ORDER BY fecha ASC;");

		if ($query_dias_prod->num_rows()>0) {
			foreach ($query_dias_prod->result_array() as $key) {
				$json['name'][$i] = date('d/m', strtotime($key['fecha']));	
				$i++;
			}
			
			echo json_encode($json);
			return $json;
		}else {
			return false;
		}
	}

	public function generandoDataGrafica() {
		$json=array();$i=0;$ecoP=array();$cho=array();$gen=array();
		$query_data_prod=$this->db->query("SELECT ((`1`+`2`)/TBD)*100 AS ep,((`3`+`4`)/TBD)*100 AS ch,((`5`+`6`)/TBD)*100 AS gen FROM tmp_produccion;");

		if ($query_data_prod->num_rows()>0) {
			foreach ($query_data_prod->result_array() as $key) {
				$ecoP[] = intval(number_format($key['ep'],0));
				$cho[] = intval(number_format($key['ch'],0));
				$gen[] = intval(number_format($key['gen'],0));
			}
			$data1[] = array(
	        	'Tipo' => 'ECO PLUS',
	        	'Data' => $ecoP
	        );
	        $data2[] = array(
	        	'Tipo' => 'CHOLIN',
	        	'Data' => $cho
	        );
	        $data3[] = array(
	        	'Tipo' => 'GENERICO',
	        	'Data' => $gen
	        );	        
	        $json = array_merge($data1,$data2,$data3);
	        
	        echo json_encode($json);
	        return $json;			
		}else {
			return false;
		}
	}

public function generandoDataRpt($meta) {	
		//DECLARANDO VARIABLES Y CONTADORES
		$dataRpt=array();
		$desde=''; $hasta='';
		$primerDia=""; $ultDia="";
		$j=0; $ii=0; $band=false; $cont=0;

		//QUERYS PARA LA DATA
		$query_sp_prod=$this->db->query("CALL sp_produccionDiaria('".$meta."')");
		$query_rpt_pro=$this->db->query("CALL sp_controlProduccionMensual('".$meta."')");
		$this->db->reconnect();
		
		$this->db->order_by("fecha", "ASC");
		$query_tmp=$this->db->get('tmp_produccion');

		//OBTENIENDO PRIMER Y ULTIMO DIA DEL MES
		$primerDia = new DateTime($query_tmp->result_array()[0]['fecha']);
		$primerDia->modify('first day of this month');

		$ultDia = new DateTime($query_tmp->result_array()[0]['fecha']);
		$ultDia->modify('last day of this month');
		
		$cc=count($query_tmp->result_array());

		foreach ($query_tmp->result_array() as $fh) {
			$fechas[] = $fh['fecha'];
		}

		for($i=$primerDia->format('Y-m-d'); $i<=$ultDia->format('Y-m-d'); $i=date("Y-m-d", strtotime($i ."+ 1 days"))) {
			if (count($fechas)>0) {
				if ($i===end($fechas)) {				
					$query1 = $this->db->query("SELECT * FROM tmp_produccion WHERE fecha BETWEEN '".$desde."' AND '".$i."' order by fecha asc;");

					foreach ($query1->result_array() as $k) {
						$dataRpt[$j]['v1'] = date('d/m/Y', strtotime($k['fecha']));
						$dataRpt[$j]['v2'] = $k['1'];
						$dataRpt[$j]['v3'] = $k['2'];
						$dataRpt[$j]['v4'] = $k['3'];
						$dataRpt[$j]['v5'] = $k['4'];
						$dataRpt[$j]['v6'] = $k['5'];
						$dataRpt[$j]['v7'] = $k['6'];
						$dataRpt[$j]['v8'] = $k['7'];
						$dataRpt[$j]['v9'] = $k['8'];
						$dataRpt[$j]['v10'] = $k['9'];
						$dataRpt[$j]['v11'] = $k['10'];
						$dataRpt[$j]['v12'] = $k['TBD'];
						$dataRpt[$j]['v13'] = $k['TNS'];
						$j++;
					}

					$dataRpt[$j]['v1'] = 'Total semana';
					$dataRpt[$j]['v2'] = $query_rpt_pro->result_array()[$ii]['v1'];
					$dataRpt[$j]['v3'] = $query_rpt_pro->result_array()[$ii]['v2'];
					$dataRpt[$j]['v4'] = $query_rpt_pro->result_array()[$ii]['v3'];
					$dataRpt[$j]['v5'] = $query_rpt_pro->result_array()[$ii]['v4'];
					$dataRpt[$j]['v6'] = $query_rpt_pro->result_array()[$ii]['v5'];
					$dataRpt[$j]['v7'] = $query_rpt_pro->result_array()[$ii]['v6'];
					$dataRpt[$j]['v8'] = $query_rpt_pro->result_array()[$ii]['v7'];
					$dataRpt[$j]['v9'] = $query_rpt_pro->result_array()[$ii]['v8'];
					$dataRpt[$j]['v10'] = $query_rpt_pro->result_array()[$ii]['v9'];
					$dataRpt[$j]['v11'] = $query_rpt_pro->result_array()[$ii]['v10'];
					$dataRpt[$j]['v12'] = '';
					$dataRpt[$j]['v13'] = '';
					$j++;

					$dataRpt[$j]['v1'] = 'Promedio';
					$dataRpt[$j]['v2'] = $query_rpt_pro->result_array()[$ii]['v1']/count($query1->result_array());
					$dataRpt[$j]['v3'] = $query_rpt_pro->result_array()[$ii]['v2']/count($query1->result_array());
					$dataRpt[$j]['v4'] = $query_rpt_pro->result_array()[$ii]['v3']/count($query1->result_array());
					$dataRpt[$j]['v5'] = $query_rpt_pro->result_array()[$ii]['v4']/count($query1->result_array());
					$dataRpt[$j]['v6'] = $query_rpt_pro->result_array()[$ii]['v5']/count($query1->result_array());
					$dataRpt[$j]['v7'] = $query_rpt_pro->result_array()[$ii]['v6']/count($query1->result_array());
					$dataRpt[$j]['v8'] = $query_rpt_pro->result_array()[$ii]['v7']/count($query1->result_array());
					$dataRpt[$j]['v9'] = $query_rpt_pro->result_array()[$ii]['v8']/count($query1->result_array());
					$dataRpt[$j]['v10'] = $query_rpt_pro->result_array()[$ii]['v9']/count($query1->result_array());
					$dataRpt[$j]['v11'] = $query_rpt_pro->result_array()[$ii]['v10']/count($query1->result_array());
					$dataRpt[$j]['v12'] = '';
					$dataRpt[$j]['v13'] = '';
					$j++;
				}else {
					if (date('w', strtotime($i))==1 ) {					
						if (in_array($i, $fechas)) {						
							$hasta = date("Y-m-d", strtotime($i ."- 1 days"));
							$query1 = $this->db->query("SELECT * FROM tmp_produccion WHERE fecha BETWEEN '".$desde."' AND '".$hasta."' order by fecha asc;");
							
							$desde=$i;				

							foreach ($query1->result_array() as $k) {
								$dataRpt[$j]['v1'] = date('d/m/Y', strtotime($k['fecha']));
								$dataRpt[$j]['v2'] = $k['1'];
								$dataRpt[$j]['v3'] = $k['2'];
								$dataRpt[$j]['v4'] = $k['3'];
								$dataRpt[$j]['v5'] = $k['4'];
								$dataRpt[$j]['v6'] = $k['5'];
								$dataRpt[$j]['v7'] = $k['6'];
								$dataRpt[$j]['v8'] = $k['7'];
								$dataRpt[$j]['v9'] = $k['8'];
								$dataRpt[$j]['v10'] = $k['9'];
								$dataRpt[$j]['v11'] = $k['10'];
								$dataRpt[$j]['v12'] = $k['TBD'];
								$dataRpt[$j]['v13'] = $k['TNS'];
								$j++;
							}

							$dataRpt[$j]['v1'] = 'Total semana';
							$dataRpt[$j]['v2'] = $query_rpt_pro->result_array()[$ii]['v1'];
							$dataRpt[$j]['v3'] = $query_rpt_pro->result_array()[$ii]['v2'];
							$dataRpt[$j]['v4'] = $query_rpt_pro->result_array()[$ii]['v3'];
							$dataRpt[$j]['v5'] = $query_rpt_pro->result_array()[$ii]['v4'];
							$dataRpt[$j]['v6'] = $query_rpt_pro->result_array()[$ii]['v5'];
							$dataRpt[$j]['v7'] = $query_rpt_pro->result_array()[$ii]['v6'];
							$dataRpt[$j]['v8'] = $query_rpt_pro->result_array()[$ii]['v7'];
							$dataRpt[$j]['v9'] = $query_rpt_pro->result_array()[$ii]['v8'];
							$dataRpt[$j]['v10'] = $query_rpt_pro->result_array()[$ii]['v9'];
							$dataRpt[$j]['v11'] = $query_rpt_pro->result_array()[$ii]['v10'];
							$dataRpt[$j]['v12'] = '';
							$dataRpt[$j]['v13'] = '';
							$j++;

							$dataRpt[$j]['v1'] = 'Promedio';
							$dataRpt[$j]['v2'] = $query_rpt_pro->result_array()[$ii]['v1']/count($query1->result_array());
							$dataRpt[$j]['v3'] = $query_rpt_pro->result_array()[$ii]['v2']/count($query1->result_array());
							$dataRpt[$j]['v4'] = $query_rpt_pro->result_array()[$ii]['v3']/count($query1->result_array());
							$dataRpt[$j]['v5'] = $query_rpt_pro->result_array()[$ii]['v4']/count($query1->result_array());
							$dataRpt[$j]['v6'] = $query_rpt_pro->result_array()[$ii]['v5']/count($query1->result_array());
							$dataRpt[$j]['v7'] = $query_rpt_pro->result_array()[$ii]['v6']/count($query1->result_array());
							$dataRpt[$j]['v8'] = $query_rpt_pro->result_array()[$ii]['v7']/count($query1->result_array());
							$dataRpt[$j]['v9'] = $query_rpt_pro->result_array()[$ii]['v8']/count($query1->result_array());
							$dataRpt[$j]['v10'] = $query_rpt_pro->result_array()[$ii]['v9']/count($query1->result_array());
							$dataRpt[$j]['v11'] = $query_rpt_pro->result_array()[$ii]['v10']/count($query1->result_array());
							$dataRpt[$j]['v12'] = '';
							$dataRpt[$j]['v13'] = '';
							$j++; $ii++;						
							
						}else {
							$band=false;
							while ($band == false) {
								$temp = date("Y-m-d", strtotime($i ."+ 1 days"));
								if (in_array($temp, $fechas) || $cont>=$cc) {
									$hasta = date("Y-m-d", strtotime($temp ."- 1 days"));
									$query1 = $this->db->query("SELECT * FROM tmp_produccion WHERE fecha BETWEEN '".$desde."' AND '".$hasta."' order by fecha asc;");
									if ($query1->num_rows()>0) {
										foreach ($query1->result_array() as $k) {
											$dataRpt[$j]['v1'] = date('d/m/Y', strtotime($k['fecha']));
											$dataRpt[$j]['v2'] = $k['1'];
											$dataRpt[$j]['v3'] = $k['2'];
											$dataRpt[$j]['v4'] = $k['3'];
											$dataRpt[$j]['v5'] = $k['4'];
											$dataRpt[$j]['v6'] = $k['5'];
											$dataRpt[$j]['v7'] = $k['6'];
											$dataRpt[$j]['v8'] = $k['7'];
											$dataRpt[$j]['v9'] = $k['8'];
											$dataRpt[$j]['v10'] = $k['9'];
											$dataRpt[$j]['v11'] = $k['10'];
											$dataRpt[$j]['v12'] = $k['TBD'];
											$dataRpt[$j]['v13'] = $k['TNS'];
											$j++;
										}

										$dataRpt[$j]['v1'] = 'Total semana';
										$dataRpt[$j]['v2'] = $query_rpt_pro->result_array()[$ii]['v1'];
										$dataRpt[$j]['v3'] = $query_rpt_pro->result_array()[$ii]['v2'];
										$dataRpt[$j]['v4'] = $query_rpt_pro->result_array()[$ii]['v3'];
										$dataRpt[$j]['v5'] = $query_rpt_pro->result_array()[$ii]['v4'];
										$dataRpt[$j]['v6'] = $query_rpt_pro->result_array()[$ii]['v5'];
										$dataRpt[$j]['v7'] = $query_rpt_pro->result_array()[$ii]['v6'];
										$dataRpt[$j]['v8'] = $query_rpt_pro->result_array()[$ii]['v7'];
										$dataRpt[$j]['v9'] = $query_rpt_pro->result_array()[$ii]['v8'];
										$dataRpt[$j]['v10'] = $query_rpt_pro->result_array()[$ii]['v9'];
										$dataRpt[$j]['v11'] = $query_rpt_pro->result_array()[$ii]['v10'];
										$dataRpt[$j]['v12'] = '';
										$dataRpt[$j]['v13'] = '';
										$j++;

										$dataRpt[$j]['v1'] = 'Promedio';
										$dataRpt[$j]['v2'] = $query_rpt_pro->result_array()[$ii]['v1']/count($query1->result_array());
										$dataRpt[$j]['v3'] = $query_rpt_pro->result_array()[$ii]['v2']/count($query1->result_array());
										$dataRpt[$j]['v4'] = $query_rpt_pro->result_array()[$ii]['v3']/count($query1->result_array());
										$dataRpt[$j]['v5'] = $query_rpt_pro->result_array()[$ii]['v4']/count($query1->result_array());
										$dataRpt[$j]['v6'] = $query_rpt_pro->result_array()[$ii]['v5']/count($query1->result_array());
										$dataRpt[$j]['v7'] = $query_rpt_pro->result_array()[$ii]['v6']/count($query1->result_array());
										$dataRpt[$j]['v8'] = $query_rpt_pro->result_array()[$ii]['v7']/count($query1->result_array());
										$dataRpt[$j]['v9'] = $query_rpt_pro->result_array()[$ii]['v8']/count($query1->result_array());
										$dataRpt[$j]['v10'] = $query_rpt_pro->result_array()[$ii]['v9']/count($query1->result_array());
										$dataRpt[$j]['v11'] = $query_rpt_pro->result_array()[$ii]['v10']/count($query1->result_array());
										$dataRpt[$j]['v12'] = '';
										$dataRpt[$j]['v13'] = '';
										$j++; $ii++;								
									}								
									$desde=$i;
									$band=true;
								}else {
									$cont++;
								}
							}
						}				
					} else {}
				}
			}
		}
		return $dataRpt;
	}
}
?>