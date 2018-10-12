<?php
session_start();
$l=$_SESSION['LEGAJO'];
require("Conexion.php");
$idCone=Conectar();
$sql="select * from empleados where legajo='$l'";
$sql2="select * from empleados";
$registro=mysql_query($sql,$idCone);
$registro2=mysql_query($sql2,$idCone);
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
        <div class="row">
            <div class="col-xl-12">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Legajo</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">C.U.I.L.</th>
                        <th scope="col">Tel&eacute;fono</th>
                        <th scope="col">Domicilio</th>
                        <th scope="col">Provincia</th>
                        <th scope="col">Localidad</th>
                        <th scope="col">Email</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Modificar</th>
                        <th scope="col">Baja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($fila2=mysql_fetch_array($registro2))
                            {
                                echo"<tr class='table-secondary'>";
                                $l=$fila2['legajo'];
                                $a=$fila2['apellido'];
                                $n=$fila2['nombre'];
                                $c=$fila2['cuil'];
                                $t=$fila2['telefono'];
                                $d=$fila2['domicilio'];
                                $p=$fila2['codprov'];
                                $loc=$fila2['codloc'];
                                $es=$fila2['estado'];
                                $em=$fila2['email'];
                                
                                $sql3="select * from provincias where codigo='$p'";
                                $registro3=mysql_query($sql3,$idCone);
                                $fila3=mysql_fetch_array($registro3);
                                $pr=$fila3['provincia'];

                                $sql4="select * from localidad where codlocalidad='$loc'";
                                $registro4=mysql_query($sql4,$idCone);
                                $fila4=mysql_fetch_array($registro4);
                                $loc2=$fila4['localidad'];

                                echo"<td>".$l;
                                echo"<td>".$a;
                                echo"<td>".$n;
                                echo"</div>";
                                echo"<td>".$c;
                                echo"<td>".$t;
                                echo"<td>".$d;
                                echo"</div>";
                                echo"<td>".$pr;
                                echo"<td>".$loc2;
                                echo"<td>".$em;
                                echo"<td>".$es;
                                echo"<td><a
                                    class='btn btn-primary ml-2'
                                    href='ActEmp2.php?legajo=$l'
                                    >
                                    Modificar
                                    </a>";
                                echo"<td><a href=javascript:borrar('$l')>";
                                    if ($es=='activo'){
                                        echo"<img class='img-fluid' style='width: 50px;' src='./img/activo.png'></a>";
                                    }
                                    else {
                                        echo"<img class='img-fluid' style='width: 50px;' src='./img/inactivo.png'></a>";
                                    }

                                echo"</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script languaje="javascript">
function borrar(dato){
direccion="BajaEmpleado.php?legajo="+dato;

if(confirm("Confirma el cambio de estado de "+dato)){
location=direccion;
}
else alert("Baja Cancelada");
}
</script>

</body>
</html>
