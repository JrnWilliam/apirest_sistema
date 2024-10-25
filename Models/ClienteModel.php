<?php
  class ClienteModel extends MySQL
  {
    private $intIdCliente;
    private $strIdentificación;
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
        $this->strIdentificación = $identificacion;
        $this->strNombres = $nombres;
        $this->strApellidos = $apellidos;
        $this->intTelefono = $telefono;
        $this->strEmail = $email;
        $this->strDireccion  = $direccion;
        $this->strNit = $nit;
        $this->strNomFiscal = $nombrefiscal;
        $this->strDirFiscal = $dirfiscal;
    }
  }
?>