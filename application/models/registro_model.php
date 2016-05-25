<?php

class Registro_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Devolver datos del registro
    public function getRegistro($id = FALSE) {
        if ($id === FALSE) {
            // devuelve todos los registros
            $this->db->select('r.id as id, r.codigo as codigo, r.alumno_id as alumno_id, a.nombres as nombres, a.apellidos as apellidos, t.id as tesis_id, t.titulo as titulo,t.anio as anio, c.nombre as carrera');
            $this->db->from('registro r');
            $this->db->join('alumno a','a.id = r.alumno_id');
            $this->db->join('tesis t','t.id = r.tesis_id');
            $this->db->join('carrera c','c.id = t.carrera_id');
            $this->db->order_by('r.fecha_registro','desc');
            $this->db->limit(5);
            $query = $this->db->get();
            return $query->result_array();
        }
        // retornar un dato de registro
        $this->db->where('id',$id);
        $query = $this->db->get('registro');
        return $query->row_array();
    }
    
    // Metodo de insertar el registro
    public function setRegistro($id = FALSE, $tesis_id = FALSE, $alumno_id = FALSE) {
        if ($id === FALSE) {
            // Insertando registro
            $this->tesis_model->setTesis();
            $row_tesis = $this->tesis_model->getTesisByTituloExact();
            $this->alumno_model->setAlumno($row_tesis['id']);
            $row_alumno = $this->alumno_model->getAlumnoByNombre();
            $this->alumno_model->setAlumnoCarrera($row_tesis['carrera_id'],$row_alumno['id']);
            $registro = $this->arrayRegistro($row_tesis, $row_alumno);
            return $this->db->insert('registro',$registro);
        }
        // Actualizando registro
        $row_tesis = $this->tesis_model->getTesis($tesis_id);
        $alumnos = $this->alumno_model->getAlumnoTesisId($tesis_id);
        foreach ($alumnos as $value) {
            $this->alumno_model->setAlumnoCarreraUpdate($row_tesis['carrera_id'],$value['id']);
            # code...
        }
        //$this->alumno_model->setAlumnoCarreraUpdate($row_tesis['carrera_id'],$alumno_id);
        $this->tesis_model->setTesis($tesis_id);
        $this->alumno_model->setAlumno($tesis_id,$alumno_id);
        $row_alumno = $this->alumno_model->getAlumnoByNombre($alumno_id);
        $registro = $this->arrayRegistro($row_tesis, $row_alumno);
        $this->db->where('id', $id);
        return $this->db->update('registro',$registro);
    }

    // Insertando registro
    public function setRegistroAlumno() {
        $row_tesis = $this->tesis_model->getTesis($this->input->post('tesis_id'));
        $this->alumno_model->setAlumno($row_tesis['id']);
        $row_alumno = $this->alumno_model->getAlumnoByNombre();
        $this->alumno_model->setAlumnoCarrera($row_tesis['carrera_id'],$row_alumno['id']);
        $registro = array(
            'fecha_registro' => date('Y-m-d H:i:s'),
            'codigo' => $this->input->post('codigo'),
            'tesis_id' => $this->input->post('tesis_id'),
            'alumno_id' => $row_alumno['id'],
            'usuario_id' => $this->session->userdata('id_usuario'),
        );
        return $this->db->insert('registro',$registro);
    }

    // Metodo para devolver datos por codigo
    public function getRegistroByCodigo($codigo) {
        $this->db->select('r.id as id, r.codigo as codigo, r.alumno_id as alumno_id, a.apellidos as apellidos, a.nombres as nombres, t.titulo as titulo, c.nombre as carrera, t.id as tesis_id, t.anio as anio');
        $this->db->from('registro r');
        $this->db->join('alumno a','a.id = r.alumno_id');
        $this->db->join('tesis t','t.id = r.tesis_id');
        $this->db->join('carrera c','c.id = t.carrera_id');
        $this->db->where('r.codigo',$codigo);
        $this->db->order_by('r.codigo','asc');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Metodo para devolver datos por titulo
    public function getRegistroByTitulo($titulo) {
        $this->db->select('r.id as id, r.codigo as codigo, r.alumno_id as alumno_id, a.apellidos as apellidos, a.nombres as nombres, t.titulo as titulo, c.nombre as carrera, t.id as tesis_id, t.anio as anio');
        $this->db->from('registro r');
        $this->db->join('alumno a','a.id = r.alumno_id');
        $this->db->join('tesis t','t.id = r.tesis_id');
        $this->db->join('carrera c','c.id = t.carrera_id');
        $this->db->like('t.titulo',$titulo);
        $this->db->order_by('t.titulo','asc');
        $this->db->limit(20);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Metodo para devolver datos por autor
    public function getRegistroByAutor($autor) {
        $this->db->select('r.id as id, r.codigo as codigo, r.alumno_id as alumno_id, a.apellidos as apellidos, a.nombres as nombres, t.titulo as titulo, c.nombre as carrera, t.id as tesis_id, t.anio as anio');
        $this->db->from('registro r');
        $this->db->join('alumno a','a.id = r.alumno_id');
        $this->db->join('tesis t','t.id = r.tesis_id');
        $this->db->join('carrera c','c.id = t.carrera_id');
        $this->db->like('a.apellidos',$autor);
        $this->db->or_like('a.nombres',$autor);
        $this->db->order_by('a.apellidos','asc');
        $this->db->order_by('a.nombres','asc');
        $this->db->limit(20);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Metodo para devolver datos por carrera
    public function getRegistroByCarrera($carrera_id, $anio) {
        $this->db->select("a.apellidos as apellidos, a.nombres as nombres, t.titulo as titulo, t.tutor as tutor, t.anio as anio, t.nota as nota, t.paginas as paginas, DATE(r.fecha_registro) as fecha_registro, m.nombre as modalidad");
        $this->db->from('registro r');
        $this->db->join('alumno a','a.id = r.alumno_id');
        $this->db->join('tesis t','t.id = r.tesis_id');
        $this->db->join('modalidad m','m.id = t.modalidad_id');
        $this->db->where('t.carrera_id',$carrera_id);
        $this->db->where('t.anio',$anio);
        $this->db->order_by('a.apellidos','asc');
        $this->db->order_by('a.nombres','asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    // devolver registro por año
    public function getRegistroByAnio($anio) {
        $this->db->select("f.nombre as facultad, c.nombre as carrera, MONTH(r.fecha_registro) as mes, COUNT(DISTINCT t.titulo) as cantidad");
        $this->db->from('facultad f');
        $this->db->join('carrera c','c.facultad_id = f.id');
        $this->db->join('tesis t','t.carrera_id = c.id');
        $this->db->join('registro r','r.tesis_id = t.id');
        $this->db->where('YEAR(r.fecha_registro)',$anio);
        $this->db->group_by('c.nombre');
        $this->db->group_by('MONTH(fecha_registro)');
        $this->db->order_by('f.nombre','asc');
        $this->db->order_by('c.nombre','asc');
        $this->db->order_by('mes','asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getRegistroByMesAnio($mes, $anio) {
        $this->db->select("f.nombre as facultad, r.codigo as codigo, t.titulo as titulo, a.nombres as nombres, a.apellidos as apellidos, c.nombre as carrera, t.anio as anio, DATE(r.fecha_registro) as fecha");
        $this->db->from('facultad f');
        $this->db->join('carrera c', 'c.facultad_id = f.id');
        $this->db->join('tesis t','t.carrera_id = c.id');
        $this->db->join('alumno a','a.tesis_id = t.id');
        $this->db->join('registro r','r.tesis_id = t.id');
        $this->db->where('MONTH(r.fecha_registro)',$mes);
        $this->db->where('YEAR(r.fecha_registro)',$anio);
        $this->db->order_by('a.apellidos','asc');
        $this->db->order_by('a.nombres','asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getEstadisticoByFacultad($facultad_id, $anio) {
        $this->db->select("c.nombre as facultad, COUNT(DISTINCT t.titulo) as cantidad");
        $this->db->from('carrera c');
        $this->db->join('tesis t','t.carrera_id = c.id');
        $this->db->join('registro r','r.tesis_id = t.id');
        $this->db->where('c.facultad_id',$facultad_id);
        $this->db->where('t.anio',$anio);
        $this->db->group_by('c.nombre');
        $this->db->order_by('c.nombre','asc');
        $query = $this->db->get();
        return $query;
    }
    
    public function getEstadisticoByAnio($anio, $mes = NULL) {
        $this->db->select("f.nombre as facultad, COUNT(DISTINCT t.titulo) as cantidad");
        $this->db->from('facultad f');
        $this->db->join('carrera c','c.facultad_id = f.id');
        $this->db->join('tesis t','t.carrera_id = c.id');
        $this->db->join('registro r','r.tesis_id = t.id');
        $this->db->where('YEAR(r.fecha_registro)',$anio);
        if ($mes !== NULL) {
            $this->db->where('MONTH(r.fecha_registro)',$mes);
        }
        $this->db->group_by('f.nombre');
        $this->db->order_by('f.nombre','asc');
        $query = $this->db->get();
        return $query;
    }
    
    // Metodo para eliminar registro
    public function deleteRegistro($id) {
        $row_registro = $this->getRegistro($id);
        $this->tesis_model->deleteTesis($row_registro['tesis_id']);
    }
    
    public function arrayRegistro($row_tesis, $row_alumno) {
        $registro = array(
            'fecha_registro' => date('Y-m-d H:i:s'),
            'codigo' => $this->input->post('codigo'),
            'tesis_id' => $row_tesis['id'],
            'alumno_id' => $row_alumno['id'],
            'usuario_id' => $this->session->userdata('id_usuario'),
        );
        return $registro;
    }
}