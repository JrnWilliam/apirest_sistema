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
      $sql = "SELECT *FROM frecuencia WHERE (idfrecuencia = :id AND frecuencia != :frc) AND estatus = :sts";
      $parametro = array(":id" => $this->intidFrecuencia, ":frc" => $this->strFrecuencia, ":sts" => 1);
      $solicitud = $this->SeleccionarUnRegistro($sql,$parametro);
      if(empty($solicitud))
      {
        $consulta = "UPDATE frecuencia SET frecuencia = : frc WHERE idfrecuencia = :id";
        $param = array(":id" => $this->intidFrecuencia, ":frc" => $this->strFrecuencia);
        $actualizar = $this->ActualizarRegistro($consulta,$param);
        return $actualizar;
      }
      else
      {
        return false;
      }
    }
  }  
?>