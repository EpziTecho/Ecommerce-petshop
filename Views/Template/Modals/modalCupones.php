<!-- Modal -->
<div class="modal fade" id="modalFormCupones" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nueva Cupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formCupones" name="formCupones" class="formCupones">
              <input type="hidden" id="idCupones" name="idCupones" value="">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Nombre <span class="required">*</span></label>
                      <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre Cupón" required="">
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label">Fecha Inicio <span class="required">*</span></label>
                      <input class="form-control" id="txtFechaInicio" name="txtFechaInicio" type="date" placeholder="Fecha Inicio" required="" value="">
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label">Fecha Fin <span class="required">*</span></label>
                      <input class="form-control" id="txtFechaFin" name="txtFechaFin" type="date" placeholder="Fecha Fin" required="">
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label">Descuento <span class="required">*</span></label>
                      <input class="form-control" id="txtDescuento" name="txtDescuento" type="text" placeholder="Descuento" required="">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Total <span class="required">*</span></label>
                      <input class="form-control" id="txtTotal" name="txtTotal" type="text" placeholder="Total" required="">
                    </div>

                    <div class="form-group">
                        <label for="exampleSelect1">Estado <span class="required">*</span></label>
                        <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                          <option value="A">Activo</option>
                          <option value="I">Inactivo</option>
                        </select>
                    </div>  
                </div>
                
                <!-- <div class="col-md-6">
                    <div class="photo">
                        <label for="foto">Foto (570x380)</label>
                        <div class="prevPhoto">
                          <span class="delPhoto notBlock">X</span>
                          <label for="foto"></label>
                          <div>
                            <img id="img" src="<?= media(); ?>/images/uploads/portada_categoria.png">
                          </div>
                        </div>
                        <div class="upimg">
                          <input type="file" name="foto" id="foto">
                        </div>
                        <div id="form_alert"></div>
                    </div>
                </div> -->
              </div>
              
              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalViewCupon" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Detalle del cupón</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>ID:</td>
              <td id="celId"></td>
            </tr>
            <tr>
              <td>Descripcion:</td>
              <td id="celDescripcion"></td>
            </tr>
            <tr>
              <td>% Descuento:</td>
              <td id="celDescuento"></td>
            </tr>
            <tr>
              <td>Fecha Inicio</td>
              <td id="celFechaInicio"></td>
            </tr>
            <tr>
              <td>Fecha Fin</td>
              <td id="celFechaFin"></td>
            </tr>
            <tr>
              <td>Cantidad Usado</td>
              <td id="celCantidadUsado"></td>
            </tr>
            <tr>
              <td>Total</td>
              <td id="celTotal"></td>
            </tr>
            <tr>
              <td>Estado</td>
              <td id="celEstado"></td>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

