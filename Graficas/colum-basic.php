<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'column'
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
        text: 'Promedios Dia'
    },
    xAxis: {
        categories: [
            <?php
            $consulta="SELECT * FROM materadate WHERE fechaMatera BETWEEN '$fechaIni' AND '$fechaFin'and horaMatera BETWEEN '$horaIni' AND '$horaFin'  GROUP BY fechaMatera ORDER BY `fechaMatera` ASC";
            $resultado=$conexion->query($consulta);
             while($date=$resultado->fetch_assoc()){ 
            ?>
            ['<?php echo $date['fechaMatera'];?>'],

            <?php }?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Porcentaje (%)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}%</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Humedad',
        data: [
        <?php
            $consulta="SELECT humMatera,count(humMatera) AS Contador, sum(humMatera) AS suma FROM materadate WHERE fechaMatera BETWEEN '$fechaIni' AND '$fechaFin'and horaMatera BETWEEN '$horaIni' AND '$horaFin' GROUP BY fechaMatera ORDER BY `fechaMatera` ASC";
            $resultado=$conexion->query($consulta);
             while($date=$resultado->fetch_assoc()){ 
                $cont=$date['Contador'];
                $suma=$date['suma'];
                $promedio=$suma/$cont;
            ?>
            [<?php 
                   echo $promedio;
            ?>],
            <?php }?>

            ]

    }, {
        name: 'Luminosidad',
        data: [
        <?php
            $consulta="SELECT luzMatera,count(luzMatera) AS Contador, sum(luzMatera) AS suma FROM materadate WHERE fechaMatera BETWEEN '$fechaIni' AND '$fechaFin'and horaMatera BETWEEN '$horaIni' AND '$horaFin' GROUP BY fechaMatera ORDER BY `fechaMatera` ASC";
            $resultado=$conexion->query($consulta);
             while($date=$resultado->fetch_assoc()){ 
                $cont=$date['Contador'];
                $suma=$date['suma'];
                $promedio=$suma/$cont;
            ?>
            [<?php 
                   echo $promedio;
            ?>],
            <?php }?>
        ]

    }]
});
</script>

