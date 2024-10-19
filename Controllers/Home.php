<?php
  class Home extends Controllers
  {
    public function __construct()
    {
      parent::__construct();
    }

    public function home($params)
    {
      $data['pagina_titulo'] = "Bienvenido a la Pagina";
      $this->views->GetView($this,"home",$data);
    }
  }  
?>