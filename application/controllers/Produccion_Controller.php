<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Produccion_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("produccion_Model");
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
        $this->load->view('Coordinador/Produccion');
        $this->load->view('footer');
    }


    public function GuardarProduccion()
    {
        $IdRptD = $this->input->get_post("idRptD");
        $NoOrden = $this->input->get_post("NoOrden");
        $operador = $this->input->get_post("operador");
        $maquina = $this->input->get_post("maquina");
        $HoraInic = $this->input->get_post("timepickerII");
        $HoraFin = $this->input->get_post("timepickerFF");
        $velocidad = $this->input->get_post("Velocidad");
        $peso = $this->input->get_post("peso");
        $diametro = $this->input->get_post("Diametro");
        $pesobase = $this->input->get_post("pesobase");
        $merma = $this->input->get_post("merma");
        $duplicado = $this->db->get_where('reporte_diario',array("IdReporteDiario" => $IdRptD,'Estado'=>0));
         if ($duplicado->num_rows()>0) {
             echo "Consecutivo ya se ha cerrado";
         } else {
        $this->produccion_Model->Guardar( $IdRptD, $NoOrden, $operador,$maquina, $HoraInic, $HoraFin,$velocidad, $peso,$diametro, $pesobase,$merma);
         echo  $IdRptD, $NoOrden, $operador,$maquina, $HoraInic, $HoraFin,$velocidad, $peso,$diametro, $pesobase , $merma;
         }
    }

        public function agregaDetalleOrdP1($idReporteD) {
        $data['produccion'] = $this->produccion_Model->ListarProd($idReporteD);
        $data['produccion2'] = $this->produccion_Model->ListarProd2($idReporteD);
        $data['produccion3'] = $this->produccion_Model->ListarProd3($idReporteD);
        $data['consecutivo'] = $this->Ordenproduccion_model->buscarRtpDiario($idReporteD);
        //$data['consecutivo'] = array('NoOrden' => $Norden, 'consecutivo' => $consecutivo, 'turno' => $turno);
        $data ['Operador'] = $this->produccion_Model->Operario();
        $data['listaMaq'] = $this->Ordenproduccion_model->listarMaquinas();
        $this->load->view('header');
        $this->load->view('dashboardclean');
        $this->load->view('Coordinador/Produccion', $data);
        $this->load->view('footer');
    }

    public function Eliminar($idprod,$IdRptD)
    {
         $duplicado = $this->db->get_where('reporte_diario',array("IdReporteDiario" => $IdRptD,'Estado'=>0));
         if ($duplicado->num_rows()>0) {
             echo "Consecutivo ya se ha cerrado";
         } else {
        $this->produccion_Model->EliminarProd($idprod,$IdRptD);
        //echo "Se puede eliminar";
         }
    }

    public function ActualizaMerma($IdReporteDiario , $Merma , $Maq)
    {
        $duplicado = $this->db->get_where('reporte_diario',array("IdReporteDiario" => $IdReporteDiario,'Estado'=>0));
         if ($duplicado->num_rows()>0) {
             echo "Consecutivo ya se ha cerrado";
         } else {
        $this->produccion_Model->ActualizarMerma($IdReporteDiario , $Merma , $Maq);
        //echo "SE PUEDE ACTUALIZAR";
         }
    }
}
?>