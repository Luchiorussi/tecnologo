<?php 

require_once('configuracion/Cargar.php');

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para Buscar Todas las Filas de la Tabla de Base de Datos por Nombre de Tabla 			*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function find_all($table){ //Encontrar Filas de la Base de Datos SISTEMA-OIS
	global $db;
	if (tableExists($table)) {
		return find_by_sql("SELECT * FROM ". $db->escape($table));
	}
}

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para subir archivos csv en la Base de Datos SISTEMA-OIS 								*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function insertar_datos_mobiliario($NombreMobiliario,$CodigoMobiliario,$idAula,$VidaUtilMobiliario,$VidaUtilMobiliarioFinal,$idNombreEstadoMobiliario){
global $db;
$sql = "insert into mobiliarioaula (NombreMobiliario, CodigoMobiliario, idAula, VidaUtilMobiliario, VidaUtilMobiliarioFinal, idNombreEstadoMobiliario) VALUES
('$NombreMobiliario','$CodigoMobiliario','$idAula','$VidaUtilMobiliario','$VidaUtilMobiliarioFinal','$idNombreEstadoMobiliario')";
$ejecutar = $result = $db->query($sql);
return $ejecutar; 
}

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para subir archivos csv en la Base de Datos SISTEMA-OIS 	csv							*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function insertar_datos_usuario($Nombre,$Apellido,$idCargoUsuario,$idTipoDocumento, $NoDocumento,$CorreoElectronico){
    global $db;
  $sql  = "INSERT INTO usuario(Nombre, Apellido,idCargoUsuario, idTipoDocumento, NoDocumento, CorreoElectronico) values ('$Nombre','$Apellido','$idCargoUsuario','$idTipoDocumento','$NoDocumento','$CorreoElectronico')";
  $ejecutar = $result = $db->query($sql);
  return $ejecutar;
 }


/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para subir archivos csv en la Base de Datos SISTEMA-OIS 								*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function insertar_datos_aula($NombreAula,$EstadoAula){
    global $db;
  $sql  = "insert into aula (NombreAula, EstadoAula) values ('$NombreAula','$EstadoAula')";
  $ejecutar = $result = $db->query($sql);
  return $ejecutar;
 }

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para Realizar Consultas en la Base de Datos SISTEMA-OIS 								*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function find_by_sql($sql){ //Encontrar por Sql
	global $db;
	$result = $db->query($sql);
	$result_set = $db->while_loop($result);
	return $result_set;
}

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para Buscar Datos de la Tabla por Id 													*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function find_by_id($table,$id){ //Encontrar por Sql
	global $db;
	$id = (int)$id;
		if (tableExists($table)) {
			$sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");	
			if ($result = $db->fetch_assoc($sql)) 
				return $result;
			else 
				return null;
			
		}
}


