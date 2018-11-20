<?php
    require("Conexion.php");
    $idCone=Conectar();
    

    $sql="select * from producto where cateprod={$_POST["id"]}";
    $registro=mysql_query($sql,$idCone);
    while($fila=mysql_fetch_array($registro)){
        echo"<tr class='table-secondary'>";
        echo"<td>".$fila["codigo"];
        echo"<td>".$fila["nombre"];
        echo"<td>".$fila["tipo"];
        echo"<td>".$fila["stockactual"];
        echo"<td>";
        echo"<a class='btn btn-primary ml-2' href='Prod.php?codigo={$fila["codigo"]}'>Añadir</a>";
        echo"</tr>";
    }
?>