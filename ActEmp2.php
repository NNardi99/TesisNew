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
$sql2="select * from empleados where legajo='$l2'";
$registro2=mysql_query($sql2,$idCone);
$fila2=mysql_fetch_array($registro2);
$a=$fila2['apellido'];
$n2=$fila2['nombre'];
$c=$fila2['cuil'];
$t=$fila2['telefono'];
$d=$fila2['domicilio'];
$lo=$fila2['codloc'];
$cp=$fila2['codprov'];
$e=$fila2['email'];
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
                            <li class="active">
                                <a href="Empleados.php" class="btn">
                                    Empleados
                                </a>
                            </li>
                            <li>
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
                        <h2 class="card-title">Actualización de Empleado</h2>
                        <form action="ActEmp3.php?legajo2=<?php echo"$l2"?>" method="post" onSubmit="if (!confirm('¿Desea guardar los cambios?')){return false;}">
                        <table class="table table-user-information ">
                            <tbody>
                                <tr>
                                    <td>
                                        <h4>Legajo</h4>
                                        <?php echo"$l2" ?>
                                    </td>
                                    <td>
                                        <h4>Apellido</h4>
                                        <input type="text" name="apellido" value="<?php echo"$a" ?>" required>
                                    </td>
                                    <td>
                                        <h4>Nombre</h4>
                                        <input type="text" name="nombre" value="<?php echo"$n2" ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4>C.U.I.L.</h4>
                                        <input type="text" placeholder="20111111115" pattern="[0-9]{11}" minlength="11" maxlength="11" name="cuil" value="<?php echo"$c" ?>" required>
                                    </td>
                                    <td>
                                        <h4>Tel&eacute;fono</h4>
                                        <input type="tel" placeholder="12312345678" minlength="10" maxlength="10" name="telefono" value="<?php echo"$t" ?>" required>
                                    </td>
                                    <td>
                                        <h4>Domicilio</h4>
                                        <input type="text" name="domicilio" value="<?php echo"$d" ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4>Provincia</h4>
                                        <?php
                                            $sql5="select * from provincias";
                                            $registro5=mysql_query($sql5,$idCone) or die("Error en el select");
                                            echo"<select name='s1' id='provincias'>";
                                            while($fila5=mysql_fetch_array($registro5)){
                                                $Cod=$fila5['codigo'];
                                                $Npro=$fila5['provincia'];
                                                echo"<option value=$Cod";if($cp==$Cod){echo" selected";}echo">$Npro</option>";
                                            }
                                            echo"</select>";
                                        ?>
                                    </td>
                                    <td>
                                        <h4>Localidad</h4>
                                        <?php
                                            $sql6="select * from localidad where codprov='$cp'";
                                            $registro6=mysql_query($sql6,$idCone) or die("Error en el select");
                                            echo"<select name='s2' id='localidades'>";
                                            while($fila6=mysql_fetch_array($registro6)){
                                                $Cd=$fila6['codlocalidad'];
                                                $Nloc=$fila6['localidad'];
                                                echo"<option value=$Cd";if($lo==$Cd){echo" selected";}echo">$Nloc</option>";
                                            }
                                            echo"</select>";
                                        ?>
                                    </td>
                                    <td>
                                        <h4>Email</h4>
                                        <input type="text" name="email" placeholder="me@example.com.ar" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?php echo"$e" ?>" required/>
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

