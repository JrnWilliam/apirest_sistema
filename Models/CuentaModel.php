<?php
    class CuentaModel extends MYSQL
    {
        private $intClienteId;
        private $intProductoId;
        private $intFrecuenciaId;
        private $fltMonto;
        private $intCuotas;
        private $fltMontoCuotas;
        private $fltCargo;
        private $fltSaldo;

        public function __construct()
        {
            parent::__construct();
        }

        public function setCuenta(int $clienteid, int $productoid, int $frecuenciaid, float $monto, int $cuotas, float $montocuotas, float $cargo, float $saldo)
        {
            $this->intClienteId = $clienteid;
            $this->intProductoId = $productoid;
            $this->intFrecuenciaId = $frecuenciaid;
            $this->fltMonto = $monto;
            $this->intCuotas = $cuotas;
            $this->fltCargo = $cargo;
            $this->fltSaldo = $saldo;

            $sql ="";
        }
    }
?>