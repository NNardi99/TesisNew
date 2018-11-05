<?php
require("Conexion.php");
$idCone=Conectar();

$l=$_REQUEST['legajo2'];
$u=$_REQUEST['usuario'];
$c=$_REQUEST['clave'];
$t=$_REQUEST['s1'];

$sql="select * from empleados where legajo='$l'";
$registro=mysql_query($sql,$idCone);
$fila=mysql_fetch_array($registro);

$e=$fila['email'];

$sql2="update usuarios set usuario='$u', clave='$c', tipo='$t' where legajo='$l'";

if(mysql_query($sql2,$idCone))
{
    $subject = "Modificacion de Usuario";
    $txt = "Se registro el cambio de sus datos. Su usuario es $u y su clave es $c.";
    $headers = "From: webmaster@example.com";

    mail($e,$subject,$txt,$headers);

    mysql_close($idCone);
    header("location:Usuarios.php");
}

?>