/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función para Eliminar datos de la tabla por id 													*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function delete_by_id($table,$id){ //Eliminar Por Id
	global $db;
	if (tableExists($table)) {
		$sql = "DELETE FROM ".$db->escape($table);
		$sql .= " WHERE id=". $db->escape($id);
		$sql .= " LIMIT 1";
		$db->query($sql);
		return ($db->affected_rows() === 1 ) ? true : false;
	}
}

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Funcion Para Contar Id por Nombre de la Tabla 													*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function count_by_id($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
	}	
}

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Determinar si existe una tabla de base de datos 												*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function tableExists($table){ //Tabla Existente
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
      if($table_exit) {
        if($db->num_rows($table_exit) > 0)
              return true;
         else
              return false;
      }
  }

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Iniciar Sesión Con Datos Proporcionados En El Metodo $ _POST,									*/
/*| Proveniente Del Formulario de Inicio de Sesión. 												*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function authenticate($NoDocumento='',$ClaveUsuario=''){ //Autentifiacion de Usuario
	global $db;
	$NoDocumento = $db->escape($NoDocumento);
	$ClaveUsuario = $db->escape($ClaveUsuario);
	$sql = sprintf("SELECT id,NoDocumento,ClaveUsuario,idCargoUsuario FROM Usuario WHERE NoDocumento ='%s'  LIMIT 1", $NoDocumento);
	$result = $db->query($sql);
	if($db->num_rows($result)) {
		$user = $db->fetch_assoc($result);
		$password_request = sha1($ClaveUsuario);
		if($password_request === $user['ClaveUsuario'] ) {
			return $user['id'];
		}
	}
	return false;
}


/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Iniciar Sesión Con Datos Proporcionados En El Metodo $ _POST,									*/
/*| Proveniente del formulario login_v2.php 														*/
/*| Si se usa Este Metodo, se Elimina la Funcion de Autenfificacion 								*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function authenticate_v2($NoDocumento='',$ClaveUsuario=''){
	global $db;
	$NoDocumento = $db->escape($NoDocumento);
	$ClaveUsuario = $db->escape($ClaveUsuario);
	$sql = sprintf("SELECT id,NoDocumento,ClaveUsuario,idCargoUsuario FROM Usuario WHERE NoDocumento ='%s' LIMIT 1", $NoDocumento);
	$result = $db->query($sql);
	if ($db->num_rows($result)) {
		$user = $db->fetch_assoc($result);
		$password_request = sha1($ClaveUsuario);
		if ($password_request === $user['ClaveUsuario']) {
			return $user;
		}
	}
	return false;
}

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Encuentra el Usuario de Inicio de Sesión Actual Por ID de Sesión 								*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/


function current_user(){ //Usuario Actual
		static $current_user;
		global $db;
		if(!$current_user){
			if (isset($_SESSION['user_id'])):
				$user_id = intval($_SESSION['user_id']);
			 	$current_user = find_by_id('Usuario',$user_id);
			endif;
		}
		return $current_user;
}

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Encuentra todos los usuarios por la Union de las Tablas Usuario y TipoCargo 					*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function find_all_user(){ //Encontrar Usuarios
	global $db;
	$results = array();
	$sql = "SELECT u.id,u.Nombre,u.Apellido,cg.NombreCargo,td.NombreTipoDocumento,
	u.NoDocumento,u.CorreoElectronico,u.UltimoLogin,";
	$sql .="u.Estado ";
	$sql .="FROM Usuario u ";
	$sql .="INNER JOIN tipodocumento td   ";
	$sql .="ON td.id = u.idTipoDocumento ";
	$sql .="INNER JOIN cargousuario cg   ";
	$sql .="ON cg.NivelVisibilidad=u.idCargoUsuario group by u.id order by u.Nombre ASC";
	$result = find_by_sql($sql);
	return $result;
}

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función para actualizar el último inicio de sesión de un usuario 								*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function updateLastLogIn($user_id){ //Ultimo Inicio de Sesion del usuario
	global $db;
	$date = make_date();
	$date = "UPDATE Usuario SET UltimoLogin='{$date}' Where id='{$user_id}' LIMIT 1";
	$result =$db->query($sql);
	return ($result && $db->affected_rows() === 1 ? true : false);
}


/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Funcion Para Buscar por Tipo de Cargo 															*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function find_by_groupName($val){ //Tipos de Grupos por Tipo de Cargo
	global $db;
    $sql = "SELECT NombreCargo FROM cargousuario WHERE NombreCargo = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Funcion Para Buscar por Tipo de Documento															*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function find_by_groupDocumento($val){
	global $db;
	$sql = "SELECT NombreTipoDocumento FROM TipoDocumento WHERE NombreTipoDocumento = 
	'{$db->escape($val)}' LIMIT 1";
	$result = $db->query($sql);
	return($db->num_rows($result) === 0 ? true : false);
}


/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Funcion Para Buscar por nivel del Tipo de Cargo 												*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT NivelVisibilidad FROM cargousuario WHERE NivelVisibilidad = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }



/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para Detectar Qué Nivel de Usuario Tiene Acceso a la página 							*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function page_require_level ($require_level){ //Nivel de Visibilidad Para los Formularios
	global $session;
	$current_user = current_user();
	$login_level = find_by_groupLevel($current_user['idCargoUsuario']);

	//Si el Usuario no Inicia Sesión
	if(!$session->isUserLoggedIn(true)):
		$session->msg('d','Por Favor Iniciar Sesión...');
		redirect('InicioSesion.php',false);

	//Si el Estado del Grupo Está Inactivo
	elseif($login_level['Estado'] === '0'):
		$session->msg('d','Este nivel de Usuario Esta Inactivo!');
		redirect('Bienvenido.php',false);

	//Verificar el Nivel de Usuario de Inicio de Sesión y el Nivel Requerido es Menor o Igual a
	elseif($current_user['idCargoUsuario'] <= (int)$require_level):
		return true;

	else:
		$session->msg('d','¡Lo siento! No tienes Permiso Para Ver la Pagina.');
		redirect('Bienvenido.php', false);
	endif;
}


/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para Enncontrar Todo el Nombre del Mobiliario 											*/
/*| JOIN con las tablas Mobiliario y Media 															*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function join_mobiliario_table(){
	global $db;
	$sql ="SELECT m.id, m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, m.VidaUtilMobiliario, m.VidaUtilMobiliarioFinal, em.NombreEstadoMobiliario ";
	$sql .="FROM MobiliarioAula m ";
	$sql .="INNER JOIN Aula a ON a.id = m.idAula ";
	$sql .="INNER JOIN EstadoMobiliario em ON em.id = m.idNombreEstadoMobiliario ";
	$sql .="ORDER BY m.NombreMobiliario ASC";
	return find_by_sql($sql);
}

function join_mobiliario_table2(){
global $db;
$sql .="SELECT pm.id, pm.descripcionprestamo, pm.InicioFechaPrestamo, pm.finFechaPrestamo,  u.id, u.Nombre, u.Apellido";
$sql .=" FROM prestamomobiliario pm ";
$sql .="INNER JOIN usuario u ";
$sql .="ON u.id = pm.idusuario ";
$sql .="ORDER BY pm.id ASC";
return find_by_sql($sql);
}

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para Encontrar Todo El Nombre del Mobiliario 											*/
/*| Solicitud Proveniente de ajax.php Para Sugerir Automáticamente 									*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function find_mobiliario_by_tittle($product_name){ //Encontrar Mobiliario por Título
	global $db;
	$p_name = remove_junk($db->escape($product_name));
	$sql = "SELECT NombreMobiliario FROM mobiliarioaula where NombreMobiliario '%$p_name%' LIMIT 5";
	$result = find_by_sql($sql);
	return $result;
}


/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para Encontrar Toda la Información del Mobiliario Por Título de Mobiliario 				*/
/*| Solicitud Proveniente de ajax.php 																*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function find_all_mobiliario_info_by_title($title){ //Encontrar Toda la Información del Mobiliario Por Título
	global $db;
	$sql ="SELECT * FROM mobiliarioaula";
	$sql .="WHERE NombreMobiliario ={'$title'}";
	$sql .="LIMIT 1";
	return find_by_sql($sql);
}

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para Encontrar Toda la Información del Usuarios Por Nombre o Apellidos Usuarios 				*/
/*| Solicitud Proveniente de ajax.php 																*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function Find_All_Usuario_Buscar($USUARIOS){
	global $db;
	$USUARIOS = remove_junk($db->escape($USUARIOS));
	$sql = "SELECT Nombre, Apellido FROM usario WHERE Nombre like'%$USUARIOS%' and Apellido like'%USUARIOS%' ";
	$result = find_by_sql($sql);
     return $result;
}



/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para Mostrar Mobiliario Reciente Agregado al Sistema 									*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function find_recent_mobiliario_added($limit){ //Encontrar Mobiliario Recientemente Agregado
	global $db;
	$sql = "SELECT m.id, m.NombreMobiliario as NombreMobiliario,
	 m.CodigoMobiliario , 
	 a.NombreAula, 
	 em.nombreEstadoMobiliario as nombreEstadoMobiliario , 
	 m.imagenMobiliario as imagenMobiliario";
	$sql .= " FROM mobiliarioaula as m ";
	$sql .= " INNER JOIN aula as a ON a.id = m.id ";
	$sql .= " INNER JOIN media as md ON md.id = m.imagenMobiliario ";
	$sql .= " INNER JOIN estadomobiliario as em ON em.id = m.idNombreEstadoMobiliario ";
	$sql .= " ORDER BY m.NombreMobiliario DESC LIMIT " .$db->escape((int)$limit);
	return find_by_sql($sql);
}

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Funcion Para Encontrar el Mobiliario Mas Solicitado ó Prestado en la Institución 				*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function find_more_borrowed_furniture ($limite){ //Mobiliario Mas Prestado
	global $sql;
	$sql = "SELECT m.NombreMobiliario, COUNT(r.PrestamoMobiliario_idPrestamoMobiliario) As TotalPrestado";
	$sql .= "FROM mobiliarioaula m";
	$sql .= "INNER JOIN reporte r ON r.PrestamoMobiliario_idPrestamoMobiliario = m.id";
	$sql .= "GROUP BY r.PrestamoMobiliario_idPrestamoMobiliario";
	$sql .= "ORDER BY m.NombreMobiliario DESC LIMIT 1" .$db->escape((int)$limit);
	return $db->query($sql);
} 

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Funcion Para Encontrar Todas las Aulas Registradas en el Sistema 								*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/

function find_all_aula(){
	global $db;
	$sql  = "SELECT a.id,a.NombreAula,a.EstadoAula";
	$sql .= " FROM aula as a";;
	$sql .= " ORDER BY a.id ASC";
	return find_by_sql($sql);
  }




function update_product_qty($EstadoAula,$p_id){
    global $db;
    $EstadoAula = (int) $EstadoAula;
    $id  = (int)$p_id;
    $sql = "UPDATE products SET quantity=quantity -'{$EstadoAula}' WHERE id = '{$id}'";
    $result = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);

  }

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Funcion Para Mostrar las novedades Registradas 									*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function find_all_novedad(){ //Encontrar Usuarios
	global $db;
	$results = array();
	$sql = "SELECT n.id, u.Nombre, u.Apellido, n.DescripcionNovedad, m.NombreMobiliario ";
	$sql .="FROM novedad n ";
	$sql .="INNER JOIN usuario u ";
	$sql .="ON u.id = n.idUsuario ";
	$sql .="INNER JOIN mobiliarioaula m ";
	$sql .="ON m.id = n.idMobiliarioAula ";
	$sql .="Order by n.id ASC";
	$result = find_by_sql($sql);
	return $result;
}

function find_all_states(){//Encontrar Estados
	global $db;
	$results = array();
	$sql = "SELECT id, NombreEstadoMobiliario ";
	$sql .="FROM estadomobiliario";
	$result = find_by_sql($sql);
	return $result;
}
/*--------------------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------*/
//PARTE EN LA QUE VAN LOS REPORTES PARA LLAMARLOS
/*--------------------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------*/
function find_sale_by_dates($start_date,$end_date){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date));

  $sql  = "SELECT m.VidaUtilMobiliario, m.NombreMobiliario, a.NombreAula,";
  $sql .= "COUNT(m.id) as Total_Mobiliarios, e.NombreEstadoMobiliario as EstadoMobiliario ";
  $sql .= "FROM mobiliarioaula 	m ";
  $sql .= "INNER JOIN aula a ON a.id = m.idAula ";
  $sql .= "INNER JOIN estadomobiliario e ON e.id = m.idNombreEstadoMobiliario ";
  $sql .= "WHERE m.VidaUtilMobiliario BETWEEN '{$start_date}' AND '{$end_date}'";
  $sql .= " GROUP BY DATE(m.VidaUtilMobiliario), m.NombreMobiliario";
  $sql .= " ORDER BY DATE(m.VidaUtilMobiliario);";

  return $db->query($sql);
 }
