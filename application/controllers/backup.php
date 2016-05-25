<?php

class Backup extends CI_Controller {
    private $ruta = '';
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->load->model('backup_model');
        $this->load->database();
    }
    
    public function index() {
        if ($this->session->userdata('categoria') == "admin") {
            $datos['title'] = 'Backup';
            $this->load->view('template/header', $datos);
            $this->load->view('template/backend');
            $this->load->view('backup/listarBackup', $datos);
            $this->load->view('template/footer');
        }
        else {
            redirect('login');
        }
    }
    
    public function exportar() {
        if ($this->session->userdata('categoria') == "admin") {
            $facultad = $this->backup_model->getTabla('facultad');
            $contenido = "";
            foreach ($facultad as $value) {
                $contenido .= "$value[id]|$value[nombre]¬";
            }
            write_file($this->ruta.'facultad.dat', $contenido);
            $carrera = $this->backup_model->getTabla('carrera');
            $contenido = "";
            foreach ($carrera as $value) {
                $contenido .= "$value[id]|$value[nombre]|$value[facultad_id]¬";
            }
            write_file($this->ruta.'carrera.dat', $contenido);
            $modalidad = $this->backup_model->getTabla('modalidad');
            $contenido = "";
            foreach ($modalidad as $value) {
                $contenido .= "$value[id]|$value[nombre]¬";
            }
            write_file($this->ruta.'modalidad.dat', $contenido);
            $alumno = $this->backup_model->getTabla('alumno');
            $contenido = "";
            foreach ($alumno as $value) {
                $contenido .= "$value[id]|$value[nombres]|$value[apellidos]|$value[tesis_id]¬";
            }
            write_file($this->ruta.'alumno.dat', $contenido);
            $carrera_alumno = $this->backup_model->getTabla('carrera_alumno');
            $contenido = "";
            foreach ($carrera_alumno as $value) {
                $contenido .= "$value[alumno_id]|$value[carrera_id]¬";
            }
            write_file($this->ruta.'carrera_alumno.dat', $contenido);
            $tesis = $this->backup_model->getTabla('tesis');
            $contenido = "";
            foreach ($tesis as $value) {
                $contenido .= "$value[id]|$value[titulo]|$value[tutor]|$value[anio]|$value[paginas]|$value[nota]|$value[carrera_id]|$value[facultad_id]|$value[modalidad_id]¬";
            }
            write_file($this->ruta.'tesis.dat', $contenido);
            $registro = $this->backup_model->getTabla('registro');
            $contenido = "";
            foreach ($registro as $value) {
                $contenido .= "$value[id]|$value[fecha_registro]|$value[codigo]|$value[tesis_id]|$value[alumno_id]|$value[usuario_id]¬";
            }
            write_file($this->ruta.'registro.dat', $contenido);
            $usuario = $this->backup_model->getTabla('usuario');
            $contenido = "";
            foreach ($usuario as $value) {
                $contenido .= "$value[id]|$value[nombre]|$value[apellido]|$value[login]|$value[password]|$value[categoria]¬";
            }
            write_file($this->ruta.'usuario.dat', $contenido);
            $impresion = $this->backup_model->getTabla('impresion');
            $contenido = "";
            foreach ($impresion as $value) {
                $contenido .= "$value[id]|$value[SetLeftMargin]|$value[SetTopMargin]|$value[SetRightMargin]|$value[apellidos]|$value[carrera]|$value[modalidad]|$value[fecha]|$value[fecha_dist]|$value[linea]|$value[usuario_id]¬";
            }
            write_file($this->ruta.'impresion.dat', $contenido);
            redirect('backup');
        }
        else {
            redirect('login');
        }
    }
    
    public function importar() {
        if ($this->session->userdata('categoria') == "admin") {
            $this->db->empty_table('facultad');
            $this->db->empty_table('modalidad');
            $this->db->empty_table('usuario');
            $facultad = read_file($this->ruta.'facultad.dat');
            $this->backup_model->setFacultad($facultad);
            $carrera = read_file($this->ruta.'carrera.dat');
            $this->backup_model->setCarrera($carrera);
            $modalidad = read_file($this->ruta.'modalidad.dat');
            $this->backup_model->setModalidad($modalidad);
            $usuario = read_file($this->ruta.'usuario.dat');
            $this->backup_model->setUsuario($usuario);
            $tesis = read_file($this->ruta.'tesis.dat');
            $this->backup_model->setTesis($tesis);
            $alumno = read_file($this->ruta.'alumno.dat');
            $this->backup_model->setAlumno($alumno);
            $carrera_alumno = read_file($this->ruta.'carrera_alumno.dat');
            $this->backup_model->setCarrera_alumno($carrera_alumno);
            $registro = read_file($this->ruta.'registro.dat');
            $this->backup_model->setRegistro($registro);
            $impresion = read_file($this->ruta.'impresion.dat');
            $this->backup_model->setImpresion($impresion);
            redirect('backup');
        }
        else {
            redirect('login');
        }
    }    
}
