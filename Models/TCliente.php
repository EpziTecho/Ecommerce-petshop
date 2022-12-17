<?php 
require_once("Libraries/Core/Mysql.php");
trait TCliente{
	private $con;
	private $intIdUsuario;
	private $strNombre;
	private $strApellido;
	private $intTelefono;
	private $strEmail;
	private $strPassword;
	private $strToken;
	private $intTipoId;
	private $intIdTransaccion;
	private $idcupon;

	public function insertCliente(string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipoid){
		$this->con = new Mysql();
		$this->strNombre = $nombre;
		$this->strApellido = $apellido;
		$this->intTelefono = $telefono;
		$this->strEmail = $email;
		$this->strPassword = $password;
		$this->intTipoId = $tipoid;

		$return = 0;
		$sql = "SELECT * FROM persona WHERE 
				email_user = '{$this->strEmail}' ";
		$request = $this->con->select_all($sql);

		if(empty($request))
		{
			$query_insert  = "INSERT INTO persona(nombres,apellidos,telefono,email_user,password,rolid) 
							  VALUES(?,?,?,?,?,?)";
        	$arrData = array($this->strNombre,
    						$this->strApellido,
    						$this->intTelefono,
    						$this->strEmail,
    						$this->strPassword,
    						$this->intTipoId);
        	$request_insert = $this->con->insert($query_insert,$arrData);
        	$return = $request_insert;
		}else{
			$return = "exist";
		}
        return $return;
	}

	public function insertDetalleTemp(array $pedido){
		$this->intIdUsuario = $pedido['idcliente'];
		$this->intIdTransaccion = $pedido['idtransaccion'];
		$productos = $pedido['productos'];

		$this->con = new Mysql();
		$sql = "SELECT * FROM detalle_temp WHERE 
					transaccionid = '{$this->intIdTransaccion}' AND 
					personaid = $this->intIdUsuario";
		$request = $this->con->select_all($sql);

		if(empty($request)){
			foreach ($productos as $producto) {
				$query_insert  = "INSERT INTO detalle_temp(personaid,productoid,precio,cantidad,transaccionid) 
								  VALUES(?,?,?,?,?)";
	        	$arrData = array($this->intIdUsuario,
	        					$producto['idproducto'],
	    						$producto['precio'],
	    						$producto['cantidad'],
	    						$this->intIdTransaccion
	    					);
	        	$request_insert = $this->con->insert($query_insert,$arrData);
			}
		}else{
			$sqlDel = "DELETE FROM detalle_temp WHERE 
				transaccionid = '{$this->intIdTransaccion}' AND 
				personaid = $this->intIdUsuario";
			$request = $this->con->delete($sqlDel);
			foreach ($productos as $producto) {
				$query_insert  = "INSERT INTO detalle_temp(personaid,productoid,precio,cantidad,transaccionid) 
								  VALUES(?,?,?,?,?)";
	        	$arrData = array($this->intIdUsuario,
	        					$producto['idproducto'],
	    						$producto['precio'],
	    						$producto['cantidad'],
	    						$this->intIdTransaccion
	    					);
	        	$request_insert = $this->con->insert($query_insert,$arrData);
			}
		}
	}

	public function setContacto(string $nombre, string $email,string $mensaje,string $ip, string $dispositivo, string $useragent){
		$this->con =new Mysql();

		$nombre = $nombre =! "" ? $nombre : "";
		$email = $email =! "" ? $email : "";
		$mensaje = $mensaje =! "" ? $mensaje : "";
		$ip = $ip =! "" ? $ip : "";
		$dispositivo = $dispositivo =! "" ? $dispositivo : "";
		$useragent = $useragent =! "" ? $useragent : "";

		$query_insert  = "INSERT INTO contacto(nombre,email,mensaje,ip,dispositivo,useragent) 
						  VALUES(?,?,?,?,?,?)";
		$arrData = array($nombre,
						$email,
						$mensaje,
						$ip,
						$dispositivo,
						$useragent
					);
		$request_insert = $this->con->insert($query_insert,$arrData);
		return $request_insert;

	}
	public function setLibroReclamaciones(string $nombre, string $email,string $mensaje,string $ip, string $dispositivo,string $useragent, int $telefono, string $asunto){
		$this->con =new Mysql();

		$nombre = $nombre =! "" ? $nombre : "";
		$email = $email =! "" ? $email : "";
		$mensaje = $mensaje =! "" ? $mensaje : "";
		$ip = $ip =! "" ? $ip : "";
		$dispositivo = $dispositivo =! "" ? $dispositivo : "";
		$useragent = $useragent =! "" ? $useragent : "";
		$telefono = $telefono =! "" ? $telefono : "";
		$asunto = $asunto =! "" ? $asunto : "";

		$query_insert  = "INSERT INTO libroreclamaciones(nombre,email,mensaje,ip,dispositivo,useragent,telefono,asunto)
						  VALUES(?,?,?,?,?,?,?,?)";
		$arrData = array($nombre,
						$email,
						$mensaje,
						$ip,
						$dispositivo,
						$useragent,
						$telefono,
						$asunto
					);
		$request_insert = $this->con->insert($query_insert,$arrData);
		return $request_insert;

	}

