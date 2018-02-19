<?php include("conexion.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<meta name="description" content="">
	
	<meta name="author" content="">
	
	<link rel="icon" href="images/favicon.ico">
	
	<title>Control Materas</title>

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
					<li class="nav-item"><a class="nav-link" href="index.php"><em class="fa fa-rebel"></em> Bienvenida</a></li>
					<li class="nav-item"><a class="nav-link" href="charts.php"><em class="fa fa-area-chart"></em> Graficas </a></li>
					<li class="nav-item"><a class="nav-link active" href="cards.php"><em class="fa fa-clone"></em> Datos <span class="sr-only">(current)</span></a></li>
				</ul>
				
				<a href="#" class="logout-button">UNIVERSIDAD CUNDINAMARCA</a></nav>
			
			<main class="col-xs-12 col-sm-8 offset-sm-4 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 pt-3 pl-4">
				<header class="page-header row justify-center">
					<div class="col-md-6 col-lg-8" >
						<h1 class="float-left text-center text-md-center">Datos Planta</h1>
					</div>
					<div class="clear"></div>
				</header>
				
				<section class="row">
					<div class="col-sm-12">
						<section class="row">
							<div class="col-lg-12 mb-12">
								<div class="card">
									<div class="card-header">
										<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalPlanta"><em  class="fa fa-plus-circle"></em> Agregar Planta</button>
										<!--Ventana Modal-->
										<div class="modal fade" id="modalPlanta">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">Agregar Planta</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															&times;
														</button>
													</div>
													<div class="modal-body">
														<form class="planta">
														  <fieldset class="form-group">
														    <label for="idPlanta">Id De La Planta</label>
														    <input type="number" class="form-control" id="idPlanta" name="idPlanta" required="">
														  </fieldset>
														  <fieldset class="form-group">
														    <label for="nombrePlanta">Nombre De La Planta</label>
														    <input type="text" class="form-control" id="nombrePlanta" name="nombrePlanta" required="">
														  </fieldset>
														  	<div class="cargas"><i class="fa fa-spinner fa-spin"></i>  Guardardando... </div>
			            							<div class="men"></div>
															<div class="modal-footer">
																<button type="submit" value="Enviar" id="boton" class="btn btn-success">Guardar</button>
															</div>
														</form>						
													</div>				
												</div>
											</div>
										</div>
									</div>
									
									<div class="card-block">
										<h3 class="card-title text-center">Busueda Datos</h3>	
										<h6 class="card-subtitle mb-2 text-center">Flitrar Datos</h6>
									<div class="card mb-4">
										<div class="card-block justify-center">
										<form class="form-inline" action="tablaDate.php" method="post" target="home">
												<!-- Name input-->
												<div class="form-group no-padding">
													<div class="col-12 ">
														<label class="col-12 control-label" for="name">Planta: </label>
														<select name="planta" id="planta" class="form-control">
													<?php
													$consulta="SELECT * FROM materas ORDER BY `idMatera`";
													$resultado=$conexion->query($consulta);
													while($date=$resultado->fetch_assoc()){	
														?>
															  <option value="<?php echo $date["idMatera"];?>">PL <?php echo $date["idMatera"];?>
																    <?php
																    }
																    ?>
															  </option>
														</select>
													</div>
												</div>
												<div class="form-group no-padding">
													<div class="col-12 ">
														<label class="col-12 control-label " for="fechaIni">Fecha Incial: </label>
														<input id="fechaIni" name="fechaIni" type="date" class="form-control">
													</div>
												</div>
												<div class="form-group no-padding">
													<div class="col-12 ">
														<label class="col-12 control-label " for="fechaIni">Hora Incial: </label>
														<input id="horaIni" name="horaIni" type="time" class="form-control">
													</div>
												</div>
												<div class="form-group no-padding">
													<div class="col-12">
														<label class="col-12 control-label " for="fechaFin">Fecha Final: </label>
														<input id="fechaFin" name="fechaFin" type="date" class="form-control">
													</div>
												</div>
												<div class="form-group no-padding">
													<div class="col-12 ">
														<label class="col-12 control-label " for="horaFin">Hora Incial: </label>
														<input id="horaFin" name="horaFin" type="time" class="form-control">
													</div>
												</div>
												<div class="col-12 text-center">	
													<button type="submit" class="btn btn-sm btn-success">Buscar</button>
												</div>

										</form>

											</div>
										</div>
										  <div class="frame-">
												 <iframe name="home" class="iframe" frameborder="0" width="100%" height="500px"></iframe>
										  </div>
									</div>
								</div>
							</div>

						</section>
						<section class="row">
							<div class="col-12 mt-1 mb-4">Realizado Por: <a href="https://www.medialoot.com">Estudiantes UDEC</a></div>
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
    
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/envioFormulario.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    
	  </body>
</html>
