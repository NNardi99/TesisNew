<?php
session_start();

require("Conexion.php");
$idCone=Conectar();

$p = $_REQUEST['codigo'];
$c = $_REQUEST['cantidad'];

$sql="select * from producto where codigo='$p'";
$registro=mysql_query($sql,$idCone) or die(mysql_error());

$fila=mysql_fetch_array($registro);

$sa=$fila['stockactual'];

$dif=$sa-$c;

$sql2="update producto set stockactual='$dif' where codigo='$p'";
$registro2=mysql_query($sql2,$idCone);


if (isset($_SESSION['prodcart']))
{
    $currentNo = $_SESSION['count']+1;

    $_SESSION['prodcart'][$currentNo] = $p;
    $_SESSION['qtycart'][$currentNo] = $c;
    $_SESSION['count'] = $currentNo;
}
else
{
    //Si el usuario visita por primera vez la página entonces se crea el primer array
    //El primer index comenzará de 0
    $prodcart = array();
    $qtycart = array();

    $_SESSION['prodcart'][0] = $p;
    $_SESSION['qtycart'][0] = $c;
    $_SESSION['count'] = 0;
}

header("location:AltVent3.php");

// $sql="select * from producto where $p=codigo";
// $registro=mysql_query($sql,$idCone);
// $fila=mysql_fetch_array($registro);

// $stock=$fila["stockactual"];
// $nombre=$fila["nombre"];
// $resultado=$stock - $c;

// if ($stock == 0 || $resultado<0)
// {
//     $message="Verificar que las cantidades ingresadas no superen el stock";
//     echo "<SCRIPT type='text/javascript'>
//         alert('$message');
//         window.location.replace(\"AltVent.php\");
//     </SCRIPT>";
//     mysql_close();
// }
// else
// {
//     $sql2="Insert into detalleventa (codprod,nombreprod,cantidad) values ('$p','$nombre','$c')";

//     $sql3="update producto set stockactual='$e' where codigo='$p'";

//     mysql_query($sql2,$idCone);
//     mysql_close($idCone);
//     header("location:AltVent3.php");
// }

?>