<?php
 $errors = array();
/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para Eliminar Escapes Especiales														*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function real_escape($str){
    global $con;
    $escape = mysqli_real_escape_string($con,$str);
    return $escape;
  }


/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función para eliminar caracteres html															*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function remove_junk($str){
  $str = nl2br($str);
	$str = utf8_encode($str);
	$str = utf8_decode($str);
	$str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
    return $str;
  }


/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para el Primer Caracter en Mayúscula													*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function first_character($str){
    $val = str_replace('-'," ",$str);
    $val = ucfirst($val);
    return $val;
  }

/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| La Función Para Verificar que los Campos de Entrada no Esten Vacios								*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function validate_fields($var){
    global $errors;
    foreach ($var as $field) {
      $val = remove_junk($_POST[$field]);
      if(isset($val) && $val==''){
        $errors = "El Campo ".$field ." No puede estar Vacio.";
        return $errors;
      }
    }
  }


/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para Mostrar Mensaje de Sesión Ex echo displayt_msg ($ mensaje);						*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function display_msg($msg =''){
    $output = array();
    if(!empty($msg)) {
       foreach ($msg as $key => $value) {
          $output  = "<div class=\"alert alert-{$key}\">";
          $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
          $output .= remove_junk(first_character($value));
          $output .= "</div>";
       }
       return $output;
    } else {
      return "" ;
    }
 }
/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para Redirigir																			*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
      header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para Fecha y Hora Legibles, los cuales son visibles en la Base de Datos SISTEMA-OIS		*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function read_date($str){
    if($str)
     return date('d/m/Y g:i:s a', strtotime($str));
    else
     return null;
 }
/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función Para la Lectura de la fecha y hora legible												*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function make_date(){
    return strftime("%Y-%m-%d %H:%M:%S", time());
  }
/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función para fecha y hora legible																*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function count_id(){
    static $count = 1;
    return $count++;
  }
/*--------------------------------------------------------------------------------------------------*/
/*|																									*/
/*| Función para crear cadenas aleatorias															*/
/*|																									*/
/*--------------------------------------------------------------------------------------------------*/
function randString($length = 5)
{
  $str='';
  $cha = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

  for($x=0; $x<$length; $x++)
   $str .= $cha[mt_rand(0,strlen($cha))];
  return $str;
}


?>
