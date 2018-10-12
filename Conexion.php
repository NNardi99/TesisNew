<?php
function Conectar()
{
$Host="localhost";
$Usuario="root";
$Clave="";
$Nombre="tesis";
$idCone=mysql_connect($Host,$Usuario,$Clave);
mysql_select_db($Nombre,$idCone);
return $idCone;
}
?>