function find_sale_by_dates_final($FECHA_DE,$FECHA_HASTA){
  global $db;
  $FECHA_DE  = date("Y-m-d", strtotime($FECHA_DE));
  $FECHA_HASTA= date("Y-m-d", strtotime($FECHA_HASTA));

  $sql  = "SELECT m.VidaUtilMobiliarioFinal, m.NombreMobiliario, a.NombreAula,";
  $sql .= "COUNT(m.id) as Total_Mobiliarios, e.NombreEstadoMobiliario as EstadoMobiliario ";
  $sql .= "FROM mobiliarioaula 	m ";
  $sql .= "INNER JOIN aula a ON a.id = m.idAula ";
  $sql .= "INNER JOIN estadomobiliario e ON e.id = m.idNombreEstadoMobiliario ";
  $sql .= "WHERE m.VidaUtilMobiliarioFinal BETWEEN '{$FECHA_DE}' AND '{$FECHA_HASTA}'";
  $sql .= " GROUP BY DATE(m.VidaUtilMobiliarioFinal), m.NombreMobiliario";
  $sql .= " ORDER BY DATE(m.VidaUtilMobiliarioFinal);";
  return $db->query($sql);
 }
function find_fecha_inicial($FECHA_DE,$FECHA_HASTA){
	global $db;
  $FECHA_DE  = date("Y-m-d", strtotime($FECHA_DE));
  $FECHA_HASTA= date("Y-m-d", strtotime($FECHA_HASTA));

  $sql  = "SELECT p.InicioFechaPrestamo as fechaInicio,concat(u.Nombre,' ',u.Apellido) as Nombres, a.NombreAula as aula, m.NombreMobiliario as mobiliario, p.DescripcionPrestamo as prestamo ";
  $sql .= "prestamomobiliario p ";
  $sql .= "INNER JOIN aula a ON a.id = p.idAula  ";
  $sql .= "INNER JOIN usuario u ON u.id = p.idUsuario ";
  $sql .= "INNER JOIN mobiliarioaula m ON m.id = p.idMobiliarioaula ";
  $sql .= "WHERE p.InicioFechaPrestamo BETWEEN '{$FECHA_DE}' AND '{$FECHA_HASTA}'";
  $sql .= " GROUP BY DATE(p.InicioFechaPrestamo), m.NombreMobiliario";
  $sql .= " ORDER BY DATE(p.InicioFechaPrestamo);";
  return $db->query($sql);

}


