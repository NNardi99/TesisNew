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
$sql2="select * from clientes where codigo='$cod'";
$registro2=mysql_query($sql2,$idCone);
$fila2=mysql_fetch_array($registro2);
$r=$fila2['razon'];
$c=$fila2['cuit'];
$t=$fila2['telefono'];
$e=$fila2['email'];
$d=$fila2['domicilio'];
$lo=$fila2['codloc'];
$cp=$fila2['codprov'];
$cont=$fila2['contacto'];
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
                        <li class="active">
                            <a href="RVent.php" class="btn ">
                                Clientes
                            </a>
                        </li>
                        <li>
                            <a href="Productos.php" class="btn">
                                Productos
                            </a>
                        </li>
                        <li>
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
                        <h2 class="card-title">Actualización de Cliente</h2>
                        <form action="ActCli3.php?codigo2=<?php echo"$cod"?>" method="post" onSubmit="if (!confirm('¿Desea guardar los cambios?')){return false;}">
                            <table class="table table-user-information ">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h4>Código</h4>
                                            <?php echo"$cod" ?>
                                        </td>
                                        <td>
                                            <h4>Razón Social</h4>
                                            <input type="text" name="razon" value="<?php echo"$r" ?>" required>
                                            <span> *</span>
                                        </td>
                                        <td>
                                            <h4>C.U.I.T.</h4>
                                            <input type="text" placeholder="20111111115" pattern="[0-9]{11}"
                                                minlength="11" maxlength="11" name="cuit" value="<?php echo"$c" ?>" required>
                                            <span> *</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4>Tel&eacute;fono</h4>
                                            <input type="tel" placeholder="12312345678" minlength="10"
                                                maxlength="10" name="telefono" value="<?php echo"$t" ?>" required>
                                            <span> *</span>
                                        </td>
                                        <td>
                                            <h4>Email</h4>
                                            <input type="text" name="email" placeholder="me@example.com.ar"
                                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?php echo"$e" ?>" required/>
                                            <span> *</span>
                                        </td>
                                        <td>
                                            <h4>Domicilio</h4>
                                            <input type="text" name="domicilio" value="<?php echo"$d" ?>" required>
                                            <span> *</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4>Provincia</h4>
                                            <?php
                                                $sql3="select * from provincias";
                                                $registro3=mysql_query($sql3,$idCone) or die("Error en el select");
                                                echo"<select name='s1' id='provincias'>";
                                                while($fila3=mysql_fetch_array($registro3)){
                                                    $Cod=$fila3['codigo'];
                                                    $Npro=$fila3['provincia'];
                                                    echo"<option value=$Cod";if($cp==$Cod){echo" selected";}echo">$Npro</option>";
                                                }
                                                echo"</select>";
                                            ?>
                                        </td>
                                        <td>
                                            <h4>Localidad</h4>
                                            <?php
                                                $sql4="select * from localidad where codprov='$cp'";
                                                $registro4=mysql_query($sql4,$idCone) or die("Error en el select");
                                                echo"<select name='s2' id='localidades'>";
                                                while($fila4=mysql_fetch_array($registro4)){
                                                    $Cd=$fila4['codlocalidad'];
                                                    $Nloc=$fila4['localidad'];
                                                    echo"<option value=$Cd";if($lo==$Cd){echo" selected";}echo">$Nloc</option>";
                                                }
                                                echo"</select>";
                                            ?>
                                        </td>
                                        <td>
                                            <h4>Contacto</h4>
                                            <input type="text" name="contacto" value="<?php echo"$cont" ?>"/>
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

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script languaje="javascript">

$('#provincias').change(function(){
        valor=$(this).val();
        $.post("localidad.php",{id:valor},function(data){
            $("#localidades").html(data);
        });
    });
</script>

</body>
</html>