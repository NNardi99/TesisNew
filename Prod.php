<?php
session_start();

$l=$_SESSION['LEGAJO'];
require("Conexion.php");
$idCone=Conectar();

$sql="select * from empleados where legajo='$l'";
$registro=mysql_query($sql,$idCone);
$fila=mysql_fetch_array($registro);

$n=$fila['nombre'];

$cod=$_REQUEST['codigo'];
$sql2="select * from producto where codigo='$cod'";
$registro2=mysql_query($sql2,$idCone);
$fila2=mysql_fetch_array($registro2);

$np=$fila2['nombre'];
$t=$fila2['tipo'];
$cat=$fila2['cateprod'];
$sa=$fila2['stockactual'];

$sql3="select * from categoria where codigo='$cat'";
$registro3=mysql_query($sql3,$idCone);
$fila3=mysql_fetch_array($registro3);
$prod=$fila3['nombre'];

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
                        <h2 class="card-title">Detalle del Producto</h2>
                        <form 
                            action="AltVent2.php"
                            method="post"
                            onSubmit="if (!confirm('¿Desea agregar?')){return false;}"
                        >
                            <table class="table table-user-information ">
                                <tbody>
                                    <tr>
                                        <td><h5>Código: </h5></td>
                                        <td><input 
                                            type='hidden' name='codigo' class='form-control' value='<?php echo $cod; ?>' style='width: 50px'>
                                            <?php echo $cod; ?></td>
                                        <td><h5>Nombre: </h5></td>
                                        <td><?php echo $np; ?></td>
                                        <td><h5>Tipo: </h5></td>
                                        <td><?php echo $t; ?></td>
                                    </tr>
                                    <tr>
                                        <td><h5>Categoría: </h5></td>
                                        <td><?php echo $prod; ?></td>
                                        <td><h5>Stock Actual: </h5></td>
                                        <td><?php echo $sa; ?></td>
                                        <td><h5>Cantidad: </h5></td>
                                        <td><input type="number" name="cantidad" min="1" max="<?php echo $sa; ?>" required></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-primary ml-2" type="submit">Agregar</button>
                        </form>
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

</script>

</body>
</html>
