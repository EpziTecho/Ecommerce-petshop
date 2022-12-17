<?php

class Promocion extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function promocion()
    {
        $data['page_tag'] = NOMBRE_EMPRESA;
        $data['page_title'] = "Todos los productos";
        $data['page_name'] = "Promociones";
        $data['productos'] = $this->model->getPromocionProductos();
        $this->views->getView($this, "promocion", $data);
    }
}
