<?php

$conexion = array();

$mysqli = new mysqli("localhost", "root", "", "OIS");
$mysqli->set_charset('utf8');
$statement = $mysqli->prepare(" SELECT m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, e.NombreEstadoMobiliario 
FROM mobiliarioaula m 
INNER JOIN aula as a ON a.id = m.idAula 
INNER JOIN estadomobiliario as e ON e.id = m.idNombreEstadoMobiliario
WHERE e.NombreEstadoMobiliario like'Reparacion'
ORDER BY m.NombreMobiliario
 ");
$statement->execute();
$resultado = $statement->get_result();
while($row = $resultado->fetch_assoc()) $conexion[] = $row;
$mysqli->close();
