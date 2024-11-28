<?php
    class Cuenta extends Controllers
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function SeleccionarCuenta($idcuenta)
        {
            echo "Cuenta {$idcuenta} Seleccionada Correctamente";
        }

        public function MostrarCuentas()
        {
            echo "Mostrar Todas las Cuentas";
        }

        public function RegistrarCuenta()
        {
            try
            {
                $metodo = $_SERVER['REQUEST_METHOD'];
                $respuesta = [];

                if($metodo=="POST")
                {
                    $_POST = json_decode(file_get_contents('php://input'),true);

                    if(empty($_POST['']))
                    echo "Registro Exitoso";
                    $codigo = 200;
                }
                else
                {
                    $respuesta = array('status' =>false, 'msg' => 'Error en la Solicitud ' . $metodo);
                    $codigo = 400;
                }
                JSONRespuesta($respuesta,$codigo);
                die();
            }
            catch(Exception $e)
            {
                echo "Error en el Proceso " .$e->getMessage();
            }
            die();
        }
    }
?>