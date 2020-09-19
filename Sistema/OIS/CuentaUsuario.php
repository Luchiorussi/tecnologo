<?php
if(isset($_POST['forgotSubmit'])){
	 //comprobar si el correo electrónico está vacío
    if(!empty($_POST['CorreoElectronico'])){
    // verifica si el usuario existe en la base de datos
    	$prevCon['where'] = array('CorreoElectronico'=>$_POST['CorreoElectronico']);
        $prevCon['return_type'] = 'count';
        $prevUser = $user->getRows($prevCon);
        if($prevUser > 0){

		// cadena única generat
        	$uniqidStr = md5(uniqid(mt_rand()));;

        // actualizar datos con contraseña olvidada
        	$conditions = array(
                'CorreoElectronico' => $_POST['CorreoElectronico']
            );
            $data = array(
                'ClaveUsuario' => $uniqidStr
            );
		
		 $update = $user->update($data, $conditions);


// obtener detalles del usuario
		 if($update){
                $resetPassLink = 'http://OIS.com/ContraseñaOlvidada.php?fp_code='.$uniqidStr;
                $con['where'] = array('CorreoElectronico'=>$_POST['CorreoElectronico']);
                $con['return_type'] = 'single';
                $userDetails = $user->getRows($con);

// enviar restablecer contraseña por correo electrónico

                $to = $userDetails['CorreoElectronico'];
                $subject = "Solicitud de actualización de contraseña";
                $mailContent = 'Querido '.$userDetails['Nombre'].', 
                <br/>Recientemente se envió una solicitud para restablecer una contraseña para su cuenta. Si esto fue un error, simplemente ignore este correo electrónico y no pasará nada.
                <br/>Para restablecer su contraseña, visite el siguiente enlace: <a href="'.$resetPassLink.'">'.$resetPassLink.'</a>
                <br/><br/>Saludos';

                // establecer encabezado de tipo de contenido para enviar correo electrónico HTML
				$headers = "MIME-Version: 1.0" . "rn";
                $headers .= "Content-type:text/html;charset=UTF-8" . "rn";

				// encabezados adicionales
				$headers .= 'From: Tu<[email protected]>' . "rn";					
				//enviar correo electrónico
				mail($to,$subject,$mailContent,$headers);

				$sessData['Estado']['type'] = 'Exito';
                $sessData['Estado']['msg'] = 'Verifique su correo electrónico, hemos enviado un enlace para restablecer la contraseña a su correo electrónico registrado.';
            }else{
                $sessData['Estado']['type'] = 'Error';
                $sessData['Estado']['msg'] = 'Se produjo algún problema, por favor intente nuevamente.';
            }
        }else{
            $sessData['Estado']['type'] = 'error';
            $sessData['Estado']['msg'] = 'El correo electrónico dado no está asociado con ninguna cuenta.'; 
        }
        }else{
        $sessData['Estado']['type'] = 'error';
        $sessData['Estado']['msg'] = 'Ingrese el correo electrónico para crear una nueva contraseña para su cuenta.'; 
    }

// almacenar el estado de restablecimiento de contraseña en la sesión
    $_SESSION['sessData'] = $sessData;

// redirigir a la página de contraseña olvidada
 header("Location:OlvidoContraseña.php");
 }elseif(isset($_POST['resetSubmit'])){
    $fp_code = '';
    if(!empty($_POST['ClaveUsuario']) && !empty($_POST['confirm_password']) && !empty($_POST['fp_code'])){
        $fp_code = $_POST['fp_code'];

// contraseña y confirmar la comparación de contraseña
if($_POST['ClaveUsuario'] !== $_POST['confirm_password']){
            $sessData['Estado']['type'] = 'error';
            $sessData['Estado']['msg'] = 'Confirme que la contraseña debe coincidir con la contraseña.'; 
            }else{         	
// verifica si existe un código de identidad en la base de datos
$prevCon['where'] = array('ClaveUsuario' => $fp_code);
            $prevCon['return_type'] = 'single';
            $prevUser = $user->getRows($prevCon);
            if(!empty($prevUser)){
            		// actualizar datos con nueva contraseña
			$conditions = array(
                    'ClaveUsuario' => $fp_code
                );

			$data = array(
                    'ClaveUsuario' => md5($_POST['ClaveUsuario'])
                );

			$update = $user->update($data, $conditions);
                if($update){
                    $sessData['Estado']['type'] = 'Exito';
                    $sessData['Estado']['msg'] = 'La contraseña de su cuenta se ha restablecido correctamente. Inicia sesión con tu nueva contraseña.';
                }else{
                    $sessData['Estado']['type'] = 'Error';
                    $sessData['Estado']['msg'] = 'Se produjo algún problema, por favor intente nuevamente.';
                }
                }else{
                $sessData['Estado']['type'] = 'Error';
                $sessData['Estado']['msg'] = 'No tiene autorización para restablecer la nueva contraseña de esta cuenta.';
            }
            }
    }else{
        $sessData['Estado']['type'] = 'error';
        $sessData['Estado']['msg'] = 'Todos los campos son obligatorios, complete todos los campos.'; 
    }
// almacenar el estado de restablecimiento de contraseña en la sesión
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['Estado']['type'] == 'success')?'InicioSesion.php':'resetPassword.php?fp_code='.$fp_code;
// redirigir a la página de inicio de sesión / restablecer contraseña
    header("Location:".$redirectURL);
}
