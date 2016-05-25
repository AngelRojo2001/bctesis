<?php
class facultad_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Metodo para devolver datos de Facultad
    public function getFacultad($id = FALSE) {
        $this->db->select('id, nombre as facultad');
        $this->db->from('facultad');
        if ($id === FALSE) {
            // Devolver todos los datos de facultad
            $this->db->order_by('nombre','asc');
            $query = $this->db->get();
            return $query->result_array();
        }
        // Devuelve un dato de facultad
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    // Metodo para insertar datos a Facultad
    public function setFacultad($id = FALSE) {
        $facultad = array(
            'nombre' => $this->input->post('facultad')
        );
        if ($id === FALSE) {
            // Insertar datos
            return $this->db->insert('facultad',$facultad);
        }
        // Actualizar datos
        $this->db->where('id', $id);
        return $this->db->update('facultad',$facultad);
    }
    
    // Metodo para eliminar facultad
    public function deleteFacultad($id) {
        $this->db->where('id',$id);
        $this->db->delete('facultad');
    }
}