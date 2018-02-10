<?php
class Login_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->library('session');
       /* if($this->session->userdata('logged')==1){ // Si esta logueado no mostrar formulariuo login
            redirect(base_url().'index.php/dashboard','refresh');}*/

	}

    public function index()
    {
        $this->load->view('header_login');
		$this->load->view('Login');
		$this->load->view('footer_login');
    }
    
    public function Salir(){
        $this->Users_model->InsertLog($this->session->userdata['IdUser'], 'CERRO SESION ');
        $this->session->sess_destroy();
        $sessiondata = array(
                'logged' => 0
        );

        $this->session->unset_userdata($sessiondata);
        redirect('login');
	}
    public function Acreditar(){
    	$this->form_validation->set_rules('txtUsuario', 'Usuario', 'required');
		$this->form_validation->set_rules('txtpassword', 'Contraseña', 'required');
    	
        if ($this->form_validation->run()== FALSE) {
    		 redirect('?error=1'); 
    	}else {
    		$name = $this->input->get_post('txtUsuario');
			$pass = $this->input->get_post('txtpassword');
			
            $data['user'] = $this->Users_model->login($name, $pass);

    		if ($data['user'] == 0) {
    			redirect('?error=2');
    		} else {
                $this->Users_model->InsertLog($data['user'][0]['IdUsuario'], 'INGRESO AL SISTEMA');
                $sessiondata = array(
                                'IdUser' => $data['user'][0]['IdUsuario'],
                                'Usuario' => $data['user'][0]['Usuario'],
                                'Nombre' => $data['user'][0]['Nombre'],
                                'Privilegio' => $data['user'][0]['Privilegio'],
                                'logged' => 1
                                );
                $this->session->set_userdata($sessiondata);
                redirect('dashboard');
    		}
    	}
    }

     public function dowload() {
        $this->load->helper('download');
        $data = file_get_contents("./assets/Manual/Manual.rar");
        $name = 'Manual.rar';
        //use this function to force the session/browser to download the file uploaded by the user 
        force_download($name, $data);
    }

    public function actualizarPassword() {
        $this->Users_model->actulizandoPassword($this->input->post('updatePass'));
    }
}
