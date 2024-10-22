<?php
    class Cliente extends Controllers
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function Seleccionarcliente($idcliente)
        {
            echo "Controlador Cliente" . $idcliente;
        }

        public function RegistroClientes()
        {
            echo "Registro de Clientes";
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