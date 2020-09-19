<?php
  require_once('configuracion/Cargar.php');
  if(!$session->logout()) {redirect("InicioSesion.php");}
?>