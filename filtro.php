<?php
    require("Conexion.php");
    $idCone=Conectar();
    $id=$_REQUEST['id'];

    if ($id==2){
        $sql="select * from clientes";
        $registro=mysql_query($sql,$idCone);
        echo"<select name='s2'>";
        while($fila=mysql_fetch_array($registro)){
            echo "<option value='{$fila["codigo"]}'>{$fila["razon"]}</option>";
        }
        echo"</select>";
    }
    else
    {
        echo"<input type='text' name='filtro' required/>";
    }
    
?>