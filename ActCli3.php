<?php
require("Conexion.php");
$idCone=Conectar();

$cod=$_REQUEST['codigo2'];
$r=$_REQUEST['razon'];
$c=$_REQUEST['cuit'];
$t=$_REQUEST['telefono'];
$e=$_REQUEST['email'];
$d=$_REQUEST['domicilio'];
$p=$_REQUEST['s1'];
$loc=$_REQUEST['s2'];
$cont=$_REQUEST['contacto'];

$sql="update clientes set razon='$r', cuit='$c', telefono='$t', email='$e', domicilio='$d', codprov='$p', codloc='$loc', contacto='$cont' where codigo='$cod'";

if(mysql_query($sql,$idCone))
{
    mysql_close($idCone);
    header("location:RVent.php");
}

?>