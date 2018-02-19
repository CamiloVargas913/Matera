<?php include("conexion.php");?>
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
	<div class="container-fluid" id="wrapper">
		<div class="row">
			<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2 bg-faded sidebar-style-1">
				<h1 class="site-title"><a href="index.php"><em class="fa fa-leaf"></em> Control Matera</a></h1>
				
				<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>
				
				<ul class="nav nav-pills flex-column sidebar-nav">
					<li class="nav-item"><a class="nav-link active" href="index.php"><em class="fa fa-rebel"></em> Bienvenida <span class="sr-only">(current)</span></a></li>
					<li class="nav-item"><a class="nav-link" href="charts.php"><em class="fa fa-area-chart"></em> Graficas</a></li>
					<li class="nav-item"><a class="nav-link" href="cards.php"><em class="fa fa-clone"></em> Datos</a></li>
				</ul>
				
				<a href="#" class="logout-button">Universidad De cundinamarca</a></nav>
			
			<main class="col-xs-12 col-sm-8 offset-sm-4 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 pt-3 pl-4">
				<header class="page-header row justify-center">
					<div class="col-md-6 col-lg-8" >
						<h1 class="float-left text-center text-md-center">Datos Matera</h1>
					</div>	
					<div class="clear"></div>
				</header>
				
				<section class="row">
					<div class="col-sm-12">
						<section class="row">
							<div class="col-md-12 col-lg-8">
								<div class="jumbotron">
									<h1 class="mb-4">Bienvenido!</h1>
									
									<p class="lead">Diseño de matera inteligente la cual es capaz de publicar Tweets por si sola, costa de sensores los cuales toman la humedad del piso y la intensidad luminica y con los valores que ofrecen estos se puede llevar a cabo la publicacion de Tweets. tambien consta con un riego automatizado el cual se lleva a cabo con una mini-motobomba la cual se activa si la humedad del piso es menor a 30.</p>
									
									<p>esta matera es desarrollada por estudiantes de la universidad, en la facultad de ingenieria, programa de ingenieria de sistemas con la guia del ingeniero Alexander Espinoza </p>
								</div>
								
								<div class="card mb-4">
									<div class="card-block">
										<h3 class="card-title text-center text-md-center">Datos Del Dia</h3>	
										<h6 class="card-subtitle mb-2 text-muted text-center text-md-center">Listado Ultimos 10 registros</h6>
										
										<div class="canvas-wrapper">	
											<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    										<?php include("dataGraf.php");?>				
										</div>
									</div>
								</div>
								
								<div class="card mb-4">
									<div class="card-block">
										<h3 class="card-title text-center text-md-center">Datos De La Planta</h3>
										<h6 class="card-subtitle mb-2 text-muted text-center text-md-center">Listado Ultimos 7 Registros</h6>
										
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
													$d=date('y/m/d');
													$consulta="SELECT * FROM materadate WHERE fechaMatera='$d' ORDER BY `horaMatera` DESC limit 10";
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
							<div class="col-md-12 col-lg-4">
								<div class="card mb-4">
									<div class="card-block">
										<h3 class="card-title text-md-center"">Calendario</h3>
										<div id="calendar"></div> 
									</div>
								</div>
							</div>
						</section>
						<section class="row">
							<div class="col-12 mt-1 mb-4">Realizado Por: <a href="#">Estudiantes Udec</a></div>
						</section>
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
