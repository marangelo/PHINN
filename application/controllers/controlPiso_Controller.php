<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class controlPiso_Controller extends CI_Controller
{	
	public function __construct() {
		parent:: __construct();
		$this->load->library('session');
        $user = $this->session->userdata('logged');
        if (!isset($user)) {
            redirect(base_url().'index.php','refresh');
        }
	}

	public function index($consecutivo) {
		$data['consumoElectrico'] = $this->controlPiso_Model->visualizarConsumoElec($consecutivo);
		$data['detalleOrdTrabajo'] = $this->controlPiso_Model->detalleOrdTrabajo($consecutivo);		
		$data['tiposFibras'] = $this->controlPiso_Model->listaInsumos();
		$data['detalle'] = $this->controlPiso_Model->detalleControlPiso($consecutivo);
		$data['pastaDetalle'] = $this->controlPiso_Model->mostrarDetallePasta($consecutivo);
		$data['tanques'] =  $this->MateriaPrima_model->ListarTanque();
		$data['pastaTanques'] = $this->controlPiso_Model->mostrarPastaProc($consecutivo);
		$this->load->view('header');
        $this->load->view('dashboardclean');
        $this->load->view('Supervisor/controlPiso', $data);
        $this->load->view('footer');
	}

	public function filtroTiposInsumos($tipo) {
		$json=array();
		$query = $this->controlPiso_Model->filtrandoTiposFibra($tipo);
		if ($query!=FALSE) {
					foreach ($query as $key) {
			$dta = array(
				'IdInsumo' => $key['IdInsumo'],
				'Descripcion' => $key['Descripcion']
				);
			$json[] = $dta;
		}
		echo json_encode($json);
		}else {
			echo "FALSE";
		}
	}

	public function detalleInsumo($idInsumo,$consecutivo) {
		$json=array();
		$query = $this->controlPiso_Model->detalleInsumoById($idInsumo,$consecutivo);
		if ($query!=1) {
			foreach ($query as $key) {
				$data = array(
					'IdInsumo' => $key['IdInsumo'],
					'Descripcion' => $key['Descripcion'],
					'UnidadMedida' => $key['UnidadMedida'],
					'Tipo' => $key['Tipo']
				);
				$json[] = $data;
			}
			echo json_encode($json);
		}elseif ($query==1) {
			echo 1;
		}
	}

	public function validaExisteControlPisoEncabezado($consecutivo) {
		$this->controlPiso_Model->validaExiste($consecutivo);
	}

	public function guardandoControlPiso() {
		$this->controlPiso_Model->guardandoDetalleControlPiso($this->input->post('consecutivo'), $this->input->post('detalle'), $this->input->post('encabezado'));
	}

	public function guardandoConsumoElectrico() {
		$this->controlPiso_Model->guardandoRegistroElectrico($this->input->post('consumoElectrico'));
	}

	public function guardarPastaProcesada() {
		$this->controlPiso_Model->guardandoPastaProcesada($this->input->post('infoPasta'));
	}

	public function eliminarPasta($idPastaProc) {
		$this->controlPiso_Model->eliminandoPastaProcesada($idPastaProc);
	}
}


?>