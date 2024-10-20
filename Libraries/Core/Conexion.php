<?php
    class Conexion
    {
        private $conexion;

        public function __construct()
        {
            if(CONEXION)
            {
                try
                {
                    $cadenaconexion = "mysql:host=".DB_HOST.";"."dbname=".DB_NAME.";"."charset=" .DB_CHARSET ;
    
                    $this->conexion = new PDO($cadenaconexion,DB_USER,DB_PASSWORD);
                    $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                }
                catch(PDOException $th)
                {
                    $this->conexion = null;
                    echo "Error: ".$th->getMessage();
                }
            }
        }

        public function Conectar()
        {
            return $this->conexion;
        }
    }
?>