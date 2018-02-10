<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class detalleplanes_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    
    public function BuscarIdPlan($id)
    {
        $this->db->where('IdPlan= ',$id);
        $query = $this->db->get("planes");
        if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
         return false;
        }
    }

    public function ListarInsumos()
    {
        $this->db->where("IdCategoria=",2);
        $query = $this->db->get("insumos");
         if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
         return false;
        }
    }

    public function ListarInsumos2()
    {
        $this->db->where("IdCategoria=",1);
        $query = $this->db->get("insumos");
         if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
         return false;
        }
    }

    public function ListarInsumos3()
    {
        $this->db->where("IdCategoria=",3);
        $query = $this->db->get("insumos");
         if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
         return false;
        }
    }

    public function ListarTanques()
    {
        $query = $this->db->get("tanques");
         if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
         return false;
        }
    }   

    public function ListarCat()
    {
      $query = $this->db->get("categoria");
         if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
         return false;
        }
    }
        

    public function ArrayGuardaDet($insumos1,$insumos2,$insumos3,$tanques)
    {
        
        for ($i=0; $i < count($insumos1) ; $i++) { 
            $array1 = explode(",",$insumos1[$i]);
            $InsertInsumo1 = array(
                'IdPlan'         => $array1[0],
                'Categoria'       => $array1[1],
                'IdInsumo'     => $array1[2]
            );
            $query = $this->db->get_where('detalle_planes', $InsertInsumo1);
            if($query->num_rows()>0){
               echo "existe";
            }
            else{
                 $this->db->insert('detalle_planes', $InsertInsumo1);
                 $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'INSERTO INFORMACION DE CATEGORIA '.$InsertInsumo1['Categoria'].' EN PLAN '.$InsertInsumo1['IdPlan']);
                echo "NO EXISTE";
            }
        }
           for ($i=0; $i < count($insumos2) ; $i++) { 
            $array2 = explode(",",$insumos2[$i]);
            $InsertInsumo2 = array(
                'IdPlan'         => $array2[0],
                'Categoria'       => $array2[1],
                'IdInsumo'     => $array2[2]
            );
            $query = $this->db->get_where('detalle_planes', $InsertInsumo2);
            if($query->num_rows()>0){
               echo "existe";
            }
            else{
                 $this->db->insert('detalle_planes', $InsertInsumo2);
                 $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'INSERTO INFORMACION DE CATEGORIA '.$InsertInsumo2['Categoria'].' EN PLAN '.$InsertInsumo2['IdPlan']);
                echo "NO EXISTE";
            } 
        }
          for ($i=0; $i < count($insumos3) ; $i++) { 
             $array3 = explode(",",$insumos3[$i]);
            $InsertInsumo3 = array(
                'IdPlan'         => $array3[0],
                'Categoria'       => $array3[1],
                'IdInsumo'     => $array3[2]
            );
             $query = $this->db->get_where('detalle_planes', $InsertInsumo3);
            if($query->num_rows()>0){
               echo "existe";
            }
            else{
                  $this->db->insert('detalle_planes', $InsertInsumo3);
                  $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'INSERTO INFORMACION DE CATEGORIA '.$InsertInsumo3['Categoria'].' EN PLAN '.$InsertInsumo3['IdPlan']);
                echo "NO EXISTE";
            }    
        }
        for ($i=0; $i < count($tanques) ; $i++) {
             $array4 = explode(",",$tanques[$i]);
            $InsertTanque = array(
                'IdPlan'         => $array4[0],
                'Categoria'       => $array4[1],
                'IdInsumo'     => $array4[2]
            );
              $query = $this->db->get_where('detalle_planes', $InsertTanque);
            if($query->num_rows()>0){
               echo "existe";
            }
            else{
                  $this->db->insert('detalle_planes', $InsertTanque);
                  $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'INSERTO INFORMACION DE CATEGORIA '.$InsertTanque['Categoria'].' EN PLAN '.$InsertTanque['IdPlan']);
                echo "NO EXISTE";
            } 
        }
    }    

    public function ListarCat1($id)
    {
        $this->db->where('IdPlan=',$id);
        $query = $this->db->get('view_detallesplanescat1');
        if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
            return false;
        }
        
    }   

     public function ListarCat2($id)
    {
         $this->db->where('IdPlan=',$id);
        $query = $this->db->get('view_detallesplanescat2');
        if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
            return false;
        }
        
    }   

       public function ListarCat3($id)
    {
         $this->db->where('IdPlan=',$id);
        $query = $this->db->get('view_detallesplanescat3');
        if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
            return false;
        }
        
    }   

     public function ListarCat4($id)
    {
         $this->db->where('IdPlan=',$id);
        $query = $this->db->get('view_detallesplanescat4');
        if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
            return false;
        }
        
    }   

    public function EliminarDet($array)
    {
        $this->db->where("IdDetallePlan",$array['idDetalle']);
        $query=$this->db->delete('detalle_planes');
        if ($query==1) {
            $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'ELIMINO EL REGISTRO '.strtoupper($array['descripcion']).' DEL PLAN '.$array['idPlan']);
        }
    }

    public function listarTurnos() {
        $query = $this->db->get("turnos");
        if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function buscarTurnoById($idTurno) {
        $this->db->where('IdTurno', $idTurno);
        $query = $this->db->get('turnos');
        if ($query->num_rows()>0) {
            echo json_encode($query->result_array());
        }else {
            echo '0';
        }
    }

    public function actualizandoRegistroTurno($data,$idTurno) {
        $this->db->where('IdTurno', $idTurno);
        $query = $this->db->update('turnos', $data);
        if ($query) {
            $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'ACTUALIZO EL TURNO CON ID '.$idTurno);
            echo json_encode($query);
        }
    }

    public function guardandoNuevoTurno($data) {
        $result = $this->db->insert('turnos', $data);
        if ($result==1) {
            $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'AGREGO EL NUEVO TURNO '.$data['Comentario']);
            echo json_encode($result);
        }else {
            echo json_encode("0");
        }        
    }

    public function elimandoRegistroTurno($idTurno, $estado) {
        $array = array(
            'estado' => $estado
        );
        $this->db->where('IdTurno', $idTurno);
        $query = $this->db->update('turnos', $array);
        if ($query==1) {
            $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'ELIMINO EL REGISTRO DE TURNO ID '.$idTurno);
            echo json_encode($query);
        }
    }

    public function restaurandoRegistroTurno($idTurno, $estado)
    {
        $array = array(
            'estado' => $estado
        );
        $this->db->where('IdTurno', $idTurno);
        $query = $this->db->update('turnos', $array);
        if ($query==1) {
            $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'RESTAURO EL REGISTRO DE TURNO ID '.$idTurno);
            echo json_encode($query);
        }
    }
}
?>