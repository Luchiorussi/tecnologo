<?php
  require_once('configuracion/Cargar.php');
  
   page_require_level(1);
?>

<?php
  $delete_id = delete_by_id('usuario',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Usuario eliminado");
      redirect('Usuarios.php');
  } else {
      $session->msg("d","Se ha producido un error en la eliminación del usuario");
      redirect('Usuarios.php');
  }
?>