<?php
    require("Conexion.php");
    $idCone=Conectar();

    $sql="select * from localidad where codprov={$_POST["id"]}";
    $registro=mysql_query($sql,$idCone);
        while($fila=mysql_fetch_array($registro)){
            echo "<option value='{$fila["codlocalidad"]}'>{$fila["localidad"]}</option>";
        }
?>