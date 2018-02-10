<?php
/**
 * @author [Cesar Mejia]
 * @email [analista4.guma@gmail.com]
 * @modify date 2017-08-31 10:27:06
 * @desc []
*/
class MateriaPrima_controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("MateriaPrima_model");
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
        $this->load->view('Coordinador/MateriaPrima');
        $this->load->view('footer');
    }

    public function GuardarMatPri()
    {
        $IdRptD = $this->input->get_post("idRptD");   
        $Tanque = $this->input->get_post("Tanque");  
        $dia = $this->input->get_post("dia");   
        $noche = $this->input->get_post("noche");    
        $consumo = 0;   
        /*Variables para guardar datos del turno mixto*/
        $dia1 = $this->input->get_post("dia1");   
        $noche1 = $this->input->get_post("noche1"); 
        /**********************************************/

        if($dia == "")
        {
            $dia = 0;
        }
        elseif($noche == "")
        {
            $noche = 0;
        }
        $duplicado = $this->db->get_where('reporte_diario',array("IdReporteDiario" => $IdRptD,'Estado'=>0));
         if ($duplicado->num_rows()>0) {
             echo "Consecutivo ya se ha cerrado";
         } else {
             //buscar datos con turno mixto
            $mixto = $this->db->get_where('view_reportediario',array('IdReporteDiario' => $IdRptD, "tipo" => "MX")); 
            if($mixto->num_rows()>0){
                $this->MateriaPrima_model->GuardaMP($IdRptD,$Tanque,$dia1,$noche1,$consumo);
            }else{
                $this->MateriaPrima_model->GuardaMP($IdRptD,$Tanque,$dia,$noche,$consumo);
            }
         }
    }

        public function agregaDetalleOrdP1($idReporteD) {
        $data['consecutivo'] = $this->Ordenproduccion_model->buscarRtpDiario($idReporteD);
        $data['listamp'] = $this->MateriaPrima_model->ListarPM($idReporteD);
        $data['listaInsumos'] =  $this->MateriaPrima_model->ListarInsumos();
        $data['listaMPInsumos'] =  $this->MateriaPrima_model->ListarPMInsumos($idReporteD);
        $data['listaTanques'] =  $this->MateriaPrima_model->ListarTanque();
        $this->load->view('header');
        $this->load->view('dashboardclean');
        $this->load->view('Coordinador/MateriaPrima', $data);
        $this->load->view('footer');
    }

    public function ValidarP($tanque,$ID)
        {
            $this->MateriaPrima_model->ValidaPasta($tanque,$ID);
        }

        public function ValidarIn($id,$desc)
        {
            $this->MateriaPrima_model->ValidaMPInsumo($id,$desc);
        }

        public function GuardaMPInsumos()
        {
            $IdRptd = $this->input->get_post("idRptd");
            $desc = $this->input->get_post("descripcion");
            $Dia = $this->input->get_post("Dia");
            $Noche = $this->input->get_post("Noche");
            $ptadia = $this->input->get_post("ptadia");
            $ptanoche = $this->input->get_post("ptanoche");
            /* Variables para guardar datos del turno mixto */

            $Dia1 = $this->input->get_post("Dia1");
            $Noche1 = $this->input->get_post("Noche1");
            $ptadia1 = $this->input->get_post("ptadia1");
            $ptanoche1 = $this->input->get_post("ptanoche1");
            /**********************************************/
            if ($Dia == "") {
                $Dia = 0;
            } 
            elseif($Noche == ""){
                $Noche = 0;
            }
            if ($ptadia == "") {
                $ptadia = 0;
            }
            elseif ($ptanoche == "") {
                $ptanoche = 0;
            }
         $duplicado = $this->db->get_where('reporte_diario',array("IdReporteDiario" => $IdRptd,'Estado'=>0));
         if ($duplicado->num_rows()>0) {
             echo "Consecutivo ya se ha cerrado";
         } else {
             //buscar datos con turno mixto
             $mixto = $this->db->get_where('view_reportediario',array('IdReporteDiario' => $IdRptd, "tipo" => "MX")); 
             if($mixto->num_rows()>0){
                $this->MateriaPrima_model->GuardarMPInsumos( $IdRptd,$desc,$Dia1,$Noche1,$ptadia1,$ptanoche1);
             }else{
                 $this->MateriaPrima_model->GuardarMPInsumos($IdRptd,$desc,$Dia,$Noche,$ptadia,$ptanoche);
             }
         }
        }

        public function EliminarPasta($id,$IdRept)
        {
        $duplicado = $this->db->get_where('reporte_diario',array("IdReporteDiario" => $IdRept,'Estado'=>0));
         if ($duplicado->num_rows()>0) {
             echo "Consecutivo ya se ha cerrado";
         } else {
            $this->MateriaPrima_model->EliminaPasta($id,$IdRept);
         }
        }

        public function EliminaInsumos($id,$IdRept)
        {
        $duplicado = $this->db->get_where('reporte_diario',array("IdReporteDiario" => $IdRept,'Estado'=>0));
         if ($duplicado->num_rows()>0) {
             echo "Consecutivo ya se ha cerrado";
         } else {
            $this->MateriaPrima_model->EliminaPMInsumo($id,$IdRept);
         }
        }
}
?>