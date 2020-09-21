<?php

$conexion = array();

$mysqli = new mysqli("localhost", "root", "", "OIS");
$mysqli->set_charset('utf8');
$statement = $mysqli->prepare(" select Nombre, Apellido, CorreoElectronico
from usuario where estado like '0'
 ");
$statement->execute();
$resultado = $statement->get_result();
while($row = $resultado->fetch_assoc()) $conexion[] = $row;
$mysqli->close();
