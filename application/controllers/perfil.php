<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfil extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model');
    }
    
    public function index() {
        if ($this->session->userdata('categoria') == 'admin' || $this->session->userdata('categoria') == 'private') {
            $id_usuario = $this->session->userdata('id_usuario');
            $datos['usuario'] = $this->usuario_model->getUsuario($id_usuario);
            $datos['title'] = 'Actualizar Usuario';
            $datos['form'] = 'perfil';
            $this->vistaFormulario($datos, $id_usuario);
        }
        else {
            redirect('login');
        }
    }
    
    public function vistaFormulario($datos, $id = FALSE) {
        $this->form_validation->set_rules('nombre','Nombre','trim|required');
        $this->form_validation->set_rules('apellido','Apellido','trim|required');
        $this->form_validation->set_rules('passwordA','Password Antiguo','trim|required');
        $this->form_validation->set_rules('passwordN','Password Nuevo','trim|required|matches[passwordconf]');
        $this->form_validation->set_rules('passwordconf','Password 2','trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template/header', $datos);
            $this->load->view('template/backend');
            $this->load->view('perfil/formularioPerfil',$datos);
            $this->load->view('template/footer');
        }
        else {
            $usuario = $this->usuario_model->getUsuario($id);
            if (sha1($this->input->post('passwordA')) == $usuario['password']) {
                $this->usuario_model->setUsuarioPerfil($id);
                redirect('welcome');
            }
            else {
                $this->session->set_flashdata('password_incorrecto','La contraseña es incorrecta');
            	redirect('perfil');
            }
        }
    }
}