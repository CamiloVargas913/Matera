<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'areaspline'
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
    legend: {
        layout: 'vertical',
        align: 'left',
        verticalAlign: 'top',
        x: 100,
        y: 1,
        floating: true,
        borderWidth: 1,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    xAxis: {
        title: {
            text: 'Hora'
        },
        categories: [
            <?php
            $consulta="SELECT * FROM materadate WHERE fechaMatera BETWEEN '$fechaIni' AND '$fechaFin'and horaMatera BETWEEN '$horaIni' AND '$horaFin' ORDER BY `horaMatera` DESC";
            $resultado=$conexion->query($consulta);
             while($date=$resultado->fetch_assoc()){ 
            ?>
            ['<?php echo $date['fechaMatera']."<br>".$date['horaMatera'];?>'],

            <?php }?>
        ],
        plotBands: [{ // visualize the weekend
            from: 4.5,
            to: 6.5,
            color: 'rgba(68, 170, 213, .2)'
        }]
    },
    yAxis: {
        title: {
            text: 'Porcentaje %'
        }
    },
    tooltip: {
        shared: true,
        valueSuffix: '%'
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        areaspline: {
            fillOpacity: 0.5
        }
    },
    series: [{
        name: 'Humedad',
        data: [
        <?php
            $consulta="SELECT humMatera FROM materadate WHERE fechaMatera BETWEEN '$fechaIni' AND '$fechaFin'and horaMatera BETWEEN '$horaIni' AND '$horaFin' ORDER BY `horaMatera` DESC";
            $resultado=$conexion->query($consulta);
             while($date=$resultado->fetch_assoc()){ 
            ?>
            [<?php echo $date['humMatera'];?>],
            <?php }?>

            ]
    }, {
        name: 'Luminosidad',
        data: [
           <?php
            $consulta="SELECT luzMatera FROM materadate WHERE fechaMatera BETWEEN '$fechaIni' AND '$fechaFin'and horaMatera BETWEEN '$horaIni' AND '$horaFin' ORDER BY `horaMatera` DESC";
            $resultado=$conexion->query($consulta);
             while($date=$resultado->fetch_assoc()){ 
            ?>
            [<?php echo $date['luzMatera'];?>],
            <?php }?>
        ]
    }]
});
 </script>