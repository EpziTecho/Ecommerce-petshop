<?php 

	class ProductosModel extends Mysql
	{
		private $intIdProducto;
		private $strNombre;
		private $strDescripcion;
		private $intCodigo;
		private $intCategoriaId;
		private $intPrecio;
		private $intStock;
		private $intStatus;
		private $strRuta;
		private $strImagen;

		private $strPorcentajeDscto;
		private $strPrecioPromocion;
		private $strFechaInicio;
		private $strFechaFin;
		private $intIdPersona;
		private $intIdPromocion;
		public function __construct()
		{
			parent::__construct();
		}

		public function selectProductos(){
			$sql = "SELECT p.idproducto,
							p.codigo,
							p.nombre,
							p.descripcion,
							p.categoriaid,
							c.nombre as categoria,
							p.precio,
							p.stock,
							p.status 
					FROM producto p 
					INNER JOIN categoria c
					ON p.categoriaid = c.idcategoria";
				
					$request = $this->select_all($sql);
			return $request;
		}	

		public function insertProducto(string $nombre, string $descripcion, int $codigo, int $categoriaid, string $precio, int $stock, string $ruta,int $status, string $porcentaje_dscto, string $precio_promocion, string $fecha_inicio, string $fecha_fin, int $id_persona){
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intCodigo = $codigo;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			$this->intStock = $stock;
			$this->strRuta = $ruta;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM producto WHERE codigo = '{$this->intCodigo}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO producto(categoriaid,
														codigo,
														nombre,
														descripcion,
														precio,
														stock,
														ruta,
														status) 
								  VALUES(?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->intCategoriaId,
        						$this->intCodigo,
        						$this->strNombre,
        						$this->strDescripcion,
        						$this->strPrecio,
        						$this->intStock,
								$this->strRuta,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
				$return = $request_insert;

				if($return > 0 && $this->intStatus === 3) {

					$sql = "SELECT idProducto FROM producto WHERE codigo = '{$this->intCodigo}'";
					$request = $this->select_all($sql);

					if(!empty($request))
					{
						$this->intIdProducto = $request[0]['idProducto'];
						$this->strPorcentajeDscto = $porcentaje_dscto;
						$this->strPrecioPromocion = $precio_promocion;
						$this->strFechaInicio = $fecha_inicio;
						$this->strFechaFin = $fecha_fin;
						$this->intIdPersona = $id_persona;

						$query_insert  = "INSERT INTO promocion(id_producto,
																porcentaje_dscto,
																precio_promocion,
																fecha_inicio,
																fecha_fin,
																id_persona,
																estado)
								  		VALUES(?,?,?,?,?,?,?)";
						$arrData = array($this->intIdProducto,
										$this->strPorcentajeDscto,
										$this->strPrecioPromocion,
										$this->strFechaInicio,
										$this->strFechaFin,
										$this->intIdPersona,
										'A');
						$request_insert = $this->insert($query_insert,$arrData);
						$return = $request_insert;

						if($return > 0) 
						{

							$sql = "UPDATE producto SET status=? WHERE idproducto = $this->intIdProducto";
							$arrData = array(3);

							$request = $this->update($sql,$arrData);
							$return = $request;

						}
					}	
				}	
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function updateProducto(int $idproducto, string $nombre, string $descripcion, int $codigo, int $categoriaid, string $precio, int $stock,string $ruta, int $status, int $id_promocion, string $porcentaje_dscto, string $precio_promocion, string $fecha_inicio, string $fecha_fin, int $id_persona){
			$this->intIdProducto = $idproducto;
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intCodigo = $codigo;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			$this->intStock = $stock;
			$this->strRuta = $ruta;
			$this->intStatus = $status;
			$this->intIdPromocion = $id_promocion;
			$return = 0;
			$sql = "SELECT * FROM producto WHERE codigo = '{$this->intCodigo}' AND idproducto != $this->intIdProducto ";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE producto 
						SET categoriaid=?,
							codigo=?,
							nombre=?,
							descripcion=?,
							precio=?,
							stock=?,
							ruta=?,
							status=? 
						WHERE idproducto = $this->intIdProducto ";
				$arrData = array($this->intCategoriaId,
        						$this->intCodigo,
        						$this->strNombre,
        						$this->strDescripcion,
        						$this->strPrecio,
        						$this->intStock,
								$this->strRuta,
        						$this->intStatus);

	        	$request = $this->update($sql,$arrData);
	        	$return = $request;

				if($return > 0 && $this->intStatus === 3) {

					if($this->intIdPromocion !== 0)
					{
						$this->strFechaInicio = $fecha_inicio;
						$this->strFechaFin = $fecha_fin;
						$this->intIdPersona = $id_persona;
						$this->strPorcentajeDscto = $porcentaje_dscto;
						$this->strPrecioPromocion = $precio_promocion;

						$query_insert  = "UPDATE promocion 
										  SET fecha_inicio =?, 
										  fecha_fin =?, 
										  id_persona_mod=?, 
										  fecha_mod = current_timestamp(), 
										  porcentaje_dscto =?,
										  precio_promocion =?
										  WHERE id_promocion = $this->intIdPromocion";
						$arrData = array($this->strFechaInicio,
										 $this->strFechaFin,
										 $this->intIdPersona,
										 $this->strPorcentajeDscto,
										 $this->strPrecioPromocion
										);
						$request_insert = $this->update($query_insert,$arrData);
						$return = $request_insert;
					}
					else
					{
						$this->strPorcentajeDscto = $porcentaje_dscto;
						$this->strPrecioPromocion = $precio_promocion;
						$this->strFechaInicio = $fecha_inicio;
						$this->strFechaFin = $fecha_fin;
						$this->intIdPersona = $id_persona;

						$query_insert  = "INSERT INTO promocion(id_producto,
																porcentaje_dscto,
																precio_promocion,
																fecha_inicio,
																fecha_fin,
																id_persona,
																estado)
								  		VALUES(?,?,?,?,?,?,?)";
						$arrData = array($this->intIdProducto,
										$this->strPorcentajeDscto,
										$this->strPrecioPromocion,
										$this->strFechaInicio,
										$this->strFechaFin,
										$this->intIdPersona,
										'A');
						$request_insert = $this->insert($query_insert,$arrData);
						$return = $request_insert;

						if($return > 0) 
						{

							$sql = "UPDATE producto SET status=? WHERE idproducto = $this->intIdProducto";
							$arrData = array(3);

							$request = $this->update($sql,$arrData);
							$return = $request;

						}
					}
				}	
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function selectProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT p.idproducto,
							p.codigo,
							p.nombre,
							p.descripcion,
							p.precio,
							p.stock,
							p.categoriaid,
							c.nombre as categoria,
							p.status,
							pm.id_promocion,
							pm.porcentaje_dscto,
							pm.precio_promocion,
							pm.fecha_inicio,
							pm.fecha_fin
					FROM producto p 
					INNER JOIN categoria c ON p.categoriaid = c.idcategoria
					LEFT JOIN promocion pm ON pm.id_producto = p.idproducto
					WHERE  idproducto = $this->intIdProducto";
			$request = $this->select($sql);
			return $request;

		}

		public function insertImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query_insert  = "INSERT INTO imagen(productoid,img) VALUES(?,?)";
	        $arrData = array($this->intIdProducto,
        					$this->strImagen);
	        $request_insert = $this->insert($query_insert,$arrData);
	        return $request_insert;
		}

		public function selectImages(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT productoid,img
					FROM imagen
					WHERE productoid = $this->intIdProducto";
			$request = $this->select_all($sql);
			return $request;
		}

		public function deleteImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query  = "DELETE FROM imagen 
						WHERE productoid = $this->intIdProducto 
						AND img = '{$this->strImagen}'";
	        $request_delete = $this->delete($query);
	        return $request_delete;
		}

		public function deleteProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "UPDATE producto SET status = ? WHERE idproducto = $this->intIdProducto ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}
	}
 ?>