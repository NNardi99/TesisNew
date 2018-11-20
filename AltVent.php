<?php
session_start();
$l=$_SESSION['LEGAJO'];
require("Conexion.php");
$idCone=Conectar();

$sql="select * from empleados where legajo='$l'";
$registro=mysql_query($sql,$idCone);
$fila=mysql_fetch_array($registro);

$n=$fila['nombre'];

//Elige la última fila de la tabla venta
$sql2="select * from venta ORDER BY codigo DESC limit 1";
$registro2=mysql_query($sql2,$idCone) or die(mysql_error());;

$fila2=mysql_fetch_array($registro2);

$ultcodvent=$fila2['codigo'];

//Elige la penúltima fila de la tabla venta
$sql6="select * from venta ORDER BY codigo DESC limit 1,1";
$registro6=mysql_query($sql6,$idCone) or die(mysql_error());;

$fila6=mysql_fetch_array($registro6);

$pultcodvent=$fila6['codigo'];


//Cuenta las filas 'codigo' de la tabla venta
$sql5="select count(codigo) as numrow from venta";
$registro5=mysql_query($sql5,$idCone) or die(mysql_error());;
$fila5=mysql_fetch_array($registro5);
$cantidadfila=$fila5['numrow'];

?>

<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
    
    <title>Sprinkler</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" type="image/png" href="img/logo.png"/>
</head>
<body id="LoginForm">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 px-0">
                <div class="navbar-header ">
                    <div class="navbar navbar-default navbar-light bg-light">
                        <img src="img/Loco-Firecontrol_AZUL.png" class="navbar-brand navbar-logo navbar-left">
                        <div class="container d-none d-lg-block">
                            <ul class="nav navbar-nav mt-2 navbar-left">
                                <li class="nav-item active">
                                    <p>Bienvenido <?php echo $n; ?></p>
                                </li>
                            </ul>
                        </div>
                        <form action="index.html" method="post" onSubmit="if (!confirm('¿Desea salir?')){return false;}">
                            <button class="btn btn-outline-success navbar-right" type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3"></div>
            <div class="col-xl-6">
                <div class="container">
                    <ul class="dashboard-tabs">
                        <li>
                            <a href="RVent.php" class="btn ">
                                Clientes
                            </a>
                        </li>
                        <li>
                            <a href="Productos.php" class="btn">
                                Productos
                            </a>
                        </li>
                        <li class="active">
                            <a href="Venta.php" class="btn">
                                Ventas
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn">
                                Reportes
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3"></div>
        </div>

        <div class="row" style="margin-bottom: 10px">
            <div class="col-xl-2 offset-md-0"></div>
            <div class="col-xl-8 offset-md-0">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Alta de Ficha de Venta</h2>
                        <table class="table table-user-information ">
                            <tbody>
                                <tr>
                                    <td>
                                        <h4>Categoría de Productos</h4>
                                            <?php
                                                $sql3="select * from categoria";
                                                $registro3=mysql_query($sql3,$idCone) or die("Error en el select");
                                                echo"<select name='s1' id='categoria'>";
                                                while($fila3=mysql_fetch_array($registro3)){
                                                    $Cd=$fila3['codigo'];
                                                    $Ncat=$fila3['nombre'];
                                                    echo"<option value=$Cd>$Ncat</option>";
                                                }
                                                echo"</select>";
                                            ?>
                                    </td>
                                </tr>
                                <tr>
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Código</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Stock</th>
                                                <th scope="col">Añadir</th>
                                            </tr>
                                        </thead>
                                        <tbody id="producto">
                                            <?php
                                                $sql4="select * from producto where cateprod='1'";
                                                $registro4=mysql_query($sql4,$idCone);
                                                while($fila4=mysql_fetch_array($registro4)){
                                                    echo "<tr class='table-secondary'>";
                                                    // echo"<td>".$fila4["codigo"];
                                                    echo"<td>".$fila4["codigo"];
                                                    echo"<td>".$fila4["nombre"];
                                                    echo"<td>".$fila4["tipo"];
                                                    echo"<td>".$fila4["stockactual"];
                                                    echo"<td>";
                                                    echo"<a class='btn btn-primary ml-2' href='Prod.php?codigo={$fila4["codigo"]}'>Añadir</a>";
                                                    echo"</tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 offset-md-0"></div>
        </div>

    </div>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $('#categoria').change(function(){
        valor=$(this).val();
        $.post("producto.php",{id:valor},function(data){
            $("#producto").html(data);
        });
    });
</script>

</body>
</html>