<?php
  class Frecuencia extends Controllers
  {
    public function __construct()
    {
        parent::__construct();
    }

    public function SeleccionarFrecuencia($idfrecuencia)
    {
        try
        {
            $metodo = $_SERVER['REQUEST_METHOD'];
            $respuesta = [];
            if($metodo == "GET")
            {
                if(empty($idfrecuencia) || !is_numeric($idfrecuencia))
                {
                    $respuesta = array('status' => false, 'msg' => 'Error en los Parametros');
                    JSONRespuesta($respuesta,400);
                    die();
                }

                $solicitud = $this->model->getFrecuencia($idfrecuencia);
                if(empty($solicitud))
                {
                    $respuesta = array('status' => false, 'msg' => 'Registro No Encontrado');
                    $codigo = 400;
                }
                else
                {
                    $respuesta = array('status' => true, 'msg' => 'Frecuencia Obtenida Correctamente', 'data' => $solicitud);
                    $codigo = 200;
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
            echo "Error en el Proceso: " . $e->getMessage();
        }
        die();
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
        try
        {
            $metodo = $_SERVER['REQUEST_METHOD'];
            $respuesta = [];

            if($metodo == "PUT")
            {
                $parametro = json_decode(file_get_contents('php://input'),true);

                if(empty($idfrecuencia) or !is_numeric($idfrecuencia))
                {
                    $respuesta = array('status' => false, 'msg' => 'Error en los Parametros');
                    JSONRespuesta($respuesta,400);
                    die();
                }

                if(empty($parametro['frecuencia']))
                {
                    $respuesta = array('status' => false, 'msg' => 'Ingrese el Valor de la Frecuencia');
                    JSONRespuesta($respuesta,400);
                    die();
                }

                $frecuencia = ucwords(LimpiarCadena($parametro['frecuencia']));

                $validarFrecuencia = $this->model->getFrecuencia($idfrecuencia);

                if(empty($validarFrecuencia))
                {
                    $respuesta = array('status' => false, 'msg' => 'La Frecuencia no Existe');
                    JSONRespuesta($respuesta,400);
                    die();
                }
                else
                {
                    $solicitud = $this->model->putFrecuencia($idfrecuencia,$frecuencia);

                    if($solicitud)
                    {
                        $arrFrecuencia = array('idfrecuencia' => $idfrecuencia, 'frecuencia' => $frecuencia);
                        $respuesta =  array('status' => true, 'msg' => 'Frecuencia Actualizada Correctamente', 'data' => $arrFrecuencia);
                        $codigo = 200;
                    }
                    else
                    {
                        $respuesta = array('status' => false, 'msg' => 'Frecuencia ya Existe');
                        $codigo = 400;
                    }
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

    public function MostrarFrecuencias()
    {
        try
        {
            $metodo = $_SERVER['REQUEST_METHOD'];
            $respuesta = [];

            if($metodo == 'GET')
            {
                $solicitud = $this->model->getFrecuencias();
                if(empty($solicitud))
                {
                    $respuesta = array('status' => false, 'msg' => 'No se Encontraron Datos');
                }
                else
                {
                    $respuesta = array('status' => true, 'msg' => 'Datos Encontrados', 'data' => $solicitud);
                }
                $codigo = 200;
            }
            else
            {
                $respuesta = array('status' => false, 'msg' => 'Error en la Solicitud ' .$metodo);
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

    public function DesactivarFrecuencia($idfrecuencia)
    {
        try
        {
            $metodo = $_SERVER['REQUEST_METHOD'];
            $respuesta = [];

            if($metodo == "PATCH")
            {
                if(empty($idfrecuencia) OR !is_numeric($idfrecuencia))
                {
                    $respuesta  = array('status' => false, 'msg' => 'Error en los Parametros');
                    JSONRespuesta($respuesta,400);
                    die();
                }
                $buscarFrecuencia = $this->model->getFrecuencia($idfrecuencia);
                
                if(empty($buscarFrecuencia))
                {
                    $respuesta = array('status' => false, 'msg' => 'La Frecuencia no Existe o ya fue Desactivada');
                    JSONRespuesta($respuesta,404);
                    die();
                }
                else
                {
                    $solicitudDesactivar = $this->model->desactivarFrecuencia($idfrecuencia);

                    if($solicitudDesactivar)
                    {
                        $respuesta = array('status' => true, 'msg' => 'Frecuencia Desactivada Correctamente');
                        $codigo = 200;
                    }
                    else
                    {
                        $respuesta = array('status' => false, 'msg' => 'No es Posible Desactivar esta Frecuencia');
                        $codigo = 500;
                    }
                }
            }
            else
            {
                $respuesta = array('status' => false, 'msg' => 'Error en la Solicitud ' . $metodo);
                $codigo = 405;
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
  }  
?>