<?php

require_once('../Conexion/Conexion.php');
require_once('../Entidad/EntPersona.php');
class DaoPersonaModelo  extends  Conector
{
    function __construct()
    {
       parent::__construct();

    }
    public function consultarPersonas()
    {
        try {
            $this->query = 'SELECT ID,NOMBRES,APELLIDOS,CEDULA FROM PERSONA';
            $stmt = $this->getConexion($this->query);
            $stmt->execute();
            $rs = $stmt->get_result();
            while ($per =$rs->fetch_object() ) {
                $this->rows [] = new Persona($per->ID,$per->NOMBRES,$per->APELLIDOS,$per->CEDULA);

            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return $this->rows;
    }
    public function consultarPersona($id)
    {
        $persona='';
        try {
            $this->query = 'SELECT ID,NOMBRES,APELLIDOS,CEDULA FROM PERSONA WHERE ID=?';
            $stmt = $this->getConexion($this->query);
            $stmt->bind_param('i',$id);
            $stmt->execute();
            $rs = $stmt->get_result();
            while ($per =$rs->fetch_object() ) {
                $persona = new Persona($per->ID,$per->NOMBRES,$per->APELLIDOS,$per->CEDULA);

            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        return $persona;
    }
    public function crearPersona(Persona $persona)
    {
        try {
            $this->query = 'INSERT INTO PERSONA(NOMBRES,APELLIDOS,CEDULA) VALUES(?,?,?)';
            $stmt = $this->getConexion($this->query);
            $stmt->bind_param('sss',$persona->__get('nombres'),$persona->__get('apellidos'),$persona->__get('cedula'));
            $stmt->execute();
            if ($stmt->affected_rows) {
                return true;
            }
            
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }
    public function editarPersona(Persona $persona)
    {
        try {
            $this->query = 'UPDATE PERSONA SET NOMBRES=?,APELLIDOS=?,CEDULA=? WHERE ID=?';
            $stmt = $this->getConexion($this->query);
            $stmt->bind_param('sssi',$persona->__get('nombres'),$persona->__get('apellidos'),$persona->__get('cedula'),$persona->__get('id'));
            $stmt->execute();
            if ($stmt->affected_rows) {
                return true;
            }
            
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }
    public function eliminarPersona($id)
    {
        try {
            $this->query = 'DELETE FROM PERSONA WHERE ID=?';
            $stmt = $this->getConexion($this->query);
            $stmt->bind_param('i',$id);
            $stmt->execute();
            if ($stmt->affected_rows) {
                return true;
            }
            
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

}