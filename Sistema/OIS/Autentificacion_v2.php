<?php include_once('configuracion/Cargar.php'); ?>
<?php  
$req_fields = array('NoDocumento','ClaveUsuario' );
validate_fields($req_fields);
$NoDocumento = remove_junk($_POST['NoDocumento']);
$ClaveUsuario = remove_junk($_POST['ClaveUsuario']);


if(empty($errors)){

  $user= authenticate_v2($NoDocumento, $ClaveUsuario);

    if($user):

      // crear sesión con id
      $session->login($user['id']);
      // Actualizar hora de inicio de sesión
      updateLastLogIn($user['id']);
      // redirige al usuario a la página de inicio del grupo por nivel de usuario

      if($user['idCargoUsario'] === '1'):
             $session->msg("s", "Hello ".$user['NoDocumento'].", Welcome to OIS-INV.");
             redirect('Administrador.php',false);
           elseif ($user['idCargoUsario'] === '2'):
              $session->msg("s", "Hello ".$user['NoDocumento'].", Welcome to OIS-INV.");
             redirect('Jefe_Inventario_Menu.php',false);
           else:
              $session->msg("s", "Hello ".$user['NoDocumento'].", Welcome to OIS-INV.");
             redirect('Bienvenido.php',false);
           endif;

        else:
          $session->msg("d", "Perdon Numero de Documento/Contraseña son Incorrectos.");
          redirect('InicioSesion.php',false);
        endif;

  } else {

     $session->msg("d", $errors);
     redirect('InicioSesion_v2.php',false);
  }

?>

