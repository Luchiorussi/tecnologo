<?php

$conexion = array();

$mysqli = new mysqli("localhost", "root", "", "OIS");
$mysqli->set_charset('utf8');
$statement = $mysqli->prepare(" select  u.Nombre, u.Apellido, u.NoDocumento,  c.NombreCargo
from usuario  u
INNER JOIN cargousuario as c ON c.NivelVisibilidad = u.idCargoUsuario
where c.NombreCargo like 'Docente'

 ");
$statement->execute();
$resultado = $statement->get_result();
while($row = $resultado->fetch_assoc()) $conexion[] = $row;
$mysqli->close();
