<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
  header("Location: login.html");
} else {
  require 'header.php';

  if ($_SESSION['ticket'] == 1) {
?>
    <div class="content-wrapper">
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h1 class="box-title">Tickets
                  <button class="btn btn-bcp" id="btnagregar" onclick="mostrarform(true)">
                    <i class="fa fa-plus-circle"></i> Agregar
                  </button>
                  <a href="../reportes/rpttickets.php" target="_blank">
                    <button class="btn btn-secondary" style="color: black !important;">
                      <i class="fa fa-clipboard"></i> Reporte
                    </button>
                  </a>
                </h1>
                <div class="box-tools pull-right">
                </div>
              </div>
              <div class="panel-body table-responsive" id="listadoregistros">
                <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover w-100" style="width: 100% !important;">
                  <thead>
                    <th>Opciones</th>
                    <th style="white-space: nowrap;">Agregado por</th>
                    <th>cargo</th>
                    <th>Banco</th>
                    <th style="white-space: nowrap;">N° Ticket</th>
                    <th>Operación</th>
                    <th style="white-space: nowrap;">N° Operación</th>
                    <th>Local</th>
                    <th style="white-space: nowrap;">RUC Local</th>
                    <th>Importe</th>
                    <th>Comisión</th>
                    <th style="white-space: nowrap;">Fecha y hora</th>
                    <th>Estado</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>Opciones</th>
                    <th>Agregado por</th>
                    <th>cargo</th>
                    <th>Banco</th>
                    <th>N° Ticket</th>
                    <th>Operación</th>
                    <th>N° Operación</th>
                    <th>Local</th>
                    <th>RUC Local</th>
                    <th>Importe</th>
                    <th>Comisión</th>
                    <th>Fecha y hora</th>
                    <th>Estado</th>
                  </tfoot>
                </table>
              </div>

              <form name="formulario" id="formulario" method="POST">
                <div class="panel-body formularioregistros" style="background-color: #ecf0f5 !important; padding-left: 0 !important; padding-right: 0 !important; height: max-content;">
                  <div class="col-lg-12 col-md-12 col-sm-12" style="padding: 8px !important; padding-left: 20px !important; padding-right: 20px !important; background-color: white;">
                    <div class="box-header">
                      <h1 class="box-title"><strong>Bancos y operaciones</strong></h1>
                    </div>
                  </div>
                </div>
                <div class="panel-body formularioregistros" style="background-color: white !important; padding-left: 0 !important; padding-right: 0 !important; padding-top: 0 !important; height: max-content;">
                  <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: white; border-top: 3px #3686b4 solid; padding-top: 20px;">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Banco(*):</label>
                      <input type="hidden" name="idticket" id="idticket">
                      <select id="idbanco" name="idbanco" class="form-control selectpicker" data-live-search="true" data-size="5" required>
                        <option value="">- Seleccione -</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Operación(*):</label>
                      <select id="idoperacion" name="idoperacion" class="form-control selectpicker" data-live-search="true" data-size="5" required>
                        <option value="">- Seleccione -</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="panel-body formularioregistros" style="background-color: #ecf0f5 !important; padding-left: 0 !important; padding-right: 0 !important; height: max-content;">
                  <div class="col-lg-12 col-md-12 col-sm-12" style="padding: 8px !important; padding-left: 20px !important; padding-right: 20px !important; background-color: white;">
                    <div class="box-header">
                      <h1 class="box-title"><strong>Datos del local</strong></h1>
                    </div>
                  </div>
                </div>
                <div class="panel-body formularioregistros" style="background-color: white !important; padding-left: 0 !important; padding-right: 0 !important; padding-top: 0 !important; height: max-content;">
                  <div class="col-lg-12 col-md-12 col-sm-12" style="border-top: 3px #3686b4 solid; padding-top: 20px;">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Local(*):</label>
                      <select id="idlocal" name="idlocal" class="form-control selectpicker idlocal" data-live-search="true" data-size="5" onchange="actualizarRUC()">
                        <option value="">- Seleccione -</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>RUC local(*):</label>
                      <input type="number" class="form-control" id="local_ruc" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" placeholder="RUC del local" disabled>
                    </div>
                  </div>
                </div>
                <div class="panel-body formularioregistros" style="background-color: #ecf0f5 !important; padding-left: 0 !important; padding-right: 0 !important; height: max-content;">
                  <div class="col-lg-12 col-md-12 col-sm-12" style="padding: 8px !important; padding-left: 20px !important; padding-right: 20px !important; background-color: white;">
                    <div class="box-header">
                      <h1 class="box-title"><strong>Datos del ticket</strong></h1>
                    </div>
                  </div>
                </div>
                <div class="panel-body formularioregistros" style="background-color: white !important; padding-left: 0 !important; padding-right: 0 !important; padding-top: 0 !important; height: max-content;">
                  <div class="col-lg-12 col-md-12 col-sm-12" style="border-top: 3px #3686b4 solid; padding-top: 20px;">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>N° de ticket(*):</label>
                      <input type="number" class="form-control" name="num_ticket" id="num_ticket" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" placeholder="Ingrese el N° de ticket." required>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>N° de operación(*):</label>
                      <input type="number" class="form-control" name="num_ope" id="num_ope" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" placeholder="Ingrese el N° de operación." required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12" style="padding: 0;">
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Tipo de letra(*):</label>
                        <select class="form-control select-picker" name="tipo_letra" id="tipo_letra" required>
                          <option value="">- Seleccione -</option>
                          <option value="hypermarket">Hypermarket</option>
                        </select>
                      </div>
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Importe(*):</label>
                        <input type="number" class="form-control" name="importe" id="importe" step="any" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" onkeydown="evitarNegativo(event)" onpaste="return false;" onDrop="return false;" min="0" placeholder="Ingrese el importe." required>
                      </div>
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Comisión(*):</label>
                        <input type="number" class="form-control" name="comision" id="comision" step="any" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" onkeydown="evitarNegativo(event)" onpaste="return false;" onDrop="return false;" min="0" placeholder="Ingrese la comisión." required>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12" style="padding: 0;">
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Descripción:</label>
                        <textarea type="text" class="form-control" name="descripcion" id="descripcion" rows="9" style="resize: none;" placeholder="Ingrese una descripción." required></textarea>
                      </div>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <button class="btn btn-warning" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                      <?php
                      if ($_SESSION['cargo'] != 'vendedor_impresion') {
                        echo '<button class="btn btn-bcp" type="submit" onclick="guardaryeditar(event)" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>';
                      } else {
                        echo '<button class="btn btn-bcp" type="submit" onclick="guardaryeditar(event)" id="btnGuardar2"><i class="fa fa-save"></i> Guardar</button>';
                        echo '<a target="_blank" href="" id="visualizar"> <button class="btn btn-success" type="button">Visualizar</button></a>';
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  <?php
  } else {
    require 'noacceso.php';
  }

  require 'footer.php';
  ?>
  <script type="text/javascript" src="scripts/tickets12.js"></script>
<?php
}
ob_end_flush();
?>