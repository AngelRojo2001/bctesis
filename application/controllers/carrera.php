<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carrera extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('carrera_model');
        $this->load->model('facultad_model');
    }
    
    // Metodo de inicio para carrera
    public function index() {
        if ($this->session->userdata('categoria') == 'admin' || $this->session->userdata('private')) {
            $datos['carreras'] = $this->carrera_model->getCarreraFacultad();
            $datos['title'] = 'Carrera';
            $this->load->view('template/header', $datos);
            $this->load->view('template/backend');
            $this->load->view('carrera/listarCarrera', $datos);
            $this->load->view('template/footer');
        }
        else {
            redirect('login');
        }
    }
    
    // Metodo para crear carrera
    public function crear() {
        if ($this->session->userdata('categoria') == 'admin' || $this->session->userdata('private')) {
            $datos['facultades'] = $this->facultad_model->getFacultad();
            $datos['title'] = 'Crear Carrera';
            $datos['form'] = 'carrera/crear';
            $this->vistaFormulario($datos);
        }
        else {
            redirect('login');
        }
    }
    
    // Metodo para editar carrera
    public function editar($id) {
        if ($this->session->userdata('categoria') == 'admin' || $this->session->userdata('private')) {
            $datos['carrera'] = $this->carrera_model->getCarrera($id);
            $datos['facultades'] = $this->facultad_model->getFacultad();
            $datos['title'] = 'Actualizar Carrera';
            $datos['form'] = 'carrera/editar/'.$id;
            $this->vistaFormulario($datos, $id);
        }
        else {
            redirect('login');
        }		
    }
    
    // Metodo para eliminar carrera
    public function borrar($id) {
        if ($this->session->userdata('categoria') == 'admin' || $this->session->userdata('private')) {
            $this->carrera_model->deleteCarrera($id);
            redirect('carrera');
        }
        else {
            redirect('login');
        }
    }

	public function listarFacultad($facultad_id) {
		$datos['carreras'] = $this->carrera_model->getByFacultadId($facultad_id);
		$this->load->view('registro/listarCarrera',$datos);
	}
    
    public function vistaFormulario($datos, $id = FALSE) {
        $this->form_validation->set_rules('carrera','Carrera','required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template/header', $datos);
            $this->load->view('template/backend');
            $this->load->view('carrera/formularioCarrera',$datos);
            $this->load->view('template/footer');
        }
        else {
            $this->carrera_model->setCarrera($id);
            redirect('carrera');
        }
    }
}