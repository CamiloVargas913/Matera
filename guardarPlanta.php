<?php
include("conexion.php");

$idPlanta= $_POST['idPlanta'];
$nombrePlanta= $_POST['nombrePlanta'];

 $consulta ="INSERT INTO `materas`(`idMatera`,`nombreMatera`) VALUES ('$idPlanta','$nombrePlanta')";
  $resultado= $conexion->query($consulta);
 if ($resultado) {
     echo true;
 }else{
  echo false;
 }
?>