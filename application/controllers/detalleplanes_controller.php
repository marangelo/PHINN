<!--
 * @author [Cesar Mejia]
 * @email [analista4.guma@gmail.com]
 * @create date 2017-06-30 07:30:07
 * @modify date 2017-06-30 07:30:07
 * @desc [description]
-->

<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class detalleplanes_controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('detalleplanes_model');
        $this->load->library('session');
        $user = $this->session->userdata('logged');
        if (!isset($user)) {
            redirect(base_url().'index.php','refresh');
        }
    }

     public function index()
    {
        $this->load->view('header');
        $this->load->view('dashboardclean');
        $this->load->view('Mantenimiento/detalle_planes');
        $this->load->view('footer');
    }

    public function AgregaDetallePlanes($id) {
        $data['planes'] = $this->detalleplanes_model->BuscarIdPlan($id);
        $data['insumos'] = $this->detalleplanes_model->ListarInsumos();
        $data['insumos2'] = $this->detalleplanes_model->ListarInsumos2();
        $data['insumos3'] = $this->detalleplanes_model->ListarInsumos3();
        $data['tanques'] = $this->detalleplanes_model->ListarTanques();
        $data['categorias'] = $this->detalleplanes_model->ListarCat();
        $data['cat1'] = $this->detalleplanes_model->ListarCat1($id);
        $data['cat2'] = $this->detalleplanes_model->ListarCat2($id);
        $data['cat3'] = $this->detalleplanes_model->ListarCat3($id);
        $data['cat4'] = $this->detalleplanes_model->ListarCat4($id);
        $this->load->view('header');
        $this->load->view('dashboardclean');
        $this->load->view('Mantenimiento/detalle_planes', $data);
        $this->load->view('footer');
    }

    public function GuardaDetalles()
    {
        $this->detalleplanes_model->ArrayGuardaDet(
            $this->input->post('insumos1'),
            $this->input->post('insumos2'),
            $this->input->post('insumos3'),
            $this->input->post('tanques')
        );
    }

    public function ValidaDetalle($id,$cat,$idinsumo)
    {
        $this->detalleplanes_model->ValidaDetPlan($id,$cat,$idinsumo);
    }

    public function EliminarDetalle()
    {
        $this->detalleplanes_model->EliminarDet($this->input->post('deleteDetalle'));
    }

}
?>