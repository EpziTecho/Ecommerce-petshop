<?php 

	class LibroReclamacionesGestion extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MDLIBRORECLAMACIONES);
		}

		public function LibroReclamacionesGestion()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Libro de Reclamaciones";
			$data['page_title'] = "LIBRO DE RECLAMACIONES <small>Oh my Pet</small>";
			$data['page_name'] = "librodereclamaciones";
			$data['page_functions_js'] = "functions_librodereclamaciones.js";
			$this->views->getView($this,"libroreclamacionesgestion",$data);
		}

		public function getLibroReclamacionesGestion(){
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectReclamos();
                // dep($arrData);
                // exit;
				for ($i=0; $i < count($arrData) ; $i++) { 
					$btnView = '';
					if($_SESSION['permisosMod']['r']){
						$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['id'].')" title="Ver mensaje"><i class="far fa-eye"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.'</div>';
				}
				 echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getMensajeReclamos($idmensaje){
			if($_SESSION['permisosMod']['r']){
				$idmensaje = intval($idmensaje);
				if($idmensaje > 0){
					$arrData = $this->model->selectMensajeReclamos($idmensaje);
					if(empty($arrData)){
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

	}
?>