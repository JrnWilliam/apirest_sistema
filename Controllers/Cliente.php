<?php
    class Cliente extends Controllers
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function SeleccionarCliente($idcliente)
        {
            try
            {
                $metodo = $_SERVER['REQUEST_METHOD'];
                $respuesta = [];

                if($metodo == "GET")
                {
                    if(empty($idcliente) or !is_numeric($idcliente))
                    {
                        $respuesta = array('status' => false , 'msg' => 'Error en los Parametros');
                        JSONRespuesta($respuesta,400);
                        die();
                    }
                    $parametros = $this->model->getCliente($idcliente);
                    if(empty($parametros))
                    {
                        $respuesta = array('status' => false, 'msg' => 'Registro no Encontrado');
                    }
                    else
                    {
                        $respuesta = array('status' => true, 'msg' => 'Datos Encontrados', 'data' => $parametros);
                    }
                    $codigo = 200;
                }
                else
                {
                    $respuesta = array('status' => false, 'msg' => 'Error en la Solicitud' . $metodo);
                    $codigo = 400;
                }
                JSONRespuesta($respuesta,$codigo);
            }
            catch (Exception $e)
            {
                echo "Error en el Proceso ". $e->getMessage();
            }
            die();
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
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    if(!ValidarNombre($_POST['nombres']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Nombre no Contiene un Formato Correcto');
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    if(!ValidarNombre($_POST['apellidos']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Apellido no Contiene un Formato Correcto');
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    if(!ValidarNumero($_POST['telefono']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Formato del Numero es Invalido' );
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    if(!ValidarCorreo($_POST['email']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Formato del Correo es Invalido' );
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    if(empty($_POST['direccion']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'La Direccion es Requerida' );
                        JSONRespuesta($respuesta,400);
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

                    if($solicitud > 0)
                    {
                        $arrCliente = array('idcliente' => $solicitud,'identificacion'=>$identificacion,'nombres'=>$nombres,'apellidos'=>$apellidos,'telefono'=>$telefono,'email'=>$correo,'direccion'=>$direccion,'nit'=>$nit,'nombrefiscal'=>$nfiscal,'direccionfiscal'=>$nfiscal);

                        $respuesta = array('status' => true, 'msg' => 'Datos Guardados Correctamente', 'data' => $arrCliente);
                        $codigo = 200;
                    }
                    else
                    {
                        $respuesta = array('status' => false, 'msg' => 'Identificación o el Correo ya Existen', $metodo);
                        $codigo = 400;
                    }
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
            try
            {
                $metodo = $_SERVER['REQUEST_METHOD'];
                $respuesta = [];

                if($metodo == "GET")
                {
                    $parametros = $this->model->getClientes();
                    if(empty($parametros))
                    {
                        $respuesta = array('status'=> true, 'msg' => 'No hay Datos para Mostrar');
                    }
                    else
                    {
                        $respuesta = array('status'=> true, 'msg' => 'Datos Encontrados' , 'data' => $parametros);
                    }
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
            catch (Exception $e)
            {
                echo "Error en el Proceso " . $e->getMessage();

            }
            die();
        }

        public function EliminarCliente($idcliente)
        {
            try
            {
                $metodo = $_SERVER['REQUEST_METHOD'];
                $respuesta = [];

                if($metodo == "DELETE")
                {
                    if(empty($idcliente) || !is_numeric($idcliente))
                    {
                        $respuesta = array('status' => false, 'msg' => 'Error en los Parametros');
                        JSONRespuesta($respuesta,400);
                        die();
                    }
                    $codigo = 200;   
                }
                else
                {
                    $respuesta = array('status' => false, 'msg' => 'Error en la Solicitud' . $metodo);
                    $codigo = 400;
                }
                JSONRespuesta($respuesta,$codigo);
                die();
            }
            catch (Exception $e)
            {
                echo "Error en el Proceso: " . $e->getMessage();
            }
            die();
        }

        public function ActualizarCliente($idcliente)
        {
            try
            {
                $metodo = $_SERVER['REQUEST_METHOD'];
                $respuesta = [];

                if($metodo == "PUT")
                {
                    $parametros = json_decode(file_get_contents('php://input'),true);

                    if(empty($idcliente) || !is_numeric($idcliente))
                    {
                        $respuesta = array('status' => false, 'msg' => 'Error en los Parametros');
                        $codigo = 400;

                        JSONRespuesta($respuesta,$codigo);
                        die();
                    }
                    if(empty($parametros['identificacion']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'La Identificacion es Requerida' );
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    if(empty($parametros['nombres']) || !ValidarNombre($parametros['nombres']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Nombre no Contiene un Formato Correcto');
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    if(empty($parametros['apellidos']) or !ValidarNombre($parametros['apellidos']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Apellido no Contiene un Formato Correcto');
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    if(empty($parametros['telefono']) || !ValidarNumero($parametros['telefono']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Formato del Numero es Invalido' );
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    if(!ValidarCorreo($parametros['email']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Formato del Correo es Invalido' );
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    if(empty($parametros['direccion']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'La Direccion es Requerida' );
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    $identificacion = $parametros['identificacion'];
                    $nombres = ucwords(strtolower($parametros['nombres']));
                    $apellidos = ucwords(strtolower($parametros['apellidos']));
                    $telefono = $parametros['telefono'];
                    $correo = strtolower($parametros['email']);
                    $direccion = $parametros['direccion'];
                    $nit = !empty($parametros['nit']) ? LimpiarCadena($parametros['nit']) : "";
                    $nfiscal = !empty($parametros['nombrefiscal']) ? LimpiarCadena($parametros['nombrefiscal']) : "";
                    $dirfiscal = !empty($parametros['direccionfiscal']) ? LimpiarCadena($parametros['direccionfiscal']) : "";

                    $validarCliente = $this->model->getCliente($idcliente);
                    if(empty($validarCliente))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Cliente no Existe');
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    $solicitud = $this->model->putCliente($idcliente,$identificacion,$nombres,$apellidos,$telefono,$correo,$direccion,$nit,$nfiscal,$dirfiscal);

                    if($solicitud)
                    {
                        $arrCliente = array('idcliente' => $idcliente, 'identificacion' => $identificacion, 'nombres' => $nombres, 'apellidos' => $apellidos, 'telefono' => $telefono, 'email' => $correo, 'direccion' => $direccion, 'nit' => $nit, 'nombrefiscal' =>$nfiscal, 'direccionfiscal' => $dirfiscal);

                        $respuesta = array('status' => true, 'msg' => 'Datos Actualizados Correctamente', 'data' => $arrCliente);
                        $codigo = 200;
                    }
                    else
                    {
                        $respuesta = array('status' => true, 'msg' => 'El Correo o la Identificación ya Existen');
                        $codigo = 400;
                    }
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
                echo "Error en el Proceso: " . $e->getMessage();
            }
            die();
        }
    }
?>