<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class tanques_controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('tanques_model');
        $this->load->library('session');
        $user = $this->session->userdata('logged');
        if (!isset($user)) {
            redirect(base_url().'index.php','refresh');
        }
    }

    public function index()
    {
        $data['tanques'] = $this->tanques_model->ListarTanque();
        $this->load->view('header');
        $this->load->view('dashboardclean');
		$this->load->view('Mantenimiento/Tanques',$data);
		$this->load->view('footer');
    }

    public function Guardar()
    {
        $tanque = $this->input->get_post('tanque');
        $this->tanques_model->Guardartanque($tanque);
    }

    public function EliminarTanque($id, $desc)
    {
        $this->tanques_model->Eliminar($id, $desc);
    }
}
?>