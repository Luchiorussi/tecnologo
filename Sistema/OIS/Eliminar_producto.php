<?php
  require_once('configuracion/Cargar.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $product = find_by_id('mobiliarioaula',(int)$_GET['id']);
  if(!$product){
    $session->msg("d","ID vacío");
    redirect('Producto.php');
  }
?>
<?php
  $delete_id = delete_by_id('mobiliarioaula',(int)$product['id']);
  if($delete_id){
      $session->msg("s","Mobiliario eliminado");
      redirect('Producto.php');
  } else {
      $session->msg("d","Se ha producido un error al momento de eliminar el mobiliario");
      redirect('Producto.php');
  }
?>
