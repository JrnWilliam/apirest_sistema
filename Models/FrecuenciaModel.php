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

    public function getFrecuencia(int $idfrecuencia)
    {
      $this->intidFrecuencia = $idfrecuencia;
      $sql = "SELECT *FROM frecuencia WHERE idfrecuencia = :id AND estatus = :est";
      $parametro = array(":id" => $this->intidFrecuencia, ":est" => 1);
      $solicitud = $this->SeleccionarUnRegistro($sql,$parametro);
      return $solicitud;
    }

    public function putFrecuencia(int $idfrecuencia,string $frecuencia)
    {
      $this->intidFrecuencia = $idfrecuencia;
      $this->strFrecuencia = $frecuencia;
      $sql = "SELECT *FROM frecuencia WHERE (idfrecuencia != :id AND frecuencia = :frc) AND estatus = :sts";
      $parametro = array(":id" => $this->intidFrecuencia, ":frc" => $this->strFrecuencia, ":sts" => 1);
      $solicitud = $this->SeleccionarUnRegistro($sql,$parametro);
      if(empty($solicitud))
      {
        $consulta = "UPDATE frecuencia SET frecuencia = :frc WHERE idfrecuencia = :id";
        $param = array(":id" => $this->intidFrecuencia, ":frc" => $this->strFrecuencia);
        $actualizar = $this->ActualizarRegistro($consulta,$param);
        return $actualizar;
      }
      else
      {
        return false;
      }
    }

    public function getFrecuencias()
    {
      $sql = "SELECT idfrecuencia, frecuencia, DATE_FORMAT(fechacreacion, '%d/%m/%Y') as fecharegistro FROM frecuencia WHERE estatus = 1 ORDER BY idfrecuencia DESC";
      $solicitud = $this->SeleccionarRegistros($sql);
      return $solicitud;
    }

    public function desactivarFrecuencia(int $idfrecuencia)
    {
      $this->intidFrecuencia = $idfrecuencia;
      $sql = "UPDATE frecuencia SET estatus = :est WHERE idfrecuencia = :id";
      $parametro = array(":id" => $this->intidFrecuencia, ":est" => 0);
      $solicitud = $this->ActualizarRegistro($sql,$parametro);
      if(strpos($solicitud,"Error") !== false)
      {
        return false;
      }
      else
      {
        return true;
      }
    }
  }  
?>