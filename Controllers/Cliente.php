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
                $respuesta = [];

                if($metodo == "POST")
                {
                    $respuesta = array('status' => true, 'msg' => 'Datos Guardados Correctamente' );
                    $codigo = 200;
                }
                else
                {
                    $respuesta = array('status' => false, 'msg' => 'Error en la Solicitud ' . $metodo);
                    $codigo = 400;
                }
                JSONRespuesta($respuesta,$codigo);
                die();
            }
            catch(Exception $e)
            {
                echo "Error en el Proceso: ". $e->getMessage();
            }
            die();
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