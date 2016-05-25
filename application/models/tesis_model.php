<?php

class tesis_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Metodo para devolver la tesis
    public function getTesis($id = FALSE) {
        if ($id === FALSE) {
        }
        // devolver una tesis
        $this->db->where('id',$id);
        $query = $this->db->get('tesis');
        return $query->row_array();
    }

    // Metodo para devolver tesis por Titulo
    public function getTesisByTituloExact() {
        $titulo = $this->input->post('titulo');
        $this->db->select('*');
        $this->db->from('tesis');
        $this->db->where('titulo', $titulo);
        $query = $this->db->get();
        return $query->row_array();
    }
        
    // Metodo para insertar tesis
    public function setTesis($id = FALSE) {
        $tesis = array(
            'titulo' => trim($this->input->post('titulo')),
            'tutor' => trim($this->input->post('tutor')),
            'anio' => $this->input->post('anio'),
            'paginas' => $this->input->post('paginas'),
            'nota' => $this->input->post('nota'),
            'facultad_id' => $this->input->post('facultad'),
            'carrera_id' => $this->input->post('carrera'),
            'modalidad_id' => $this->input->post('modalidad')
        );
        
        if ($id === FALSE) {
            // Insertando la tesis
            return $this->db->insert('tesis',$tesis);
        }
        // Actualizando la tesis
        $this->db->where('id', $id);
        return $this->db->update('tesis',$tesis);
    }
    
    // eliminar tesis
    public function deleteTesis($id) {
        $this->db->where('id',$id);
        return $this->db->delete('tesis');
    }
}