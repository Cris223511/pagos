<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
  header("Location: login.html");
} else {
  require 'header.php';

  if ($_SESSION['perfilu'] == 1) {
?>
    <div class="content-wrapper">
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h1 class="box-title">Reporte de locales
                  <a href="../reportes/rptreporte_locales.php" target="_blank">
                    <button class="btn btn-secondary" style="color: black !important;">
                      <i class="fa fa-clipboard"></i> Reporte
                    </button>
                  </a>
                </h1>
                <div class="box-tools pull-right">
                </div>
              </div>
              <div class="panel-body table-responsive" id="listadoregistros" style="overflow-x: visible; padding-left: 0px; padding-right: 0px;">
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <label>Local:</label>
                  <select id="idlocal" name="idlocal" class="form-control selectpicker" data-live-search="true" data-size="5">
                    <option value="">- Seleccione -</option>
                  </select>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <label>Fecha Inicial:</label>
                  <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <label>Fecha Final:</label>
                  <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
                </div>
                <div style="display: flex; gap: 10px; padding: 15px; padding-top: 0px; padding-bottom: 0px;">
                  <button style="margin-top: 10px;" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 btn btn-warning" id="buscarPorLocal" onclick="buscarPorLocal()">Buscar por local</button>
                  <button style="margin-top: 10px;" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 btn btn-bcp" id="buscarTodos" onclick="buscarTodos()">Buscar todos</button>
                  <button style="margin-top: 10px;" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 btn btn-bcp" id="buscarPorFecha" onclick="buscarPorFecha()">Buscar por rango de fecha</button>
                  <button style="margin-top: 10px;" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 btn btn-success" id="resetear" onclick="resetear()">Resetear</button>
                </div>
              </div>
              <div class="panel-body formularioregistros" style="background-color: #ecf0f5 !important; padding-left: 0 !important; padding-right: 0 !important; height: max-content;">
                <div class="table-responsive" style="padding: 8px !important; padding: 20px !important; background-color: white;">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover w-100" style="width: 100% !important;">
                    <thead>
                      <th style="white-space: nowrap;">Fecha y hora</th>
                      <th>Local</th>
                      <th style="white-space: nowrap;">RUC Local</th>
                      <th style="white-space: nowrap;">Agregado por</th>
                      <th>Cargo</th>
                      <th>Estado</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <th>Fecha y hora</th>
                      <th>Local</th>
                      <th>RUC Local</th>
                      <th>Agregado por</th>
                      <th>Cargo</th>
                      <th>Estado</th>
                    </tfoot>
                  </table>
                </div>
              </div>
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
  <script type="text/javascript" src="scripts/reporte_locales1.js"></script>
<?php
}
ob_end_flush();
?>