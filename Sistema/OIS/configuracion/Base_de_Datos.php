<?php
require_once(LIB_PATH_INC.DS."Configuracion.php");

class MySqli_DB {

    private $con;
    public $query_id;

    function __construct() {
      $this->db_connect();
    }

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Funcion Para abrir la conexion a la Base de Datos SISTEMA-OIS									*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
public function db_connect()
{
  $this->con = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
  if(!$this->con)
         {
           die(" Conexión de base de datos fallida:". mysqli_connect_error());
         } else {
           $select_db = $this->con->select_db(DB_NAME);
             if(!$select_db)
             {
               die(" Error al seleccionar la base de datos:". mysqli_connect_error());
             }
         }
}


/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para Cerrar la Base de Datos SISTEMA-OIS												*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
public function db_disconnect()
{
  if(isset($this->con))
  {
    mysqli_close($this->con);
    unset($this->con);
  }
}

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para la Consulta MySqli de la Base de Datos SISTEMA-OIS									*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
public function query($sql)
   {
    //Consulta de DB
      if (trim($sql != "")) {
          $this->query_id = $this->con->query($sql);
      }
      if (!$this->query_id)
        //Para el Modo Desarrollador
              die("Error en esta consulta :<pre> " . $sql ."</pre>");
       //Para el Modo de Produccion
				//Error en la Consulta
       return $this->query_id;

   }
		

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para el Asistente de Consultas de la Base de Datos SISTEMA-OIS							*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
public function fetch_array($statement)//Buscar Matriz
{
  return mysqli_fetch_array($statement);
}
public function fetch_object($statement)//Buscar Objeto
{
  return mysqli_fetch_object($statement);
}
public function fetch_assoc($statement)//Buscar Asociación
{
  return mysqli_fetch_assoc($statement);
}
public function num_rows($statement)//Numero de Filas
{
  return mysqli_num_rows($statement);
}
public function insert_id()//Insertar Id
{
  return mysqli_insert_id($this->con);
}
public function affected_rows()//Asociar Filas Afectadas
{
  return mysqli_affected_rows($this->con);
}


/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para Eliminar Escapes Especiales														*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
public function escape($str){//Eliminar Caracteres Innecesarios
    return $this->con->real_escape_string($str);
  }

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para el Bucle While																		*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
public function while_loop($loop){//Ciclo While
    global $db;
      $results = array();
      while ($result = $this->fetch_array($loop)) {
         $results[] = $result;
      }
    return $results;
   }

}//Fin de la Clase
$db = new MySqli_DB();
?>