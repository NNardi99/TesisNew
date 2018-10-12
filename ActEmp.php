<?php
require("Conexion.php");
$idCone=Conectar();

$l=$_REQUEST['legajo'];

$t=$_REQUEST['telefono'];
$d=$_REQUEST['domicilio'];
$p=$_REQUEST['s1'];
$loc=$_REQUEST['s2'];
$e=$_REQUEST['email'];

$sql="update empleados set telefono='$t', domicilio='$d', codprov='$p', codloc='$loc', email='$e' where legajo='$l'";

if(mysql_query($sql,$idCone))
{
    mysql_close($idCone);
    header("location:Admin.php");
}

?>