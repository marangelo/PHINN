<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Mantenimiento_controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        		$this->load->library('session');
		//$this->seguridad->estactivo($this->session->userdata('logged'));	
		$user = $this->session->userdata('logged');

           if (!isset($user)) {
               redirect(base_url().'index.php','refresh');
           }
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('dashboardclean');
		$this->load->view('Mantenimiento/menu_mantenimiento');
		$this->load->view('footer');
    }

    public function turnos() {
      $data['listandoTurnos'] = $this->detalleplanes_model->listarTurnos();
      $this->load->view('header');
      $this->load->view('dashboardclean');
      $this->load->view('Mantenimiento/turnos', $data);
      $this->load->view('footer');
    }

    public function buscarTurno($idTurno) {
      $this->detalleplanes_model->buscarTurnoById($idTurno);
    }

    public function actualizarTurno($idTurno) {
      $this->detalleplanes_model->actualizandoRegistroTurno($this->input->post('dataTurno'), $idTurno);
    }

    public function guardarNuevoTurno() {
      $this->detalleplanes_model->guardandoNuevoTurno($this->input->post('data_turno')); 
    }

    public function elimarRegistroTurno($idTurno) {
     $estado = 0;
     $this->detalleplanes_model->elimandoRegistroTurno($idTurno, $estado);
    }

    public function restaurarRegistroTurno($idTurno)
    {
      $estado = 1;
      $this->detalleplanes_model->restaurandoRegistroTurno($idTurno, $estado);
    }
}
?>