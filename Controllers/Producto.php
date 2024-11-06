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
            echo "Registro Exitoso";
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