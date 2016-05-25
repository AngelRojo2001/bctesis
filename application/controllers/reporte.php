<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('excel');
        $this->load->model('facultad_model');
        $this->load->model('carrera_model');
        $this->load->model('registro_model');
    }
    
    public function index() {
        if ($this->session->userdata('categoria') == "admin" || $this->session->userdata('categoria') == 'private') {
            $facultades = $this->facultad_model->getFacultad();
            $datos['title'] = "Reportes";
            $datos['facultades'] = $facultades;
            $this->load->view('template/header',$datos);
            $this->load->view('template/backend');
            $this->load->view('reporte/inicioReporte', $datos);
            $this->load->view('template/footer');
        }
        else {
            redirect('login');
        }
    }
    
    public function facultad() {
        if ($this->session->userdata('categoria') == "admin" || $this->session->userdata('categoria') == 'private') {
            $datos['facultad_id'] = $this->input->post('facultad');
            $datos['anio'] = $this->input->post('anio_facultad');
            $this->load->view('reporte/reporteFacultad',$datos);
        }
        else {
            redirect('login');
        }
    }
    
    public function anio($anio = NULL) {
        if ($this->session->userdata('categoria') == "admin" || $this->session->userdata('categoria') == 'private') {
            $datos['anio'] = $this->input->post('anio');
            $this->load->view('reporte/reporteAnio',$datos);
        }
        else {
            redirect('login');
        }
    }

    public function mes() {
        if ($this->session->userdata('categoria') == "admin" || $this->session->userdata('categoria') == 'private') {
            $datos['mes'] = $this->input->post('mes');
            $datos['anio'] = $this->input->post('mes_anio');
            $this->load->view('reporte/reporteMes',$datos);
        }
        else {
            redirect('login');
        }
    }
    
    public function graficoByFacultad() {
        if ($this->session->userdata('categoria') == "admin" || $this->session->userdata('categoria') == 'private') {
            $datos['registros'] = $this->registro_model->getEstadisticoByFacultad($this->input->post('facultad'),$this->input->post('anio_facultad'));
            //$datos['anio'] = $this->input->post('anio');
            $datos['graficos'] = $this->input->post('graficosFacultad');
            $this->load->view('reporte/GraficoByAnio',$datos);
        }
        else {
            redirect('login');
        }
    }
    
    public function graficoByAnio() {
        if ($this->session->userdata('categoria') == "admin" || $this->session->userdata('categoria') == 'private') {
            $datos['registros'] = $this->registro_model->getEstadisticoByAnio($this->input->post('anio'));
            //$datos['anio'] = $this->input->post('anio');
            $datos['graficos'] = $this->input->post('graficosAnio');
            $this->load->view('reporte/GraficoByAnio',$datos);
        }
        else {
            redirect('login');
        }
    }

    public function graficoByMes() {
        if ($this->session->userdata('categoria') == "admin" || $this->session->userdata('categoria') == 'private') {
            $datos['registros'] = $this->registro_model->getEstadisticoByAnio($this->input->post('mes_anio'),$this->input->post('mes'));
            //$datos['mes'] = $this->input->post('mes');
            //$datos['anio'] = $this->input->post('mes_anio');
            $datos['graficos'] = $this->input->post('graficosMes');
            $this->load->view('reporte/GraficoByAnio',$datos);
        }
        else {
            redirect('login');
        }
    }
}