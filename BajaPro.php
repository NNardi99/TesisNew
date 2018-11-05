<?php
require("Conexion.php");
$idCone=Conectar();
$cod=$_REQUEST['codigo'];

$sql1="select * from proveedores where codigo='$cod'";
$registro1=mysql_query($sql1,$idCone);
$fila=mysql_fetch_array($registro1);

    $sql2="update proveedores set estado='inactivo' where codigo='$cod'";
    mysql_query($sql2,$idCone);    

mysql_close($idCone);
header("location:EStock.php");
?>