<?php
  class ClienteModel extends MySQL
  {
    private $intIdCliente;
    private $strIdentificacion;
    private $strNombres;
    private $strApellidos;
    private $intTelefono;
    private $strEmail;
    private $strDireccion;
    private $strNit;
    private $strNomFiscal;
    private $strDirFiscal;
    private $intStatus;

    public function __construct()
    {
      parent::__construct();   
    }

    public function setCliente(string $identificacion,string $nombres, string $apellidos, int $telefono, string $email, string $direccion, string $nit, string $nombrefiscal, string $dirfiscal)
    {
        $this->strIdentificacion = $identificacion;
        $this->strNombres = $nombres;
        $this->strApellidos = $apellidos;
        $this->intTelefono = $telefono;
        $this->strEmail = $email;
        $this->strDireccion  = $direccion;
        $this->strNit = $nit;
        $this->strNomFiscal = $nombrefiscal;
        $this->strDirFiscal = $dirfiscal;

        $sql = "SELECT identificacion,email FROM cliente WHERE (email = :email or identificacion = :ident) and status = :estado";
        $parametros = array(":email" => $this->strEmail, ":ident" =>$this->strIdentificacion,":estado"=>1);

        $solicitud = $this->SeleccionarUnRegistro($sql,$parametros);

        if(!empty($solicitud))
        {
          return false;
        }
        else
        {
          $insertar = "INSERT INTO cliente(identificacion,nombres,apellidos,telefono,email,direccion,nit,nombrefiscal,direccionfiscal) VALUES (:ident,:nom,:ape,:tel,:correo,:dir,:nit,:nomfiscal,:dirfiscal)";

          $param = array(":ident" => $this->strIdentificacion, ":nom" => $this->strNombres, ":ape" => $this->strApellidos, ":tel" => $this->intTelefono, ":correo" => $this->strEmail, ":dir" => $this->strDireccion, ":nit" => $this->strNit,":nomfiscal" => $this->strNomFiscal, ":dirfiscal" => $this->strDirFiscal);

          $solicitudinsert = $this->InsertarRegistro($insertar,$param);
          return $solicitudinsert;
        }
    }

    public function putCliente(int $idcliente, string $identificacion, string $nombres, string $apellidos, int $telefono, string $email, string $direccion, string $nit, string $nombrefiscal, string $dirfiscal)
    {
      $this->intIdCliente = $idcliente;
      $this->strIdentificacion = $identificacion;
      $this->strNombres= $nombres;
      $this->strApellidos = $apellidos;
      $this->intTelefono = $telefono;
      $this->strEmail = $email;
      $this->strDireccion = $direccion;
      $this->strNit = $nit;
      $this->strNomFiscal = $nombrefiscal;
      $this->strDirFiscal = $dirfiscal;

      $sql = "SELECT identificacion,email FROM cliente WHERE (email = :correo AND idcliente != :id) OR (identificacion= :ident AND idcliente != :id) AND status = 1";

      $parametros = array(":correo" => $this->strEmail, ":id" => $this->intIdCliente, ":ident" => $this->strIdentificacion);

      $solicitud = $this->SeleccionarUnRegistro($sql,$parametros);

      if(empty($solicitud))
      {
        $consulta = "UPDATE cliente SET identificacion = :ident, nombres = :nom, apellidos = :ape, telefono = :tel, email = :correo, direccion = :dir, nit = :nit, nombrefiscal = :nomfiscal, direccionfiscal = :dirfiscal WHERE idcliente = :id";

        $param = array(":id" => $this->intIdCliente,":ident" => $this->strIdentificacion, ":nom" => $this->strNombres, ":ape" => $this->strApellidos, ":tel" => $this-> intTelefono, ":correo" => $this->strEmail, ":dir" => $this->strDireccion, ":nit" => $this->strNit, ":nomfiscal" => $this->strNomFiscal, ":dirfiscal" => $this->strDirFiscal);

        $solicitudupdate = $this->ActualizarRegistro($consulta,$param);
        return $solicitudupdate;
      }
      else
      {
        return false;
      }
    }
  }
?>