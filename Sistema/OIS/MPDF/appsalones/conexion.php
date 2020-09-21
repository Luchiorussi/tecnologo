<?php

$conexion = array();

$mysqli = new mysqli("localhost", "root", "", "OIS");
$mysqli->set_charset('utf8');
$statement = $mysqli->prepare(" Select NombreAula, count(id) as Numero
from aula group by id");
$statement->execute();
$resultado = $statement->get_result();
while($row = $resultado->fetch_assoc()) $conexion[] = $row;
$mysqli->close();
