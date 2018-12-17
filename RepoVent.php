<?php
session_start();
$l=$_SESSION['LEGAJO'];
require("Conexion.php");
$idCone=Conectar();

$sql="select * from empleados where legajo='$l'";
$registro=mysql_query($sql,$idCone);
$fila=mysql_fetch_array($registro);

$n=$fila['nombre'];

$sql2="select p.nombre producto, count(*) as cantidadvendida from producto p inner join detalleventa dv on dv.codigo = p.codigo group by p.nombre order by p.nombre";
$result=mysql_query($sql2,$idCone);

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
                        <li>
                            <a href="Venta.php" class="btn">
                                Ventas
                            </a>
                        </li>
                        <li class="active">
                            <a href="RepoVent.php" class="btn">
                                Reportes
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3"></div>
        </div>
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'Productos')" id="defaultOpen">Productos</button>
                <button class="tablinks" onclick="openTab(event, 'Clientes')">Clientes</button>
                <!-- <button class="tablinks" onclick="openTab(event, 'Tokyo')">Tokyo</button> -->
            </div>

            <div id="Productos" class="tabcontent">
                <div id="piechart"></div>
            </div>

            <div id="Clientes" class="tabcontent">
                <div id="barchart"></div>
            </div>

            <!-- <div id="Tokyo" class="tabcontent">
                <h3>Tokyo</h3>
                <p>Tokyo is the capital of Japan.</p>
            </div> -->

    </div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

google.charts.load('current', {'packages':['corechart', 'bar']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var datap = google.visualization.arrayToDataTable([
      ['Producto', 'Cantidad'],
      <?php
      $sql2="select dv . nombreprod producto , count( * ) as cantidadvendida from detalleventa dv inner join producto p on dv . nombreprod = p . nombre group by p . nombre order by p . nombre";
      $result=mysql_query($sql2,$idCone);
      $consulta=mysql_num_rows($result);
      if($consulta>0){
          while($row = mysql_fetch_array($result)){
            echo "['".$row['producto']."', ".$row['cantidadvendida']."],";
          }
      }
      ?>
    ]);
    var optionsp = {
        title: 'Productos más vendidos',
        width: 900,
        height: 500,
    };
    
    var chartprod = new google.visualization.PieChart(document.getElementById('piechart'));
    
    chartprod.draw(datap, optionsp);

    var datac = google.visualization.arrayToDataTable([
      ['Clientes', 'Cantidad', { role: 'annotation' }],
      <?php
      $sql3="select c.razon cliente, count(*) as cantidad from clientes c inner join venta v on v.codcliente = c.codigo group by c.razon order by cantidad desc";
      $result2=mysql_query($sql3,$idCone);
      $consulta2=mysql_num_rows($result2);
      
      if($consulta2>0){
          while($row2 = mysql_fetch_array($result2)){
            echo "['".$row2['cliente']."', ".$row2['cantidad'].", '".$row2['cliente']."'],";
          }
      }
      ?>
    ]);

    var optionsc = {
        title: 'Clientes con mayores movimientos de compras',
        width: 900,
        height: 500,
        legend: { position: "none" },
        vAxis: {
          title: 'Clientes'
        },
        hAxis: {
          title: 'Cantidad de Compras',
          format: '0'
        },
    };

    var chartcli = new google.visualization.BarChart(document.getElementById('barchart'));
    
    chartcli.draw(datac, optionsc);
    
}
</script>

</body>
</html>