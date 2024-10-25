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
                    $_POST = json_decode(file_get_contents('php://input'),true);

                    if(empty($_POST['identificacion']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'La Identificacion es Requerida' );
                        JSONRespuesta($respuesta,200);
                        die();
                    }

                    if(!ValidarNombre($_POST['nombres']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Nombre no Contiene un Formato Correcto');
                        JSONRespuesta($respuesta,200);
                        die();
                    }

                    if(!ValidarNombre($_POST['apellidos']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Apellido no Contiene un Formato Correcto');
                        JSONRespuesta($respuesta,200);
                        die();
                    }

                    if(!ValidarNumero($_POST['telefono']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Formato del Numero es Invalido' );
                        JSONRespuesta($respuesta,200);
                        die();
                    }

                    if(!ValidarCorreo($_POST['email']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Formato del Correo es Invalido' );
                        JSONRespuesta($respuesta,200);
                        die();
                    }

                    if(empty($_POST['direccion']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'La Direccion es Requerida' );
                        JSONRespuesta($respuesta,200);
                        die();
                    }
                    $identificacion = $_POST['identificacion'];
                    $nombres = ucwords(strtolower($_POST['nombres']));
                    $apellidos = ucwords(strtolower($_POST['apellidos']));
                    $telefono = $_POST['telefono'];
                    $correo = strtolower($_POST['email']);
                    $direccion = $_POST['direccion'];
                    $nit = !empty($_POST['nit']) ? LimpiarCadena($_POST['nit']) : "";
                    $nfiscal = !empty($_POST['nombrefiscal']) ? LimpiarCadena($_POST['nombrefiscal']) : "";
                    $dirfiscal = !empty($_POST['direccionfiscal']) ? LimpiarCadena($_POST['direccionfiscal']) : "";

                    $solicitud = $this->model->setCliente($identificacion,$nombres,$apellidos,$telefono,$correo,$direccion,$nit,$nfiscal,$dirfiscal);
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