<?php
session_start();
$l=$_SESSION['LEGAJO'];
require("Conexion.php");
$idCone=Conectar();

$sql="select * from empleados where legajo='$l'";
$registro=mysql_query($sql,$idCone);
$fila=mysql_fetch_array($registro);

$n=$fila['nombre'];

$tipo=$_REQUEST['s1'];

$filtro=$_REQUEST['filtro'];


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
                        <h2 class="card-title">Consulta</h2>
                        <?php
                            if ($tipo=1)
                            {
                                $sql2="select * from venta where codigo='$filtro'";
                                $registro2=mysql_query($sql2,$idCone);
                                $consulta=mysql_num_rows($registro2);
                                if($consulta>0)
                                {
                                    echo"<table class='table table-bordered table-hover'>";
                                        echo"<thead class='thead-dark'>";
                                            echo"<tr>";
                                                echo"<th scope='col'>Código</th>";
                                                echo"<th scope='col'>Producto</th>";
                                                echo"<th scope='col'>Cantidad</th>";
                                                echo"<th scope='col'>Legajo Vendedor</th>";
                                                echo"<th scope='col'>Cliente</th>";
                                                echo"<th scope='col'>Fecha</th>";
                                                echo"<th scope='col'>Estado</th>";
                                            echo"</tr>";
                                        echo"<thead>";
                                        echo"<tbody>";
                                        while($fila2=mysql_fetch_array($registro2))
                                        {
                                            echo"<tr>";
                                                echo"<td>".$filtro;
                                                $legajo=$fila2['legajo'];
                                                $detalle=$fila2['coddetvta'];
                                                
                                                $sql3="select * from detalleventa where codigo='$detalle'";
                                                $registro3=mysql_query($sql3,$idCone);
                                                $fila3=mysql_fetch_array($registro3);

                                                $nomprod=$fila3['nombreprod'];
                                                $cant=$fila3['cantidad'];

                                                $codcliente=$fila2['codcliente'];

                                                $sql4="select * from clientes where codigo='$codcliente'";
                                                $registro4=mysql_query($sql4,$idCone);
                                                $fila4=mysql_fetch_array($registro4);

                                                $razon=$fila4['razon'];

                                                $fecha=$fila2['fecha'];
                                                $estado=$fila2['estado'];

                                                echo"<td>".$nomprod;
                                                echo"<td>".$cant;
                                                echo"<td>".$legajo;
                                                echo"<td>".$razon;
                                                echo"<td>".$fecha;
                                                echo"<td>".$estado;
                                            echo"</tr>";
                                        }
                                        echo"<tbody>";
                                    echo"</table>";
                                }
                                else
                                {
                                    echo"<h4>La consulta realizada no arrojó ningún resultado</h4>";
                                }
                                
                            }
                            else
                            {
                                $sql2="select * from venta where codcliente='$filtro'";
                                $registro2=mysql_query($sql2,$idCone);
                                $consulta=mysql_num_rows($registro2);
                                if($consulta>0)
                                {
                                    echo"<table class='table table-bordered table-hover'>";
                                        echo"<thead class='thead-dark'>";
                                            echo"<tr>";
                                                echo"<th scope='col'>Código</th>";
                                                echo"<th scope='col'>Producto</th>";
                                                echo"<th scope='col'>Cantidad</th>";
                                                echo"<th scope='col'>Legajo Vendedor</th>";
                                                echo"<th scope='col'>Cliente</th>";
                                                echo"<th scope='col'>Fecha</th>";
                                                echo"<th scope='col'>Estado</th>";
                                            echo"</tr>";
                                        echo"<thead>";
                                        echo"<tbody>";
                                        while($fila2=mysql_fetch_array($registro2))
                                        {
                                            echo"<tr>";
                                                $code=$fila2['codigo'];
                                                echo"<td>".$code;

                                                $legajo=$fila2['legajo'];
                                                $detalle=$fila2['coddetvta'];
                                                

                                                $sql3="select * from detalleventa where codigo='$detalle'";
                                                $registro3=mysql_query($sql3,$idCone);
                                                $fila3=mysql_fetch_array($registro3);

                                                $nomprod=$fila3['nombreprod'];
                                                $cant=$fila3['cantidad'];

                                                $sql4="select * from clientes where codigo='$filtro'";
                                                $registro4=mysql_query($sql4,$idCone);
                                                $fila4=mysql_fetch_array($registro4);

                                                $razon=$fila4['razon'];

                                                $fecha=$fila2['fecha'];
                                                $estado=$fila2['estado'];

                                                echo"<td>".$nomprod;
                                                echo"<td>".$cant;
                                                echo"<td>".$legajo;
                                                echo"<td>".$razon;
                                                echo"<td>".$fecha;
                                                echo"<td>".$estado;
                                            echo"</tr>";
                                        }
                                        echo"<tbody>";
                                    echo"</table>";
                                }
                                else
                                {
                                    echo"<h4>La consulta realizada no arrojó ningún resultado</h4>";
                                }
                            }
                        ?>
                        <a class="btn btn-primary ml-2" href="Venta.php">Regresar</a>
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