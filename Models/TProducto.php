<?php
require_once("Libraries/Core/Mysql.php");
trait TProducto{
private $con;
private $strCategoria;
private $intIdCategoria;
private $intIdProducto;
private $strProducto;
private $cant;
private $option;
private $strRuta;

public function getProductosT(){
    $this->con = new Mysql();
    $sql = "SELECT p.idproducto,
                    p.codigo,
                    p.nombre,
                    p.descripcion,
                    p.categoriaid,
                    c.nombre as categoria,
                    p.precio,
                    p.ruta,
                    p.stock,
                    p.status
            FROM producto p 
            INNER JOIN categoria c
            ON p.categoriaid = c.idcategoria
            WHERE p.status not in (2,3,0) and p.stock >0 ORDER BY p.idproducto DESC ";
            $request = $this->con->select_all($sql);
            if(count($request) > 0){
                for ($c=0; $c < count($request) ; $c++) { 
                    $intIdProducto = $request[$c]['idproducto'];
                    $sqlImg = "SELECT img
                            FROM imagen
                            WHERE productoid = $intIdProducto";
                    $arrImg = $this->con->select_all($sqlImg);
                    if(count($arrImg) > 0){
                        for ($i=0; $i < count($arrImg); $i++) { 
                            $arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];
                        }
                    }
                    $request[$c]['images'] = $arrImg;
                }
            }
    return $request;
}
public function getProductosCategoriaT(int $idcategoria, string $ruta){
    $this->intIdcategoria = $idcategoria;
    $this->strRuta = $ruta;

    $this->con = new Mysql();
    $sql_cat = "SELECT idcategoria,nombre FROM categoria WHERE idcategoria = '{$this->intIdcategoria}'";
    $request = $this->con->select($sql_cat);

    if(!empty($request)){
        $this->strCategoria = $request['nombre'];
        $sql = "SELECT p.idproducto,
                        p.codigo,
                        p.nombre,
                        p.descripcion,
                        p.categoriaid,
                        c.nombre as categoria,
                        p.precio,
                        p.ruta,
                        p.stock,
                        p.status
                FROM producto p 
                INNER JOIN categoria c
                ON p.categoriaid = c.idcategoria
                WHERE p.status != 0 AND p.categoriaid = $this->intIdcategoria AND c.ruta = '{$this->strRuta}' ";
                $request = $this->con->select_all($sql);
                if(count($request) > 0){
                    for ($c=0; $c < count($request) ; $c++) { 
                        $intIdProducto = $request[$c]['idproducto'];
                        $sqlImg = "SELECT img
                                FROM imagen
                                WHERE productoid = $intIdProducto";
                        $arrImg = $this->con->select_all($sqlImg);
                        if(count($arrImg) > 0){
                            for ($i=0; $i < count($arrImg); $i++) { 
                                $arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];
                            }
                        }
                        $request[$c]['images'] = $arrImg;
                    }
                }
        $request = array('idcategoria' => $this->intIdcategoria,
                            'categoria' => $this->strCategoria,
                            'productos' => $request
                        );

    }
    return $request;
}


public function getProductoT(int $idproducto, string $ruta){
    $this->con = new Mysql();
    $this->intIdProducto = $idproducto;
    $this->strRuta = $ruta;
    $sql = "SELECT p.idproducto,
                    p.codigo,
                    p.nombre,
                    p.descripcion,
                    p.categoriaid,
                    c.nombre as categoria,
                    c.ruta as ruta_categoria,
                    p.precio,
                    p.ruta,
                    p.stock,
                    p.status,
                    pm.precio_promocion
            FROM producto p 
            INNER JOIN categoria c ON p.categoriaid = c.idcategoria
            LEFT JOIN promocion pm ON pm.id_producto = p.idproducto
            WHERE p.status != 0 AND p.idproducto = '{$this->intIdProducto}' AND p.ruta = '{$this->strRuta}' ";
            $request = $this->con->select($sql);
            if(!empty($request)){
                $intIdProducto = $request['idproducto'];
                $sqlImg = "SELECT img
                        FROM imagen
                        WHERE productoid = $intIdProducto";
                $arrImg = $this->con->select_all($sqlImg);
                if(count($arrImg) > 0){
                    for ($i=0; $i < count($arrImg); $i++) { 
                        $arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];
                    }
                }else{
                    $arrImg[0]['url_image'] = media().'/images/uploads/product.png';
                }
                $request['images'] = $arrImg;
            }
    return $request;
}
public function getProductosRandom(int $idcategoria, int $cant, string $option){
    $this->intIdcategoria = $idcategoria;
    $this->cant = $cant;
    $this->option = $option;

    if($option == "r"){
        $this->option = " RAND() ";
    }else if($option == "a"){
        $this->option = " idproducto ASC ";
    }else{
        $this->option = " idproducto DESC ";
    }

    $this->con = new Mysql();
    $sql = "SELECT p.idproducto,
                    p.codigo,
                    p.nombre,
                    p.descripcion,
                    p.categoriaid,
                    c.nombre as categoria,
                    p.precio,
                    p.ruta,
                    p.stock,
                    p.status,
                    pm.precio_promocion
            FROM producto p 
            INNER JOIN categoria c ON p.categoriaid = c.idcategoria
            LEFT JOIN promocion pm ON pm.id_producto = p.idproducto
            WHERE p.status != 0 AND p.categoriaid = $this->intIdcategoria
            ORDER BY $this->option LIMIT  $this->cant ";
            $request = $this->con->select_all($sql);
            if(count($request) > 0){
                for ($c=0; $c < count($request) ; $c++) { 
                    $intIdProducto = $request[$c]['idproducto'];
                    $sqlImg = "SELECT img
                            FROM imagen
                            WHERE productoid = $intIdProducto";
                    $arrImg = $this->con->select_all($sqlImg);
                    if(count($arrImg) > 0){
                        for ($i=0; $i < count($arrImg); $i++) { 
                            $arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];
                        }
                    }
                    $request[$c]['images'] = $arrImg;
                }
            }
    return $request;
}	

public function getProductoIDT(int $idproducto){
    $this->con = new Mysql();
    $this->intIdProducto = $idproducto;
    $sql = "SELECT p.idproducto,
                    p.codigo,
                    p.nombre,
                    p.descripcion,
                    p.categoriaid,
                    c.nombre as categoria,
                    (CASE p.status WHEN 3 THEN pm.precio_promocion ELSE p.precio END) AS precio,
                    p.ruta,
                    p.stock,
                    p.status
            FROM producto p 
            INNER JOIN categoria c ON p.categoriaid = c.idcategoria
            LEFT JOIN promocion pm ON pm.id_producto = p.idproducto
            WHERE p.status != 0 AND p.idproducto = '{$this->intIdProducto}' ";
            $request = $this->con->select($sql);
            if(!empty($request)){
                $intIdProducto = $request['idproducto'];
                $sqlImg = "SELECT img
                        FROM imagen
                        WHERE productoid = $intIdProducto";
                $arrImg = $this->con->select_all($sqlImg);
                if(count($arrImg) > 0){
                    for ($i=0; $i < count($arrImg); $i++) { 
                        $arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];
                    }
                }else{
                    $arrImg[0]['url_image'] = media().'/images/uploads/product.png';
                }
                $request['images'] = $arrImg;
            }
    return $request;
}

}





?>