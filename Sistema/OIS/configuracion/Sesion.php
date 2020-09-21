<?php 

session_start();

class Session {

 public $msg;
 private $user_is_logged_in = false;

 function __construct(){
   $this->flash_msg();          //Mensaje Rapido
   $this->userLoginSetup();     //Configuracion de Inicio de Sesion de Usuario
 }

/*----------------------------------------------------------------------------------*/
public function isUserLoggedIn(){   //Usuario Conectado
    return $this->user_is_logged_in;
  }
	
/*----------------------------------------------------------------------------------*/
public function login($user_id){ //Iniciar Sesión
    $_SESSION['user_id'] = $user_id;
  }
	

/*----------------------------------------------------------------------------------*/
private function userLoginSetup()//Configuración de Inicio de Sesión de Usuario 
  {
    if(isset($_SESSION['user_id']))
    {
      $this->user_is_logged_in = true;
    } else {
      $this->user_is_logged_in = false;
    }

  }
	
/*----------------------------------------------------------------------------------*/
public function logout(){//Cerrar Sesión
    unset($_SESSION['user_id']);
  }
/*----------------------------------------------------------------------------------*/
public function msg($type ='', $msg =''){//Mensaje
    if(!empty($msg)){
       if(strlen(trim($type)) == 1){
         $type = str_replace( array('d', 'i', 'w','s'), array('danger', 'info', 'warning','success'), $type );
       }
       $_SESSION['msg'][$type] = $msg;
    } else {
      return $this->msg;
    }
  }
	
/*----------------------------------------------------------------------------------*/
private function flash_msg(){//Mensaje Rapido / Mensaje Destello

    if(isset($_SESSION['msg'])) {
      $this->msg = $_SESSION['msg'];
      unset($_SESSION['msg']);
    } else {
      $this->msg;
    }
  }
}//Fin de la clase de Sesion
$session = new Session();
$msg = $session->msg();


