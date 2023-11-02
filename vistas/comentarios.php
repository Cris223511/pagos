<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
  header("Location: login.html");
} else {
  require 'header.php';

  if ($_SESSION['conversaciones'] == 1) {
?>
    <div class="content-wrapper">
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h1 class="box-title">Comentarios
                </h1>
                <div class="box-tools pull-right">
                </div>
              </div>
              <div class="panel-body table-responsive" id="listadoregistros">
                <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover w-100" style="width: 100% !important;">
                  <thead>
                    <th>Opciones</th>
                    <th>De</th>
                    <th>Para</th>
                    <th>Asunto</th>
                    <th style="width: 40%; min-width: 280px; white-space: nowrap;">Mensaje</th>
                    <th style="white-space: nowrap;">Fecha y hora</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>Opciones</th>
                    <th>De</th>
                    <th>Para</th>
                    <th>Asunto</th>
                    <th>Mensaje</th>
                    <th>Fecha y hora</th>
                  </tfoot>
                </table>
              </div>
              <div class="panel-body" style="height: 400px;" id="formularioregistros">
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label>De:</label>
                  <input type="text" class="form-control" name="emisor" id="emisor" autocomplete="off" disabled>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label>Para:</label>
                  <input type="text" class="form-control" name="receptor" id="receptor" autocomplete="off" disabled>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <label>Asunto:</label>
                  <input type="text" class="form-control" name="asunto" id="asunto" autocomplete="off" disabled>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <label>Mensaje:</label>
                  <textarea type="text" class="form-control" name="mensaje" id="mensaje" rows="4" disabled></textarea>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <button class="btn btn-warning" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cerrar</button>
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
  <script type="text/javascript" src="scripts/comentarios1.js"></script>
<?php
}
ob_end_flush();
?>