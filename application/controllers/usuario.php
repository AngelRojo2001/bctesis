<?php

class Usuario extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model');
    }
    
    // Metodo de inicio para usuario
    public function index() {
        if ($this->session->userdata('categoria') == 'admin') {
            $datos['usuarios'] = $this->usuario_model->getUsuario();
            $datos['title'] = 'Usuario';
            $this->load->view('template/header',$datos);
            $this->load->view('template/backend');
            $this->load->view('usuario/listarUsuario',$datos);
            $this->load->view('template/footer');
        }
        else {
            redirect('login');
        }
    }
    
    // Metodo para crear usuario
    public function crear() {
        if ($this->session->userdata('categoria') == 'admin') {
            $datos['title'] = 'Crear Usuario';
            $datos['form'] = 'usuario/crear';
            $this->form_validation->set_rules('nombre','Nombre','trim|required');
            $this->form_validation->set_rules('apellido','Apellido','trim|required');
            $this->form_validation->set_rules('login','Usuario','trim|required');
            $this->form_validation->set_rules('categoria','Categoria','required');
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('template/header', $datos);
                $this->load->view('template/backend');
                $this->load->view('usuario/formularioUsuario',$datos);
                $this->load->view('template/footer');
            }
            else {
                $login = $this->input->post('login');
                $usuarios = $this->usuario_model->getUsuarioByLogin($login);
                if ($usuarios) {
                    $this->session->set_flashdata('login_error','El usuario existe, inserte otro usuario');
                    redirect('usuario/crear');
                }
                else {
                    $this->usuario_model->setUsuario();
                    redirect('usuario');
                }
            }
        }
        else {
            redirect('login');
        }
    }
    
    // Metodo para actualizar usuario
    public function editar($id) {
        if ($this->session->userdata('categoria') == 'admin') {
            $datos['usuario'] = $this->usuario_model->getUsuario($id);
            $datos['title'] = 'Actualizar Usuario';
            $datos['form'] = 'usuario/editar/'.$id;
            $this->form_validation->set_rules('nombre','Nombre','trim|required');
            $this->form_validation->set_rules('apellido','Apellido','trim|required');
            $this->form_validation->set_rules('categoria','Categoria','required');
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('template/header', $datos);
                $this->load->view('template/backend');
                $this->load->view('usuario/formularioUsuario',$datos);
                $this->load->view('template/footer');
            }
            else {
                $this->usuario_model->setUsuario($id);
                redirect('usuario');
            }
        }
        else {
            redirect('login');
        }
    }
    
    // Metodo para eliminar usuario
    public function borrar($id) {
        if ($this->session->userdata('categoria') == 'admin') {
            $this->usuario_model->deleteUsuario($id);
            redirect('usuario');
        }
        else {
            redirect('login');
        }
    }
}
