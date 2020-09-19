<?php
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;

$regpagina = 15;

$inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

$registros = $pdo->prepare("SELECT SQL_CALC_FOUND_ROWS concat(u.Nombre,' ',u.Apellido) as NombreCompleto, cg.NombreCargo, td.NombreTipoDocumento, u.NoDocumento, u.CorreoElectronico
		FROM usuario u
 	 INNER JOIN tipodocumento td  ON td.id = u.idTipoDocumento
 	 INNER JOIN cargousuario cg ON cg.NivelVisibilidad=u.idCargoUsuario
 	 group by u.id order by u.Nombre ASC LIMIT $inicio,$regpagina");

$registros->execute();
$registros = $registros->fetchAll();

$totalregistros = $pdo->query("SELECT FOUND_ROWS() as total");
$totalregistros = $totalregistros->fetch()['total'];

$numeropaginas = ceil($totalregistros / $regpagina);
