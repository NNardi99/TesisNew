<?php
require("Conexion.php");
$idCone=Conectar();
$p=$_REQUEST['s1'];
$c=$_REQUEST['cantidad'];

$sql="select * from producto where $p=codigo";
$registro=mysql_query($sql,$idCone);
$fila=mysql_fetch_array($registro);

$stock=$fila["stockactual"];
$resultado=$stock - $c;

if ($stock == 0 || $resultado<0)
{
    $message="Verificar que las cantidades ingresadas no superen el stock";
    echo "<SCRIPT type='text/javascript'>
        alert('$message');
        window.location.replace(\"AltVent.php\");
    </SCRIPT>";
    mysql_close();
}
else
{
    $sql2="Insert into detalleventa (codprod,cantidad) values ('$p','$c')";

    mysql_query($sql2,$idCone);
    mysql_close($idCone);
    header("location:AltVent.php");
}

?>