	public function insertPedido(string $idtransaccionpaypal = NULL, int $idcupon, string $datospaypal = NULL, int $personaid, float $costo_envio, string $monto, int $tipopagoid, string $direccionenvio, string $status){
		$this->con = new Mysql();
		$this->idcupon = $idcupon;

		if($idcupon > 0){

			$sql = "SELECT COUNT(1) AS cantidad FROM `cupon` WHERE cantidad_uso < total AND fecha_inicio < NOW() AND fecha_fin > NOW() AND estado = 'A' AND id_cupon = $this->idcupon";
			$request = $this->con->select_all($sql);

		if($request[0]['cantidad'] > 0){

			$query_insert  = "INSERT INTO pedido(idtransaccionpaypal,id_cupon,datospaypal,personaid,costoenvio,monto,tipopagoid,direccionenvio,status) 
							  VALUES(?,?,?,?,?,?,?,?,?)";
			$arrData = array($idtransaccionpaypal,
								$idcupon,
								$datospaypal,
								$personaid,
								$costo_envio,
								$monto,
								$tipopagoid,
								$direccionenvio,
								$status
							);
			$request_insert = $this->con->insert($query_insert,$arrData);
			$return = $request_insert;

			if($return > 0){

			$sql = "UPDATE cupon SET cantidad_uso = cantidad_uso + 1 WHERE id_cupon = $this->idcupon";
			$arrData = [];
			$this->con->update($sql,$arrData);

			}

		}
		else{

			$return = -7;

		}
	}
	else{

		$query_insert  = "INSERT INTO pedido(idtransaccionpaypal,id_cupon,datospaypal,personaid,costoenvio,monto,tipopagoid,direccionenvio,status) 
		VALUES(?,?,?,?,?,?,?,?,?)";
		$arrData = array($idtransaccionpaypal,
				null,
				$datospaypal,
				$personaid,
				$costo_envio,
				$monto,
				$tipopagoid,
				$direccionenvio,
				$status
			);
		$request_insert = $this->con->insert($query_insert,$arrData);
		$return = $request_insert;

	}

	    return $return;
	}

	public function insertDetalle(int $idpedido, int $productoid, float $precio, int $cantidad){
		$this->con = new Mysql();
		$query_insert  = "INSERT INTO detalle_pedido(pedidoid,productoid,precio,cantidad) 
							  VALUES(?,?,?,?)";
		$arrData = array($idpedido,
    					$productoid,
						$precio,
						$cantidad
					);
		$request_insert = $this->con->insert($query_insert,$arrData);
	    $return = $request_insert;
	    return $return;
	}

	public function getPedido(int $idpedido){
		$this->con = new Mysql();
		$request = array();
		$sql = "SELECT p.idpedido,
							p.referenciacobro,
							p.idtransaccionpaypal,
							p.personaid,
							p.fecha,
							p.costoenvio,
							p.monto,
							p.tipopagoid,
							t.tipopago,
							p.direccionenvio,
							p.status
					FROM pedido as p
					INNER JOIN tipopago t
					ON p.tipopagoid = t.idtipopago
					WHERE p.idpedido =  $idpedido";
		$requestPedido = $this->con->select($sql);
		if(count($requestPedido) > 0){
			$sql_detalle = "SELECT p.idproducto,
											p.nombre as producto,
											d.precio,
											d.cantidad
									FROM detalle_pedido d
									INNER JOIN producto p
									ON d.productoid = p.idproducto
									WHERE d.pedidoid = $idpedido
									";
			$requestProductos = $this->con->select_all($sql_detalle);
			$request = array('orden' => $requestPedido,
							'detalle' => $requestProductos
							);
		}
		return $request;
	}
}

 ?>