<?php include("conexion.php");
    $planta = $_POST['planta'];
    $fechaIni = $_POST['fechaIni'];
    $horaIni = $_POST['horaIni'];
    $fechaFin = $_POST ['fechaFin'];
    $horaFin = $_POST ['horaFin'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<meta name="description" content="">
	
	<meta name="author" content="">
	<!--datos de graficas -->
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>

	<link rel="icon" href="images/favicon.ico">
	
	<title>Matera</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
								
								<div class="card mb-4">
									<div class="card-block">
										<div class="table-responsive">	
											<table class="table table-striped">
												<thead>
													<tr>
														<th>Id Matera</th>

														<th>Luminosidad</th>
														
														<th>Humedad</th>
														
														<th>Fecha</th>
														
														<th>Hora</th>
													</tr>
												</thead>
												<tbody>
													<?php
											            $consulta="SELECT * FROM materadate WHERE fechaMatera BETWEEN '$fechaIni' AND '$fechaFin'and horaMatera BETWEEN '$horaIni' AND '$horaFin' ORDER BY `horaMatera` DESC";
											            $resultado=$conexion->query($consulta);
											             while($date=$resultado->fetch_assoc()){ 
											            ?>
													<tr>
														<td><?php echo $date['idMatera'];?></td>
														
														<td><?php echo $date['luzMatera'];?></td>
														
														<td><?php echo $date['humMatera'];?></td>
															
														<td><?php echo $date['fechaMatera'];?></td>

														<td><?php echo $date['horaMatera'];?></td>
													</tr>	
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
					</div>
				</section>
			</main>
		</div>
	</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    
	  </body>
</html>
