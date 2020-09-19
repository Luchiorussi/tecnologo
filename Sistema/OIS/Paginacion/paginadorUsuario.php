<?php 
	$pagina=isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

	$regpagina=10;

	$inicio=($pagina>1) ? (($pagina * $regpagina) - $regpagina):0;

	$registros=$pdo->prepare("SELECT SQL_CALC_FOUND_ROWS u.id,u.Nombre,u.Apellido,cg.NombreCargo,td.NombreTipoDocumento,u.NoDocumento,u.CorreoElectronico,u.UltimoLogin, u.Estado 
		FROM Usuario u 
  INNER JOIN tipodocumento td ON td.id = u.idTipoDocumento
  INNER JOIN cargousuario cg ON cg.NivelVisibilidad=u.idCargoUsuario
  group by u.id order by u.Nombre ASC LIMIT $inicio,$regpagina");

	$registros->execute();
	$registros=$registros->fetchAll();

	$totalregistros=$pdo->query("SELECT FOUND_ROWS() as total");
	$totalregistros=$totalregistros->fetch()['total'];

	$numeropaginas=ceil($totalregistros/$regpagina);

	?>

