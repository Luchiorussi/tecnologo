<?php
  ob_start();
  require_once('configuracion/Cargar.php');
  if($session->isUserLoggedIn(true)) { redirect('Bienvenido.php', false);}
?>
<div class="login-page">
    <div class="text-center">
       <h1>Welcome</h1>
       <p>Sign in to start your session</p>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="auth_v2.php" class="clearfix">
        <div class="form-group">
              <label for="NoDocumento" class="control-label">Usuario</label>
              <input type="name" class="form-control" name="NoDocumento" placeholder="Numero de Documento">
        </div>
        <div class="form-group">
            <label for="ClaveUsuario" class="control-label">Contraseña</label>
            <input type="password" name= "ClaveUsuario" class="form-control" placeholder="Contraseña">
        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-info  pull-right">Login</button>
        </div>
    </form>
</div>
<?php include_once('Disenos/Pie_de_Pagina.php'); ?>
