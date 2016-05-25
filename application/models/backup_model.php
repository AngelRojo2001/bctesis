<?php

class Backup_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function getTabla($tabla) {
        $query = $this->db->get($tabla);
        return $query->result_array();
    }
    
    public function setFacultad($facultades) {
        $datos = array();
        $i = 0;
        $filas = explode('¬', $facultades);
        for ($i = 0; $i < count($filas)-1; $i++) {
            $columnas = explode('|', $filas[$i]);
            $datos[$i]['id'] = $columnas[0];
            $datos[$i]['nombre'] = $columnas[1];
        }
        $this->db->insert_batch('facultad',$datos);
    }
    
    public function setCarrera($carreras) {
        $datos = array();
        $i = 0;
        $filas = explode('¬', $carreras);
        for ($i = 0; $i < count($filas)-1; $i++) {
            $columnas = explode('|', $filas[$i]);
            $datos[$i]['id'] = $columnas[0];
            $datos[$i]['nombre'] = $columnas[1];
            $datos[$i]['facultad_id'] = $columnas[2];
        }
        $this->db->insert_batch('carrera',$datos);
    }
    
    public function setModalidad($modalidades) {
        $datos = array();
        $i = 0;
        $filas = explode('¬', $modalidades);
        for ($i = 0; $i < count($filas)-1; $i++) {
            $columnas = explode('|', $filas[$i]);
            $datos[$i]['id'] = $columnas[0];
            $datos[$i]['nombre'] = $columnas[1];
        }
        $this->db->insert_batch('modalidad',$datos);
    }
    
    public function setUsuario($usuarios) {
        $datos = array();
        $i = 0;
        $filas = explode('¬', $usuarios);
        for ($i = 0; $i < count($filas)-1; $i++) {
            $columnas = explode('|', $filas[$i]);
            $datos[$i]['id'] = $columnas[0];
            $datos[$i]['nombre'] = $columnas[1];
            $datos[$i]['apellido'] = $columnas[2];
            $datos[$i]['login'] = $columnas[3];
            $datos[$i]['password'] = $columnas[4];
            $datos[$i]['categoria'] = $columnas[5];
        }
        $this->db->insert_batch('usuario',$datos);
    }
    
    public function setTesis($tesis) {
        $datos = array();
        $i = 0;
        $filas = explode('¬', $tesis);
        for ($i = 0; $i < count($filas)-1; $i++) {
            $columnas = explode('|', $filas[$i]);
            $datos[$i]['id'] = $columnas[0];
            $datos[$i]['titulo'] = $columnas[1];
            $datos[$i]['tutor'] = $columnas[2];
            $datos[$i]['anio'] = $columnas[3];
            $datos[$i]['paginas'] = $columnas[4];
            $datos[$i]['nota'] = $columnas[5];
            $datos[$i]['carrera_id'] = $columnas[6];
            $datos[$i]['facultad_id'] = $columnas[7];
            $datos[$i]['modalidad_id'] = $columnas[8];
        }
        $this->db->insert_batch('tesis',$datos);
    }
    
    public function setAlumno($alumnos) {
        $datos = array();
        $i = 0;
        $filas = explode('¬', $alumnos);
        for ($i = 0; $i < count($filas)-1; $i++) {
            $columnas = explode('|', $filas[$i]);
            $datos[$i]['id'] = $columnas[0];
            $datos[$i]['nombres'] = $columnas[1];
            $datos[$i]['apellidos'] = $columnas[2];
            $datos[$i]['tesis_id'] = $columnas[3];
        }
        $this->db->insert_batch('alumno',$datos);
    }
    
    public function setCarrera_alumno($carrera_alumno) {
        $datos = array();
        $i = 0;
        $filas = explode('¬', $carrera_alumno);
        for ($i = 0; $i < count($filas)-1; $i++) {
            $columnas = explode('|', $filas[$i]);
            $datos[$i]['alumno_id'] = $columnas[0];
            $datos[$i]['carrera_id'] = $columnas[1];
        }
        $this->db->insert_batch('carrera_alumno',$datos);
    }
    
    public function setRegistro($registros) {
        $datos = array();
        $i = 0;
        $filas = explode('¬', $registros);
        for ($i = 0; $i < count($filas)-1; $i++) {
            $columnas = explode('|', $filas[$i]);
            $datos[$i]['id'] = $columnas[0];
            $datos[$i]['fecha_registro'] = $columnas[1];
            $datos[$i]['codigo'] = $columnas[2];
            $datos[$i]['tesis_id'] = $columnas[3];
            $datos[$i]['alumno_id'] = $columnas[4];
            $datos[$i]['usuario_id'] = $columnas[5];
        }
        $this->db->insert_batch('registro',$datos);
    }
    
    public function setImpresion($impresion) {
        $datos = array();
        $i = 0;
        $filas = explode('¬', $impresion);
        for ($i = 0; $i < count($filas)-1; $i++) {
            $columnas = explode('|', $filas[$i]);
            $datos[$i]['id'] = $columnas[0];
            $datos[$i]['SetLeftMargin'] = $columnas[1];
            $datos[$i]['SetTopMargin'] = $columnas[2];
            $datos[$i]['SetRightMargin'] = $columnas[3];
            $datos[$i]['apellidos'] = $columnas[4];
            $datos[$i]['carrera'] = $columnas[5];
            $datos[$i]['modalidad'] = $columnas[6];
            $datos[$i]['fecha'] = $columnas[7];
            $datos[$i]['fecha_dist'] = $columnas[8];
            $datos[$i]['linea'] = $columnas[9];
            $datos[$i]['usuario_id'] = $columnas[10];
        }
        $this->db->insert_batch('impresion',$datos);
    }
}
