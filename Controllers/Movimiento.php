<?php
  class Movimiento extends Controllers
  {
    public function __construct()
    {
        parent::__construct();        
    }

    public function RegistrarTipoMovimiento()
    {
        try
        {
            $metodo = $_SERVER['REQUEST_METHOD'];
            $respuesta = [];

            if($metodo == "POST")
            {
                $_POST = json_decode(file_get_contents('php://input'),true);
                if(empty($_POST['movimiento']))
                {
                    $respuesta = array('status' => false, 'msg' => 'Ingrese el Movimiento');
                    JSONRespuesta($respuesta,406);
                    die();
                }
                if(empty($_POST['tipomovimiento']) or ($_POST['tipomovimiento'] != 1 AND $_POST['tipomovimiento'] != 2))
                {
                    $respuesta = array('status' => false, 'msg' => 'Error en el Tipo de Movimiento');
                    JSONRespuesta($respuesta,406);
                    die();
                }
                if(empty($_POST['descripcion']))
                {
                    $respuesta = array('status' => false, 'msg' => 'Ingrese una Descripción');
                    JSONRespuesta($respuesta,406);
                    die();
                }
                $movimiento = ucwords(LimpiarCadena($_POST['movimiento']));
                $tipomovimiento = ucwords(LimpiarCadena($_POST['tipomovimiento']));
                $descripcion = ucwords(LimpiarCadena($_POST['descripcion']));
                
                $solicitud = $this->model->setTipoMovimiento($movimiento, $tipomovimiento, $descripcion);
                if($solicitud > 0)
                {
                    $arrmovimiento = array('idtipomovimiento' => $solicitud, 'movimiento' => $movimiento, 'tipomovimiento' => $tipomovimiento, 'descripcion' => $descripcion);
                    $respuesta = array('status' => true, 'msg' => 'Registro Guardado Correctamente', 'data' => $arrmovimiento);
                    $codigo = 200;
                }
                else
                {
                    $respuesta = array('status' => false, 'msg' => 'Este Tipo de Movimiento ya Existe');
                    $codigo = 405;
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
        catch(Exception $e)
        {
            echo "Error en el Proceso " . $e->getMessage();
        }
        die();
    }

    public function TiposMovimiento()
    {
        echo "Mostrar los Tipos de Movimiento";
    }
  }  
?>