<?php 
    class Conexion{
        private $host   = "localhost";
        private $user   = "root";
        private $pass   = "";
        private $db     = "crud_usuarios";
        private $conect;

        public function __construct(){
            $conectString = "mysql:hos=".$this->host.";dbname=".$this->db.";charset=utf8";

            try{
                $this->conect = new PDO($conectString, $this->user, $this->pass);
                $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "conexion exitosa";
            }catch( Exception $e){
                $this->conect = "Error de conexión";
                echo "ERROR: " . $e->getMessage();
            }
        }

        public function connect(){
            return $this->conect;
        }
    }

    
    //$conect = new Conexion();

?>