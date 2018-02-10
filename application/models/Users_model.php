<?php
    class Users_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        public function login($name, $pass){            
            if($name != FALSE && $pass != FALSE){
                $this->db->where('Usuario', $name);
                $this->db->where('Password', MD5($pass));
                $this->db->where('Estado', 1);
                $query = $this->db->get('Usuarios');

                if($query->num_rows() == 1){
                    return $query->result_array();
                }
                return 0;
            }
        }

        public function actulizandoPassword($data) {
            for ($i=0; $i < count($data) ; $i++) {
                $index1 = explode(",",$data[$i]);
                $result = $this->db->query("call updatePasswordUser(".$index1[0].",'".MD5($index1[1])."','".MD5($index1[2])."')");
            }
            echo json_encode((int)$result->result_array()[0]['resultado']);
        }

        public function Guardar($user,$name,$pass,$rol,$estado){
        if($rol != "5")
        {
            $data = array(
                'Usuario' => $user,
                'Nombre' => $name,
                'Password' => md5($pass),
                'Privilegio' => $rol,
                'Estado' => $estado
            );
        }
            else{
                $data = array(
                    'Usuario' => $user,
                    'Nombre' => $name,
                    'Privilegio' => $rol,
                    'Estado' => $estado
                );
            }
            $this->db->insert('usuarios', $data);
            $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'GUARDO USUARIO '.strtoupper($user).' CON ROL '.strtoupper($rol));
        }

        public function del($id, $estado){
            $this->db->where('IdUsuario', $id);
            $data = array('Estado' => $estado);
            $this->db->update('usuarios', $data);
            $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'CAMBIO ESTADO DE USUARIO '.strtoupper($id));
        }

   
        public function allUser(){
            $query = $this->db->order_by("IdUsuario","asc");
            $query = $this->db->get('usuarios');
            
            if($query->num_rows() <> 0){            
                return $query->result_array();
            }
            return 0;
        }

        public function InsertLog($usuario, $accion){
            $datos = array('IdUser' => $usuario, 
                    'Accion' => $accion,
                    'Fecha' => date('Y-m-d H:i:s')
                    );
            $this->db->insert('log',$datos);
        }

    }