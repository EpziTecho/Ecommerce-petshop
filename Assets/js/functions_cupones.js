let tableCupones;
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function() {
    let formCupones = document.querySelector('#formCupones');
    formCupones.onsubmit = function(e) {
        e.preventDefault();
        let strNombre = document.querySelector('#txtNombre').value;
        let strFechaInicio = document.querySelector('#txtFechaInicio').value;
        let strFechaFin = document.querySelector('#txtFechaFin').value;
        let strDescuento = document.querySelector('#txtDescuento').value;
        let strTotal = document.querySelector('#txtTotal').value;
        let strEstado = document.querySelector('#listStatus').value;

        if (strNombre == '' || strFechaInicio == '' || strFechaFin == '' || strDescuento == '' || strTotal == '' || strEstado == '') {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/Cupon/setCupones';
        let formData = new FormData(formCupones);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#modalFormCupones').modal("hide");
                    formCupones.reset();
                    swal("Cupones", objData.msg, "success");
                    tableCupones.api().ajax.reload(function() {
                        fntEditCupon();

                    });
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }


    }
}, false);


tableCupones = $('#tableCupones').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax": {
        "url": " " + base_url + "/Cupon/getCupones",
        "dataSrc": ""
    },
    "columns": [
        { "data": "id" },
        { "data": "cupon" },
        { "data": "porcentaje" },
        { "data": "fecha_inicio" },
        { "data": "fecha_fin" },
        { "data": "cantidad" },
        { "data": "total" },
        { "data": "estado" },
        { "data": "options" }

    ],
    'dom': 'lBfrtip',
    'buttons': [{
        "extend": "copyHtml5",
        "text": "<i class='far fa-copy'></i> Copiar",
        "titleAttr": "Copiar",
        "className": "btn btn-secondary"
    }, {
        "extend": "excelHtml5",
        "text": "<i class='fas fa-file-excel'></i> Excel",
        "titleAttr": "Esportar a Excel",
        "className": "btn btn-success"
    }, {
        "extend": "pdfHtml5",
        "text": "<i class='fas fa-file-pdf'></i> PDF",
        "titleAttr": "Esportar a PDF",
        "className": "btn btn-danger"
    }, {
        "extend": "csvHtml5",
        "text": "<i class='fas fa-file-csv'></i> CSV",
        "titleAttr": "Esportar a CSV",
        "className": "btn btn-info"
    }],
    "resonsieve": "true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order": [
        [0, "desc"]
    ]
});


function fntViewCupon(idcupon) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Cupon/getCupon/' + idcupon;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let estadoCupon = objData.data.estado == "A" ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celId").innerHTML = objData.data.id;
                document.querySelector("#celDescripcion").innerHTML = objData.data.cupon;
                document.querySelector("#celDescuento").innerHTML = objData.data.porcentaje;
                document.querySelector("#celFechaInicio").innerHTML = objData.data.fecha_inicio;
                document.querySelector("#celFechaFin").innerHTML = objData.data.fecha_fin;
                document.querySelector("#celCantidadUsado").innerHTML = objData.data.cantidad;
                document.querySelector("#celTotal").innerHTML = objData.data.total;
                document.querySelector("#celEstado").innerHTML = estadoCupon;

                $('#modalViewCupon').modal('show');

            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}


function fntEditCupon(idcupon) {
    document.querySelector('#titleModal').innerHTML = "Actualizar Cupon";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Cupon/getCupon/' + idcupon;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idCupones").value = objData.data.id;
                document.querySelector("#txtNombre").value = objData.data.cupon;
                document.querySelector("#txtDescuento").value = objData.data.porcentaje;
                document.querySelector("#txtFechaInicio").value = objData.data.fecha_inicio;
                document.querySelector("#txtFechaFin").value = objData.data.fecha_fin;
                document.querySelector("#txtTotal").value = objData.data.total;
                document.querySelector("#listStatus").value = objData.data.estado;
                if (objData.data.estado == "A") {
                    document.querySelector("#listStatus").value == "ACTIVO";
                } else {
                    document.querySelector("#listStatus").value == "INACTIVO";
                }
            } else {
                swal("Error", objData.msg, "error");
            }

        }
        $('#modalFormCupones').modal('show');

    }

}


function fntDelCupon(idcupon) {
    swal({
        title: "Eliminar Cupon",
        text: "¿Realmente quiere eliminar el Cupon?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Cupon/delCupon';
            let strData = "idcupon=" + idcupon;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableCupones.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    });
}




function openModal() {
    rowTable = "";
    document.querySelector('#idCupones').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Cupón";
    document.querySelector("#formCupones").reset();
    $('#modalFormCupones').modal('show');
}