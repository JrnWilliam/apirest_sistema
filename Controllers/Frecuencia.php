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
                $_POST = json_decode(file_get_contents('php://input'),true);

                if(empty($_POST['frecuencia']))
                {
                    $respuesta = array('status' => false, 'msg' => 'Frecuencia es Requerida');
                    JSONRespuesta($respuesta,400);
                    die();
                }

                $frecuencia = ucwords(LimpiarCadena($_POST['frecuencia']));

                $solicitud = $this->model->setFrecuencia($frecuencia);

                if($solicitud > 0)
                {
                    $arrFrecuencia = array('idfrecuencia' => $solicitud,'frecuencia' => $frecuencia);
                    $respuesta = array('status' => true, 'msg' => 'Datos Guardados Correctamente', 'Data' => $arrFrecuencia);
                    $codigo = 200;
                }
                else
                {
                    $respuesta = array('status' => false, 'msg' => 'La Frecuencia ya Existe');
                    $codigo = 400;
                }
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