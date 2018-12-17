<?php
session_start();
$l=$_SESSION['LEGAJO'];
require("Conexion.php");
$idCone=Conectar();

$sql="select * from empleados where legajo='$l'";
$registro=mysql_query($sql,$idCone);
$fila=mysql_fetch_array($registro);

$n=$fila['nombre'];

$sql2="select * from clientes";
$registro2=mysql_query($sql2,$idCone);
$registrocount=mysql_query($sql2,$idCone);

$count=1;

while ($filacount=mysql_fetch_array($registrocount))
{
    $count = $count + 1;
}

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
                            <a href="RepoVent.php" class="btn">
                                Reportes
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3"></div>
        </div>

        <div class="row" style="margin-bottom: 10px">
            <!-- <div class="col-xl-2 offset-md-0"></div> -->
            <div class="col-xl-12 offset-md-0">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Registro de Cliente</h2>
                        <form action="AltaCli.php" method="post" onSubmit="if (!confirm('¿Desea dar de alta?')){return false;}">
                            <table class="table table-user-information ">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h4>Código</h4>
                                            <?php echo"$count" ?>
                                        </td>
                                        <td>
                                            <h4>Razón Social</h4>
                                            <input type="text" name="razon" required>
                                            <span> *</span>
                                        </td>
                                        <td>
                                            <h4>C.U.I.T.</h4>
                                            <input type="text" name="cuit" placeholder="30111111117"
                                                pattern="[0-9]{11}" minlength="11" maxlength="11" required>
                                            <span> *</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4>Tel&eacute;fono</h4>
                                            <input type="tel" placeholder="12312345678"
                                                minlength="10" maxlength="10" name="telefono" required>
                                            <span> *</span>
                                        </td>
                                        <td>
                                            <h4>Email</h4>
                                            <input type="text" name="email" placeholder="me@example.com.ar"
                                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required/>
                                            <span> *</span>
                                        </td>
                                        <td>
                                            <h4>Domicilio</h4>
                                            <input type="text" name="domicilio" required>
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
                                                    echo"<option value=$Cod>$Npro</option>";
                                                }
                                                echo"</select>";
                                            ?>
                                        </td>
                                        <td>
                                            <h4>Localidad</h4>
                                            <?php
                                                $sql4="select * from localidad where codprov='1'";
                                                $registro4=mysql_query($sql4,$idCone) or die("Error en el select");
                                                echo"<select name='s2' id='localidades'>";
                                                while($fila4=mysql_fetch_array($registro4)){
                                                    $Cd=$fila4['codlocalidad'];
                                                    $Nloc=$fila4['localidad'];
                                                    echo"<option value=$Cd>$Nloc</option>";
                                                }
                                                echo"</select>";
                                            ?>
                                        </td>
                                        <td>
                                            <h4>Contacto</h4>
                                            <input type="text" name="contacto"/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-primary ml-2" type="submit">Dar de Alta</button>
                        </form>
                        <hr>
                        <h2 class="card-title">Listado de Cliente</h2>
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Razón Social</th>
                                <th scope="col">C.U.I.T.</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Email</th>
                                <th scope="col">Domicilio</th>
                                <th scope="col">Provincia</th>
                                <th scope="col">Localidad</th>
                                <th scope="col">Contacto</th>
                                <th scope="col">Modificar</th>
                                <th scope="col">Baja</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while ($fila2=mysql_fetch_array($registro2))
                                    {
                                        echo"<tr class='table-secondary'>";
                                        $cod2=$fila2['codigo'];
                                        $r=$fila2['razon'];
                                        $c=$fila2['cuit'];
                                        $t=$fila2['telefono'];
                                        $e=$fila2['email'];
                                        $dom=$fila2['domicilio'];
                                        $p=$fila2['codprov'];
                                        $loc=$fila2['codloc'];
                                        $cont=$fila2['contacto'];
                                        $est=$fila2['estado'];

                                        $sql5="select * from provincias where codigo='$p'";
                                        $registro5=mysql_query($sql5,$idCone);
                                        $fila5=mysql_fetch_array($registro5);
                                        $pr=$fila5['provincia'];

                                        $sql6="select * from localidad where codlocalidad='$loc'";
                                        $registro6=mysql_query($sql6,$idCone);
                                        $fila6=mysql_fetch_array($registro6);
                                        $loc2=$fila6['localidad'];

                                        if ($est=='activo')
                                        {
                                            echo"<td>".$cod2;
                                            echo"<td>".$r;
                                            echo"<td>".$c;
                                            echo"<td>".$t;
                                            echo"<td>".$e;
                                            echo"<td>".$dom;
                                            echo"<td>".$pr;
                                            echo"<td>".$loc2;
                                            echo"<td>".$cont;
                                            echo"<td><a
                                                class='btn btn-primary ml-2'
                                                href='ActCli2.php?codigo=$cod2'
                                                >
                                                Modificar
                                            </a>";
                                            echo"<td><a href=javascript:borrar('$cod2') class='btn btn-primary ml-2'>Baja</a>";
                                            echo"</tr>";
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- <div class="col-xl-2 offset-md-0"></div> -->
        </div>

        <!-- <div class="row">
            <div class="col-xl-12">
                
            </div>
        </div> -->
    </div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    function borrar(dato){
    direccion="BajaCli.php?codigo="+dato;

    if(confirm("Confirma la baja")){
    location=direccion;
    }
    else alert("Baja Cancelada");
}

    $('#provincias').change(function(){
        valor=$(this).val();
        $.post("localidad.php",{id:valor},function(data){
            $("#localidades").html(data);
        });
    });

</script>

</body>
</html>