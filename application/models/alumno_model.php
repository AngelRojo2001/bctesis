<?php

class Alumno_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Metodo para devolver Alumno
    public function getAlumnoByNombre($id = FALSE) {
        $nombres = $this->input->post('nombres');
        $apellidos = $this->input->post('apellidos');
        if ($id === FALSE) {
            $this->db->where('nombres',$nombres);
            $this->db->where('apellidos',$apellidos);
            $query = $this->db->get('alumno');
            return $query->row_array();
        }
        /*$query = $this->db->query("SELECT id, nombres, apellidos, tesis_id
            FROM alumno
            WHERE nombres = '$nombres' AND apellidos='$apellidos'");*/
        $this->db->where('id',$id);
        $query = $this->db->get('alumno');
        return $query->row_array();
    }

    // Metodo para generar el pdf
    public function getAlumnoAll($id) {
        $this->db->select('a.apellidos as apellidos, a.nombres as nombres, f.nombre as facultad, c.nombre as carrera, m.nombre as modalidad, t.titulo as titulo');
        $this->db->from('alumno a');
        $this->db->join('tesis t','t.id = a.tesis_id');
        $this->db->join('facultad f','f.id = t.facultad_id');
        $this->db->join('carrera c','c.id = t.carrera_id');
        $this->db->join('modalidad m','m.id = t.modalidad_id');
        $this->db->where('a.id',$id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getAlumnoTesisId($tesis_id) {
        $this->db->where('tesis_id',$tesis_id);
        $query = $this->db->get('alumno');
        return $query->result_array();
    }

    // Metodo para insertar en la tabla carrera_alumno
    public function setAlumnoCarrera($carrera_id, $alumno_id) {
        $alumno = array(
            'alumno_id' => $alumno_id,
            'carrera_id' => $carrera_id
        );
        return $this->db->insert('carrera_alumno',$alumno);
    }
    
    // Metodo para actualizar carrera_alumno
    public function setAlumnoCarreraUpdate($carrera_id, $alumno_id) {
        $alumno = array(
            'alumno_id' => $alumno_id,
            'carrera_id' => $this->input->post('carrera')
        );
        $this->db->where('alumno_id',$alumno_id);
        $this->db->where('carrera_id',$carrera_id);
        return $this->db->update('carrera_alumno',$alumno);
    }

    // Metodo para insertar alumno
    public function setAlumno($tesis_id, $id = FALSE) {
        $alumno = array(
            'nombres' => trim($this->input->post('nombres')),
            'apellidos' => trim($this->input->post('apellidos')),
            'tesis_id' => $tesis_id
        );
        if ($id === FALSE) {
            // Insertando alumno
            return $this->db->insert('alumno',$alumno);
        }
        // Actualizando alumno
        $this->db->where('id',$id);
        return $this->db->update('alumno',$alumno);
    }
    
    public function deleteAlumno($id) {
        $this->db->where('id',$id);
        $this->db->delete('alumno');
    }
}