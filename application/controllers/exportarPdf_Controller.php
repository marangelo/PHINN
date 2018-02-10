<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class exportarPdf_Controller extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->library('MPDF/mpdf');
        $this->load->library('session');
        $user = $this->session->userdata('logged');
        if (!isset($user)) {
            redirect(base_url().'index.php','refresh');
        }
	}
	public function index($idReporteDiario) {
        $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'GENERO UN REPORTE DEL REPORTE DIARIO CON ID '.$idReporteDiario);
        $data['tiemposM'] = $this->listandoTiempoMuerto($idReporteDiario);
        $data['cargaTotal'] = $this->listandoCargaTotalPulper($idReporteDiario);
        $data['horasMolienda'] = $this->listandoHorasMolienda($idReporteDiario);
        $data['cargasPulper'] = $this->cargasPulper_Model->listarCargasP($idReporteDiario);
        $query = $this->produccion_Model->ListarProd($idReporteDiario);
        $data['mermaTotal'] = $this->calculandoMermaTotal($query);
        $data['produccion'] = $query;
        $data['consecutivo'] = $this->Ordenproduccion_model->buscarRtpDiario($idReporteDiario);
		$data['pasta'] = $this->MateriaPrima_model->ListarPM($idReporteDiario);
        $data['insumos'] = $this->MateriaPrima_model->ListarPMInsumos($idReporteDiario);
        $data['totalHrsM'] = date('H:i', strtotime($this->calcularCantHoras($idReporteDiario)));
        $data['cabeceraRpt'] = $this->reporteDiario_Model->caberaReporte($idReporteDiario);
        
        $PdfCliente = new mPDF('utf-8','A4');
        $PdfCliente->SetFooter("Página {PAGENO} de {nb}");
        $PdfCliente -> writeHTML($this->load->view('Reportes/reporteOrdTrabDiario',$data,true));
        $PdfCliente->Output();
        $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'GENERO UN REPORTE DEL RPT CON ID '.$idReporteDiario);
	}
    /*LISTANDO REPORTES*/
    public function calculandoMermaTotal($array) {
        $mermaMq1=0;$mermaMq2=0;
        foreach ($array as $key) {
            if ($key['Maquina'] == 'Maquina 1') {
                $mermaMq1=$key['Merma'];
            }else if ($key['Maquina'] == 'Maquina 2') {
                $mermaMq2=$key['Merma'];
            }       
        }
        return $mermaMq1+$mermaMq2;
    }

    public function listandoTiempoMuerto($idReporteDiario) {
        $list = $this->tiemposMuertos_Model->listarTM($idReporteDiario);
        $array = array();
        $i=0;
        if ($list!=false) {
            foreach($list as $row){
            $horaInicio = date('g:i A', strtotime($row['HoraInicio']));
            $horaFinal = date('g:i A', strtotime($row['HoraFin']));
            $horaMD = new DateTime('00:00:00');
            $datetime1 = new DateTime($row['HoraInicio']);
            $datetime2 = new DateTime($row['HoraFin']);

            if ($datetime2<$datetime1) {
                $time1 = $horaMD->diff($datetime2);
                $time2 = $horaMD->diff($datetime2);
                $tf=$this->sumaRestaHoras($horaFinal,$horaInicio);
                
            }else {
                $interval = $datetime1->diff($datetime2);
                $tf = $interval->format("%H:%I");
            }       

            $array[$i]['IdTiempoMuerto'] = $row['IdTiempoMuerto'];
            $array[$i]['IdReporteDiario'] = $row['IdReporteDiario'];
            $array[$i]['NoOrden'] = $row['NoOrden'];
            $array[$i]['HoraInicio'] = $horaInicio;
            $array[$i]['Turno'] = $row['Turno'];
            $array[$i]['HoraFin'] = $horaFinal;
            $array[$i]['Intervalos'] = $tf;
            $array[$i]['Maquina'] = $row['Maquina'];
            $array[$i]['Descripcion'] = $row['Descripcion'];
            $i++;
            }           
        }
        return $array;
    }
    public function listandoCargaTotalPulper($idReporteDiario) {
        $query = $this->cargasPulper_Model->calcularTotalCarga($idReporteDiario);        
            foreach ($query as $key) {
                $cargaTotal = $key['sumTotal'];
            }
        return $cargaTotal;
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

    public function listandoHorasMolienda($idReporteDiario) {
        $horasM=array();
        $query1=$this->cargasPulper_Model->listarHorasMolienda($idReporteDiario);
        if ($query1!=FALSE) {
            foreach ($query1 as $key) {
                $horaInicio = date('g:i A', strtotime($key['horaInicio']));
                $horaFinal = date('g:i A', strtotime($key['horaFin']));
                $tf=$this->sumaRestaHoras($horaFinal,$horaInicio);
                $dta = array(
                    'horaInicio' => $horaInicio,
                    'horaFin' => $horaFinal,
                    'tiempo' => $tf,   
                );
                $horasM[] =$dta;
            }
        }
        return $horasM;
    }

	public function cambiaEstadoRptD($idRptDiario, $estado) {
        $query=$this->reporteDiario_Model->cambiarEstadoReporteD($idRptDiario, $estado);
    }

    public function eliminarRegRptDiario($idReporteDiario) {
    	$this->reporteDiario_Model->eliminarRptDiario($idReporteDiario);
    }

    public function sumaRestaHoras($horainicio, $horafin){
        $dif=date("H:i:s", strtotime("00:00:00") + strtotime($horainicio) - strtotime($horafin) );
        return $dif;
    }

    public function reporteControlPiso($consecutivo) {
        $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'GENERO UN REPORTE DE CONTROL PISO DEL CONSECUTIVO '.$consecutivo);
        $data['controPisoDetalle'] = $this->reporteDiario_Model->reporteControlPiso($consecutivo);
        $result = $this->controlPiso_Model->validandoInfoPasta($consecutivo);
        if ($result==1) {
            $data['pastaDetalle'] = $this->controlPiso_Model->mostrarDetallePasta($consecutivo);
        }
        $PdfCliente = new mPDF('utf-8','A4');        
        $PdfCliente->SetFooter("Página {PAGENO} de {nb}");
        $PdfCliente -> writeHTML($this->load->view('Reportes/reporteControlPiso', $data, true));
        $PdfCliente->Output();
    }

    public function rptConsolidadoFinal($consecutivo) {
        echo $consecutivo;
        //$this->Users_model->InsertLog($this->session->userdata['IdUser'], 'GENERO UN REPORTE DE CONSOLIDADO DEL CONSECUTIVO '.$consecutivo);
        $data['consolidadoFinal'] = $this->reporteDiario_Model->reporteConsoliadoFinal($consecutivo);
        $data['materiaPrima'] = $this->controlPiso_Model->detalleControlPiso($consecutivo);
        $data['consumoElectrico'] = $this->controlPiso_Model->consumoElectrico($consecutivo);
        //$this->load->view('Reportes/reporteConsolidado', $data);
        //print_r($data['consolidadoFinal']);
        
        $PdfCliente = new mPDF('utf-8','A4');        
        $PdfCliente->SetFooter("Página {PAGENO} de {nb}");
        $PdfCliente -> writeHTML($this->load->view('Reportes/reporteConsolidado', $data, true));
        $PdfCliente->Output();
    }
    
    public function reporteProdMensual($meta) {
        $data['dataRpt'] = $this->produccionDiaria_Model->generandoDataRpt($meta);
        $data['metas'] = $this->produccionDiaria_Model->soloMetas($meta);
        $data['pesos'] = $this->produccionDiaria_Model->soloPesos();
        $data['fecha'] = $this->produccionDiaria_Model->soloFecha($meta);
        $_data['porCump'] = $this->produccionDiaria_Model->porcentajeCumplimiento($meta);

        $data['grafica'] = $this->load->view('superAdmin/graficaRpt',$_data, true);

        //$this->load->view('Reportes/reporteProduccionMensual', $data);
                 
        $PdfCliente = new mPDF('utf-8','A4'); 
        $PdfCliente->AddPage('L'); 
        $PdfCliente->SetFooter("Página {PAGENO} de {nb}");
        $PdfCliente -> writeHTML($this->load->view('Reportes/reporteProduccionMensual', $data, true));        
        $PdfCliente->Output();
    }
}
?>