function find_sale_by_Dañado(){
 	global $db;
 	 $sql  = "SELECT m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, e.NombreEstadoMobiliario ";
 	 $sql .= "FROM mobiliarioaula m ";
 	 $sql .= "INNER JOIN aula as a ON a.id = m.id ";
 	 $sql .= "INNER JOIN estadomobiliario as e ON e.id = m.idNombreEstadoMobiliario ";
 	 $sql .= "WHERE e.NombreEstadoMobiliario like'Dañado' ";
 	 $sql .= "ORDER BY m.NombreMobiliario";
  return $db->query($sql);
 }

function find_sale_by_Bueno(){
 	global $db;
 	 $sql  = "SELECT m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, e.NombreEstadoMobiliario ";
 	 $sql .= "FROM mobiliarioaula m ";
 	 $sql .= "INNER JOIN aula as a ON a.id = m.id ";
 	 $sql .= "INNER JOIN estadomobiliario as e ON e.id = m.idNombreEstadoMobiliario ";
 	 $sql .= "WHERE e.NombreEstadoMobiliario like'Bueno' ";
 	 $sql .= "ORDER BY m.NombreMobiliario";
  return $db->query($sql);
 }

 function find_sale_by_Malo(){
 	global $db;
 	 $sql  = "SELECT m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, e.NombreEstadoMobiliario ";
 	 $sql .= "FROM mobiliarioaula m ";
 	 $sql .= "INNER JOIN aula as a ON a.id = m.id ";
 	 $sql .= "INNER JOIN estadomobiliario as e ON e.id = m.idNombreEstadoMobiliario ";
 	 $sql .= "WHERE e.NombreEstadoMobiliario like'Malo' ";
 	 $sql .= "ORDER BY m.NombreMobiliario";
  return $db->query($sql);

 }
 function find_sale_by_baja(){
 	global $db;
 	 $sql  = "SELECT m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, e.NombreEstadoMobiliario ";
 	 $sql .= "FROM mobiliarioaula m ";
 	 $sql .= "INNER JOIN aula as a ON a.id = m.id ";
 	 $sql .= "INNER JOIN estadomobiliario as e ON e.id = m.idNombreEstadoMobiliario ";
 	 $sql .= "WHERE e.NombreEstadoMobiliario like'Dado de baja' ";
 	 $sql .= "ORDER BY m.NombreMobiliario";
  return $db->query($sql);

 }
 function find_sale_by_alta(){
 	global $db;
 	 $sql  = "SELECT m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, e.NombreEstadoMobiliario ";
 	 $sql .= "FROM mobiliarioaula m ";
 	 $sql .= "INNER JOIN aula as a ON a.id = m.id ";
 	 $sql .= "INNER JOIN estadomobiliario as e ON e.id = m.idNombreEstadoMobiliario ";
 	 $sql .= "WHERE e.NombreEstadoMobiliario like'Dado de alta' ";
 	 $sql .= "ORDER BY m.NombreMobiliario";
  return $db->query($sql);

 }
 function find_sale_by_Reparacion(){
 	global $db;
 	 $sql  = "SELECT m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, e.NombreEstadoMobiliario ";
 	 $sql .= "FROM mobiliarioaula m ";
 	 $sql .= "INNER JOIN aula as a ON a.id = m.id ";
 	 $sql .= "INNER JOIN estadomobiliario as e ON e.id = m.idNombreEstadoMobiliario ";
 	 $sql .= "WHERE e.NombreEstadoMobiliario like'Reparación' ";
 	 $sql .= "ORDER BY m.NombreMobiliario";
  return $db->query($sql);
 }

 function find_sale_by_Robado(){
 	global $db;
 	 $sql  = "SELECT m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, e.NombreEstadoMobiliario ";
 	 $sql .= "FROM mobiliarioaula m ";
 	 $sql .= "INNER JOIN aula as a ON a.id = m.id ";
 	 $sql .= "INNER JOIN estadomobiliario as e ON e.id = m.idNombreEstadoMobiliario ";
 	 $sql .= "WHERE e.NombreEstadoMobiliario like'Robado' ";
 	 $sql .= "ORDER BY m.NombreMobiliario";
  return $db->query($sql);
 }
