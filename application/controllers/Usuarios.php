<?php
	class Usuarios extends CI_Controller{	
		public function __construct(){
			parent::__construct();
			$this->load->library('session');
			$user = $this->session->userdata('logged');
			
			if (!isset($user)) { 
				redirect(base_url().'index.php','refresh');
			} 
		}

		public function WHead(){
			$this->load->view('header');
			$this->load->view('dashboardclean');
		}

		public function index(){
			$this->WHead();
			$data['TBUS']=$this->Users_model->allUser();
			$this->load->view('Usuario/users', $data);
			$this->load->view('footer');
		}
		
		public function Eliminar($ID, $status){
			if($status == 1)
			{
				$status = 0;
			}
			elseif($status == 0)
			{
				$status = 1;
			}
			$this->Users_model->del($ID, $status);
		}

		public function Clave($ID, $pass){
			$this->Users->Clave($ID, $pass);
		}

		public function Guardar(){
			$user = $this->input->get_post('Usuario');
			$name = $this->input->get_post('NombreC');
			$pass = $this->input->get_post('Pass');
			$passC = $this->input->get_post('PassC');
			$rol = $this->input->get_post('rol');
			$estado = 1;
			if($passC == $pass){
				$this->Users_model->Guardar($user, $name, $pass, $rol ,$estado);
				redirect("Usuarios");
			}
		}
	}