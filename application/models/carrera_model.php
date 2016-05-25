<?php

class carrera_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Devuelve datos de carrera
    public function getCarrera($id = FALSE) {
        $this->db->select('id, nombre as carrera, facultad_id');
        $this->db->from('carrera');
        if ($id === FALSE) {
            $this->db->order_by('nombre','asc');
            $query = $this->db->get();
            return $query->result_array();
        }
        // Devuelve un dato de carrera
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function getCarreraByFacultad($facultad_id) {
        $this->db->select('id, nombre as carrera, facultad_id');
        $this->db->from('carrera');
        $this->db->where('facultad_id',$facultad_id);
        $this->db->order_by('nombre','asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Metodo para devolver datos de carrera y facultad
    public function getCarreraFacultad() {
        $this->db->select('c.id as id, c.nombre as carrera, f.nombre as facultad');
        $this->db->from('carrera c');
        $this->db->join('facultad f','f.id = c.facultad_id');
        $this->db->order_by('c.nombre','asc');
        $this->db->order_by('f.nombre','asc');
        $query = $this->db->get();
        return $query->result_array();
    }

	public function getByFacultadId($facultad_id) {
        $this->db->select('id, nombre as carrera, facultad_id');
        $this->db->from('carrera');
        $this->db->where('facultad_id',$facultad_id);
        $this->db->order_by('nombre','asc');
        $query = $this->db->get();
		return $query->result_array();
	}

    // Metodo para insertar datos en la carrera
    public function setCarrera($id = FALSE) {
        $carrera = array(
            'nombre' => $this->input->post('carrera'),
            'facultad_id' => $this->input->post('facultad')
        );
        if ($id === FALSE) {
            // Insertar datos en la carrera
            return $this->db->insert('carrera',$carrera);
        }
        // Actualizar datos de la carrera
        $this->db->where('id', $id);
        return $this->db->update('carrera',$carrera);
    }
    
    // Metodo para eliminar carrera
    public function deleteCarrera($id) {
        $this->db->where('id',$id);
        return $this->db->delete('carrera');
    }
}