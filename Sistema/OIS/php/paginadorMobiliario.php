<?php 
	$pagina=isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

	$regpagina=20;

	$inicio=($pagina>1) ? (($pagina * $regpagina) - $regpagina):0;

	$registros=$pdo->prepare("SELECT SQL_CALC_FOUND_ROWS  m.id, m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, m.VidaUtilMobiliario, m.VidaUtilMobiliarioFinal, em.NombreEstadoMobiliario
		FROM MobiliarioAula m INNER JOIN Aula a ON a.id = m.idAula 
		INNER JOIN EstadoMobiliario em ON em.id = m.idNombreEstadoMobiliario
		ORDER BY m.NombreMobiliario ASC
		LIMIT $inicio,$regpagina");

	$registros->execute();
	$registros=$registros->fetchAll();

	$totalregistros=$pdo->query("SELECT FOUND_ROWS() as total");
	$totalregistros=$totalregistros->fetch()['total'];

	$numeropaginas=ceil($totalregistros/$regpagina);

	?>

