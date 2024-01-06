<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
  header("Location: login.html");
} else {
  require 'header.php';

  if ($_SESSION['escritorio'] == 1) {
?>
    <style>
      .tarjeta1 {
        background-color: #27a844;
      }

      .tarjeta2 {
        background-color: #fec107;
      }

      .tarjeta3 {
        background-color: #17a2b7;
      }

      .ticket1 {
        color: #68c37e;
      }

      .ticket2 {
        color: #ffd250;
      }

      .ticket3 {
        color: #5cbfce;
      }

      .tarjeta1,
      .tarjeta2,
      .tarjeta3 {
        padding: 10px;
        border-radius: 20px;
        color: white;
      }

      .tarjeta1 h1,
      .tarjeta2 h1,
      .tarjeta3 h1 {
        font-weight: bold;
      }

      @media (max-width: 1199px) {
        .marco {
          padding-top: 10px !important;
          padding-bottom: 10px !important;
          padding-left: 15px !important;
          padding-right: 15px !important;
        }

        .marco:nth-child(1),
        .marco:nth-child(2) {
          padding-top: 0 !important;
        }
      }

      @media (max-width: 991px) {
        .marco:nth-child(2) {
          padding-top: 10px !important;
        }
      }
    </style>
    <div class="content-wrapper">
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h1 class="box-title">Escritorio</h1>
                <div class="box-tools pull-right">
                </div>
              </div>
              <div class="panel-body table-responsive" id="listadoregistros" style="overflow-x: visible; padding-left: 0px; padding-right: 0px;">
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label>Fecha Inicial:</label>
                  <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label>Fecha Final:</label>
                  <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
                </div>
                <div style="display: flex; gap: 10px; padding: 15px; padding-top: 0px; padding-bottom: 0px;">
                  <button style="margin-top: 10px;" class="col-lg-4 col-md-4 col-sm-12 col-xs-12 btn btn-bcp" id="buscarPorFecha" onclick="buscarPorFecha()">Calcular por rango de fecha</button>
                  <button style="margin-top: 10px;" class="col-lg-4 col-md-4 col-sm-12 col-xs-12 btn btn-success" id="resetear" onclick="resetear()">Resetear</button>
                </div>
              </div>
              <div class="panel-body formularioregistros" style="background-color: white !important; padding-left: 0 !important; padding-right: 0 !important; height: max-content;">
                <div class="panel-body" style="padding-top: 0; padding-bottom: 0; padding-left: 15px; padding-right: 15px;">
                  <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 marco" style="padding-right: 10px">
                      <div class="tarjeta1">
                        <div class="display: flex; flex-direction: column; aligh-items: start; justify-content: start;">
                          <h1 id="importe" style="z-index: 1000 !important">S/. 0.00</h1>
                          <span style="z-index: 1000 !important">Importe Total</span>
                          <i class="fa fa-money ticket1" style="position: absolute; top: 25px; right: 40px; font-size: 60px;"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 marco" style="padding-left: 10px; padding-right: 10px">
                      <div class="tarjeta2">
                        <div class="display: flex; flex-direction: column; aligh-items: start; justify-content: start;">
                          <h1 id="comision" style="z-index: 1000 !important">S/. 0.00</h1>
                          <span style="z-index: 1000 !important">Comisión Total</span>
                          <i class="fa fa-usd ticket2" style="position: absolute; top: 25px; right: 40px; font-size: 60px;"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 marco" style="padding-left: 10px;">
                      <div class="tarjeta3">
                        <div class="display: flex; flex-direction: column; aligh-items: start; justify-content: start;">
                          <h1 id="ticket" style="z-index: 1000 !important">0</h1>
                          <span style="z-index: 1000 !important">Tickets Total</span>
                          <i class="fa fa-ticket ticket3" style="position: absolute; top: 25px; right: 40px; font-size: 60px;"></i>
                        </div>
                      </div>
                    </div>
                  </div>
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

  <script src="../public/js/chart.min.js"></script>
  <script src="../public/js/Chart.bundle.min.js"></script>

  <script type="text/javascript" src="scripts/escritorio3.js"></script>

<?php
}
ob_end_flush();
?>