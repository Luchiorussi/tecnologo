<?php
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;

$regpagina = 15;

$inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

$registros = $pdo->prepare("SELECT SQL_CALC_FOUND_ROWS m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, e.NombreEstadoMobiliario
		FROM mobiliarioaula m
  INNER JOIN aula as a ON a.id = m.id
  INNER JOIN estadomobiliario as e ON e.id = m.idNombreEstadoMobiliario
  WHERE e.NombreEstadoMobiliario like'Dañado'
  ORDER BY m.NombreMobiliario ASC LIMIT $inicio,$regpagina");

$registros->execute();
$registros = $registros->fetchAll();

$totalregistros = $pdo->query("SELECT FOUND_ROWS() as total");
$totalregistros = $totalregistros->fetch()['total'];

$numeropaginas = ceil($totalregistros / $regpagina);
