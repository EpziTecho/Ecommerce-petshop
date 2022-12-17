document.addEventListener('DOMContentLoaded', function () {

    paypal.Buttons({
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: (total / 3.90).toFixed(2)
                    }
                }]
            });
        },
        onApprove: (data, actions) => {
            return actions.order.capture().then(function (details) {
                let idcupon = document.querySelector("#hdIdCupon").value;
                let direccion = document.querySelector("#txtDireccion").value;
                let ciudad = document.querySelector("#txtCiudad").value;
                let inttipopago = 1;
                let request = (window.XMLHttpRequest) ?
                    new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url + '/Tienda/procesarVenta';
                let formData = new FormData();
                formData.append('direccion', direccion);
                formData.append('ciudad', ciudad);
                formData.append('inttipopago', inttipopago);
                formData.append('idCupon', idcupon);
                formData.append('datapay', JSON.stringify(details));
                formData.append('total', total);
                formData.append('costo_envio', document.getElementById("paypal").checked ? costoEnvio : 0);
                request.open("POST", ajaxUrl, true);
                request.send(formData);
                request.onreadystatechange = function () {
                    if (request.readyState !== 4) return;
                    if (request.status === 200) {
                        let objData = JSON.parse(request.responseText);
                        if (objData.status) {
                            window.location = base_url + "/Tienda/confirmarpedido/";
                        } else {
                            swal("", objData.msg, "error");
                        }
                    }
                }
            });
        }
    }).render('#paypal-btn-container');
}, false);