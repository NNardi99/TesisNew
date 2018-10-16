<?php
require("Conexion.php");
$idCone=Conectar();
$a=$_REQUEST['apellido'];
$n=$_REQUEST['nombre'];
$c=$_REQUEST['cuil'];
$t=$_REQUEST['telefono'];
$d=$_REQUEST['domicilio'];
$p=$_REQUEST['s1'];
$loc=$_REQUEST['s2'];
$e=$_REQUEST['email'];
$sql="Insert into empleados (apellido,nombre,cuil,telefono,domicilio,codloc,codprov,estado,email) values ('$a','$n','$c','$t','$d','$loc','$p','activo','$e')";

mysql_query($sql,$idCone);
mysql_close($idCone);
header("location:Empleados.php");
?>