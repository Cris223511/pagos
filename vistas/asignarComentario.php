<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
  header("Location: login.html");
} else {
  require 'header.php';

  if ($_SESSION['perfilu'] == 1 && ($_SESSION['cargo'] == "superadmin" || $_SESSION['cargo'] == "admin")) {
?>
    <div class="content-wrapper">
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h1 class="box-title">Asignar comentarios
                  <button class="btn btn-bcp" id="btnagregar" onclick="mostrarform(true)">
                    <i class="fa fa-plus-circle"></i> Agregar
                  </button>
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
                <form name="formulario" id="formulario" method="POST">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>De(*):</label>
                    <input type="hidden" name="idconversacion" id="idconversacion">
                    <select id="emisor" name="emisor" class="form-control selectpicker" data-size="5"  disabled>
                      <option value="">- Seleccione -</option>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Para(*):</label>
                    <select id="receptor" name="receptor" class="form-control selectpicker" data-live-search="true" data-size="5" required>
                      <option value="">- Seleccione -</option>
                    </select>
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Asunto(*):</label>
                    <input type="text" class="form-control" name="asunto" id="asunto" maxlength="40" autocomplete="off" placeholder="Ingrese un asunto." required>
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Mensaje(*):</label>
                    <textarea type="text" class="form-control" name="mensaje" id="mensaje" maxlength="250" placeholder="Ingrese un mensaje." rows="4" required></textarea>
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-warning" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cerrar</button>
                    <button class="btn btn-bcp" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                    <button class="btn btn-success" type="button" onclick="enviarTodos()"><i class="fa fa-save"></i> Enviar a todos</button>
                  </div>
                </form>
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
  <script type="text/javascript" src="scripts/asignarComentario5.js"></script>
<?php
}
ob_end_flush();
?>