<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        zoomType: 'xy'
    },
    title: {
        <?php
        $consulta="SELECT nombreMatera FROM `materas` WHERE idMatera = '$planta'";
            $resultado=$conexion->query($consulta);
             while($date=$resultado->fetch_assoc()){ 
            ?>
        text: '<?php echo $date['nombreMatera'];?>'
        <?php }?>
    },
    subtitle: {
        text: 'Datos Por Hora'
    },
    xAxis: [{
        categories: [<?php
            $consulta="SELECT * FROM materadate WHERE fechaMatera BETWEEN '$fechaIni' AND '$fechaFin'and horaMatera BETWEEN '$horaIni' AND '$horaFin' ORDER BY `horaMatera` DESC";
            $resultado=$conexion->query($consulta);
             while($date=$resultado->fetch_assoc()){ 
            ?>
            ['<?php echo $date['fechaMatera']."<br>".$date['horaMatera'];?>'],

            <?php }?>],
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}%',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: 'Luminosidad',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        title: {
            text: 'Humedad',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value} %',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        x: 100,
        verticalAlign: 'top',
        y: 1,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    series: [{
        name: 'Humedad',
        type: 'column',
        yAxis: 1,
        data: [
            <?php
            $consulta="SELECT humMatera FROM materadate WHERE fechaMatera BETWEEN '$fechaIni' AND '$fechaFin'and horaMatera BETWEEN '$horaIni' AND '$horaFin' ORDER BY `horaMatera` DESC";
            $resultado=$conexion->query($consulta);
             while($date=$resultado->fetch_assoc()){ 
            ?>
            [<?php echo $date['humMatera'];?>],
            <?php }?>

        ],
        tooltip: {
            valueSuffix: ' %'
        }

    }, {
        name: 'Luminosidad',
        type: 'spline',
        data: [
            <?php
            $consulta="SELECT luzMatera FROM materadate WHERE fechaMatera BETWEEN '$fechaIni' AND '$fechaFin'and horaMatera BETWEEN '$horaIni' AND '$horaFin' ORDER BY `horaMatera` DESC";
            $resultado=$conexion->query($consulta);
             while($date=$resultado->fetch_assoc()){ 
            ?>
            [<?php echo $date['luzMatera'];?>],
            <?php }?>
        ],
        tooltip: {
            valueSuffix: ' %'
        }
    }]
});
		</script>
