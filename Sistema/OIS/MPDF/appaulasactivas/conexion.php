<?php

$conexion = array();

$mysqli = new mysqli("localhost", "root", "", "OIS");
$mysqli->set_charset('utf8');
$statement = $mysqli->prepare(" select NombreAula, EstadoAula
from aula
where EstadoAula like '1'
 ");
$statement->execute();
$resultado = $statement->get_result();
while($row = $resultado->fetch_assoc()) $conexion[] = $row;
$mysqli->close();
