<?php 
// require_once("CategoriasModel.php");
	class HomeModel extends Mysql
	{
		private $objCategoria;
		public function __construct()
		{
			parent::__construct();
			// $this->objCategoria=new CategoriasModel();//reutlizar los metodos del modelo CategoriasModel
		}	


		public function getCategorias(){
			// return $this->objCategoria->selectCategorias(); //reutlizar los metodos del modelo CategoriasModel

		}
	}
 ?>