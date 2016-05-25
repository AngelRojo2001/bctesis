<?php

class Usuario_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Devolver datos de usuario
    public function getUsuario($id = FALSE) {
        if ($id === FALSE) {
            // Devolver todos los usuarios
            $query = $this->db->query("SELECT id, nombre, apellido, login, password, categoria
                FROM usuario
                ORDER BY nombre ASC, apellido ASC");
            return $query->result_array();
        }
        $query = $this->db->query("SELECT id, nombre, apellido, login, password, categoria
            FROM usuario
            WHERE id = $id");
        return $query->row_array();
    }
    
    // Insertar datos a usuario
    public function setUsuario($id = FALSE) {
        if ($id === FALSE) {
            $usuario = array(
                'nombre' => $this->input->post('nombre'),
                'apellido' => $this->input->post('apellido'),
                'login' => $this->input->post('login'),
                'password' => sha1($this->input->post('login')),
                'categoria' => $this->input->post('categoria')
            );
            // Insertar nuevo usuario
            return $this->db->insert('usuario',$usuario);
        }
        $usuario = array(
            'nombre' => $this->input->post('nombre'),
            'apellido' => $this->input->post('apellido'),
            'categoria' => $this->input->post('categoria')
        );
        // Actualizar usuario
        $this->db->where('id', $id);
        return $this->db->update('usuario',$usuario);
    }

    // Insertar datos a usuario por perfil
    public function setUsuarioPerfil($id = FALSE) {
        $usuario = array(
            'nombre' => $this->input->post('nombre'),
            'apellido' => $this->input->post('apellido'),
            'password' => sha1($this->input->post('passwordN')),
        );
        // Actualizar usuario
        $this->db->where('id', $id);
        return $this->db->update('usuario',$usuario);
    }

    // Devolver datos de usuario por login
    public function getUsuarioByLogin($login) {
        $query = $this->db->query("SELECT id, nombre, apellido, login, password, categoria
            FROM usuario
            WHERE login = '$login'");
        return $query->row_array();
    }
    
    // eliminar usuario
    public function deleteUsuario($id) {
        $this->db->where('id',$id);
        return $this->db->delete('usuario');
    }

    public function getImpresion($usuario_id) {
        $this->db->where('usuario_id',$usuario_id);
        $query = $this->db->get('impresion');
        return $query->row_array();
    }
}