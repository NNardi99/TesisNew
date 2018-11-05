<?php
session_start();
require("Conexion.php");
$idCone=Conectar();
$n=$_REQUEST['inputUser'];
$c=$_REQUEST['inputPassword'];
$sql="select * from usuarios where usuario='$n' and clave='$c'";
$registro=mysql_query($sql,$idCone);
if($fila=mysql_fetch_array($registro)){
    $t=$fila['tipo'];
    $l=$fila['legajo'];
    if($t==1)
    {
        $_SESSION['LEGAJO']=$l;
        $sql2="select * from login where legajo='$l'";
        $registro2=mysql_query($sql2,$idCone);
        $fila2=mysql_fetch_array($registro2);

        $datetimeold=$fila2['datetime'];
        $cant=$fila2['cant'];
        $datetimenew=date("d/m/Y");
        if ($datetimeold == "")
        {
            $cant=1;
            $sql3="insert into login (legajo,datetime,cant) values ('$l','$datetimenew','$cant')";
        }
        else if($datetimenew > $datetimeold)
        {
            $cant=1;
            $sql3="update login set cant='$cant', datetime='$datetimenew' where legajo='$l'";
        }
        else
        {
            $cant=$cant++;
            $sql3="update login set cant='$cant' where legajo='$l'";
        }

        header("location:Admin.php");
    }
    else if ($t==2)
    {
        $_SESSION['LEGAJO']=$l;
        header("location:RVent.php");
    }
    else if ($t==3)
    {
        $_SESSION['LEGAJO']=$l;
        header("location:EStock.php");
    }
}
else
{
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
        <div class="container">
            <img src="./img/logo.png" class="logo">
            <h1 class="form-heading">Sprinkler</h1>
            <div class="login-form">
                <div class="main-div">
                    <div class="panel">
                        <h2>Login</h2>
                        <p>Por favor ingrese su usuario y password</p>
                    </div>
                    <form id="Login" action="Login.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="inputUser" placeholder="Usuario">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="inputPassword" placeholder="Password">
                    </div>
                    <div class="forgot">
                        <p >Usuario o clave incorrectos</p>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>
    </html>
    <?php
}