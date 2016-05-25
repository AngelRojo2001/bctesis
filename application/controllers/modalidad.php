<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modalidad extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('modalidad_model');
    }
    
    // Metodo inicio de Modalidad
    public function index() {
        if ($this->session->userdata('categoria') == 'admin') {
            $datos['modalidades'] = $this->modalidad_model->getModalidad();
            $datos['title'] = 'Modalidad';        
            $this->load->view('template/header', $datos);
            $this->load->view('template/backend');
            $this->load->view('modalidad/listarModalidad', $datos);
            $this->load->view('template/footer');
        }
        else {
            redirect('login');
        }
    }
    
    // Metodo para crear una modalidad
    public function crear() {
        if ($this->session->userdata('categoria') == 'admin') {
            $datos['title'] = 'Crear Modalidad';
            $datos['form'] = 'modalidad/crear';        
            $this->vistaFormulario($datos);
        }
        else {
            redirect('login');
        }
    }
    
    // Metodo para modificar una modalidad
    public function editar($id) {
        if ($this->session->userdata('categoria') == 'admin') {
            $datos['modalidad'] = $this->modalidad_model->getModalidad($id);
            $datos['title'] = 'Actualizar Modalidad';
            $datos['form'] = 'modalidad/editar/'.$id;        
            $this->vistaFormulario($datos, $id);
        }
        else {
            redirect('login');
        }
    }
    
    // Metodo para eliminar una modalidad
    public function borrar($id) {
        if ($this->session->userdata('categoria') == 'admin') {
            $this->modalidad_model->deleteModalidad($id);
            redirect('modalidad');
        }
        else {
            redirect('login');
        }
    }
    
    public function vistaFormulario($datos, $id = FALSE) {
        $this->form_validation->set_rules('modalidad','Modalidad','required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template/header', $datos);
            $this->load->view('template/backend');
            $this->load->view('modalidad/formularioModalidad',$datos);
            $this->load->view('template/footer');
        }
        else {
            $this->modalidad_model->setModalidad($id);
            redirect('modalidad');
        }
    }
}