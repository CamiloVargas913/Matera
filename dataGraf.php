<?php $d=date("D");?>
<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'areaspline'
    },
    title: {
        text: '<?php echo $d?>'
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
				$d=date('y/m/d');
				$consulta="SELECT * FROM materadate WHERE fechaMatera='$d' ORDER BY `horaMatera` DESC limit 10";
				$resultado=$conexion->query($consulta);
				while($date=$resultado->fetch_assoc()){	
			?>
            ['<?php echo $date['horaMatera']."<br>ID Matera: ".$date['idMatera'];?>'],
            <?php }?>
        ],
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
				$d=date('y/m/d');
				$consulta="SELECT * FROM materadate WHERE fechaMatera='$d' ORDER BY `horaMatera` DESC limit 10";
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
				$d=date('y/m/d');
				$consulta="SELECT * FROM materadate WHERE fechaMatera='$d' ORDER BY `horaMatera` DESC limit 10";
				$resultado=$conexion->query($consulta);
				while($date=$resultado->fetch_assoc()){	
			?>
            [<?php echo $date['luzMatera'];?>],
            <?php }?>
        ]
    }]
});
 </script>