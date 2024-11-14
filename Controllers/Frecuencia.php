<?php
  class Frecuencia extends Controllers
  {
    public function __construct()
    {
        parent::__construct();
    }

    public function SeleccionarFrecuencia($idfrecuencia)
    {
        echo "Frecuencia Seleccionada " . $idfrecuencia;
    }

    public function RegistroFrecuencia()
    {
        echo "Frecuencia Registrada Correctamente";
    }

    public function ActualizarFrecuencia($idfrecuencia)
    {
        echo "Frecuencia Actualizada " . $idfrecuencia;
    }

    public function MostrarFrecuencias()
    {
        echo "Listado de Frecuencias";
    }

    public function DesactivarFrecuencia($idfrecuencia)
    {
        echo "Frecuencia Desactivada " . $idfrecuencia;
    }
  }  
?>