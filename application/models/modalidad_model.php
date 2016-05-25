<?php

class modalidad_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Metodo para devolver datos de la modalidad
    public function getModalidad($id = FALSE) {
        if ($id === FALSE) {
            // Devuelve todos los elementos de la tabla modalidad
            $query = $this->db->query("SELECT id, nombre as modalidad
                FROM modalidad
                ORDER BY nombre ASC");
            return $query->result_array();
        }
        // Devuelve un dato de Modalidad
        $query = $this->db->query("SELECT id, nombre as modalidad
            FROM modalidad
            WHERE id = $id");
        return $query->row_array();
    }
    
    // Metodo para ingresar datos a Modalidad
    public function setModalidad($id = FALSE) {
        $modalidad = array(
            'nombre' => $this->input->post('modalidad')
        );
        if ($id === FALSE) {
            // insertando nuevos datos a modalidad
            return $this->db->insert('modalidad',$modalidad);
        }
        // modificando el dato de modalidad
        $this->db->where('id', $id);
        return $this->db->update('modalidad',$modalidad);
    }
    
    // Metodo para eliminar una modilidad
    public function deleteModalidad($id) {
        $this->db->where('id',$id);
        return $this->db->delete('modalidad');
    }
}