<?php
session_start();
$l=$_SESSION['LEGAJO'];
require("Conexion.php");
$idCone=Conectar();
$sql="select * from empleados where legajo='$l'";
$sql2="select * from usuarios where legajo='$l'";
$registro=mysql_query($sql,$idCone);
$registro2=mysql_query($sql2,$idCone);
$fila=mysql_fetch_array($registro);
$fila2=mysql_fetch_array($registro2);
$n=$fila['nombre'];
$a=$fila['apellido'];
$c=$fila['cuil'];
$t=$fila['telefono'];
$d=$fila['domicilio'];
$loc=$fila['codloc'];
$cp=$fila['codprov'];
$e=$fila['email'];

$u=$fila2['usuario'];
$pass=$fila2['clave'];
$tu=$fila2['tipo'];

$sql3="select * from tipousuario where codigo='$tu'";
$registro3=mysql_query($sql3,$idCone);
$fila3=mysql_fetch_array($registro3);
$cargo=$fila3['nombre'];

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
                            <a href="Admin.php" class="btn ">
                                Perfil
                            </a>
                        </li>
                        <li>
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

        <div class="row">
            <div class="col-xl-6 offset-md-0">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo$n ?></h2>
                        <form 
                            action="ActEmp.php?legajo=<?php echo$l ?>"
                            method="post"
                            onSubmit="if (!confirm('¿Desea guardar los cambios?')){return false;}"
                            >
                            <table class="table table-user-information ">
                                <tbody>
                                    <tr>
                                        <td> Apellido:</td>
                                        <td><?php echo$a ?></td>
                                    </tr>
                                    <tr>
                                        <td>Cargo:</td>
                                        <td><?php echo$cargo ?></td>
                                    </tr>
                                    <tr>
                                        <td>Cuil:</td>
                                        <td><?php echo $c ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tel&eacute;fono:</td>
                                        <td><input
                                                type="tel"
                                                name="telefono"
                                                placeholder="12312345678"
                                                minlength="10"
                                                maxLength="10"
                                                value="<?php echo $t ?>"
                                                required
                                            /><span> *</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Domicilio</td>
                                        <td>
                                            <input
                                                type="text"
                                                name="domicilio"
                                                value="<?php echo $d ?>"
                                                required
                                            /><span> *</span>
                                        </td>
                                    </tr>
                                        <td>Provincia</td>
                                        <td>
                                            <select name="s1" id="provincias">
                                            <?php
                                                $sql4="select * from provincias";
                                                $registro4=mysql_query($sql4,$idCone);

                                                while($fila4=mysql_fetch_array($registro4)){
                                                    $Cpr=$fila4['codigo'];
                                                    $N=$fila4['provincia'];
                                                    echo"<option value=$Cpr ";if($cp==$Cpr){echo"selected";}echo">$N</option>";
                                                }
                                            ?>
                                            </select><span> *</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Localidad:</td>
                                        <td>
                                            <select name="s2" id="localidades">
                                                <?php
                                                    $sql5="select * from localidad where codprov='$cp'";
                                                    $registro5=mysql_query($sql5,$idCone);

                                                    while($fila5=mysql_fetch_array($registro5)){
                                                        $Cloc=$fila5['codlocalidad'];
                                                        $Nl=$fila5['localidad'];
                                                        echo"<option value=$Cloc ";if($loc==$Cloc){echo"selected";}echo">$Nl</option>";
                                                    }
                                                ?>
                                            </select><span> *</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td>
                                            <input
                                                type="text"
                                                name="email"
                                                placeholder="me@example.com.ar"
                                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                                value="<?php echo $e ?>"
                                                required
                                            /><span> *</span>
                                        </td>
                                    </tr>
                                    <tr>
                                </tbody>
                            </table>
                            <button 
                                class="btn btn-primary ml-2" type="submit">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 offset-md-0">
                <div class="card">
                    <div class="card-body">
                        <form 
                            action="ActUs.php?legajo=<?php echo$l ?>"
                            method="post"
                            onSubmit="if (!confirm('¿Desea guardar los cambios?')){return false;}"
                            >
                            <h3 class="card-title">Cambia tu clave</h3>
                            <table class="table table-user-information ">
                                <tbody>
                                    <tr>
                                        <td>Usuario actual:</td>
                                        <td>
                                            <?php echo $u ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Usuario nuevo:</td>
                                        <td>
                                            <input
                                            name="newUsuario"
                                            type="text"
                                            value=""
                                            required
                                            /><span> *</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Clave nueva:</td>
                                        <td>
                                            <Input
                                            name="newPassword"
                                            type="password"
                                            value=""
                                            required
                                            /><span> *</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-primary ml-2" type="submit">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $('#provincias').change(function(){
        valor=$(this).val();
        $.post("localidad.php",{id:valor},function(data){
            $("#localidades").html(data);
        });
    });

</script>

</body>
</html>
