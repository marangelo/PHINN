<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class planes_controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("planes_model");
        $this->load->library('session');
        $user = $this->session->userdata('logged');
        if (!isset($user)) {
            redirect(base_url().'index.php','refresh');
        }
    }

    public function index()
    {
        $data['lista'] = $this->planes_model->ListarPlan();
        $this->load->view('header');
        $this->load->view('dashboardclean');
		$this->load->view('Mantenimiento/planes',$data);
		$this->load->view('footer');
    }

    public function GuardaPlan()
    {
        $fecha = $this->input->get_post("fecha");
        $comentario = $this->input->get_post("comentario");
        $estado = 1;
        $this->planes_model->GuardarPlan($fecha,$comentario,$estado);
       //echo $fecha,$comentario,$estado;
    }

    public function ActualizarPlan()
    {
        $id = $this->input->get_post('IdPlan');
        $fecha = $this->input->get_post('Fecha');
        $comentario = $this->input->get_post('Comentario');
        $this->planes_model->ActualizarRegistroPlan($id,$fecha,$comentario);
       
    }
}
?>