<?php include_once('configuracion/Cargar.php'); ?>
<?php
$req_fields = array('NoDocumento','ClaveUsuario' );
validate_fields($req_fields);
$NoDocumento = remove_junk($_POST['NoDocumento']);
$ClaveUsuario = remove_junk($_POST['ClaveUsuario']);

if(empty($errors)){

    $user = authenticate_v2($NoDocumento, $ClaveUsuario);

    if($user):
        //crear sesion con id
        $session->login($user['id']);
        //actualizar inicio de sesion con tiempo
        updateLastLogIn($user['id']);
        // redirect user to group home page by user level
        if($user['idCargoUsuario'] === '1'):
          $session->msg("s", "Hello ".$user['NoDocumento'].", Welcome to OSWA-INV.");
          redirect('Adminstrador.php',false);
        elseif ($user['idCargoUsuario'] === '2'):
           $session->msg("s", "Hello ".$user['NoDocumento'].", Welcome to OSWA-INV.");
          redirect('JefeInventario.php',false);
        else:
           $session->msg("s", "Hello ".$user['NoDocumento'].", Welcome to OSWA-INV.");
          redirect('Bienvenido.php',false);
        endif;
    else:
        $session->msg("d", "Sorry Username/Password incorrect.");
        redirect('InicioSesion.php',false);
      endif;

} else {

   $session->msg("d", $errors);
   redirect('InicioSesionV2.php',false);
}
?>