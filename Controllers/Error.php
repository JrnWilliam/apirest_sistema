<?php
  class VError extends Controllers
  {
    public function __construct()
    {
        parent::__construct();
    }

    public function notFound()
    {
        $this->views->GetView($this,"Error");
    }
  }
  $nf = new VError();
  $nf->notFound();
?>