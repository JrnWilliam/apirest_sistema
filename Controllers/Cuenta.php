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
            echo "Cuenta Registrada Correctamente";
        }
    }
?>