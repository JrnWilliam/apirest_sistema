<?php
    class Producto extends Controllers
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function SeleccionarProducto($idproducto)
        {
            echo "Extraer Producto " . $idproducto;
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

                    $codigo = LimpiarCadena($_POST['codigo']);
                    $nombre = ucwords(strtolower(LimpiarCadena($_POST['nombre'])));
                    $descripcion = ucwords(strtolower(LimpiarCadena($_POST['descripcion'])));
                    $precio = LimpiarCadena($_POST['precio']);

                    $solicitud = $this->model->setProducto($codigo, $nombre, $descripcion,$precio);

                    if($solicitud > 0)
                    {
                        $arrproducto = array('idproducto' => $solicitud, 'codigo' => $codigo, 'nombre' => $nombre, 'descripcion' => $descripcion, 'precio' => $precio);
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
        }

        Public function MostrarProductos()
        {
            echo "Mostrar Todos los Productos";
        }

        public function ActualizarProducto($idproducto)
        {
            echo "Producto Actualizado " . $idproducto;
        }

        public function EliminarProducto($idproducto)
        {
            echo "Producto Eliminado " . $idproducto;
        }
    }
?>