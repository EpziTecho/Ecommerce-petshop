<?php 
require_once("Models/TCategoria.php");
require_once("Models/TProducto.php");

	class TerminosCondiciones extends Controllers{
        use TCategoria,
		TProducto;
		
		public function __construct()
		{
			parent::__construct();
			session_start();
			 getPermisos(MDPAGINAS);
		}

		public function TerminosCondiciones()
		{
			
			$pageContent = getPageRout('terminos-y-condiciones');
			$data['page_tag'] = NOMBRE_EMPRESA;
			$data['page_title'] = NOMBRE_EMPRESA;
			$data['page_name'] = "Oh my Pet";
			$data['page'] = $pageContent;
			$data['productos'] = $this->getProductosT();
			$this->views->getView($this,"terminoscondiciones",$data);
		}
	}

?>

