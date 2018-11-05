<?php
require("Conexion.php");
$idCone=Conectar();

$l=$_REQUEST['s1'];
$t=$_REQUEST['s2'];
$u=$_REQUEST['usuario'];
$c=$_REQUEST['clave'];

$sql="Insert into usuarios (legajo,usuario,clave,tipo) values ('$l','$u','$c','$t')";

if(mysql_query($sql,$idCone)){
    $sql1="select * from empleados where legajo='$l'";
    $registro1=mysql_query($sql1,$idCone);
    $fila1=mysql_fetch_array($registro1);
    
    $e=$fila1['email'];
    
    $subject = "Creación de Usuario";
    $txt = "Su usuario es $u y su clave es $c.";
    $headers = "From: webmaster@example.com";
    
    
    
    mail($e,$subject,$txt,$headers);
}

mysql_close($idCone);
header("location:Usuarios.php");

?>