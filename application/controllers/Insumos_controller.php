<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Insumos_controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Insumos_model');
        $this->load->library('session');
        $user = $this->session->userdata('logged');
        if (!isset($user)) {
            redirect(base_url().'index.php','refresh');
        }
    }

    public function index()
    {
        $data['listainsumos'] = $this->Insumos_model->ListarInsumos();
        $data['categoria'] = $this->Insumos_model->cargarcat();
        $this->load->view('header');
        $this->load->view('dashboardclean');
		$this->load->view('Mantenimiento/Insumos',$data);
		$this->load->view('footer');
    }

    public function GuardarInsumos()
    {
        $Desc = $this->input->get_post("Descripcion");
        $Id = $this->input->get_post("categoria");
        $unidadmed = $this->input->get_post("unidadmedida");
        $tipo = $this->input->get_post("tipo");
        $this->Insumos_model->GuardarIns($Desc,$Id,$unidadmed,$tipo);
        // echo $Desc . " " . $Id;
    }

    public function Eliminar($Id)
    {
        $this->Insumos_model->EliminarIns($Id);
    }
}
?>