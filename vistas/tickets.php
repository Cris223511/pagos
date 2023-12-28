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
    <style>
      .part1 {
        padding-right: 15px !important;
      }

      .part2,
      .part3 {
        padding-right: 15px !important;
      }

      @media (max-width: 1199px) {

        .part1 {
          padding-right: 15px !important;
        }
      }
    </style>
    <div class="content-wrapper">
      <section class="content">
        <div class="row" style="margin: 0 !important;">
          <div class="col-md-12" style="background: white; padding-left: 0px; padding-right: 0px; padding-bottom: 20px; display: flex;">
            <div class="box" style="box-shadow: 0 0 0 rgba(0, 0, 0, 0.1); margin-bottom: 0px !important">
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
              <div class="contenido" id="listadoregistros">
                <?php
                if ($_SESSION['cargo'] != 'vendedor_impresion') {
                  echo '<div class="col-lg-7 col-md-12 col-sm-12 part1" style="padding-left: 0px;">';
                } else {
                  echo '<div class="col-lg-12 col-md-12 col-sm-12" style="padding-left: 0px; padding-right: 0px;">';
                }
                ?>
                <div class="panel-body table-responsive" style="background: white !important;">
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
              </div>
              <?php
              if ($_SESSION['cargo'] != 'vendedor_impresion') {
              ?>
                <div class="col-lg-5 col-md-12 col-sm-12 part2" style="padding-right: 0px">
                  <div class="panel-body" style="height: max-content;">
                    <div style="border-top: 3px #3686b4 solid; padding-top: 0 !important; padding-bottom: 0 !important; height: max-content;">
                      <div class="col-lg-12 col-md-12 col-sm-12" style="padding: 8px !important; padding-left: 20px !important; padding-right: 20px !important; padding-bottom: 0 !important; background-color: white;">
                        <div class="box-header" style="padding-bottom: 0 !important; padding-left: 0 !important; padding-right: 0 !important;">
                          <h1 class="box-title"><strong>Visor PDF</strong></h1>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div style="padding: 20px; width: 100%; text-align: center; font-style: italic;">
                    <h4 class="no_data">Sin datos por mostrar</h4>
                    <object type="application/pdf" style="width: 100%; height: 410px;" id="visorPDF" data=""></object>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
            <form name="formulario" id="formulario" method="POST">
              <div class="panel-body formularioregistros" style="height: max-content;">
                <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <label>N° de ticket(*):</label>
                  <input type="number" class="form-control" name="num_ticket" id="num_ticket" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" placeholder="Ingrese el N° de ticket." required>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>N° de operación(*):</label>
                  <input type="number" class="form-control" name="num_ope" id="num_ope" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" placeholder="Ingrese el N° de operación." required>
                </div>
                <div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
                  <label>Banco(*):</label>
                  <input type="hidden" name="idticket" id="idticket">
                  <select id="idbanco" name="idbanco" class="form-control selectpicker" data-live-search="true" data-size="5" required>
                    <option value="">- Seleccione -</option>
                  </select>
                </div>
                <div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
                  <label>Operación(*):</label>
                  <select id="idoperacion" name="idoperacion" class="form-control selectpicker" data-live-search="true" data-size="5" required>
                    <option value="">- Seleccione -</option>
                  </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Local(*):</label>
                  <select id="idlocal" name="idlocal" class="form-control selectpicker idlocal" data-live-search="true" data-size="5" onchange="actualizarRUC()">
                    <option value="">- Seleccione -</option>
                  </select>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <label>RUC local(*):</label>
                  <input type="number" class="form-control" id="local_ruc" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" placeholder="RUC del local" disabled>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding: 0;">
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Tipo de letra(*):</label>
                    <select class="form-control select-picker" name="tipo_letra" id="tipo_letra" required>
                      <!-- <option value="">- Seleccione -</option> -->
                      <option value="courier">Courier</option>
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
                    <textarea type="text" class="form-control" name="descripcion" id="descripcion" rows="9" style="resize: none;" placeholder="Ingrese una descripción." required oninput="verificarTexto()"></textarea>
                  </div>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <button class="btn btn-warning" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                  <?php
                  if ($_SESSION['cargo'] != 'vendedor_impresion') {
                    echo '<button class="btn btn-bcp" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>';
                  } else {
                    echo '<button class="btn btn-bcp" type="submit" id="btnGuardar2"><i class="fa fa-save"></i> Guardar</button>';
                    // echo '<a target="_blank" href="" id="visualizar"> <button class="btn btn-success" type="button">Visualizar</button></a>';
                    echo '<button class="btn btn-info" type="button" style="margin-left: 3px" id="visualizar"><i class="fa fa-sign-in"></i> Visualizar</button>';
                  }
                  ?>
                </div>
                <div class="col-lg-6 col-md-12 part3" style="padding-right: 0px; display: flex; flex-direction: column;">
                  <div style="border-top: 3px #3686b4 solid;">
                    <div class="box-header" style="padding-bottom: 0 !important; padding-left: 0 !important; padding-right: 0 !important;">
                      <h1 class="box-title"><strong>Visor PDF</strong></h1>
                    </div>
                  </div>
                  <div style="padding: 20px; width: 100%; text-align: center; font-style: italic;">
                    <object type="application/pdf" style="width: 100%; height: 410px;" id="visorPDF2" data=""></object>
                  </div>
                </div>
              </div>
            </form>
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
  <script type="text/javascript" src="scripts/tickets17.js"></script>
<?php
}
ob_end_flush();
?>