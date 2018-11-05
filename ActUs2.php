<?php
session_start();
$l=$_SESSION['LEGAJO'];
require("Conexion.php");
$idCone=Conectar();
$sql="select * from empleados where legajo='$l'";
$registro=mysql_query($sql,$idCone);

$fila=mysql_fetch_array($registro);
$n=$fila['nombre'];

$l2=$_REQUEST['legajo2'];
$sql2="select * from usuarios where legajo='$l2'";
$registro2=mysql_query($sql2,$idCone);
$fila2=mysql_fetch_array($registro2);
$u=$fila2['usuario'];
$c=$fila2['clave'];
$t=$fila2['tipo'];

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
                            <a href="Admin.php" class="btn ">
                                Perfil
                            </a>
                        </li>
                        <li>
                            <a href="Empleados.php" class="btn">
                                Empleados
                            </a>
                        </li>
                        <li class="active">
                            <a href="Usuarios.php" class="btn">
                                Usuarios
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
                        <h2 class="card-title">Actualización de Usuario</h2>
                        <form action="ActUs3.php?legajo2=<?php echo"$l2"?>" method="post" onSubmit="if (!confirm('¿Desea guardar los cambios?')){return false;}">
                        <table class="table table-user-information ">
                            <tbody>
                                <tr>
                                    <td>
                                        <h4>Legajo</h4>
                                        <?php echo"$l2" ?>
                                    </td>
                                    <td>
                                        <h4>Tipo</h4>
                                        <?php
                                            $sql3="select * from tipousuario";
                                            $registro3=mysql_query($sql3,$idCone) or die("Error en el select");
                                            echo"<select name='s1'>";
                                            while($fila3=mysql_fetch_array($registro3)){
                                                $cod=$fila3['codigo'];
                                                $tipo=$fila3['nombre'];
                                                echo"<option value=$cod";if($cod==$t){echo" selected";}echo">$tipo</option>";
                                            }
                                            echo"</select>";
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4>Usuario</h4>
                                        <input type="text" name="usuario" value="<?php echo"$u" ?>" required>
                                    </td>
                                    <td>
                                        <h4>Clave</h4>
                                        <input type="text" name="clave" value="<?php echo"$c" ?>" required>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button 
                            class="btn btn-primary ml-2" type="submit">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>