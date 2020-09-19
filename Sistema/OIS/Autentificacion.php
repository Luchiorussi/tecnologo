<?php include_once('configuracion/Cargar.php'); ?>

<?php 
$req_fields = array('NoDocumento','ClaveUsuario' );
validate_fields($req_fields);
$NoDocumento = remove_junk($_POST['NoDocumento']);
$ClaveUsuario= remove_junk($_POST['ClaveUsuario']);

if(empty($errors)){
  $user_id = authenticate($NoDocumento, $ClaveUsuario);
  if($user_id){
    // crear sesión con id
     $session->login($user_id);
   // Actualizar hora de inicio de sesión
     updateLastLogIn($user_id);
     $session->msg("s", "Bienvenido al SISTEMA OIS");
     redirect('Bienvenido.php',false);

  } else {
    $session->msg("d", "Numero de Documento y/o Contraseña son incorrectos.");
    redirect('InicioSesion.php',false);
  }

} else {
   $session->msg("d", $errors);
   redirect('InicioSesion.php',false);
}

?> 