<?php
    class Cliente extends Controllers
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function SeleccionarCliente($idcliente)
        {
            echo "Controlador Cliente" . $idcliente;
        }

        public function RegistroClientes()
        {
            try
            {
                $metodo = $_SERVER['REQUEST_METHOD'];
                if($metodo == "POST")
                {
                    echo "Se Realizo el Proceso Correctamente";
                }
                else
                {
                    echo "Error en La Solicitud";
                }
            }
            catch(Exception $e)
            {
                echo "Error en el Proceso: ". $e->getMessage();
            }
        }

        public function MostrarClientes()
        {
            echo "Registro de Clientes";
        }

        public function EliminarCliente($idcliente)
        {
            echo "Registro de Clientes" . $idcliente;
        }

        public function ActualizarCliente($idcliente)
        {
            echo "Registro de Clientes" . $idcliente;
        }
    }
?>