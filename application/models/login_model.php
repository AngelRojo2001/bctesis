<?php

class Login_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function verificar($usuario, $contrasena) {
        $this->db->where('login',$usuario);
        $this->db->where('password',$contrasena);
        $query = $this->db->get('usuario');
        if ($query->num_rows() == 1) {
            return $query->row();
        }
        else {
            $this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
            redirect('login');
        }
    }
}