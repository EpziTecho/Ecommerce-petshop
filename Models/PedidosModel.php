<?php
class PedidosModel extends Mysql
{
    private $objCategoria;
    public function __construct()
    {
        parent::__construct();
    }


    public function selectPedidos($idpersona = NULL)
    {
        $where = "";
        if ($idpersona != NULL) {
            $where = " WHERE p.personaid  = " . $idpersona;
        }
        $sql = "SELECT p.idpedido, 
                           p.referenciacobro,
                           p.idtransaccionpaypal,
                           DATE_FORMAT(p.fecha,'%d/%m/%Y') as fecha,
                           p.monto,
                           tp.tipopago,
                           tp.idtipopago,
                           p.status 
                    FROM pedido p 
                    INNER JOIN tipopago tp 
                    ON p.tipopagoid = tp.idtipopago $where ";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectPedido(int $idpedido, $idpersona = null)
    {
        $busqueda = "";
        if ($idpersona != null) {
            $busqueda = " AND p.personaid =" . $idpersona;
        }
        $request = array();
        $sql = "SELECT p.idpedido,
                                p.id_cupon,
                                p.referenciacobro,
                                p.idtransaccionpaypal,
                                p.personaid,
                                DATE_FORMAT(p.fecha,'%d/%m/%Y') as fecha,
                                p.costoenvio,
                                p.monto,
                                p.tipopagoid,
                                t.tipopago,
                                p.direccionenvio,
                                p.status
                        FROM pedido as p
                        INNER JOIN tipopago t
                        ON p.tipopagoid = t.idtipopago
                        WHERE p.idpedido =  $idpedido " . $busqueda;
        $requestPedido = $this->select($sql);
        if (!empty($requestPedido)) {
            $idpersona = $requestPedido['personaid'];
            $sql_cliente = "SELECT idpersona,
                                         nombres,
                                       apellidos,
                                        telefono,
                                      email_user,
                                             nit,
                                    nombrefiscal,
                                  direccionfiscal FROM persona WHERE idpersona = $idpersona ";
            $requestcliente = $this->select($sql_cliente);
            $sql_detalle = "SELECT p.idproducto,
											p.nombre as producto,
											d.precio,
											d.cantidad
									FROM detalle_pedido d
									INNER JOIN producto p
									ON d.productoid = p.idproducto
									WHERE d.pedidoid = $idpedido
									";
            $requestProductos = $this->select_all($sql_detalle);
            $request = array(
                'cliente' => $requestcliente,
                'orden' => $requestPedido,
                'detalle' => $requestProductos
            );
        }

        return $request;
    }

    public function selectTransPaypal(string $idtransaccion, $idpersona = NULL)
    {
        $busqueda = "";
        if ($idpersona != null) {
            $busqueda = " AND personaid =" . $idpersona;
        }
        $objTransaccion = array();
        $sql = "SELECT datospaypal FROM pedido WHERE idtransaccionpaypal = '{$idtransaccion}'".$busqueda;
        $requestData = $this->select($sql);
        if (!empty($requestData)) {
            $objData = json_decode($requestData['datospaypal']);
            $urlOrden = $objData->links[0]->href;
            $objTransaccion = CurlConnectionGet($urlOrden, "application/json", getTokenPaypal());
        }
        return $objTransaccion;
    }

    public function reembolsoPaypal(string $idtransaccion, string $observacion){
        $response = false;
        $sql = "SELECT idpedido,datospaypal FROM pedido WHERE idtransaccionpaypal = '{$idtransaccion}' ";
        $requestData = $this->select($sql);
        if(!empty($requestData)){
            $objData = json_decode($requestData['datospaypal']);
            $urlOrden = $objData->links[0]->href;
            $objTransaccion = CurlConnectionGet($urlOrden, "application/json", getTokenPaypal());
            $urlReembolso = $objTransaccion->purchase_units[0]->payments->captures[0]->links[1]->href;
            $objTransaccionPost = CurlConnectionPost($urlReembolso,"application/json",getTokenPaypal());
            if(isset($objTransaccionPost->status) and  $objTransaccion->status == "COMPLETED"){
                $idpedido = $requestData['idpedido'];
                $idtrasaccion = $objTransaccionPost->id;
                $status = $objTransaccionPost->status;
                $jsonData = json_encode($objTransaccion);
                $observacion = $observacion;
                $query_insert  = "INSERT INTO reembolso(pedidoid,
                                                    idtransaccion,
                                                    datosreembolso,
                                                    observacion,
                                                    status) 
                                  VALUES(?,?,?,?,?)";
                $arrData = array($idpedido,
                                $idtrasaccion,
                                $jsonData,
                                $observacion,
                                $status
                            );
                $request_insert = $this->insert($query_insert,$arrData);
                if($request_insert > 0){
                    $updatePedido  = "UPDATE pedido SET status = ? WHERE idpedido = $idpedido";
                    $arrPedido = array("Reembolsado");
                    $request = $this->update($updatePedido,$arrPedido);
                    $response = true;
                }
            }
            return $response;
        }
    }

    public function updatePedido(int $idpedido, $transaccion = NULL, $idtipopago = NULL, string $estado){
        if($transaccion == NULL){
            $query_insert = "UPDATE pedido SET status = ? WHERE idpedido = $idpedido";
            $arrData = array($estado);
        } else {
            $query_insert = "UPDATE pedido SET referenciacobro = ?, tipopagoid=?,status=? WHERE idpedido = $idpedido";
            $arrData = array($transaccion, $idtipopago, $estado);
        }
        $request_insert = $this->update($query_insert,$arrData);
        return $request_insert;
    }

    public function selectCupon(string $codigo= NULL)
    {
        $sql = "SELECT * FROM cupon WHERE id_cupon = '{$codigo}' AND estado = 'A'";
        $request = $this->select($sql);
        return $request;
    }
}
