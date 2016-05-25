<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facultad extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('facultad_model');
    }
    
    // Metodo de inicio de Facultad
    public function index() {
        if ($this->session->userdata('categoria') == 'admin') {
            $datos['facultades'] = $this->facultad_model->getFacultad();
            $datos['title'] = 'Facultad';
            $this->load->view('template/header', $datos);
            $this->load->view('template/backend');
            $this->load->view('facultad/listarFacultad', $datos);
            $this->load->view('template/footer');
        }
        else {
            redirect('login');
        }
    }
    
    // Metodo para crear facultad
    public function crear() {
        if ($this->session->userdata('categoria') == 'admin') {
            $datos['title'] = 'Crear Facultad';
            $datos['form'] = 'facultad/crear';
            $this->vistaFormulario($datos);
        }
        else {
            redirect('login');
        }
    }
    
    // Metodo para actualizar facultad
    public function editar($id) {
        if ($this->session->userdata('categoria') == 'admin') {
            $datos['facultad'] = $this->facultad_model->getFacultad($id);
            $datos['title'] = 'Actualizar Facultad';
            $datos['form'] = 'facultad/editar/'.$id;
            $this->vistaFormulario($datos, $id);
        }
        else {
            redirect('login');
        }
    }
    
    // Metodo para eliminar facultad
    public function borrar($id) {
        if ($this->session->userdata('categoria') == 'admin') {
            $this->facultad_model->deleteFacultad($id);
            redirect('facultad');
        }
        else {
            redirect('login');
        }
    }
        
    public function vistaFormulario($datos, $id = FALSE) {
        $this->form_validation->set_rules('facultad','Facultad','required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template/header', $datos);
            $this->load->view('template/backend');
            $this->load->view('facultad/formularioFacultad',$datos);
            $this->load->view('template/footer');
        }
        else {
            $this->facultad_model->setFacultad($id);
            redirect('facultad');
        }
    }
}