<?php
    class MovimientoModel extends MYSQL
    {
        private $strMovimiento;
        private $intTipoMovimiento;
        private $strDescripcion;

        public function __construct()
        {
            parent::__construct();
        }

        public function setTipoMovimiento(string $movimiento, int $tipomovimiento, string $descripcion)
        {
            $this->strMovimiento = $movimiento;
            $this->intTipoMovimiento = $tipomovimiento;
            $this->strDescripcion = $descripcion;

            $sql = "SELECT *FROM tipo_movimiento WHERE movimiento = : mov AND estatus = :sts";
            $parametro = array(":mov" => $this->strMovimiento, ":sts" => 1);
            $solicitud = $this->SeleccionarUnRegistro($sql,$parametro);
        }
    }
?>