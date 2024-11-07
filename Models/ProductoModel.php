<?php
    class ProductoModel extends MYSQL
    {
        private $intidproducto;
        private $strcodigo;
        private $strnombre;
        private $strdescripcion;
        private $strprecio;
        private $intstatus;

        public function __construct()
        {
            parent::__construct();
        }

        public function setProducto(string $codigo, string $nombre, string $descripcion, string $precio)
        {
            $this->strcodigo = $codigo;
            $this->strnombre = $nombre;
            $this->strdescripcion = $descripcion;
            $this->strprecio = $precio;

            $sql = "SELECT *FROM producto WHERE codigo = :cod AND estatus = 1";
            $parametros = array(":cod" => $this->strcodigo);

            $solicitud = $this->SeleccionarUnRegistro($sql, $parametros);

            if(empty($solicitud))
            {
                $consulta = "INSERT INTO producto(codigo, nombre, descripcion, precio) VALUES (:cod, :nom, :descr, :price)";
                $param = array(":cod" => $this->strcodigo, ":nom" => $this->strnombre, ":descr" => $this->strdescripcion, ":price" => $this->strprecio);

                $insertar = $this->InsertarRegistro($consulta,$param);
                return $insertar;
            }
            else
            {
                return false;
            }
        }
    }
?>