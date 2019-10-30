<?php
abstract class Conector
{
    private static $db_host;
    private static $db_user;
    private static $db_pass;
    private static $db_port;
    protected $query;
    protected $conn;
    protected $rows;
    protected $db_name;

    function __construct()
    {
        self::$db_host ='Localhost';
        self::$db_user = 'root';
        self::$db_pass = '';
        self::$db_port = '3306';
        $this->query ='';
        $this->conn = '';
        $this->db_name = 'escuela';
        $this->rows = array();
    }

    private function abrirConexion()
    {
        try {
            $this->conn = new msqli(self::$db_host,self::$db_user,self::$db_pass,$this->db_name,self::$db_port);
            if ($this->conn->connect_errno) {
                echo 'Fallo la conexion con mysql';
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }
    public function getConexion()
    {
        $this->abrirConexion();
        return $this->conn;
    }
     
}