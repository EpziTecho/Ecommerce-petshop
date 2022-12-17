
<?php 
require_once("Models/TProducto.php");
	class Nosotros extends Controllers{
	
		use TProducto;
		public function __construct()
		{
			parent::__construct();
			session_start();
			getPermisos(MDPAGINAS);

		}

		public function Nosotros()
		{
			$pageContent = getPageRout('nosotros');
			if(empty($pageContent)){
				header("Location: ".base_url());
			}else{
			$data['page_tag'] = NOMBRE_EMPRESA;
			$data['page_title'] = NOMBRE_EMPRESA." - ".$pageContent['titulo'];
			$data['page_name'] = $pageContent['titulo'];
			$data['page'] = $pageContent;
			$data['productos'] = $this->getProductosT();
			$this->views->getView($this,"nosotros",$data);
			
		}



		}
	
	}

	 ?>



