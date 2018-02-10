<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class tanques_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function ListarTanque()
        {
            $this->db->order_by('Tanque','ASC');
            $query = $this->db->get('tanques');
            if ($query->num_rows()>0) {
                return $query->result_array();
            } else {
                return false;
            }
            
        }

    public function Guardartanque($tanque)
    {
        $data = array("Tanque" => $tanque);
        $duplicado = $this->db->get_where('tanques',array('Tanque' => $tanque));
        if($duplicado->num_rows()>0){
            echo "Ya existe un registro";
        }else{
           $this->db->insert('tanques',$data);
           $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'GUARDO '.strtoupper($tanque));
        }
    }

    public function Eliminar($id, $desc)
    {
        $this->db->where('IdTanque',$id);
        $query=$this->db->delete('tanques');
        if ($query==1) {
            $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'ELIMINO '.strtoupper($desc));
        }

    }
}
?>