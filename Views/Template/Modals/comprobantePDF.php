<?php
$cliente = $data['cliente'];
$orden = $data['orden'];
$detalle = $data['detalle'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        table {
            width: 100%;
        }

        table td,
        table th {
            font-size: 10px;
        }

        h4 {
            margin-bottom: 0px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .wd33 {
            width: 33.3%;
        }

        .tbl-cliente {
            border: 1px solid #CCC;
            border-radius: 10px;
            padding: 5px;
        }

        .wd10 {
            width: 10%;
        }

        .wd40 {
            width: 40%;
        }

        .wd55 {
            width: 55%;
        }

        .wd15 {
            width: 15%;
        }

        .tbl-detalle {
            border-collapse: collapse;
        }

        .tbl-detalle thead th {
            padding: 5px;
            background-color: #009688;
            color: #FFF;
        }

        .tbl-detalle tbody td {
            border-bottom: 1px solid #CCC;
            padding: 5px;
        }
    </style>
</head>

<body>
    <table class="tbl-header">
        <tbody>
            <tr>
                <td class="wd33">
                    <img src="https://i.ibb.co/1m1Pkw9/logo-1-1.jpg" width="111" height="30" alt="Logo">
                </td>
                <td class="text-center wd33">
                    <h4><strong><?= NOMBRE_EMPRESA ?></strong></h4>
                    <p><?= DIRECCION ?><br>
                        Telefono: <?= TELEFONOEMPRESA ?> <br>
                        Email : <?= EMAIL_EMPRESA ?> </p>
                </td>
                <td class="text-right wd33">
                    <p>No.Orden<strong><?= $orden['idpedido'] ?></strong> <br>
                        Fecha: <?= $orden['fecha'] ?><br>
                        <?php
                        if ($orden['tipopagoid'] == 1) {
                        ?>
                            Metodo Pago: <?= $orden['tipopago'] ?><br>
                            Transacion: <?= $orden['idtransaccionpaypal'] ?>
                        <?php } else{?>
                        Metodo Pago: Contra entrega<br>
                        Transacion: <?= $orden['tipopago'] ?>
                        <?php }?>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table class="tbl-cliente">
        <tbody>
            <tr>
                <td class="wd10">DNI</td>
                <td class="wd40"><?= $cliente['nit'] ?></td>
                <td class="wd10">Telefono</td>
                <td class="wd40"><?= $cliente['telefono'] ?></td>
            </tr>
            <tr>
                <td>Nombre:</td>
                <td><?= $cliente['nombres'].' '.$cliente['apellidos']?></td>
                <td>Direccion</td>
                <td><?= $cliente['direccionfiscal']?></td>
            </tr>
        </tbody>
    </table>
    <br>
    <table class="tbl-detalle">
        <thead>
            <tr>
                <th class="wd55">Descripcion</th>
                <th class="wd15 text-right">Precio</th>
                <th class="wd15 text-center">Cantidad</th>
                <th class="wd15 text-right">Importe</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $subtotal=0;
                foreach ($detalle as $producto) {
                    $importe = $producto['precio'] * $producto['cantidad'];
                    $subtotal += $importe;
            ?>
            <tr>
                <td><?= $producto['producto']?></td>
                <td class="text-right"><?= SMONEY.' '.formatMoney($producto['precio']) ?></td>
                <td class="text-center"><?= $producto['cantidad'] ?></td>
                <td class="text-right"><?= SMONEY.' '.formatMoney($importe) ?></td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right">Subtotal:</td>
                <td class="text-right"><?= SMONEY.' '.formatMoney($subtotal) ?></td>
            </tr>
                <?php if($orden['costoenvio'] > 0){ ?>
                    <tr>
                      <th colspan="3" class="text-right">Envio:</th>
                      <td class="text-right"><?= SMONEY.' '.formatMoney($orden['costoenvio'])?></td>
                    </tr>
                    <?php } ?>
                    <?php if($orden['id_cupon'] != 0 ){ 
                        
                      ?>
                      
                    <tr>
                      <th colspan="3" class="text-right">Descuento:</th>
                      <td class="text-right"><?= SMONEY.' '.(($data['arrCupon']['porcentaje_dscto']*$subtotal)/100)?></td>
                    </tr>
                    <?php }else{ ?>
                      <tr>
                      <th colspan="3" class="text-right">Descuento:</th>
                      <td class="text-right">Sin descuentos</td>
                    </tr>
                    <?php } ?>
            <tr>
                <?php if($orden['costoenvio'] > 0){ ?>
                    <tr>
                      <th colspan="3" class="text-right">Envio:</th>
                      <td class="text-right"><?= SMONEY.' '.formatMoney($orden['costoenvio'])?></td>
                    </tr>
                    <?php } ?>
                <td colspan="3" class="text-right">Total:</td>
                <td class="text-right"><?= SMONEY.' '.formatMoney($orden['monto']) ?></td>
            </tr>
        </tfoot>
    </table>
    <div class="text-center">
        <p>Si tienes una pregunta sobre tu pedido,<br> pongase en contacto con nombre, telefono e Email</p>
        <h4>¡Gracias por tu compra!</h4>
    </div>
</body>

</html>