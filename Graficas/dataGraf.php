<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<div  id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<?php 
$d=date("D");
include("../conexion.php");
    $planta = $_POST['planta'];
    $fechaIni = $_POST['fechaIni'];
    $horaIni = $_POST['horaIni'];
    $fechaFin = $_POST ['fechaFin'];
    $horaFin = $_POST ['horaFin'];
    $graficas = $_POST ['grafico'];
    switch ($graficas) {
      case '1':
        include("areaspline.php");
        break;
      case '2':
        include("combo-dual-axes.php");
        break;
      case '3':
        include("colum-basic.php");
        break;     
      default:
        # code...
        break;
    }
?>