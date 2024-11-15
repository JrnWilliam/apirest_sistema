<?php
  class Frecuencia extends MYSQL
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
    }
  }  
?>