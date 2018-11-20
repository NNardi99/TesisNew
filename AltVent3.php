<?php
session_start();

$l=$_SESSION['LEGAJO'];
require("Conexion.php");
$idCone=Conectar();

$sql="select * from empleados where legajo='$l'";
$registro=mysql_query($sql,$idCone);
$fila=mysql_fetch_array($registro);

$n=$fila['nombre'];
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
                                    <p>Bienvenido <?php echo $n ?></p>
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
                        <?php
                            if(isset($_GET['id']))
                            {
                                $id = $_GET['id'];
                                $codprod=$_SESSION['prodcart'][$id];
                                $cantidad=$_SESSION['qtycart'][$id];

                                $sqlsel="select * from producto where codigo='$codprod'";
                                $registrosel=mysql_query($sqlsel,$idCone) or die(mysql_error());
                                
                                $filasel=mysql_fetch_array($registrosel);
                                
                                $sa=$filasel['stockactual'];

                                $dif=$sa+$cantidad;

                                $sqlsuma="update producto set stockactual='$dif' where codigo='$codprod'";
                                $registrosuma=mysql_query($sqlsuma,$idCone) or die(mysql_error());
                                
                                unset($_SESSION['prodcart'][$id]);
                                unset($_SESSION['qtycart'][$id]);
                            }

                            if(isset($_SESSION['prodcart']) && !empty($_SESSION['prodcart']))
                            {
                                echo "<table class='table table-bordered table-hover'>";
                                    echo "<thead class='thead-dark'>";
                                        echo "<tr>";
                                            echo"<th scope='col'>Nro</th>";
                                            echo"<th scope='col'>Producto</th>";
                                            echo"<th scope='col'>Cantidad</th>";
                                            echo"<th scope='col'>Eliminar</th>";
                                        echo "<tr>";
                                    echo"</thead>";
                                    echo"<tbody>";
                                        $i = 0;
                                        foreach ($_SESSION['prodcart'] as $key => $value) {
                                            $i++;
                                            $sql2="select * from producto where codigo='$value'";
                                            $registro2=mysql_query($sql2,$idCone);
                                            $fila2=mysql_fetch_array($registro2);

                                            $qty=$_SESSION['qtycart'][$key];
                                            
                                            echo"<tr>";
                                                echo"<td>$i</td>";
                                                echo"<td>{$fila2['nombre']}</td>";
                                                echo"<td>$qty</td>";
                                                echo"<td><a class='btn btn-primary ml-2' href='?id=$key'>Eliminar Producto</a></td>";
                                            echo"</tr>";
                                        }
                                    echo"</tbody>";
                                echo "</table>";
                                echo"<a class='btn btn-primary ml-2' href='AltVent.php'>Agregar Productos</a>";
                            }
                            else
                            {
                                echo"<h3>No hay productos agregados</h3>";
                                echo"<a class='btn btn-primary ml-2' href='AltVent.php'>Agregar Productos</a>";
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 offset-md-0"></div>
        </div>

        <div class="row">
            <div class="col-xl-2 offset-md-0"></div>
            <div class="col-xl-8 offset-md-0">
                <form action="AltVent4.php" method="post" onSubmit="if (!confirm('¿Desea continuar?')){return false;}">
                    <h2>Seleccione el Cliente</h2>
                    <select name="s1">
                        <?php
                            $sql3="select * from clientes";
                            $registro3=mysql_query($sql3,$idCone);

                            while($fila3=mysql_fetch_array($registro3)){
                                $Ccli=$fila3['codigo'];
                                $N=$fila3['razon'];
                                echo"<option value=$Ccli>$N</option>";
                            }
                        ?>
                    </select><span> *</span>
                    <button class='btn btn-primary ml-2'>Crear Ficha de Venta</button>
                </form>
            </div>
            <div class="col-xl-2 offset-md-0"></div>
        </div>
    </div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>

</script>

</body>
</html>