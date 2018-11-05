<?php
require("Conexion.php");
$idCone=Conectar();
$r=$_REQUEST['razon'];
$c=$_REQUEST['cuit'];
$t=$_REQUEST['telefono'];
$e=$_REQUEST['email'];
$d=$_REQUEST['domicilio'];
$p=$_REQUEST['s1'];
$loc=$_REQUEST['s2'];
$contacto=$_REQUEST['contacto'];

$sql="Insert into proveedores (razon,cuit,telefono,email,domicilio,codloc,codprov,contacto,estado) values ('$r','$c','$t','$e','$d','$loc','$p','$contacto','activo')";

mysql_query($sql,$idCone);
mysql_close($idCone);
header("location:EStock.php");
?>