function find_sale_by_Regular(){
 	global $db;
 	 $sql  = "SELECT m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, e.NombreEstadoMobiliario ";
 	 $sql .= "FROM mobiliarioaula m ";
 	 $sql .= "INNER JOIN aula as a ON a.id = m.id ";
 	 $sql .= "INNER JOIN estadomobiliario as e ON e.id = m.idNombreEstadoMobiliario ";
 	 $sql .= "WHERE e.NombreEstadoMobiliario like'Regular' ";
 	 $sql .= "ORDER BY m.NombreMobiliario ASC" ;
  return $db->query($sql);
 }

function find_sale_Usuario(){
	global $db;
 	 $sql  = "SELECT concat(u.Nombre,' ',u.Apellido) as NombreCompleto, cg.NombreCargo, td.NombreTipoDocumento, u.NoDocumento, u.CorreoElectronico ";
 	 $sql .= "FROM usuario u ";
 	 $sql .= "INNER JOIN tipodocumento td  ON td.id = u.idTipoDocumento ";
 	 $sql .= "INNER JOIN cargousuario cg ON cg.NivelVisibilidad=u.idCargoUsuario  ";
 	 $sql .= "group by u.id order by u.Nombre ASC";
  return $db->query($sql);
}
 function find_Novedad(){
 	global $db;
 	 $sql  = "SELECT concat(u.Nombre,' ',u.Apellido) as Nombres, a.NombreAula as aula, m.NombreMobiliario as Mobilario, e.NombreEstadoMobiliario as estado, n.DescripcionNovedad as novedad, COUNT(m.id) as Total ";
 	 $sql .= "from novedad n ";
 	 $sql .= "INNER JOIN aula a ON a.id = n.idAula ";
 	 $sql .= "INNER JOIN estadomobiliario e ON e.id = n.idEstadoMobiliario  ";
 	 $sql .= "INNER JOIN mobiliarioaula m ON m.id = n.idMobiliarioaula  ";
 	 $sql .= "INNER JOIN usuario u ON u.id = n.idUsuario  ";
 	 $sql .= "group by m.NombreMobiliario order by n.id ASC";
  return $db->query($sql);
 }

