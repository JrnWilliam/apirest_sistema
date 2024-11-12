<?php
    class Producto extends Controllers
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function SeleccionarProducto($idproducto)
        {
            try
            {
                $metodo = $_SERVER['REQUEST_METHOD'];
                $respuesta = [];

                if($metodo == "GET")
                {
                    if(empty($idproducto) OR !is_numeric($idproducto))
                    {
                        $respuesta = array('status' => false, 'msg' => "Error en los Parametros");
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    $solicitud = $this->model->getProducto($idproducto);
                    if(empty($solicitud))
                    {
                        $respuesta = array('status' => false, 'msg' => 'Registro no Encontrado');
                        $codigo = 400;
                    }
                    else
                    {
                        $respuesta = array('status' => true, 'msg' => 'Registro Obtenido Correctamente', 'data' => $solicitud);
                        $codigo = 200;
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
            catch (Exception $e)
            {
                echo "Error en el Proceso " . $e->getMessage();
            }
            die();
        }

        public function RegistrarProducto()
        {
            try
            {
                $metodo = $_SERVER['REQUEST_METHOD'];
                $respuesta = [];

                if($metodo == "POST")
                {
                    $_POST = json_decode(file_get_contents('php://input'),true);

                    if(empty($_POST['codigo']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Codigo es Requerido');
                        JSONRespuesta($respuesta,400);
                        die();
                    }
                    if(empty($_POST['nombre']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Nombre del Producto es Requerido');
                        JSONRespuesta($respuesta,400);
                        die();
                    }
                    if(empty($_POST['descripcion']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'La Descripción del Producto es Requerida');
                        JSONRespuesta($respuesta,400);
                        die();
                    }
                    if(empty($_POST['precio']) or !is_numeric($_POST['precio']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El precio del Producto es Requerido');
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    $strcodigo = LimpiarCadena($_POST['codigo']);
                    $nombre = ucwords(strtolower(LimpiarCadena($_POST['nombre'])));
                    $descripcion = ucwords(strtolower(LimpiarCadena($_POST['descripcion'])));
                    $precio = LimpiarCadena($_POST['precio']);

                    $solicitud = $this->model->setProducto($strcodigo, $nombre, $descripcion,$precio);

                    if($solicitud > 0)
                    {
                        $arrproducto = array('idproducto' => $solicitud, 'codigo' => $strcodigo, 'nombre' => $nombre, 'descripcion' => $descripcion, 'precio' => $precio);
                        $respuesta = array('status' => true, 'msg' => 'Datos Guardados Correctamente', 'data' => $arrproducto);
                        $codigo = 200;
                    }
                    else
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Codigo ya Existe');
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
            catch (Exception $e)
            {
                echo "Error en el Proceso " . $e->getMessage();
            }
            die();
        }

        Public function MostrarProductos()
        {
            try
            {
                $metodo = $_SERVER['REQUEST_METHOD'];
                $respuesta = [];

                if($metodo == "GET")
                {
                    $solicitud = $this->model->getProductos();
                    if(empty($solicitud))
                    {
                        $respuesta = array('status' => true, 'msg' => 'No hay Datos Para Mostrar');
                    }
                    else
                    {
                        $respuesta = array('status' => true, 'msg' => 'Datos Encontrados', 'Data' => $solicitud);
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

        public function ActualizarProducto($idproducto)
        {
            try
            {
                $metodo = $_SERVER['REQUEST_METHOD'];
                $respuesta = [];

                if($metodo == "PUT")
                {
                    $parametro = json_decode(file_get_contents('php://input'),true);

                    if(empty($idproducto) or !is_numeric($idproducto))
                    {
                        $respuesta = array('status' => false, 'msg' => 'Error en los Parametros');
                        JSONRespuesta($respuesta,400);
                        die();
                    }
                    if(empty($parametro['codigo']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'Codigo del Producto es Requerido');
                        JSONRespuesta($respuesta,400);
                        die();
                    }
                    if(empty($parametro['nombre']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Nombre del Producto es Requerido');
                        JSONRespuesta($respuesta,400);
                        die();
                    }
                    if(empty($parametro['descripcion']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'La Descripción es Requerida');
                        JSONRespuesta($respuesta, 400);
                        die();
                    }
                    if(empty($parametro['precio']))
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Precio es Requerido');
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    $strcodigo = LimpiarCadena($parametro['codigo']);
                    $nombre = ucwords(strtolower(LimpiarCadena($parametro['nombre'])));
                    $descripcion = ucwords(strtolower(LimpiarCadena($parametro['descripcion'])));
                    $precio = LimpiarCadena($parametro['precio']);
                    
                    $obtenerProducto = $this->model->getproducto($idproducto);
                    if(empty($obtenerProducto))
                    {
                        $respuesta = array('status' => false, 'msg' => "El Registro no Existe");
                        JSONRespuesta($respuesta,400);
                        die();
                    }

                    $solicitud = $this->model->putProducto($idproducto,$strcodigo,$nombre,$descripcion,$precio);
                    if($solicitud)
                    {
                        $arrproducto = array('idproducto' => $idproducto, 'codigo' => $strcodigo, 'nombre' => $nombre, 'descripcion' => $descripcion, 'precio' => $precio);
                        $respuesta = array('status' => true, 'msg' => 'Datos Actualizados Correctamente', 'data' => $arrproducto);
                        $codigo = 200;
                    }
                    else
                    {
                        $respuesta = array('status' => false, 'msg' => 'El Codigo ya Existe');
                        $codigo = 400;
                    }
                }
                else
                {
                    $respuesta = array('status' => false, 'msg' => 'Error en la Solicitud ' . $metodo);
                    $codigo = 400;
                }
                JSONRespuesta($respuesta, $codigo);
                die();
            }
            catch (Exception $e)
            {
                echo "Error en el Proceso " . $e->getMessage();
            }
            die();
        }

        public function EliminarProducto($idproducto)
        {
            echo "Producto Eliminado " . $idproducto;
        }
    }
?>