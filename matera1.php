<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Matera</title>
</head>
<body>
	<?php 
		include("conexion.php");
		$a=$_GET['a'];
		$b=$_GET['b'];
		$c=$_GET['c'];
		$d=date('y/m/d');
		$e=date('H:i:s');
		$consul="INSERT INTO `materadate`(`idMatera`, `luzMatera`, `humMatera`, `fechaMatera`, `horaMatera`) VALUES ('$a','$b','$c','$d','$e')";
  		$result=$conexion->query($consul);
 		if ($result) {
     		echo " datos registrados"; 
 		}else{
  			echo "Datos no guardados";
 		}
		//echo "CLOSED";
	?>
</body>
</html>