function find_estados_mobiliario(){
	global $db;
 	$sql  = "SELECT m.NombreMobiliario as Mobilario, e.NombreEstadoMobiliario as estado ";
 	$sql .= "from mobiliarioaula m ";
 	$sql .= "INNER JOIN estadomobiliario e ON e.id = m.idNombreEstadoMobiliario ";
 	$sql .= "group by m.NombreMobiliario order by m.id ASC";
 	return $db->query($sql);
}

function find_estados_usuarios(){
	global $db;
 	 $sql  = "SELECT concat(u.Nombre,' ',u.Apellido) as NombreCompleto, cg.NombreCargo as cargo, u.CorreoElectronico as correo,u.Estado as estado ";
 	 $sql .= "FROM usuario u ";
 	 $sql .= "INNER JOIN cargousuario cg ON cg.NivelVisibilidad=u.idCargoUsuario  ";
 	 $sql .= "group by u.id order by u.Nombre ASC";
  return $db->query($sql);
}

function find_Prestamo(){
 	global $db;
 	 $sql  = "SELECT concat(u.Nombre,' ',u.Apellido) as Nombres, a.NombreAula as aula, m.NombreMobiliario as mobiliario, p.DescripcionPrestamo as prestamo ";
 	 $sql .= "FROM prestamomobiliario p ";
 	 $sql .= "INNER JOIN aula a ON a.id = p.idAula  ";
 	 $sql .= "INNER JOIN usuario u ON u.id = p.idUsuario ";
 	 $sql .= "INNER JOIN mobiliarioaula m ON m.id = p.idMobiliarioaula  ";
 	 $sql .= "group by m.NombreMobiliario order by p.id ASC";
  return $db->query($sql);
 }
function find_Estado_Prestamo(){
 	global $db;
 	 $sql  = "SELECT m.NombreMobiliario As Mobiliario, a.NombreAula As aula, u.NoDocumento As documento,
	   CONCAT(u.Nombre,' ',u.Apellido) As nombre, p.DescripcionPrestamo as prestamo, es.Descripcion as estado ";
 	 $sql .= "FROM prestamomobiliario p ";
 	 $sql .= "INNER JOIN aula a ON a.id = p.idAula  ";
 	 $sql .= "INNER JOIN usuario u ON u.id = p.idUsuario ";
 	 $sql .= "INNER JOIN mobiliarioaula m ON m.id = p.idMobiliarioaula  ";
 	 $sql .= "INNER JOIN estadoPrestamo as es ON  es.idEstadoMobiliario = p.CodigoEstado ";
 	 $sql .= "group by m.NombreMobiliario order by p.id ASC";
  return $db->query($sql);
 }

?>