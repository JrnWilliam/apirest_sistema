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

                    if(empty($_POST['clienteid']) || !is_numeric($_POST['clienteid']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'Error con el cliente o esta Vacio');
                        JSONRespuesta($respuesta,400);
                        die();
                    }
                    if(empty($_POST['productoid']) || !is_numeric($_POST['productoid']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'Error con el Producto o esta Vacio');
                        JSONRespuesta($respuesta,400);
                        die();
                    }
                    if(empty($_POST['frecuenciaid']) || !is_numeric($_POST['frecuenciaid']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'Error con la Frecuencia o esta Vacia');
                        JSONRespuesta($respuesta,400);
                        die();
                    }
                    if(empty($_POST['monto']) || !is_numeric($_POST['monto']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'Error en el Monto o esta vacio');
                        JSONRespuesta($respuesta,400);
                        die();
                    }
                    if(empty($_POST['cuotas']) || !is_numeric($_POST['cuotas']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'Error en las Cuotas o Esta Vacia');
                        JSONRespuesta($respuesta,400);
                        die();
                    }
                    if(empty($_POST['montocuotas']) || !is_numeric($_POST['montocuotas']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'Error en el Monto de la Cuota o esta Vacio');
                        JSONRespuesta($respuesta,400);
                        die();
                    }
                    if(empty($_POST['cargo']) || !is_numeric($_POST['cargo']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'Error en el Cargo o esta Vacio');
                        JSONRespuesta($respuesta,400);
                        die();
                    }
                    if(empty($_POST['saldo']) || !is_numeric($_POST['saldo']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'Error en el Saldo o esta Vacio');
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    $clienteid = LimpiarCadena($_POST['clienteid']);
                    $productoid = LimpiarCadena($_POST['productoid']);
                    $frecuenciaid = LimpiarCadena($_POST['frecuenciaid']);
                    $monto = LimpiarCadena($_POST['monto']);
                    $cuotas = LimpiarCadena($_POST['cuotas']);
                    $montocuotas = LimpiarCadena($_POST['montocuotas']);
                    $cargo = LimpiarCadena($_POST['cargo']);
                    $saldo = LimpiarCadena($_POST['saldo']);

                    $solicitud = $this->model->setCuenta($clienteid,$productoid,$frecuenciaid,$monto,$cuotas,$montocuotas,$cargo,$saldo);
                    
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