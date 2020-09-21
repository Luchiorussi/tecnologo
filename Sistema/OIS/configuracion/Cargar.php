<?php 

/*----------------------------------------------------------------------------------*/
/*|																					*/
/*| DEFINIR ALIAS SEPARADORAS														*/
/*|																					*/
/*----------------------------------------------------------------------------------*/
define("URL_SEPARATOR", '/');

define("DS", DIRECTORY_SEPARATOR);


/*----------------------------------------------------------------------------------*/
/*|																					*/
/*| DEFINIR CAMINOS DE RAÍZ															*/
/*|																					*/
/*----------------------------------------------------------------------------------*/
defined('SITE_ROOT')? null: define('SITE_ROOT', realpath(dirname(__FILE__)));
define("LIB_PATH_INC", SITE_ROOT.DS);


require_once(LIB_PATH_INC.'Configuracion.php');
require_once(LIB_PATH_INC.'Funciones.php');
require_once(LIB_PATH_INC.'Sesion.php');
require_once(LIB_PATH_INC.'SubirArchivos.php');
require_once(LIB_PATH_INC.'Base_de_Datos.php');
require_once(LIB_PATH_INC.'Sql.php');


?>