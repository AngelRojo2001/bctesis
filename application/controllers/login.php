<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->database();
    }
    
    // Metodo de inicio de login
    public function index() {
        $datos['title'] = 'Registrarse';
        $datos['form'] = 'login/new_user';
        switch ($this->session->userdata('categoria')) {
            case 'admin':
            case 'private':
                redirect('welcome');
                break;
            default:
                $datos['token'] = $this->token();
                $this->load->view('template/header', $datos);
                $this->load->view('login/inicio', $datos);
                $this->load->view('template/footer');
                break;
        }
    }
    
    public function new_user() {
        if ($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token')) {
            $this->form_validation->set_rules('usuario','Usuario','required|trim|min_length[2]|max_length[150]|xss_clean');
            $this->form_validation->set_rules('contrasena','Password','required|trim|min_length[5]|max_length[150]|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->index();
            }
            else {
                $usuario = $this->input->post('usuario');
                $contrasena = sha1($this->input->post('contrasena'));
                $check_user = $this->login_model->verificar($usuario,$contrasena);
                if ($check_user == true) {
                    $data = array(
                        'is_logued_in' => TRUE,
                        'id_usuario' => $check_user->id,
                        'categoria' => $check_user->categoria,
                        'usuario' => $check_user->login,
                    );
                    $this->session->set_userdata($data);
                    $this->index();
                }
            }
        }
        else {
            redirect('login');
        }
    }
    
    public function token() {
        $token = md5(uniqid(rand(),TRUE));
        $this->session->set_userdata('token',$token);
        return $token;
    }
    
    public function logout_ci() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
