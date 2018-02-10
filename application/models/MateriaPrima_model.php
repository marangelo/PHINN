<?php
class MateriaPrima_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function GuardaMP($Id,$tanque,$dia,$noche,$consumo)
    {
        $datos = array(
            "IdReporteDiario" => $Id,
            "Tanque" => $tanque,
            "Dia" => $dia,
            "Noche" => $noche,
            "Consumo" => $consumo
        );
        $query=$this->db->insert('pasta',$datos);
        if ($query) {
            $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'AGREGO UN REGISTRO DE PASTA DEL TANQUE CON ID '.$tanque.' AL RPT CON ID '.$Id);
        }
    }

    public function ListarPM($IdRept)
    {
        $this->db->where("IdReporteDiario =",$IdRept);
        $query = $this->db->get('view_pasta');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
            return false;        
    }
        public function ValidaPasta($tanque,$ID)
    {
        $valor = false;
        $this->db->where("Tanque",$tanque);
        $this->db->where('IdReporteDiario',$ID);
        $query = $this->db->get('pasta');
        if ($query->num_rows()>0) {
            $valor = true;
        }
        
        echo $valor;
    }

    public function ListarInsumos()
    {
        $query = $this->db->get('view_detallesplanescat2');
        if ($query->num_rows()>0) {
            return $query->result_array();
        } 
            return false;        
    }

    public function GuardarMPInsumos($idrptd,$desc,$Dia,$Noche,$ptadia,$ptanoche)
    {
        $datos = array(
            "IdReporteDiario" => $idrptd,
            "Descripcion" => $desc,
            "Dia" => $Dia,
            "Noche" => $Noche,
            "Cantidad_PTA_Agua_Dia" => $ptadia,
            "Cantidad_PTA_Agua_Noche" => $ptanoche
        );
        $query=$this->db->insert('mp_insumos',$datos);
        if ($query) {
            $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'AGREGO UN REGISTRO DE INSUMO AL RPT CON ID '.$idrptd);
        }
    }

    public function ListarPMInsumos($IdRept)
    {
            $this->db->where("IdReporteDiario =",$IdRept);
        $query = $this->db->get('view_mp_insumos');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
            return false;
    }

    public function ValidaMPInsumo($ID,$des)
    {
        $valor = false;
        $this->db->where('IdReporteDiario',$ID);
        $this->db->where("Descripcion",$des);
        $query = $this->db->get('mp_insumos');
        if ($query->num_rows()>0) {
            $valor = true;
        }
        echo $valor;
    }
     public function EliminaPasta($id,$IdRept)
    {
        $this->db->where("IdPasta",$id);
        $this->db->where("IdReporteDiario",$IdRept);
        $query=$this->db->delete('pasta');
        if ($query) {
            $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'ELIMINO UN REGISTRO DE PASTA DEL RPT CON ID '.$IdRept);
        }
    }

    public function EliminaPMInsumo($id,$IdRept)
    {
        $this->db->where("IdMpInsumos",$id);
        $this->db->where("IdReporteDiario",$IdRept);
        $query=$this->db->delete('mp_insumos');
        if ($query) {
            $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'ELIMINO UN REGISTRO DE INSUMO DEL RPT CON ID '.$IdRept);
        }
    }

            public function ListarTanque()
        {
            $query = $this->db->get('view_detallesplanescat4');
            if ($query->num_rows()>0) {
                return $query->result_array();
            }
                return false;
            
        }
}
?>