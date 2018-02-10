<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Maquinas_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function ListarMaq()
    {
        $query = $this->db->get('maquinas');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
        
    }

    public function GuardarMaq($maq,$comentario)
    {
        $data = array(
            'maquina' => $maq,
            'comentario' => $comentario
        );
        $duplicado = $this->db->get_where('maquinas',array('maquina' => $maq));
        if($duplicado->num_rows()>0)
        {
            echo "Ya existe un registro";
        }else{
            $this->db->insert('maquinas',$data);
            $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'AGREGO MAQUINA '.strtoupper($maq));
        }
        
    }

    public function EliminarMaq($ID, $desc)
    {
        $this->db->where('idMaquina',$ID);
        $query=$this->db->delete('maquinas');
        if ($query==1) {
            $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'ELIMINO MAQUINA '.strtoupper($desc));
        }

    }
}
?>