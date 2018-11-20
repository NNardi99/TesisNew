<?php

session_start();

$l=$_SESSION['LEGAJO'];
$codcl=$_REQUEST['s1'];

require("Conexion.php");
$idCone=Conectar();

//Elige el codigo de la última fila de la tabla venta
$sql="select * from venta ORDER BY codigo DESC limit 1";
$registro=mysql_query($sql,$idCone) or die(mysql_error());

$fila=mysql_fetch_array($registro);

$ultcodvent=$fila['codigo']+1;

//toma la fecha actual del servidor
$date= date('Y-m-d');

if(isset($_SESSION['prodcart']) && !empty($_SESSION['prodcart']))
{
    foreach ($_SESSION['prodcart'] as $key => $value) {
        $sql1="select * from producto where codigo='$value'";
        $registro1=mysql_query($sql1,$idCone);
        $fila1=mysql_fetch_array($registro1);

        $nompr=$fila1['nombre'];
        $sa=$fila1['stockactual'];

        $qty=$_SESSION['qtycart'][$key];
        $dif= $sa-$qty;

        // $sql2="update producto set stockactual='$dif' where codigo='$value'";
        // $registro2=mysql_query($sql2,$idCone);

        $sql3="insert into detalleventa (codprod,nombreprod,cantidad) values ('$value','$nompr','$qty')";
        $registro3=mysql_query($sql3,$idCone);

        $sql4="select * from detalleventa ORDER BY codigo DESC limit 1";
        $registro4=mysql_query($sql4,$idCone);
        $fila4=mysql_fetch_array($registro4);
        $coddetvta=$fila4['codigo'];
        
        $sql5="insert into venta (codigo,coddetvta,legajo,codcliente,fecha,estado) values ('$ultcodvent','$coddetvta','$l','$codcl','$date','activo')";
        $registro5=mysql_query($sql5,$idCone);

    }

    $_SESSION['prodcart'] = array();
    $_SESSION['qtycart'] = array();
    $_SESSION['count'] = array();

    header("location:RVent.php");
}
?>