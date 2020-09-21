<?php
  require_once('configuracion/Cargar.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $aula = find_by_id('aula',(int)$_GET['id']);
  if(!$aula){
    $session->msg("d","ID vacío.");
    redirect('Aulas.php');
  }
?>
<?php
  $delete_id = delete_by_id('aula',(int)$aula['id']);
  if($delete_id){
      $session->msg("s","Aula eliminada.");
      redirect('Aulas.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('Aulas.php');
  }
?>