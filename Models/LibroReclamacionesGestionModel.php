<?php 

class LibroReclamacionesGestionModel extends Mysql{

	public function selectReclamos()
	{
		$sql = "SELECT id, nombre, email, DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha, asunto 
				FROM libroreclamaciones ORDER BY id DESC";
		$request = $this->select_all($sql);
		return $request;
	}

	public function selectMensajeReclamos(int $idmensaje){
		$sql = "SELECT id, asunto, nombre, email, DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha, mensaje
				FROM libroreclamaciones WHERE id = {$idmensaje}";
		$request = $this->select($sql);
		return $request;
	}

}
 ?>