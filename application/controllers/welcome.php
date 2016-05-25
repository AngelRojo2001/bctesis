<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model');
    }
    
    public function index() {
        if ($this->session->userdata('categoria') == 'admin' || $this->session->userdata('categoria') == 'private') {
            $usuario = $this->usuario_model->getUsuario($this->session->userdata('id_usuario'));
            $datos['title'] = 'Inicio';
            $datos['usuario'] = $usuario;
            $this->load->view('template/header', $datos);
            $this->load->view('template/backend');
            $this->load->view('principal',$datos);
            $this->load->view('template/footer');
        }
        else {            
            redirect('login');
        }        
    }
}