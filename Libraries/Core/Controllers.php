<?php
    class Controllers
    {
        protected $model;
        protected $views;
        public function __construct()
        {
            $this->views = new Views();
            $this->LoadModel();
        }

        public function LoadModel()
        {
            $model = get_class($this). "Model";
            $routeClass = "Models/" . $model . ".php";

            if(file_exists($routeClass))
            {
                require_once($routeClass);
                $this->model = new $model();
            }
        }
    }
?>