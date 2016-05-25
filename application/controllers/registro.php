<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registro extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('modalidad_model');
        $this->load->model('carrera_model');
        $this->load->model('facultad_model');
        $this->load->model('tesis_model');
        $this->load->model('alumno_model');
        $this->load->model('registro_model');
        $this->load->model('usuario_model');
    }
    
    // Metodo de inicio
    public function index() {
        if ($this->session->userdata('categoria') == 'admin' || $this->session->userdata('categoria') == 'private') {
            $datos['tesis'] = $this->registro_model->getRegistro();
            $datos['title'] = 'Registro';
            $this->load->view('template/header', $datos);
            $this->load->view('template/backend');
            $this->load->view('registro/listarRegistro', $datos);
            $this->load->view('template/footer');
        }
        else {
            redirect('login');
        }
    }
    
    //Metodo para la crear registros
    public function crear() {
        if ($this->session->userdata('categoria') == 'admin' || $this->session->userdata('categoria') == 'private') {
            $datos['facultades'] = $this->facultad_model->getFacultad();
            $datos['carreras'] = $this->carrera_model->getCarrera();
            $datos['modalidades'] = $this->modalidad_model->getModalidad();
            $datos['title'] = 'Crear Registro';
            $datos['form'] = 'registro/crear';
            $this->vistaForm($datos);
        }
        else {
            redirect('login');
        }
    }

    // Metodo para agregar alumno a una tesis
    public function agregar($tesis_id = FALSE) {
        if ($this->session->userdata('categoria') == 'admin' || $this->session->userdata('categoria') == 'private') {
            if ($tesis_id === FALSE) {
                $datos['tesis_id'] = $this->input->post('tesis_id');
            }
            else {
                $datos['tesis_id'] = $tesis_id;
            }
            $datos['title'] = "Agregar alumno a tesis";
            $datos['form'] = "registro/agregar";
            $this->form_validation->set_rules('codigo','Código','trim|required|is_numeric');
            $this->form_validation->set_rules('apellidos','Apellidos','trim|required');
            $this->form_validation->set_rules('nombres','Nombres','trim|required');
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('template/header', $datos);
                $this->load->view('template/backend');
                $this->load->view('registro/registroAlumno',$datos);
                $this->load->view('template/footer');
            }
            else {
                $this->registro_model->setRegistroAlumno();
                redirect('registro');
            }
        }
        else {
            redirect('login');
        }
    }
    
    // Metodo para editar registro
    public function editar($id) {
        if ($this->session->userdata('categoria') == 'admin' || $this->session->userdata('categoria') == 'private') {
            $row_registro = $this->registro_model->getRegistro($id);
            $row_alumno = $this->alumno_model->getAlumnoByNombre($row_registro['alumno_id']);
            $row_tesis = $this->tesis_model->getTesis($row_registro['tesis_id']);
            $datos['registro'] = $row_registro;
            $datos['alumno'] = $row_alumno;
            $datos['tesis'] = $row_tesis;
            $datos['facultades'] = $this->facultad_model->getFacultad();
            $datos['carreras'] = $this->carrera_model->getCarreraByFacultad($row_tesis['facultad_id']);
            $datos['modalidades'] = $this->modalidad_model->getModalidad();
            $datos['title'] = 'Actualizar Registro';
            $datos['form'] = 'registro/editar/'.$id;
            $this->vistaForm($datos, $id, $row_registro);
        }
        else {
            redirect('login');
        }
    }
    
    // Eliminar registro
    public function borrar($alumno_id) {
        if ($this->session->userdata('categoria') == 'admin' || $this->session->userdata('categoria') == 'private') {
            $alumno = $this->alumno_model->getAlumnoByNombre($alumno_id);
            $alumnos = $this->alumno_model->getAlumnoTesisId($alumno['tesis_id']);
            if (count($alumnos) > 1) {
                $this->alumno_model->deleteAlumno($alumno_id);
            } else {
                $this->tesis_model->deleteTesis($alumno['tesis_id']);
            }
            redirect('registro');
        }
        else {
            redirect('login');
        }
    }
    
    public function pdf($alumno_id) {
        if ($this->session->userdata('categoria') == 'admin' || $this->session->userdata('categoria') == 'private') {
            $datos['alumno_id'] = $alumno_id;  
            $this->load->view('registro/reportePdf',$datos);
        }
        else {
            redirect('login');
        }
    }

    // Validaciones
    public function validaciones() {
        $config = array(
            array('field' => 'codigo','label' => 'Código','rules' => 'trim|required|is_numeric'),
            array('field' => 'apellidos','label' => 'Apellidos','rules' => 'trim|required'),
            array('field' => 'nombres','label' => 'Nombres','rules' => 'trim|required'),
            array('field' => 'titulo','label' => 'Titulo','rules' => 'trim|required'),
            array('field' => 'facultad','label' => 'Facultad','rules' => 'required'),
            array('field' => 'carrera','label' => 'Carrera','rules' => 'required'),
            array('field' => 'anio','label' => 'Año','rules' => 'trim|required|exact_length[4]|numeric|is_natural'),
            array('field' => 'paginas','label' => 'Páginas','rules' => 'trim|numeric|is_natural'),
            array('field' => 'valoracion','label' => 'Valoración','rules' => 'trim|numeric|is_natural'),
            array('field' => 'modalidad','label' => 'Modalidad','rules' => 'required')
        );
        return $config;
    }
    
    public function vistaForm($datos, $id = FALSE, $row_registro = FALSE) {
        $config = $this->validaciones();
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template/header', $datos);
            $this->load->view('template/backend');
            $this->load->view('registro/formularioRegistro',$datos);
            $this->load->view('template/footer');
        }
        else {
            $this->registro_model->setRegistro($id,$row_registro['tesis_id'],$row_registro['alumno_id']);
            redirect('registro');
        }
    }
}