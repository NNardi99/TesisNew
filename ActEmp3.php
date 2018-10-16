<?php
require("Conexion.php");
$idCone=Conectar();

$l=$_REQUEST['legajo2'];
$a=$_REQUEST['apellido'];
$n=$_REQUEST['nombre'];
$c=$_REQUEST['cuil'];
$t=$_REQUEST['telefono'];
$d=$_REQUEST['domicilio'];
$p=$_REQUEST['s1'];
$loc=$_REQUEST['s2'];
$e=$_REQUEST['email'];

$sql="update empleados set apellido='$a', nombre='$n', cuil='$c', telefono='$t', domicilio='$d', codprov='$p', codloc='$loc', email='$e' where legajo='$l'";

if(mysql_query($sql,$idCone))
{
    mysql_close($idCone);
    header("location:Empleados.php");
}

?>