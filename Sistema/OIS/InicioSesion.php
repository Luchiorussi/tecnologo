<?php
  ob_start();
  require_once('configuracion/Cargar.php');
  if($session->isUserLoggedIn(true)) { redirect('Bienvenido.php', false);}
?>



<?php include_once('Disenos/Encabezado.php'); ?>

<html>
<body >




<div class="login-page" style="background: #0588FC ; align="center"; margin-right: 10px ; "  >

    <div class="text-center">
       <h1 style="font-family: Arial; color: #FFF;">Bienvenido</h1> <!-- Color blanco y letra arial--->
       <img src="Cargas/Usuarios/fondo.png" height="190px" width="200">
       <h1 style="font-family: Arial; color: #FFF;">Iniciar Sesi&oacute;n</h1> <!-- Color blanco y letra arial--->
     </div>
     <?php echo display_msg($msg); ?>

     <form method="post" action="Autentificacion.php" class="clearfix">
        <div class="form-group">
              <label for="NoDocumento" class="control-label" style="color: #FFF; font-family: Arial;">Usuario</label>
              <input type="name" class="form-control" name="NoDocumento" placeholder="Numero de Documento">
        </div>
      
        <div class="form-group">
            <label for="ClaveUsuario" class="control-label" style="color: #FFF; font-family: Arial;">Contraseña</label>
            <input type="password" name= "ClaveUsuario" class="form-control" placeholder="Contraseña">
        </div>

        <div class="panel-heading">
						<div style="float:right; font-size: 110%; position: relative; color:#FFF; top:-10px;"><a href="recuperar/olvidocontrasena.php">¿Se te olvid&oacute; tu contraseña?</a></div>
					</div>

        <div class="form-group">
                <br>
                <br>
                <button type="submit" style="margin-right: 120px" class="btn btn-info  pull-right">Entrar</button>
                <br>
                <br>
        </div>
        </form>
</div>


  
</body>
</html>
<?php include_once('Disenos/Pie_de_Pagina.php'); ?>