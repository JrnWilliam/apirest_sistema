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

            $sql = "SELECT *FROM tipo_movimiento WHERE movimiento = :mov AND estatus = :sts";
            $parametro = array(":mov" => $this->strMovimiento, ":sts" => 1);
            $solicitud = $this->SeleccionarUnRegistro($sql,$parametro);
            if(empty($solicitud))
            {
                $consulta = "INSERT INTO tipo_movimiento(movimiento,tipomovimiento,descripcion) VALUES (:mov, :tipomov, :descr)";
                $param = array(":mov" => $this->strMovimiento,":tipomov" => $this->intTipoMovimiento,":descr" => $this->strDescripcion);
                $solicitudinsert = $this->InsertarRegistro($consulta,$param);
                return $solicitudinsert;
            }
            else
            {
                return false;
            }
        }
    }
?>