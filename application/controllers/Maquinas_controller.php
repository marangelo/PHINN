<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Maquinas_controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Maquinas_model');
        $this->load->library('session');
        $user = $this->session->userdata('logged');
        if (!isset($user)) {
            redirect(base_url().'index.php','refresh');
        }
    }

    public function index()
    {
        $data['maquinas'] = $this->Maquinas_model->ListarMaq();
        $this->load->view('header');
        $this->load->view('dashboardclean');
		$this->load->view('Mantenimiento/Maquinas',$data);
		$this->load->view('footer');
    }

    public function GuardarMaquina()
    {
        $maquina = $this->input->get_post("maquina");
        $comentario = $this->input->get_post("comentario");
        $this->Maquinas_model->GuardarMaq($maquina,$comentario);
       // echo $maquina ." - ". $comentario;
    }

    public function Eliminarmaquina($ID, $desc)
    {
        $this->Maquinas_model->EliminarMaq($ID, $desc);
    }
}
?>