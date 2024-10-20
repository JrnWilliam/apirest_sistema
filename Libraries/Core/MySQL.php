<?php
  class MYSQL extends Conexion
  {
    private $conexion;
    private $query;
    private $valores;

    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->Conectar();
        //parent::__construct();
    }

    public function InsertarRegistro(string $consulta, array $valor)
    {
        try
        {
            $this->query = $consulta;
            $this->valores= $valor;
            //$conexion = $this->Conectar();

            $insertar = $this->conexion->prepare($this->query);
            $resinsertar = $insertar->execute($this->valores);
            $idinsertar = $this->conexion->lastInsertId();
            $insertar->closeCursor();
            return $idinsertar;
        }
        catch(PDOException $e)
        {
            $response = "Error: " . $e->getMessage();
            return $response;
        }
    }

    public function SeleccionarRegistros(string $consulta)
    {
      try
      {
        $this->query = $consulta;
        $ejecucion = $this->conexion->query($this->query);
        $solicitud = $ejecucion->fetchall(PDO::FETCH_ASSOC);
        $ejecucion->closeCursor();
        return $solicitud;
      }
      catch(PDOException $e)
      {
        $response = "Error: " . $e->getMessage();
        return $response;
      }
    }

    public function SeleccionarUnRegistro(string $consulta, array $valor)
    {
      try
      {
        $this->query = $consulta;
        $this->valores = $valor;

        $consulta = $this->conexion->prepare($this->query);
        $consulta->execute($this->valores);
        $solicitud = $consulta->fetch(PDO::FETCH_ASSOC);
        $consulta->closeCursor();
        return $solicitud;
      }
      catch(PDOException $e)
      {
        $response = "Error: " . $e->getMessage();
        return $response;
      }
    }

    public function ActualizarRegistro(string $consulta, array $valor)
    {
      try
      {
        $this->query = $consulta;
        $this->valores = $valor;

        $update = $this->conexion->prepare($this->query);
        $resupdate = $update->execute($this->valores);
        $update->closeCursor();
        return $update;
      }
      catch(PDOException $e)
      {
        $response = "Error: " . $e->getMessage();
        return $response;
      }
    }

    public function EliminarRegistro(string $consulta, array $valor)
    {
      try
      {
        $this->query = $consulta;
        $this->valores = $valor;

        $eliminar = $this->conexion->prepare($this->query);
        $delete = $eliminar->execute($this->valores);
        return $delete;
      }
      catch(PDOException $e)
      {
        $response = "Error: " . $e->getMessage();
        return $response;
      }
    }
  }  
?>