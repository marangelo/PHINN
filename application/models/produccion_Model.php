<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Produccion_Model extends CI_Model
{
     function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

   public function buscarRtpDiario($idRtpD) {
        $this->db->where('IdReporteDiario =',$idRtpD);
        $query=$this->db->get('reporte_diario');
        if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function Operario()
    {
          $query = $this->db->where('Privilegio',5);
        $query = $this->db->where("Estado",1);
        $query = $this->db->get('usuarios');
        if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function Guardar($IdRepD, $noOrden, $Oper,$Maq, $HoraIn, $HoraFin, $Velocidad,$peso, $Diam, $pesobase,$Merma)
    {
         
        $data = array(
            "IdReporteDiario" => $IdRepD,
            "NoOrden" => $noOrden,
            "Operador" => $Oper,
            "Maquina" => $Maq,
            "HoraInicio" => $HoraIn,
            "HoraFin" => $HoraFin,
            "VelocMaquina" => $Velocidad,
            "Peso" => $peso,
            "Diametro" => $Diam,
            "PesoBase" => $pesobase,
            "Merma" => $Merma
        );
        $consulta = $this->db->insert("produccion",$data);
        $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'AGREGO INFORMACION DE PRODUCCION DEL RPT DIARIO CON ID '.$IdRepD);
        if($consulta){
            $this->actualizarProduccionTotal($IdRepD);
        }
    }

    public function actualizarProduccionTotal($IdRepD){
        $consulta = $this->db->query("SELECT SUM(Peso) AS TOTAL FROM produccion WHERE IdReporteDiario = '".$IdRepD."' GROUP BY IdReporteDiario");
        $total = $consulta->result_array()[0]['TOTAL'];

        $datos = array('ProduccionTotal' => $total);
        $this->db->where('IdReporteDiario',$IdRepD);
        $this->db->update('reporte_diario',$datos);
        $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'ACTUALIZO INFORMACION DE PRODUCCION DEL RPT DIARIO CON ID '.$IdRepD);
    }

    public function ListarProd($IdReporteDiario)
    {
        $this->db->where("IdReporteDiario =",$IdReporteDiario);
        $query = $this->db->get("view_produccion");
        if ($query->num_rows()>0) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function ListarProd2($IdReporteDiario)
    {
        $this->db->distinct();
        $this->db->select('Merma,Maquina');
        $this->db->where("Maquina", 1);
        $this->db->where('IdReporteDiario',$IdReporteDiario);
        $query = $this->db->get('produccion');
       if ($query->num_rows()>0) {
            return $query->result_array();
        }else{
            return false;
        }
    }

       public function ListarProd3($IdReporteDiario)
    {
        $this->db->distinct();
        $this->db->select('Merma,Maquina');
        $this->db->where("Maquina", 2);
        $this->db->where('IdReporteDiario',$IdReporteDiario);
        $query = $this->db->get('produccion');
       if ($query->num_rows()>0) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function EliminarProd($idProd,$IdRptD)
    {
        $this->db->where('IdProduccion',$idProd);
        $this->db->where('IdReporteDiario',$IdRptD);
        $query=$this->db->delete("produccion");
        if ($query==1) {
            $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'ELIMINO UN REGISTRO DE PRODUCCION DEL RPT CON ID '.$IdRptD);
        }
    }

    public function ActualizarMerma($IdReporteDiario , $Merma , $Maq)
    {
        $data = array('Merma' => $Merma );
        $this->db->where('IdReporteDiario=',$IdReporteDiario);
        $this->db->where('Maquina=',$Maq);
        $query=$this->db->update('produccion',$data);
        if ($query==1) {
            $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'ACTUALIZO EL REGISTRO DE LA MERMA DEL RPT CON ID '.$IdReporteDiario.' DE LA MAQUINA '.$Maq);
        }
        
    }
}
?>