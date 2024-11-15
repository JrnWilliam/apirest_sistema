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

    public function RegistrarFrecuencia()
    {
        try
        {
            $metodo = $_SERVER['REQUEST_METHOD'];
            $respuesta = [];

            if($metodo == "POST")
            {
                $respuesta = array('status' => true, 'msg' => 'Frecuencia Registrada Correctamente');
                $codigo = 200;
            }
            else
            {
                $respuesta = array('status' => false, 'msg' => 'Error en la Solicitud ' . $metodo);
                $codigo = 400;
            }
            JSONRespuesta($respuesta,$codigo);
            die();
        }
        catch (Exception $e)
        {
            echo "Error en el Proceso " . $e->getMessage();
        }
        die();
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