<?php
class CuponModel extends Mysql
{       
    private $strCupon;
    private $intIdPersona;

    public function getCupon(string $cupon, int $idpersona)
    {
        $this->strCupon = $cupon;
        $this->intIdPersona = $idpersona;
        $this->con = new Mysql();

        $sql = "SELECT c.id_cupon, c.porcentaje_dscto FROM cupon c 
                INNER JOIN pedido p ON p.id_cupon = c.id_cupon 
                INNER JOIN persona e ON e.idpersona = p.personaid 
                WHERE e.idpersona = $this->intIdPersona AND c.descripcion = '$this->strCupon'";
        $request = $this->select($sql);

        if (empty($request)) {
            $sql = "SELECT id_cupon, porcentaje_dscto FROM cupon
                WHERE cantidad_uso < total AND NOW() >= fecha_inicio AND NOW() <= fecha_fin
                AND estado = 'A' AND descripcion = '$this->strCupon'";
            $request = $this->select($sql);
        } else {
            $request = NULL;
        }

        return $request;
    }

    public function selectCupones()
	{
		$sql = "SELECT id_cupon as id, descripcion as cupon, porcentaje_dscto as porcentaje, cantidad_uso as cantidad, total, 
                DATE_FORMAT(fecha_inicio, '%d-%m-%Y') as fecha_inicio, DATE_FORMAT(fecha_fin, '%d-%m-%Y') as fecha_fin, estado 
                FROM cupon ORDER BY id DESC";
			
		$request = $this->select_all($sql);
		return $request;
	}

    public function selectCupon(int $id)
    {
        $this->intId = $id;
        $sql = "SELECT id_cupon as id, descripcion as cupon, porcentaje_dscto as porcentaje, cantidad_uso as cantidad, total, 
                DATE_FORMAT(fecha_inicio, '%Y-%m-%d') as fecha_inicio, DATE_FORMAT(fecha_fin, '%Y-%m-%d') as fecha_fin, estado 
                FROM cupon WHERE id_cupon = $this->intId";
        $request = $this->select($sql);
        return $request;
    }


    public function insertCupon(string $nombre, string $fecha_inicio, string $fecha_fin, int $descuento, int $total, string $estado)
    {
        
        $this->strNombre = $nombre;
        $this->strFechaInicio = $fecha_inicio;
        $this->strFechaFin = $fecha_fin;
        $this->intDescuento = $descuento;
        $this->intTotal = $total;
        $this->strEstado = $estado;
        $return = 0;

        $sql = "SELECT * FROM cupon WHERE descripcion = '{$this->strNombre}' ";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $query_insert  = "INSERT INTO cupon(descripcion,fecha_inicio,fecha_fin,porcentaje_dscto,total,estado) VALUES(?,?,?,?,?,?)";
            $arrData = array($this->strNombre, $this->strFechaInicio, $this->strFechaFin, $this->intDescuento, $this->intTotal, $this->strEstado);
            $request_insert = $this->insert($query_insert,$arrData);
            $return = $request_insert;
        } else {
            $return = "exist";
        }
        return $return;
    }


    public function updateCupon(int $id, string $nombre, string $fecha_inicio, string $fecha_fin, int $descuento, int $total, string $estado)
    {
        $this->intId = $id;
        $this->strNombre = $nombre;
        $this->strFechaInicio = $fecha_inicio;
        $this->strFechaFin = $fecha_fin;
        $this->intDescuento = $descuento;
        $this->intTotal = $total;
        $this->strEstado = $estado;
        $sql = "SELECT * FROM cupon WHERE descripcion = '{$this->strNombre}' AND id_cupon != $this->intId ";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "UPDATE cupon SET descripcion = ?, fecha_inicio = ?, fecha_fin = ?, porcentaje_dscto = ?, total = ?, estado = ? 
                    WHERE id_cupon = $this->intId ";
            $arrData = array($this->strNombre, $this->strFechaInicio, $this->strFechaFin, $this->intDescuento, $this->intTotal, $this->strEstado);
            $request = $this->update($sql,$arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deleteCupon(int $id)
    {
        $this->intId = $id;
        $sql = "DELETE FROM cupon WHERE id_cupon = $this->intId ";
        $request = $this->delete($sql);
        return $request;
    }

}

