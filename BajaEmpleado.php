<?php
require("Conexion.php");
$idCone=Conectar();
$l=$_REQUEST['legajo'];
$sql1="select * from empleados where legajo='$l'";
$registro1=mysql_query($sql1,$idCone);
$fila=mysql_fetch_array($registro1);

if ($fila['estado']=='activo'){
    $sql2="update empleados set estado='inactivo' where legajo='$l'";
    mysql_query($sql2,$idCone);    
}
else {
    $sql2="update empleados set estado='activo' where legajo='$l'";
    mysql_query($sql2,$idCone);

}
mysql_close($idCone);
header("location:Empleados.php");
?>