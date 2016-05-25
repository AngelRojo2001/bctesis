<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Busqueda extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('registro_model');
    }
    
    public function index() {
        if ($this->session->userdata('categoria') == 'admin' || $this->session->userdata('categoria') == 'private') {
            $datos['title'] = 'Búsqueda';
            $this->load->view('template/header',$datos);
            $this->load->view('template/backend');
            $this->load->view('busqueda/buscar');
            $this->load->view('template/footer');
        }
        else {
            redirect('login');
        }
    }

    public function codigo() {
        if ($this->session->userdata('categoria') == 'admin' || $this->session->userdata('categoria') == 'private') {
            $codigo = $this->input->post('codigo');
            $row_registro = $this->registro_model->getRegistroByCodigo($codigo);
            $datos['registros'] = $row_registro;
            $this->load->view('busqueda/codigo',$datos);
        }
        else {
            redirect('login');
        }
    }

    public function titulo() {
        if ($this->session->userdata('categoria') == 'admin' || $this->session->userdata('categoria') == 'private') {
            $titulo = $this->input->post('titulo');
            $row_registro = $this->registro_model->getRegistroByTitulo($titulo);
            $datos['registros'] = $row_registro;
            $this->load->view('busqueda/codigo',$datos);
        }
        else {
            redirect('login');
        }
    }

    public function autor() {
        if ($this->session->userdata('categoria') == 'admin' || $this->session->userdata('categoria') == 'private') {
        	$autor = $this->input->post('autor');
        	$row_registro = $this->registro_model->getRegistroByAutor($autor);
        	$datos['registros'] = $row_registro;
        	$this->load->view('busqueda/codigo',$datos);
        }
        else {
            redirect('login');
        }
    }
}
