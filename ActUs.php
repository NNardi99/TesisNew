<?php
require("Conexion.php");
$idCone=Conectar();

$l=$_REQUEST['legajo'];
$sql1="select * from empleados where legajo='$l'";
$registro1=mysql_query($sql1,$idCone);
$fila1=mysql_fetch_array($registro1);

$e=$fila1['email'];

$u=$_REQUEST['newUsuario'];
$p=$_REQUEST['newPassword'];

$sql2="update usuarios set usuario='$u', clave='$p' where legajo='$l'";

if(mysql_query($sql2,$idCone))
{
    
    $subject = "Modificacion de Usuario";
    $txt = "Se registro el cambio de sus datos. Su usuario es $u y su clave es $p.";
    $headers = "From: webmaster@example.com";

    mail($e,$subject,$txt,$headers);
    mysql_close($idCone);
    header("location:Admin.php");

}

?>