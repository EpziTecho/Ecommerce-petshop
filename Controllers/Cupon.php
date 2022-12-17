<?php
class Cupon extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        session_regenerate_id(true);
        if(empty($_SESSION['login']))
        {
            header('Location: '.base_url().'/login');
        }
        getPermisos(14);
    }
    public function Cupon()
    {
        if(empty($_SESSION['permisosMod']['r'])){
            header("Location:".base_url().'/dashboard');
        }
        $data['page_tag'] = "Cupones";
        $data['page_title'] = '<i class="fas fa-user-tag"></i>'." CUPONES";
        $data['page_name'] = "cupones";
        $data['page_functions_js'] = "functions_cupones.js";
        $this->views->getView($this,"cupones",$data);
    }


public function getCupones(){
    if($_SESSION['permisosMod']['r']){
        $arrData = $this->model->selectCupones();
        for ($i=0; $i < count($arrData) ; $i++) { 
            $btnViewCupon = ''; //boton ver
			$btnEditCupon = ''; //boton editar
			$btnDeleteCupon = ''; //boton eliminar
            if($arrData[$i]['estado'] == 'A')
				{
					$arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
				}

            if($_SESSION['permisosMod']['r']){
            $btnViewCupon = '<button class="btn btn-info btn-sm btnViewCupon" onClick="fntViewCupon('.$arrData[$i]['id'].')" title="Ver cupón"><i class="fas fa-eye"></i></button>';
            }else{
             $btnViewCupon = '<button class="btn btn-info btn-sm" disabled><i class="fas fa-eye"></i></button>';

            }
            if($_SESSION['permisosMod']['u']){
            $btnEditCupon = '<button class="btn btn-primary btn-sm btnEditCupon" onClick="fntEditCupon('.$arrData[$i]['id'].')" title="Editar cupón"><i class="fas fa-pencil-alt"></i></button>';
            }else{
             $btnEditCupon = '<button class="btn btn-primary btn-sm" disabled><i class="fas fa-pencil-alt"></i></button>';

            }
            if($_SESSION['permisosMod']['d']){
            $btnDeleteCupon = '<button class="btn btn-danger btn-sm btnDelCupon" onClick="fntDelCupon('.$arrData[$i]['id'].')" title="Eliminar cupón"><i class="far fa-trash-alt"></i></button>';
            }else{
             $btnDeleteCupon = '<button class="btn btn-danger btn-sm" disabled><i class="far fa-trash-alt"></i></button>';

            }
            $arrData[$i]['options'] = '<div class="text-center">'.$btnViewCupon.' '.$btnEditCupon.' '.$btnDeleteCupon.'</div>';

        }
         echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
    }
    die();
}

public function getCupon( int $idcupon){
    if($_SESSION['permisosMod']['r']){
        $idcupon = intval($idcupon);
        if($idcupon > 0){
            $arrData = $this->model->selectCupon($idcupon);
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

public function setCupones(){
    if($_POST){
        if(empty($_POST['txtNombre'])|| empty($_POST['txtDescuento']) || empty($_POST['txtFechaInicio']) || empty($_POST['txtFechaFin']) || empty($_POST['listStatus']) )
        {
            $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            
    }else{// que la fecha de inicio sea mayor que la fecha final
            if(strtotime($_POST['txtFechaInicio']) > strtotime($_POST['txtFechaFin'])){
                $arrResponse = array("status" => false, "msg" => 'La fecha de inicio debe ser mayor que la fecha final.');
            }else{

        $idcupon = intval($_POST['idCupones']);
        $strNombre= strClean($_POST['txtNombre']);
        $strFechaInicio= strClean($_POST['txtFechaInicio']);
        $strFechaFin= strClean($_POST['txtFechaFin']);
        $strDescuento= strClean($_POST['txtDescuento']);
        $strTotal= strClean($_POST['txtTotal']);
        $strEstado= strClean($_POST['listStatus']);

        if($idcupon == 0){
            $option = 1;
             $request_cupon= $this->model->insertCupon($strNombre,$strFechaInicio,$strFechaFin,$strDescuento,$strTotal,$strEstado); 
            
        }else{
            $option = 2;
            $request_cupon= $this->model->updateCupon($idcupon,$strNombre,$strFechaInicio,$strFechaFin,$strDescuento,$strTotal,$strEstado);
        }

       if($request_cupon > 0)
       {
              if($option == 1){
                $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                }else{
                $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                }
    }else if($request_cupon == 'exist'){
        $arrResponse = array('status' => false, 'msg' => '¡Atención! el cupon ya existe.');
    }else{
        $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
    }

    }
    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
}
die();
}
}


public function delCupon(){
    if($_POST){
        if(empty($_POST['idcupon'])){
            $arrResponse = array('status' => false, 'msg' => 'Error de datos.');
        }else{
            $intIdcupon = intval($_POST['idcupon']);
            $requestDelete = $this->model->deleteCupon($intIdcupon);
            if($requestDelete){
                $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el cupon.');
            }else{
                $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el cupon.');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
    }
    die();
}



    public function validar($cupon)
    {
        $strCupon = strtoupper(strClean($cupon));
        $arrData = $this->model->getCupon($strCupon, $_SESSION['idUser']);

        if (empty($arrData)) {
            $arrResponse = array('status' => false, 'msg' => 'Cupón ingresado no valido');
        } else {
            $arrResponse = array('status' => true, 'msg' => 'Cupón ingresado valido', 'data' => $arrData);
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

        die();
    }



}
