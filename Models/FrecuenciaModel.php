<?php
  class FrecuenciaModel extends MYSQL
  {
    protected $intidFrecuencia;
    protected $strFrecuencia;

    public function __construct()
    {
      parent::__construct();
    }

    public function setFrecuencia(string $frecuencia)
    {
      $this->strFrecuencia = $frecuencia;
      $sql = "SELECT *FROM frecuencia WHERE frecuencia = :frecuencia AND estatus != :sts";
      $parametro = array(":frecuencia" => $this->strFrecuencia, ":sts" => 0);
      $solicitud = $this->SeleccionarUnRegistro($sql,$parametro);

      if(empty($solicitud))
      {
        $consulta = "INSERT INTO frecuencia(frecuencia) VALUES (:frecuencia)";
        $param = array(":frecuencia" => $this->strFrecuencia);
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