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
                    echo "Registrar Producto";
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